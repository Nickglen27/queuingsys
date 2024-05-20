<?php

namespace App\Http\Controllers;

use App\Models\StudTrans;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Department;
use App\Models\Transaction;

class StudTransController extends Controller
{
    /**
     * Store the selected details in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|string|max:10',
            'section' => 'required|string|max:10',
            'department' => 'required|string|max:255',
            'transaction' => 'required|string|max:255'
        ]);

        // Find the student by their full name
        $student = Student::whereRaw("CONCAT(Firstname, ' ', Middlename, ' ', Lastname) = ?", [$request->name])->first();

        // Find the department by its name
        $department = Department::where('name', $request->department)->first();

        // Find the transaction by its type
        $transaction = Transaction::where('transaction_type', $request->transaction)->first();

        // Check if all necessary entities were found
        if ($student && $department && $transaction) {
            // Create a new StudTrans record
            StudTrans::create([
                'student_id' => $student->Stud_Id,
                'department_id' => $department->id,
                'transaction_id' => $transaction->id
            ]);

            // Return a successful response
            return response()->json(['success' => true, 'message' => 'Details stored successfully!']);
        } else {
            // Return an error response if any entity is not found
            return response()->json(['success' => false, 'message' => 'Invalid data provided.']);
        }
    }
}
