<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Group;
use App\Models\Student;

class GroupStudentSeeder extends Seeder
{
    public function run(): void
    {
        $groupIds = Group::pluck('id')->toArray();
        $studentIds = Student::pluck('id')->toArray();

        if (empty($groupIds) || empty($studentIds)) {
            $this->command->warn('Group yoki Student topilmadi.');
            return;
        }

        foreach ($studentIds as $studentId) {
            $randomGroupIds = collect($groupIds)->random(rand(1, 3))->toArray();

            foreach ($randomGroupIds as $groupId) {
                DB::table('group_student')->insertOrIgnore([
                    'student_id' => $studentId,
                    'group_id' => $groupId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
