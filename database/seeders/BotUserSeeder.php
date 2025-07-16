<?php

namespace Database\Seeders;

use App\Models\BotUser;
use Illuminate\Database\Seeder;

class BotUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        \App\Models\Student::truncate();

        BotUser::insert([
            [
                'first_name' => 'Shohbozbek',
                'last_name' => 'Turgunov',
                'phone' => '+998889442402',
                'username' => 'devit_uz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ali',
                'last_name' => 'Valiyev',
                'phone' => '+998952798899',
                'username' => 'nrishi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Shaxzodbek ',
                'last_name' => 'Qambaraliyev',
                'phone' => '+998908212776',
                'username' => 'shaxzodbekQ1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
