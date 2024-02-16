<?php

namespace Database\Seeders;

use \App\Enums\Major;
use Illuminate\Database\Seeder;
use \App\Models\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberLabels = ['الثالث', 'الرابع', 'الخامس', 'السادس', 'السابع'];
        //
        Semester::factory()->create([
            'name' => 'الفصل الأول',
            'major' => Major::GENERAL->value,
            'order' => 1
        ]);

        Semester::factory()->create([
            'name' => 'الفصل الثاني',
            'major' => Major::GENERAL->value,
            'order' => 2
        ]);

        // software engineering
        foreach($numberLabels as $index => $label){
            Semester::factory()->create([
                'name' => 'الفصل ' . $label,
                'major' => Major::SOFTWARE_ENG->value,
                'order' => $index + 3
            ]);
        }

        // telecommunication
        foreach($numberLabels as $index => $label){
            Semester::factory()->create([
                'name' => 'الفصل ' . $label,
                'major' => Major::TELECOMMUNICATION->value,
                'order' => $index + 3
            ]);
        }

        // control
        foreach($numberLabels as $index => $label){
            Semester::factory()->create([
                'name' => 'الفصل ' . $label,
                'major' => Major::CONTROL->value,
                'order' => $index + 3
            ]);
        }
    }
}