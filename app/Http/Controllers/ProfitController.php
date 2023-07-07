<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CommissionDetail;
use App\Models\Transaction;

class ProfitController extends Controller
{
    public function index()
    {
        $transaction = Transaction::orderByDesc('id')
            ->with('account.rank')
            ->first();

        $transactionsData = [
            'parent_id' => $transaction->account->parent_id,
            'member_name' => $transaction->account->member_name,
            'account_id' => $transaction->account_id,
            'profit' => $transaction->profit,
            'rank_percentage' => $transaction->account->rank->percentage,
            'table' => 'transactions'
        ];

        $parentId = $transactionsData['parent_id'];

        $uplines = $this->findAncestors($parentId);

        $commissionDetails = [];
        $previousPercentage = 0;

        foreach ($uplines as $upline) {
            $commission = $this->calculateCommission($upline, $transactionsData, $previousPercentage);
            $previousPercentage = $upline['rank_percentage'];
            $commissionDetails[] = $commission;
        }

        CommissionDetail::insert($commissionDetails);

        return response()->json([
            'message' => 'success',
            'data' => [
                'transactions' => $transactionsData,
                'commission_details' => $commissionDetails,
            ]
        ]);
    }

    private function findAncestors($parentId)
    {
        $accounts = Account::with(['rank', 'accountGroup'])
            ->when($parentId, function ($query) use ($parentId) {
                $query->ancestorsOf($parentId);
            })
            ->get()
            ->reverse();

        $uplines = [];

        foreach ($accounts as $account) {
            $uplines[] = [
                'id' => $account->id,
                'rank' => $account->rank->name,
                'rank_percentage' => $account->rank->percentage,
                'login' => $account->login,
                'member_name' => $account->member_name,
            ];
        }

        return $uplines;
    }

    private function calculateCommission($upline, $transactionData, $previousPercentage)
    {
        $fuelcharge = $transactionData['profit'] * 0.2; // 20% dari profit
        $realPercentage = $upline['rank_percentage'] - $previousPercentage;

        $commission = [
            'account_id' => $upline['id'],
            'account_from_id' => $transactionData['account_id'],
            'fuelcharge' => $fuelcharge,
            'commission' => $fuelcharge * $realPercentage / 100,
            'percentage' => $realPercentage,
        ];

        return $commission;
    }
}
