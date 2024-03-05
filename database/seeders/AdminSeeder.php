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
            // $faker = Faker::create();
            Admin::create([
                'name' => 'م. معاذ بن طاهر',
                'ref_number' => 1111,
                'password' =>  Hash::make('password'),
            ]);

            Admin::create([
                'name' => $name,
                'ref_number' => 1111,
                'password' =>  Hash::make('password'),
            ]);
        }
    }
}
