<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NalavariyamOnlinePaymentController extends Controller
{
    /**
     * STEP 1: Create Order & Redirect to Gateway
     */

    public function create(Request $request)
    {
        // ✅ SERVER SIDE VALIDATION
        $request->validate(
            [
                'amount' => 'required|numeric|min:1',
            ],
            [
                'amount.min'      => 'Minimum wallet topup amount is 50',
                'amount.required' => 'Please enter amount',
                'amount.numeric'  => 'Amount must be a number',
            ]
        );
        $userId = auth()->id();
        $amount = $request->amount;
        $mobile = $request->mobile;

        // ✅ UNIQUE ORDER ID
        $orderId = 'ORD' . time() . rand(1000, 9999);

        // // ✅ SAVE ORDER (QUERY BUILDER)
        // DB::table('orders')->insert([
        //     'order_id'   => $orderId,
        //     'user_id'    => $userId,
        //     'mobile'     => $mobile,
        //     'amount'     => $amount,
        //     'status'     => 'PENDING',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        DB::table('wallet_topup_nalavariyam')->insert([
            'order_id' => $orderId,
            'user_id'  => $userId,
            'payment'  => $request->amount,
            'status'   => 'PENDING',
            'date'     => date("Y-m-d H:i:s"),
        ]);
        $returnUrl = route('nalavariyamonline.return', ['order_id' => $orderId]);

        // ✅ GATEWAY PAYLOAD
        $payload = [
            'customer_mobile' => $mobile,
            'user_token'      => config('services.ditasol_ra.token'),
            'amount'          => $amount,
            'order_id'        => $orderId,
            'redirect_url'    => $returnUrl,
            'remark1'         => 'RAWallet Topup',
            'remark2'         => $userId,
        ];
        // ✅ CREATE ORDER API CALL
        $response = Http::asForm()->post(
            'https://api.ditacore.com/api/create-order',
            $payload
        );
        $data = $response->json();

        Log::info('Ditasol Create Order', $data);

// ✅ REDIRECT TO PAYMENT PAGE
        if ($response->successful() && isset($data['result']['payment_url'])) {
            session(['payment_order_id' => $orderId]);
            return redirect($data['result']['payment_url']);
        }
        //❌ FAILURE
        DB::table('wallet_topup_nalavariyam')
            ->where('order_id', $orderId)
            ->update([
                'status'     => 'FAILED',
                'updated_at' => now(),
            ]);

        return back()->with('error', 'Unable to initiate payment');
    }

    /**
     * STEP 2: Return URL → Verify Payment
     */
    public function return (Request $request, $order_id)
    {
        Log::info('Payment return hit', [
            'order_id' => $order_id,
            'query'    => $request->query(),
        ]);

        DB::beginTransaction();

        try {
            // 🔒 LOCK ORDER ROW (CRITICAL)
            $order = DB::table('wallet_topup_nalavariyam')
                ->where('order_id', $order_id)
                ->lockForUpdate()
                ->first();

            if (! $order) {
                DB::rollBack();
                Log::error('Order not found wefdgdg', ['order_id' => $order_id]);
                abort(404, 'Invalid Order');
            }

            // 🔒 STOP if already processed
            if ($order->status === 'SUCCESS') {
                DB::commit();
                Log::info('Order already SUCCESS', ['order_id' => $order_id]);
                return redirect()->route('nalavariyamonline.success', $order_id);
            }

            // 🔹 CALL DITASOL STATUS API (SOURCE OF TRUTH)
            $response = Http::asForm()->post(
                'https://api.ditacore.com/api/check-order-status',
                [
                    'user_token' => config('services.ditasol_ra.token'),
                    'order_id'   => $order_id,
                ]
            );

            if (! $response->successful()) {
                DB::rollBack();
                Log::error('Gateway API failed', ['order_id' => $order_id]);
                return redirect()->route('nalavariyamonline.failed', $order_id);
            }

            $data = $response->json();
            Log::info('Ditasol status response', $data);

            /**
             * 🔒 NORMALIZE STATUS (VERY IMPORTANT)
             * Gateway may return SUCCESS / COMPLETED
             */
            $rawStatus = strtoupper($data['result']['status'] ?? '');
            $txnStatus = in_array($rawStatus, ['SUCCESS', 'COMPLETED'])
                ? 'SUCCESS'
                : 'FAILED';

            $txnAmount = (float) ($data['result']['amount'] ?? $order->payment);
            $txnUtr    = $data['result']['utr'] ?? null;

            // 🔹 UPDATE ORDER TABLE
            DB::table('wallet_topup_nalavariyam')
                ->where('order_id', $order_id)
                ->update([
                    'status'         => $txnStatus, // ONLY SUCCESS / FAILED
                    'transaction_id' => $txnUtr,
                    'updated_at'     => now(),
                ]);

            // 🔹 CREDIT WALLET ONLY ON SUCCESS
            if ($txnStatus === 'SUCCESS') {

                DB::table('users')
                    ->where('id', $order->user_id)
                    ->increment('nalavariyamwallet', $txnAmount);

                $newBalance = DB::table('users')
                    ->where('id', $order->user_id)
                    ->value('nalavariyamwallet');

                // 🔹 PAYMENT LOG (SAFE IF transaction_id IS UNIQUE)

                DB::table('nalavariyampayment')->insert([
                    'log_id'         => $order->user_id,
                    'from_id'        => 1,
                    'to_id'          => 2, // fixed value
                    'amount'         => $txnAmount,
                    'ad_info'        => 'NaWallet Topup',
                    'service_status' => 'IN Payment',
                    'time'           => now()->format('H:i:s'),
                    'paydate'        => now()->format('Y-m-d'),
                    'pay_id'         => $order->user_id,
                    'newbalance'     => $newBalance,
                ]);

            }

            DB::commit();

            return $txnStatus === 'SUCCESS'
                ? redirect()->route('nalavariyamonline.success', $order_id)
                : redirect()->route('nalavariyamonline.failed', $order_id);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Payment return exception', [
                'order_id' => $order_id,
                'error'    => $e->getMessage(),
            ]);
            return redirect()->route('nalavariyamonline.failed', $order_id);
        }
    }

    private function getOrder($order_id)
    {
        $order = DB::table('wallet_topup_nalavariyam')
            ->where('order_id', $order_id)
            ->first();

        if (! $order) {
            abort(404, $order);
        }

        return $order;
    }

    public function success($order_id)
    {
        $order = $this->getOrder($order_id);
        return view('nalavariyampayment.nalavariyamsuccess', compact('order'));
    }

    public function failed($order_id)
    {
        $order = $this->getOrder($order_id);
        return view('nalavariyampayment.nalavariyamfailed', compact('order'));
    }
}
