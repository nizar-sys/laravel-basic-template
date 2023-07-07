<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trxs = [
            [
                'account_id' => 15,
                'profit' => 100 //usdt
            ]
        ];

        Transaction::insert($trxs);
    }
}
