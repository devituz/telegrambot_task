<?php

namespace Database\Seeders;

use App\Models\Debt;
use App\Models\GroupStudent;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DebtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $groupStudents = GroupStudent::all();

        if ($groupStudents->isEmpty()) {
            $this->command->info('No GroupStudent records found. Skipping Debt seeding.');
            return;
        }

        foreach ($groupStudents as $groupStudent) {
            Debt::create([
                'group_student_id' => $groupStudent->id,
                'debt' => $faker->numberBetween(100_000, 1_000_000),
                'is_active' => $faker->boolean(80),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
