<?php

namespace Database\Seeders;

use \App\Enums\Major;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $generalMajorJsonData = file_get_contents(database_path('seeders/seeds/generalSubjects.json'));

        $generalMajorSubjectsForEachSemester = json_decode($generalMajorJsonData, true);


        foreach($generalMajorSubjectsForEachSemester as $key => $semesterCourses)
        {
            $semester = Semester::where('order', (int)$key)
            ->where('major', Major::GENERAL->value)->first();

            // dd($semester->name);
            foreach ($semesterCourses as $courseName) {
                // dd($courseName);
                $subject = \App\Models\Subject::factory()->create([
                    'name' => $courseName,
                    'semester_id' => $semester->id
                ]);
                $subject->save();
            }
        }



        // software engineering department


        $softwareMajorSubjectsJsonData = file_get_contents(database_path('/seeders/seeds/softwareEngineeringSubjects.json'));

        $softwareEngSubjectsForEachSemester = json_decode($softwareMajorSubjectsJsonData, true);


        foreach($softwareEngSubjectsForEachSemester as $key => $semesterCourses)
        {
            $semester = Semester::where('order', (int)$key)
            ->where('major', Major::SOFTWARE_ENG->value)
            ->first();

            foreach ($semesterCourses as $courseName) {
                $subject = \App\Models\Subject::factory()->create([
                    'name' => $courseName,
                    'semester_id' => $semester->id
                ]);
                $subject->save();
            }
        }

        // controlSubjects department

        $controlSubjectsJsonData = file_get_contents(database_path('seeders/seeds/controlSubjects.json'));

        $controlSubjectsForEachSemester = json_decode($controlSubjectsJsonData, true);

        foreach($controlSubjectsForEachSemester as $key => $semesterCourses)
        {
            $semester = Semester::where('order', (int)$key)
            ->where('major', Major::CONTROL->value)->first();

            foreach ($semesterCourses as $courseName) {
                $subject = \App\Models\Subject::factory()->create([
                    'name' => $courseName,
                    'semester_id' => $semester->id
                ]);

                $subject->save();
            }
        }

         // telecommunicationMajor subject 
        $controlSubjectsJsonData = file_get_contents(database_path('seeders/seeds/telecomunicationSubjects.json'));

        $controlSubjectsForEachSemester = json_decode($controlSubjectsJsonData, true);

        foreach($controlSubjectsForEachSemester as $key => $semesterCourses)
        {
            $semester = Semester::where('order', (int)$key)
            ->where('major', Major::TELECOMMUNICATION->value)->first();

            foreach ($semesterCourses as $courseName) {
                $subject = \App\Models\Subject::factory()->create([
                    'name' => $courseName,
                    'semester_id' => $semester->id
                ]);
                $subject->save();
            }
        }
    }
}