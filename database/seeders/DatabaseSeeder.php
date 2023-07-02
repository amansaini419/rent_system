<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Setting;
use App\Models\Users;
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
                'value' => '&lt;h1&gt;TERMS&amp;nbsp;&amp;amp;&amp;nbsp;CONDITION&lt;/h1&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;This&amp;nbsp;is&amp;nbsp;the&amp;nbsp;dummy&amp;nbsp;terms&amp;nbsp;and&amp;nbsp;conditions.&amp;nbsp;Ignore&amp;nbsp;it.&lt;/p&gt;',
            ],
            [
                'setting' => 'RESET_PASSWORD_TOKEN_EXPIRY',
                'value' => '123456',
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
                'setting' => 'SECOND_PENALTY_PER',
                'value' => '10',
            ],
            [
                'setting' => 'ANNUAL_INTEREST_RATE',
                'value' => '22',
            ],
        ]);

        Users::create([
            'name' => 'ADMIN',
            'email' => 'admin@email.com',
            'password' => '123456',
            'country_code' => '+91',
            'phone_number' => '987654321',
            'user_type' => 'ADMIN',
        ]);
    }
}
