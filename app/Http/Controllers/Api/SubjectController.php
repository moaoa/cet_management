<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SubjectStoreRequest;
use App\Http\Resources\Api\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::all();

        return response()->json($subjects);
    }

    public function show(Request $request,  $id)
    {
        $subject = Subject::find($id);

        return  response()->json($subject);
    }

    public function store(SubjectStoreRequest $request)
    {
        $subject = Subject::create($request->validated());

        return  response()->json($subject);;
    }

    public function subjectStudents($subject_id)
    {
        $subject = Subject::where('id',$subject_id)->first();
        
        if (!$subject) {
            # code...
            return 'لاتوجد مادة بهذا الرقم';
        }

        $students = $subject->students()->where('subject_id',$subject_id)->get();

        return response()->json($students);


    }
}
