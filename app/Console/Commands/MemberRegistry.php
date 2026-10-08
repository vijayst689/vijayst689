<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class MemberRegistry extends Command
{
    protected $signature = 'generate:member-registry';

    protected $description = 'Generate Member IDs';

    public function handle()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);

        $year = 2024;

        $usersCount = DB::table('users')
            ->where('verified', 1)
            ->whereNull('member_id')
            ->count();

        $customersCount = DB::table('nalavariyam_customer')
            ->whereNull('member_id')
            ->count();

        $totalCount = $usersCount + $customersCount;

        if ($totalCount == 0) {
            $this->info('No records found');
            return;
        }

        $response = Http::post(
            'https://erp.nalavariyam.org/api/member-registry/generate',
            [
                'count' => $totalCount,
                'year'  => $year
            ]
        );

        if (!$response->successful()) {
            $this->error('API Failed');
            return;
        }

        $memberIds = $response->json()['data'];

        $index = 0;

        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */
        DB::table('users')
            ->where('verified', 1)
            ->whereNull('member_id')
            ->orderBy('id')
            ->chunk(1000, function ($rows) use (&$memberIds, &$index) {

                $registryRows = [];

                foreach ($rows as $row) {

                    $member = $memberIds[$index];

                    DB::table('users')
                        ->where('id', $row->id)
                        ->update([
                            'member_id' => $member['member_id']
                        ]);

                   $registryRows[] = [
    'member_id'   => $member['member_id'],
    'sequence_no' => $member['sequence_no'],
    'user_id'     => $row->id,
    'customer_id' => null,
];

                    $index++;
                }

                if (!empty($registryRows)) {

                  $response =   Http::post(
                        'https://erp.nalavariyam.org/api/member-registry/store',
                        [
                            'rows' => $registryRows
                        ]
                    );
                }
            });

        /*
        |--------------------------------------------------------------------------
        | CUSTOMERS
        |--------------------------------------------------------------------------
        */
        DB::table('nalavariyam_customer')
            ->whereNull('member_id')
            ->orderBy('id')
            ->chunk(1000, function ($rows) use (&$memberIds, &$index) {

                $registryRows = [];

                foreach ($rows as $row) {

                    $member = $memberIds[$index];

                    DB::table('nalavariyam_customer')
                        ->where('id', $row->id)
                        ->update([
                            'member_id' => $member['member_id']
                        ]);

                  
                    $registryRows[] = [
    'member_id'   => $member['member_id'],
    'sequence_no' => $member['sequence_no'],
    'user_id'     => null,
    'customer_id' => $row->id,
];

                    $index++;
                }

                if (!empty($registryRows)) {

                    Http::post(
                        'https://erp.nalavariyam.org/api/member-registry/store',
                        [
                            'rows' => $registryRows
                        ]
                    );
                }
            });

        $this->info('Completed Successfully');
    }
}