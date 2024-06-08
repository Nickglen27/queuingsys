<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('students')->insert([
                'stud_id' => Str::random(10),
                'Firstname' => $faker->firstName,
                'Middlename' => $faker->optional()->firstName,
                'Lastname' => $faker->lastName,
                'Grade' => $faker->numberBetween(1, 12),
                'Section' => Str::random(1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
