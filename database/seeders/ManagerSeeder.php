<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Seed 50 fake manager records
        foreach (range(1, 5) as $index) {
            DB::table('managers')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'role' => $faker->randomElement(['Editor', 'Administrator']),
                'status' => $faker->randomElement(['Pending', 'Active', 'Disabled']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
