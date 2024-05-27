<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchStudents(Request $request)
    {
        $letter = $request->input('letter');

        // Query students whose Firstname, Middlename, or Lastname starts with the specified letter
        $students = Student::where('Firstname', 'like', $letter . '%')
                           ->orWhere('Middlename', 'like', $letter . '%')
                           ->orWhere('Lastname', 'like', $letter . '%')
                           ->get();
    
        return response()->json($students);
    }

    /**
     * Store a newly created student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Stud_Id' => 'required|integer|unique:students',
            'Firstname' => 'required|string|max:255',
            'Middlename' => 'nullable|string|max:255',
            'Lastname' => 'required|string|max:255',
            'Grade' => 'required|string|max:255',
            'Section' => 'required|string|max:255',

        ]);

        $student = Student::create($validatedData);
        return response()->json($student, 201);
    }

    /**
     * Display the specified student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    /**
     * Update the specified student in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'Firstname' => 'sometimes|required|string|max:255',
            'Middlename' => 'nullable|string|max:255',
            'Lastname' => 'sometimes|required|string|max:255',
            'Grade' => 'sometimes|required|string|max:255',
            'Section' => 'sometimes|required|string|max:255',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validatedData);
        return response()->json($student);
    }

    /**
     * Remove the specified student from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(null, 204);
    }
}