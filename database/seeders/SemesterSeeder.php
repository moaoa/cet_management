<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'major' => 1,
            'order' => 1
        ]);

        Semester::factory()->create([
            'name' => 'الفصل الثاني',
            'major' => 1,
            'order' => 2
        ]);

        // software engineering
        foreach($numberLabels as $index => $label){
            Semester::factory()->create([
                'name' => 'الفصل ' . $label,
                'major' => 2,
                'order' => $index + 3
            ]);
        }

        // telecomunication
        foreach($numberLabels as $index => $label){
            Semester::factory()->create([
                'name' => 'الفصل ' . $label,
                'major' => 3,
                'order' => $index + 3
            ]);
        }

        // telecomunication
        foreach($numberLabels as $index => $label){
            Semester::factory()->create([
                'name' => 'الفصل ' . $label,
                'major' => 4,
                'order' => $index + 3
            ]);
        }
    }
}