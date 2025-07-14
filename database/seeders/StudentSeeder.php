<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::insert([
            [
                'first_name' => 'Saidxon',
                'last_name' => 'Zarifjonov',
                'phone' => '+998884086612',
                'debt' => 250000,
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Kozimjon',
                'last_name' => 'Hamroqulov',
                'phone' => '+998333435503',
                'debt' => 250000,
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Begzod',
                'last_name' => 'Abdusamiyev',
                'phone' => '+998939901424',
                'debt' => 250000,
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],   [
                'first_name' => 'Begzod',
                'last_name' => 'Abdusamiyev',
                'phone' => '+998939901424',
                'debt' => 250000,
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
