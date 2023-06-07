<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Setting::insert([
            [
                'setting' => 'OTP_EXPIRY_TIME',
                'value' => '5',
            ],
            [
                'setting' => 'REGISTRATION_FEES',
                'value' => '50',
            ],
            [
                'setting' => 'TNC',
                'value' => '50',
            ],
            [
                'setting' => 'RESET_PASSWORD_TOKEN_EXPIRY',
                'value' => '15',
            ],
            [
                'setting' => 'FIRST_PENALTY_DAY',
                'value' => '4',
            ],
            [
                'setting' => 'FIRST_PENALTY_PER',
                'value' => '5',
            ],
            [
                'setting' => 'SECOND_PENALTY_DAY',
                'value' => '9',
            ],
            [
                'setting' => 'SECONDA_PENALTY_PER',
                'value' => '10',
            ],
        ]);
    }
}
