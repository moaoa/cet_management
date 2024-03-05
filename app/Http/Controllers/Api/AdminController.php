<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\Api\UserAuthRequest;
use App\Models\Lecture;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Enums\WeekDays;

class AdminController extends Controller
{
    public function store(UserAuthRequest $request)
    {
        $request->validated($request->all());

        $admin = Admin::create([
            'ref_number' => $request->ref_number,
            'password' => Hash::make($request->password),
        ]);

        $token = $admin->createToken('Api token of ' . $admin->name)->plainTextToken;

        return response()->json([
            $admin,
            'token' => $token,
        ]);
    }

    public function login(UserAuthRequest $request)
    {
        $request->validated($request->all());
        $admin = Admin::where('ref_number',$request->ref_number)->first();

        if (!$admin || ! Hash::check($request->password , $admin->password)) {
            return response()->json(['Credentials do not match'],401); 
        }else{
            
            $token = $admin->createToken('Api token of '. $admin->name)->plainTextToken;
            return response()->json([
                $admin,
                $token,
            ],200); 
        }
    }

    public function addStudent(Request $request)
    {
        $data = $request->validate([
            'ref_number' => 'required',
            'password' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        if (!$data) {
            return response()->json(['message' => 'الرجاء إدخال بيانات صحيحة'], 400);
        }

        $student = Student::create([
            'ref_number' => $request->ref_number,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);


        $student->save();

        return response()->json($student);
    }
    public function addTeacher(Request $request)
    {

        $data = $request->validate([
            'ref_number' => 'required',
            'password' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        if (!$data) {
            return 'الرجاء إدخال بيانات صحيحة';
        }

        $subjects = json_decode($request->subjects, true) ?? [];

        $matchedSubjects = Subject::whereIn('id', $subjects)->get();

        if ($matchedSubjects != null &&  count($matchedSubjects) !== count($subjects)) {
            return response()->json(['message' => 'الرجاء إدخال المواد بشكل صخيخ'], 400);
        }

        $teacher = Teacher::create([
            'ref_number' => $request->ref_number,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'subjects' => $request->subjects,
            'email' => $request->email,
            'phone_number' => $request->phone_number
        ]);

        if ($matchedSubjects != null &&  count($matchedSubjects) === count($subjects)) {
            $teacher->subjects()->attach($matchedSubjects);
        }

        $teacher->save();

        return response()->json($teacher);
    }
    public function assignSubjectsToTeacher(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        if (!$data) {
            return 'إدخال غير صحيخ';
        }

        try {
            $subjects = json_decode($request->subjects, true) ?? [];

            $matchedSubjects = Subject::whereIn('id', $subjects)->get();

            $teacher = Teacher::where('id', $request->teacher_id)->first();

            if ($matchedSubjects != null && count($matchedSubjects) !== count($subjects)) {
                return response()->json(['message' => 'الرجاء إدخال المواد بشكل صحيح'], 400);
            }

            if ($matchedSubjects != null && count($matchedSubjects) === count($subjects)) {
                $teacher->subjects()->attach($subjects);
            }


            $teacher->save();

            return 'تمت إضافة المواد للاستاذ';
        } catch (\Throwable $th) {
            //throw $th;
            return $th;
        }
    }
    public function assignStudentToSemester(Request $request)
    {
        $data = $request->validate([
            'semester_id' => 'required|exists:semesters,id',
            'student_id' => 'required|exists:students,id'
        ]);

        if (!$data) {
            return response()->json(['message' => 'الرجاء إدخال المواد بشكل صحيح'], 400);
        }

        $student = Student::find($request->student_id);
        $semester = Semester::find($request->semester_id);

        $subjectsInSemesterIds = $semester->subjects()->pluck('subjects.id');

        $student->subjects()->attach($subjectsInSemesterIds);

        return response()->json([
            'message' => 'تم إضافة مواد للطالب'
        ]);
    }
    public function addLecture(Request $request)
    {
        $weekDays = '';

        foreach (WeekDays::cases() as $day) {
            $weekDays = $weekDays . ',' . $day->name;
        }
        /**/
        /* $data = $request->validate([ */
        /*     'start_time' => 'required|regex:/^\d\d:\d\d$/', */
        /*     'end_time' => 'required|regex:/^\d\d:\d\d$/', */
        /*     'day_of_week' => 'required|in:' . $weekDays, */
        /*     'subject_id' => 'required|exists:subjects,id', */
        /*     'class_room_id' => 'required|exists:class_rooms,id', */
        /*     'group_id' => 'required|exists:groups,id', */
        /*     'teacher_id' => 'required|exists:teachers,id' */
        /* ]); */
        /**/
        /* if (!$data) { */
        /*     return response()->json(['message' => 'الرجاء ادخال بيانات صحيحة'], 400); */
        /* } */



        Lecture::create([
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'day_of_week'=>$request->day_of_week,
            'subject_id' => $request->subject_id,
            'class_room_id' => $request->class_room_id,
            'group_id' => $request->group_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return response()->json([
            'message' => 'تم إضافة محاضرة'
        ]);
    }
    public function addSubject(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'semester_id' => 'required|exists:semesters,id'
        ]);

        if (!$data) {
            return 'الرجاء ادخال بيانات صحيحة';
        }

        Subject::create([
            'name' => $request->name,
            'semester_id' => $request->semester_id
        ]);

        return response()->json([
            'message' => 'تم إضافة محاضرة'
        ]);
    }
}

// add subject for the teacher on the store method
// assign multiple subjects to the teacher
//
//
//
//
