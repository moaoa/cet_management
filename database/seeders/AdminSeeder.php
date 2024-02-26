<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;



class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $names = [
            'محمد',
        ];


        foreach ($names as $name) {
            $faker = Faker::create();

            Admin::create([
                'name' => $name,
                'ref_number' => 1111,                 'phone_number' => $faker->phoneNumber(),
                'password' =>  Hash::make('password'),
            ]);
        }
    }
}
