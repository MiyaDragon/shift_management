<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'position_id' => 1, // SV
            'name' => '山田 花子',
            'email' => 'yamada@hanako.com',
            'email_verified_at' => now(),
            'telephone_number' => '08012345678',
            'password' => Hash::make('password'),
            'prescribed' => 5 // 所定5
        ]);

        User::factory(9)->create(
            [
                'position_id' => 2, // OP
            ]
        );
    }
}
