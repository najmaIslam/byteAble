<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Spatie\Activitylog\Facades\Activity;

class StudentController extends Controller
{
    public function fetchAllRecords()
    {
        return response()->json(Student::all());
    }

  //fetch record by name
    public function show($name)
    {
        $student = Student::where('name', $name)->first();

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json($student);
    }

    // update record
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->update($request->only(['name', 'Specialization', 'year']));
        activity()
        ->performedOn($user) 
        ->causedBy(auth()->user())
        ->log('Updated user information'); 

        return response()->json(['message' => 'Student updated successfully', 'data' => $student]);
    }

    // delete
    public function delete($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        activity()
        ->performedOn($user) 
        ->causedBy(auth()->user())
        ->log('Updated user information'); 

        return response()->json(['message' => 'Student deleted successfully']);
    }
}