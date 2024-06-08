<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $departments = DB::table('departments')->pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            DB::table('transactions')->insert([
                'department_id' => $faker->randomElement($departments),
                'transaction_type' => $faker->randomElement(['Inquiry', 'Payment', 'Enrollment', 'Record Update']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
