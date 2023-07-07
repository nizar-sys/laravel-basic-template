<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class TreeviewController extends Controller
{
    public function index()
    {
        $parentId = request('parent_id');

        $accounts = Account::with(['rank', 'accountGroup'])
            ->when($parentId, function ($query) use ($parentId) {
                $query->where('id', $parentId)
                    ->orWhereDescendantOf($parentId);
            })
            ->get()
            ->toTree();

        $accountsData = [];

        foreach ($accounts as $account) {
            $accountsData[] = $this->formatAccountData($account);
        }

        print_r(count($accountsData));

        dd($accountsData);
    }

    private function formatAccountData($account)
    {
        $formattedData = [
            'id' => $account->id,
            'parent_id' => $account->parent_id,
            'rank' => $account->rank->name,
            'refferal_code' => $account->accountGroup->refferal_code,
            'login' => $account->login,
            'member_name' => $account->member_name,
            'mobile_number' => $account->mobile_number,
            'email' => $account->email,
            'children' => []
        ];

        foreach ($account->children as $child) {
            $formattedData['children'][] = $this->formatAccountData($child);
        }

        return $formattedData;
    }
}
