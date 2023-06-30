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
                'name' => 'TENANT',
                'email' => 'tenant@email.com',
                'password' => '123456',
                'country_code' => '+91',
                'phone_number' => '9977340300',
                'user_type' => 'TENANT',
            ],
            [
                'name' => 'STAFF',
                'email' => 'staff@email.com',
                'password' => '123456',
                'country_code' => '+91',
                'phone_number' => '987654321',
                'user_type' => 'STAFF',
            ],
            [
                'name' => 'AGENT',
                'email' => 'agent@email.com',
                'password' => '123456',
                'country_code' => '+91',
                'phone_number' => '987654321',
                'user_type' => 'AGENT',
            ],
            [
                'name' => 'ADMIN',
                'email' => 'admin@email.com',
                'password' => '123456',
                'country_code' => '+91',
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
