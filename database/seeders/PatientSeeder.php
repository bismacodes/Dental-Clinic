<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {

            DB::table('patients')->insert([
                'firstname' => $faker->firstName,
                'surname' => $faker->lastName,
                'othername' => $faker->optional()->firstName,
                'gender' => $faker->randomElement(['male', 'female', 'other']),
                'blood_group' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
                'date_of_birth' => $faker->date('Y-m-d', '2005-01-01'),
                'phone_no' => $faker->phoneNumber,
                'relative_phone_no' => $faker->phoneNumber,
                'address' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
