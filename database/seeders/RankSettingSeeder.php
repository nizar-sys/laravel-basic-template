<?php

namespace Database\Seeders;

use App\Models\RankSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ranks = [
            [
                'name' => 'Bronze',
                'grade' => 1,
                'percentage' => 25,
            ],
            [
                'name' => 'Silver',
                'grade' => 2,
                'percentage' => 30,
            ],
            [
                'name' => 'Gold',
                'grade' => 3,
                'percentage' => 35,
            ],
            [
                'name' => 'Platinum',
                'grade' => 4,
                'percentage' => 40,
            ],
            [
                'name' => 'Diamond',
                'grade' => 5,
                'percentage' => 45,
            ],
            [
                'name' => 'Crown',
                'grade' => 6,
                'percentage' => 50,
            ],
        ];

        RankSetting::insert($ranks);
    }
}
