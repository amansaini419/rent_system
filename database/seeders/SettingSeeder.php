<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $objs = [
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
                'value' => '&lt;h1&gt;TERMS&amp;nbsp;&amp;amp;&amp;nbsp;CONDITION&lt;/h1&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;This&amp;nbsp;is&amp;nbsp;the&amp;nbsp;dummy&amp;nbsp;terms&amp;nbsp;and&amp;nbsp;conditions.&amp;nbsp;Ignore&amp;nbsp;it.&lt;/p&gt;',
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
        ];

        foreach($objs as $obj)
        {
            Setting::create($obj);
        }
    }
}
