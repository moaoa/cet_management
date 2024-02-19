<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LectureStoreRequest;
use App\Http\Resources\Api\LectureResource;
use App\Models\Lecture;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LectureController extends Controller
{
    public function index(Request $request)
    {
        $lectures = Lecture::all();

        return  response()->json( $lectures);
    }

    public function show(Request $request, Lecture $id)
    {
        $lecture = Lecture::find($id);

        return  response()->json( $lecture);
    }

    public function store(LectureStoreRequest $request)
    {
        $lecture = Lecture::create($request->validated());

        return  response()->json( $lecture);
    }

    public function lectureStudents($lecture_id){

        $lectureExists = Lecture::where('id',$lecture_id)->exists();
        if(!$lectureExists)
        {
            return 'لاتوجد محاضرة بهذا الرقم';
        } else {
            # code...
            try {
                //code...

                $attendentGroup = Lecture::where('id',$lecture_id)->value('group_id');
                $groupStudents = Student::where('group_id',$attendentGroup)->orderBy('name','asc')->get();

                if(!$groupStudents->isEmpty()){
                    return response()->json($groupStudents);
                }
                return 'لاتوجد مجموعة بهذا الرقم';

            } catch (\Throwable $th) {
                //throw $th;
                return $th ;
            }
            
        }
        
    }
}
