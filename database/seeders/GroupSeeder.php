<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::insert([
            [
                'name' => 'Sevara Beginner 1',
                'start_time' => '08:01:00',
                'attendance_taken' => true,
                'students_count' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jasur Elementary 2',
                'start_time' => '09:30:00',
                'attendance_taken' => false,
                'students_count' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dilnoza Intermediate A',
                'start_time' => '11:15:00',
                'attendance_taken' => true,
                'students_count' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Begzod Pre-Intermediate',
                'start_time' => '13:00:00',
                'attendance_taken' => false,
                'students_count' => 22,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gulnora Advanced 1',
                'start_time' => '14:30:00',
                'attendance_taken' => true,
                'students_count' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aziza IELTS Prep',
                'start_time' => '16:00:00',
                'attendance_taken' => false,
                'students_count' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rustam Evening Group',
                'start_time' => '18:00:00',
                'attendance_taken' => true,
                'students_count' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
