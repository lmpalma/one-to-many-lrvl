<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        return Student::with('subjects')->get();
    }

    public function store(Request $request)
    {
        $student = Student::create($request->all());
        if($request->has('subjects'))
        {
            $student->subjects()->createMany($request->input('subjects'));
        }
        return response()->json([$student, 201]);
    }

    public function update(Request $request, $id)
    {
        $student = Student::fine($id);
        $student -> update($request->all());
        return response()-> json(['student' => $student]);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        $student -> subjects()->delete();
        $student -> delete();
        return response()-> json(['message' => 'Student successfully deleted.']);
    }
}
