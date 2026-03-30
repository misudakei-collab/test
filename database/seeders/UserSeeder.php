<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => '管理者',
            'email' => 'mi.su.da.kei@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
