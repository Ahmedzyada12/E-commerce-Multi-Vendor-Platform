<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
                [
                'name' => 'admin',
                 'email'=> 'admin@example.com',
                 'password'=> bcrypt('admin12345'),
                 'role_id'=> 1
                ]);

                User::create(
                    [
                    'name' => 'user',
                     'email'=> 'user@example.com',
                     'password'=> bcrypt('user12345'),
                     'role_id'=> 2
                    ]);
    }
}