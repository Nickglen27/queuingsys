<?php

namespace App\Http\Controllers;

use App\Models\StudTrans;
use App\Models\Student;
use App\Models\Department;
use App\Models\Transaction;
use App\Models\Queuing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

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
            if (!$student) {
                Log::error('Student not found with name: ' . $request->name);
                return response()->json(['success' => false, 'message' => 'Student not found.']);
            }
    
            // Find the department by its name
            $department = Department::where('name', $request->department)->first();
            if (!$department) {
                Log::error('Department not found with name: ' . $request->department);
                return response()->json(['success' => false, 'message' => 'Department not found.']);
            }
    
            // Find the transaction by its type
            $transaction = Transaction::where('transaction_type', $request->transaction)->first();
            if (!$transaction) {
                Log::error('Transaction not found with type: ' . $request->transaction);
                return response()->json(['success' => false, 'message' => 'Transaction not found.']);
            }
    
            // Get the latest window value
            $latestWindow = StudTrans::max('windows');
            $nextWindow = ($latestWindow % 3) + 1; // Loop windows within the range of 1 to 3
    
            // Create a new StudTrans record with the incremented window value
            $studTrans = StudTrans::create([
                'student_id' => $student->id, // Changed 'stud_id' to 'id'
                'department_id' => $department->id,
                'transaction_id' => $transaction->id,
                'windows' => $nextWindow
            ]);
    
            // Find the current maximum priority_num in the queuing table
            $maxPriorityNum = Queuing::max('priority_num');
        
            // Increment the priority_num by 1 for the new record
            $newPriorityNum = is_null($maxPriorityNum) ? 1 : $maxPriorityNum + 1;
        
            // Calculate the window number based on the new priority_num
            $window = ($newPriorityNum % 3) + 1; // Assuming 3 windows, adjust as needed
        
            Queuing::create([
                'department_id' => $department->id,
                'studtrans_id' => $studTrans->id,
                'priority_num' => $newPriorityNum,
                'guest_id' => null, // Allow guest_id to be null
                'windows' => $window // Use $window instead of $nextWindow
            ]);
    
            // Return a successful response
            return response()->json(['success' => true, 'message' => 'Details stored successfully!']);
        } catch (\Exception $e) {
            // Log the error for debugging with detailed information
            Log::error('Error storing details: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Internal server error.']);
        }
    }
    
    

    /**
     * Fetch all StudTrans records with related student, department, and transaction data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    // public function fetchStudTrans()
    // {
    //     try {
    //         // Fetch all StudTrans records with related student, department, and transaction data
    //         $studTrans = StudTrans::with(['student', 'department', 'transaction'])->get();
    //         return response()->json($studTrans);
    //     } catch (\Exception $e) {
    //         // Log the error for debugging
    //         Log::error('Error fetching StudTrans records: ' . $e->getMessage(), ['exception' => $e]);
    //         return response()->json(['success' => false, 'message' => 'Internal server error.']);
    //     }
    // }

    /**
     * Call the first student transaction from the queue.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function FetchTransactions(Request $request)
    {
        try {
            // Get the logged-in user
            $user = Auth::user();
    
            // Find all Queuing records belonging to the user's department and window
            $queuedTransactions = Queuing::where(function ($query) use ($user) {
                $query->where('department_id', $user->department_id)
                    ->where('windows', $user->window);
            })
                ->orderBy('priority_num')
                ->get();
    
            // Initialize an array to store the transaction data
            $transactions = [];
    
            // Iterate over each queued transaction
            foreach ($queuedTransactions as $queuedTransaction) {
                // Find the associated StudTrans record with its related models
                $studTrans = StudTrans::with('student', 'transaction')
                    ->find($queuedTransaction->studtrans_id);
    
                // If a StudTrans record is found, add it to the transactions array
                if ($studTrans) {
                    // Add the priority_num to the transaction data
                    $transactionData = $studTrans->toArray();
                    $transactionData['priority_num'] = $queuedTransaction->priority_num;
                    $transactions[] = $transactionData;
                }
            }
    
            // Return the transactions data as a JSON response
            return response()->json([
                'success' => true,
                'data' => $transactions
            ]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error fetching transactions: ' . $e->getMessage(), ['exception' => $e]);
            return response()->json(['success' => false, 'message' => 'Internal server error.']);
        }
    }
    
    
}
