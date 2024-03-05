<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class HybridController extends Controller
{

    public function absenceRatio($student_id)
    {
        $student = Student::where('id',$student_id)->first();

        if (!$student) {
            # code...
            return 'لايوجد طالب بهذا الرقم';
        }

        $absenceRatio = DB::table('subject_student')
        ->join('subjects','subjects.id','=','subject_student.subject_id')
        ->where('subject_student.student_id',$student_id)
        ->where('subject_student.passed',false)
        ->select('subject_id','name', DB::raw('COALESCE(ROUND((absence / total_lectures) * 100), 0) as ratio'))
        ->get();
        
        return $absenceRatio;
   
    }
    
    public function studentGrades($student_id)
    {
        $studentGrades = DB::table('subject_student')
        ->join('subjects','subjects.id','=','subject_student.subject_id')
        ->where('subject_student.student_id',$student_id)
        ->where('subject_student.passed',false)
        ->select('name','mid_mark','final_mark',DB::raw('mid_mark+final_mark as Total'))
        ->get();

         return $studentGrades;
         
    }


}