<?php

namespace Database\Seeders;

use App\Models\AccountGroups;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'refferal_code' => rand(100000, 999999),
                'leader_account_id' => 1,
            ],
            [
                'refferal_code' => rand(100000, 999999),
                'leader_account_id' => 2,
            ],
            [
                'refferal_code' => rand(100000, 999999),
                'leader_account_id' => 11,
            ],
            [
                'refferal_code' => rand(100000, 999999),
                'leader_account_id' => 12,
            ],
        ];

        AccountGroups::insert($groups);
    }
}
