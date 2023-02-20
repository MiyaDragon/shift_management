<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminUser::create([
            'name' => '管理者 太郎',
            'email' => 'admin@admin.com',
            'telephone_number' => '090-1234-5678',
            'password' => Hash::make('password'),
        ]);

        AdminUser::factory(2)->create();
    }
}
