<?php

namespace Database\Seeders;

use App\Models\Workday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkdaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Workday::create([
            'user_id' => 1,
            'shift_id' => 1,
            'shift_pattern_id' => 1,
            'workday' => 1
        ]);

        Workday::create([
            'user_id' => 1,
            'shift_id' => 1,
            'shift_pattern_id' => 1,
            'workday' => 2
        ]);

        Workday::create([
            'user_id' => 1,
            'shift_id' => 1,
            'shift_pattern_id' => 1,
            'workday' => 3
        ]);

        Workday::create([
            'user_id' => 2,
            'shift_id' => 1,
            'shift_pattern_id' => 1,
            'workday' => 1
        ]);

        Workday::create([
            'user_id' => 1,
            'shift_id' => 2,
            'shift_pattern_id' => 1,
            'workday' => 1
        ]);

        Workday::create([
            'user_id' => 1,
            'shift_id' => 2,
            'shift_pattern_id' => 1,
            'workday' => 2
        ]);
    }
}
