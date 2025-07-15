<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

//        \App\Models\Student::truncate();


        $faker = Faker::create();


        foreach (range(1, 100) as $i) {
            Student::create([
                'first_name'  => $faker->firstName,
                'last_name'   => $faker->lastName,
                'phone'       => '+998' . $faker->numerify('9########'),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
