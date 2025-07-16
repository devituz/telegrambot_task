<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendancesSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();

        if ($students->isEmpty()) {
            $this->command->warn('Studentlar topilmadi. Iltimos, avval studentlarni yarating.');
            return;
        }

        foreach ($students as $student) {
            foreach (range(1, 5) as $i) {
                DB::table('attendances')->insert([
                    'student_id' => $student->id,
                    'date' => Carbon::now()->subDays(rand(0, 15))->format('Y-m-d'),
                    'status' => rand(0, 1),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
