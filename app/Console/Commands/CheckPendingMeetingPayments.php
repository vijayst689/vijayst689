<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CheckPendingMeetingPayments extends Command
{
    protected $signature = 'meeting:check-pending';
    protected $description = 'Check pending meeting payments and update status safely';

    public function handle()
    {
        $this->info('Checking pending payments...');

        $pendingOrders = DB::table('meetingpayment')
             ->whereIn('status', ['PENDING'])
            ->get();

        foreach ($pendingOrders as $order) {

            // 🔒 Validate date & time
            if (!$order->req_date || !$order->req_time) {
                continue;
            }

            // 🔹 Combine DATE + TIME
            $reqDateTime = Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $order->req_date . ' ' . $order->req_time
            );

            $ageMinutes = $reqDateTime->diffInMinutes(now());

            // 🔹 QR still active / buffer window
            if ($ageMinutes < 10) {
                continue;
            }

            // 🔹 Call gateway
            $response = Http::asForm()->post(
                'https://api.ditacore.com/api/check-order-status',
                [
                    'user_token' => config('services.ditasol.token'),
                    'order_id'   => $order->order_id
                ]
            );

            if (!$response->successful()) {
                Log::warning('Payment status API failed', [
                    'order_id' => $order->order_id
                ]);
                continue;
            }

            $data = $response->json();
            $gatewayStatus = $data['result']['status'] ?? 'PENDING';
            $utr = $data['result']['utr'] ?? null;
            $amount = $data['result']['amount'] ?? $order->amount;

            DB::beginTransaction();

            try {

                // 🔹 SUCCESS
                if ($gatewayStatus === 'SUCCESS') {
                    DB::table('meetingpayment')
                        ->where('id', $order->id)
                        ->update([
                            'status'          => 'SUCCESS',
                            'transaction_id'  => $utr,
                            'updated_at'      => now()
                        ]);

                         DB::table('meetingdetails')
                        ->where('user_id', $order->user_id)->where('meetingid', $order->meeting_id)
                        ->update([
                            'paymentstatus'          => 'SUCCESS',
                            'updated_at'      => now()
                        ]);


                    DB::commit();
                    continue;
                }

                // 🔹 FAILED (expired + not success)
                DB::table('meetingpayment')
                    ->where('id', $order->id)
                    ->update([
                        'status'     => 'FAILED',
                        'updated_at' => now()
                    ]);

                    DB::table('meetingdetails')
                        ->where('user_id', $order->user_id)->where('meetingid', $order->meeting_id)
                        ->update([
                            'paymentstatus'          => 'FAILED',
                            'updated_at'      => now()
                        ]);

                DB::commit();

            } catch (\Exception $e) {

                DB::rollBack();
                Log::error('Cron payment error', [
                    'order_id' => $order->order_id,
                    'error'    => $e->getMessage()
                ]);
            }
        }

        $this->info('Meeting Pending payment check completed.');
    }
}
