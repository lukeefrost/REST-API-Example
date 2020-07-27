<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class ApiController extends Controller
{
    public function getAllStudents()
    {
        $students = Student::get()->toJson(JSON_PRETTY_PRINT);
        return response($students, 200);
    }

    public function createStudent(Request $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->course = $request->course;
        $student->save();

        return response()->json([
          "message" => "Student Record created"
        ], 201);
    }

    public function getStudent($id)
    {
        if(Student::where('id', $id)->exists()) {
          $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
          return response($student, 200);
        } else {
          return response()->toJson([
            "message" => "Student not found"
          ], 404);
        }
    }

    public function updateStudent(Request $request, $id)
    {
        if(Student::where('id', $id)->exists())
        {
          $student = Student::find($id);
          $student->name = is_null($request->name) ? $student->name : $request->name; // Checks if name is null, if it isn't null the request value is passed. If it is null, null is passed as the value
          $student->course = is_null($request->course) ? $student->course : $request->course; // Checks if course is null, if it isn't null the request value is passed. If it is null, null is passed as the value
          $student->save();

          return response()->json([
            "message" => "Record updated successfully"
          ], 200);
        } else {
          return response()->json([
            "message" => "Student not found"
          ], 404);
        }
    }

    public function deleteStudent($id)
    {

    }
}
