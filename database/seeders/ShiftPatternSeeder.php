<?php

namespace Database\Seeders;

use App\Models\ShiftPattern;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftPatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShiftPattern::create([
            'name' => 'A',
            'start_time' => '09:00',
            'end_time' => '18:00',
        ]);

        ShiftPattern::create([
            'name' => 'B',
            'start_time' => '10:00',
            'end_time' => '19:00',
        ]);
    }
}
