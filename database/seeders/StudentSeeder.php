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
            // 'أحمد',
            // 'علي',
            // 'عبدالله',
            // 'يوسف',
            // 'طارق',
            // 'أمير',
            // 'خالد',
            // 'مصطفى',
            // 'ياسر',
            // 'محمود',
            // 'حسام',
            // 'عمر',
            // 'حسين',
            // 'ماجد',
            // 'جمال',
            // 'سعيد',
            // 'رامي',
            // 'زياد',
            // 'ناصر',
            // 'فاطمة',
            // 'مريم',
            // 'سارة',
            // 'ليلى',
            // 'نور',
            // 'ريما',
            // 'مروة',
            // 'سلمى',
            // 'لمى',
            // 'رنا',
            // 'جميلة',
            // 'آمنة',
            // 'داليا',
            // 'هالة',
            // 'رحمة',
            // 'زينب',
            // 'لينا',
            // 'ميساء',
            // 'روان',
            // 'سمية'
        ];

        $counter = 1;

        Student::create([
            'name' => 'م.رحيم ديهوم',
            'ref_number' => '1111',
            'email'=> 'student' . $counter . '@email.com',
            'phone_number'=> '092' . $counter,
            'password' =>  Hash::make('password')
        ]);

        foreach($names as $name){
            // $faker = Faker::create();
            $counter++;

            Student::create([
                'name' => $name,
                'ref_number' => str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT),
                'email'=> 'student' . $counter . '@email.com',
                'phone_number'=> '092' . $counter,
                'password' =>  Hash::make('password'),
                'group_id'=> random_int(1,15),
            ]);
        }
    }
}