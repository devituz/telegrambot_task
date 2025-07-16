<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use App\Models\GroupStudent;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (GroupStudent::all() as $groupStudent) {
            foreach (range(1, rand(1, 3)) as $i) {
                Evaluation::create([
                    'group_student_id' => $groupStudent->id,
                    'score' => $faker->numberBetween(1, 5),
                    'desc' => $faker->optional()->sentence,
                    'date' => $faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
