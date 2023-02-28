<?php

namespace Database\Factories;

use App\Models\Shift;
use App\Models\ShiftPattern;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workday>
 */
class WorkdayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, User::count()),
            'shift_id' => rand(1, Shift::count()),
            'shift_pattern_id' => rand(1, ShiftPattern::count()),
            'workday' => fake()->numberBetween(1, 28)
        ];
    }
}
