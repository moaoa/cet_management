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
                'ref_number' => str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT),
                'email' => 'admin@gmail.com',
                'phone_number' => $faker->phoneNumber(),
                'password' =>  Hash::make('password'),
            ]);
        }
    }
}
