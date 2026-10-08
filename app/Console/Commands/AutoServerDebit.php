<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AutoServerDebit extends Command
{
    protected $signature = 'server:auto-debit';
    protected $description = 'Auto debit server amount from RA wallet on 4th';

    public function handle()
    {
        $today = Carbon::today();

        // ✅ Check already debited this month
        $alreadyPaid = DB::table('ramji_payment')
            ->where('to_id', 2)
            ->whereYear('paydate', $today->year)
            ->whereMonth('paydate', $today->month)
            ->where('message', 'SERVER_AUTO_DEBIT')
            ->exists();

        if ($alreadyPaid) {
            $this->info('Already debited this month.');
            return;
        }

        // ✅ Run only on 4th
        if ($today->day != 4) {
            $this->info('Not 4th. Skipping.');
            return;
        }

        $user = DB::table('users')->where('id', 2)->lockForUpdate()->first();

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $amount = $user->server_amount ?? 0;

        if ($amount <= 0) {
            $this->warn('Server amount is zero.');
            return;
        }

        DB::transaction(function () use ($user, $amount, $today) {

            // 🔹 Deduct from RA wallet
            DB::table('users')
                ->where('id', $user->id)
                ->decrement('rawallet', $amount);

            // 🔹 Get updated balance
            $newBalance = DB::table('users')
                ->where('id', $user->id)
                ->value('rawallet');

            // 🔹 Update next payment date (next 4th)
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'payment_date' => Carbon::now()
                        ->addMonth()
                        ->startOfMonth()
                        ->addDays(3),
                    'updated_at' => now()
                ]);

            // 🔹 Insert payment history
            DB::table('ramji_payment')->insert([
                'from_id'        => 1,
                'to_id'          => $user->id,
                'amount'         => $amount,
                'newbalance'     => $newBalance,
                'service_status' => 'Out Payment',
                'message'        => 'SERVER_AUTO_DEBIT',
                'ad_info'        => 'Server Payment Auto Debit on 4th of ' . $today->format('F Y'),
                'paydate'        => $today->format('Y-m-d'),
                'time'           => now()->format('H:i:s'),
            ]);
        });

        $this->info("Server amount debited successfully from User ID: {$user->id}");
    }
}