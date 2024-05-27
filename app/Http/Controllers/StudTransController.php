<?php

namespace App\Http\Controllers;

use App\Models\StudTrans;
use App\Models\Student;
use App\Models\Department;
use App\Models\Transaction;
use App\Models\Queuing; // Add this line to import the Queuing model
use Illuminate\Http\Request;

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
    
        try {
            // Find the student by their full name
            $student = Student::whereRaw("CONCAT(Firstname, ' ', Middlename, ' ', Lastname) = ?", [$request->name])->first();
    
            // Find the department by its name
            $department = Department::where('name', $request->department)->first();
    
            // Find the transaction by its type
            $transaction = Transaction::where('transaction_type', $request->transaction)->first();
    
            // Check if all necessary entities were found
            if ($student && $department && $transaction) {
                // Get the latest window value
                $latestWindow = StudTrans::max('windows');
                $nextWindow = ($latestWindow % 3) + 1; // Loop windows within the range of 1 to 3
    
                // Create a new StudTrans record with the incremented window value
                $studTrans = StudTrans::create([
                    'student_id' => $student->Stud_Id,
                    'department_id' => $department->id,
                    'transaction_id' => $transaction->id,
                    'windows' => $nextWindow
                ]);
    
                // Check if a queuing record already exists for this StudTrans record
                $existingQueuingRecord = Queuing::where('studtrans_id', $studTrans->id)->exists();
    
                if (!$existingQueuingRecord) {
                    // Find the current maximum priority_num in the queuing table
                    $maxPriorityNum = Queuing::max('priority_num');
    
                    // Increment the priority_num by 1 for the new record
                    $newPriorityNum = is_null($maxPriorityNum) ? 1 : $maxPriorityNum + 1;
    
                    // Create a new Queuing record with the incremented priority_num
                    Queuing::create([
                        'studtrans_id' => $studTrans->id,
                        'priority_num' => $newPriorityNum,
                        'guest_id' => null // Allow guest_id to be null
                    ]);
                }
    
                // Return a successful response
                return response()->json(['success' => true, 'message' => 'Details stored successfully!']);
            } else {
                // Return an error response if any entity is not found
                return response()->json(['success' => false, 'message' => 'Invalid data provided.']);
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error storing details: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Internal server error.']);
        }
    }

    public function fetchStudTrans()
    {
        // Fetch all StudTrans records with related student, department, and transaction data
        $studTrans = StudTrans::with(['student', 'department', 'transaction'])->get();

        return response()->json($studTrans);
    }






    

  /**
 * Call the first student transaction from the queue.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
public function callStudTrans(Request $request)
{
    // Find the first Queuing record
    $firstQueue = Queuing::orderBy('priority_num')->first();

    if ($firstQueue) {
        // Find the associated StudTrans record
        $studTrans = StudTrans::with(['student', 'department', 'transaction'])->find($firstQueue->studtrans_id);

        if ($studTrans) {
            // Delete the Queuing record to simulate it being "called"
            $firstQueue->delete();

            // Return the StudTrans data as a JSON response
            return response()->json([
                'success' => true,
                'data' => $studTrans
            ]);
        }
    }

    return response()->json([
        'success' => false,
        'message' => 'No records found in queue.'
    ]);
}
}