<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'tenant@email.com',
                'password' => bcrypt('123456'),
                'phone_number' => '987654321',
                'user_type' => 'TENANT',
            ],
            [
                'email' => 'staff@email.com',
                'password' => bcrypt('123456'),
                'phone_number' => '987654321',
                'user_type' => 'STAFF',
            ],
            [
                'email' => 'agent@email.com',
                'password' => bcrypt('123456'),
                'phone_number' => '987654321',
                'user_type' => 'AGENT',
            ],
            [
                'email' => 'admin@email.com',
                'password' => bcrypt('123456'),
                'phone_number' => '987654321',
                'user_type' => 'ADMIN',
            ],
        ];

        foreach($users as $user)
        {
            Users::create($user);
        }
    }
}
