<?php

namespace Database\Seeders;

use App\Models\BotUser;
use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

//        \App\Models\Student::truncate();


        $faker = \Faker\Factory::create();

        $botUserIds = BotUser::pluck('id')->toArray();

        if (empty($botUserIds)) {
            $this->command->warn('Bot users topilmadi. Iltimos, avval BotUserSeeder ishga tushiring.');
            return;
        }

        foreach (range(1, 10) as $i) {
            Group::create([
                'bot_user_id' => $faker->randomElement($botUserIds),
                'name' => $faker->words(3, true),
                'start_time' => $faker->time('H:i:s'),
                'end_time' => $faker->time('H:i:s'),
                'active' => $faker->boolean(90),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
