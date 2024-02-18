<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;



class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $names = [
            'محمد',
            'أحمد',
            'علي',
            'عبدالله',
            'يوسف',
            'طارق',
            'أمير',
            'خالد',
            'مصطفى',
            'ياسر',
            'محمود',
            'حسام',
            'عمر',
            'حسين',
            'ماجد',
            'جمال',
            'سعيد',
            'رامي',
            'زياد',
            'ناصر',
            'فاطمة',
            'مريم',
            'سارة',
            'ليلى',
            'نور',
            'ريما',
            'مروة',
            'سلمى',
            'لمى',
            'رنا',
            'جميلة',
            'آمنة',
            'داليا',
            'هالة',
            'رحمة',
            'زينب',
            'لينا',
            'ميساء',
            'روان',
            'سمية'
        ];


        foreach($names as $name){
            $faker = Faker::create();

            Student::create([
                'name' => $name,
                'ref_number' => str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT),
                'email'=> $faker->email(),
                'phone_number'=> $faker->phoneNumber(),
                'password' =>  Hash::make('password')
            ]);
        }
    }
}