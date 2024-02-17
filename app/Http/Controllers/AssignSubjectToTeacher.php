<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class AssignSubjectToTeacher extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
       $data = $request->validate([
        'teacher_id' => 'required|exists:teachers,id',
        'subject_id' => 'required|exists:subjects,id'
       ]);

       if(!$data){
         return 'your input is not valid';
       }

       try {
          //code...
          $teacher = Teacher::where('id', $request->teacher_id)->first();

          $teacherAlreadyHasTheSubject = $teacher->subjects()->where('subject_id', $request->subject_id)->exists();

          if(!$teacherAlreadyHasTheSubject){
            $teacher->subjects()->attach($request->subject_id);

            $teacher->save();
          } else {
            return 'teacher already has this subject';
          }

          return 'subject was assigned to teacher';
       } catch (\Throwable $th) {
        //throw $th;
        return $th;
       }
    }
}
