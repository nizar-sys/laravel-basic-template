<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    public function run()
    {
        $accounts = [
            [
                'rank_id' => 3, // gold
                'account_group_id' => 1,
                'login' => rand(100000, 999999),
                'member_name' => fake()->name,
                'mobile_number' => fake()->phoneNumber,
                'email' => fake()->email,
                'children' => [
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 1,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                        'children' => [
                            [
                                'rank_id' => 1, // bronze
                                'account_group_id' => 2,
                                'login' => rand(100000, 999999),
                                'member_name' => fake()->name,
                                'mobile_number' => fake()->phoneNumber,
                                'email' => fake()->email,
                            ],
                            [
                                'rank_id' => 1, // bronze
                                'account_group_id' => 2,
                                'login' => rand(100000, 999999),
                                'member_name' => fake()->name,
                                'mobile_number' => fake()->phoneNumber,
                                'email' => fake()->email,
                            ],
                        ]
                    ],
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 1,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 1,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 1,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 1,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 1, // bronze
                        'account_group_id' => 1,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 1, // bronze
                        'account_group_id' => 1,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                ],
            ],

            [
                'rank_id' => 3, // gold
                'account_group_id' => 3,
                'login' => rand(100000, 999999),
                'member_name' => fake()->name,
                'mobile_number' => fake()->phoneNumber,
                'email' => fake()->email,
                'children' => [
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 3,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                        'children' => [
                            [
                                'rank_id' => 1, // bronze
                                'account_group_id' => 4,
                                'login' => rand(100000, 999999),
                                'member_name' => fake()->name,
                                'mobile_number' => fake()->phoneNumber,
                                'email' => fake()->email,
                            ],
                            [
                                'rank_id' => 1, // bronze
                                'account_group_id' => 4,
                                'login' => rand(100000, 999999),
                                'member_name' => fake()->name,
                                'mobile_number' => fake()->phoneNumber,
                                'email' => fake()->email,
                            ],
                        ]
                    ],
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 3,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 3,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 3,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 2, // silver
                        'account_group_id' => 3,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 1, // bronze
                        'account_group_id' => 3,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                    [
                        'rank_id' => 1, // bronze
                        'account_group_id' => 3,
                        'login' => rand(100000, 999999),
                        'member_name' => fake()->name,
                        'mobile_number' => fake()->phoneNumber,
                        'email' => fake()->email,
                    ],
                ],
            ],
        ];

        foreach ($accounts as $accountData) {
            $this->createAccount($accountData);
        }
    }

    private function createAccount($accountData, $parent = null)
    {
        $account = new Account([
            'rank_id' => $accountData['rank_id'],
            'account_group_id' => $accountData['account_group_id'],
            'login' => $accountData['login'],
            'member_name' => $accountData['member_name'],
            'mobile_number' => $accountData['mobile_number'],
            'email' => $accountData['email'],
        ]);

        if ($parent) {
            $account->appendToNode($parent)->save();
        } else {
            $account->save();
        }

        if (isset($accountData['children'])) {
            foreach ($accountData['children'] as $childAccountData) {
                $this->createAccount($childAccountData, $account);
            }
        }
    }
}
