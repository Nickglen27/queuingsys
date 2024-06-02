<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queuing;
use App\Models\StudTrans;
use App\Models\Department;
use Illuminate\Support\Facades\Response;


class QueuingController extends Controller
{
    /**
     * Fetch the studtrans_id and related data from the StudTrans model.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchIds()
    {
        // Fetch all Queuing records with studtrans_id and related data from StudTrans model
        $queuingRecords = Queuing::with('studTrans.student', 'studTrans.department', 'studTrans.transaction', 'studTrans.windows')
            ->select('studtrans_id', 'guest_id')
            ->get();

        return response()->json($queuingRecords);
    }
    public function updateStatus($studTransId)
    {
        // Find the Queuing record with the given studTrans_id
        $queuing = Queuing::where('studtrans_id', $studTransId)->first();
    
        // If the Queuing record exists
        if ($queuing) {
            // Check if is_call is already 1 and the is_done field is not provided
            if ($queuing->is_call == 1 && !request()->has('is_done') && !request()->has('is_archive')) {
                // Update is_done to 1
                $queuing->is_done = 1;
            } else {
                // Update is_call attribute to 1 if is_archive is not provided
                if (!request()->has('is_archive')) {
                    $queuing->is_call = 1;
                }
    
                // Update is_done attribute only if provided
                if (request()->has('is_done')) {
                    $queuing->is_done = request()->input('is_done');
                }
    
                // Update is_archive attribute only if provided
                if (request()->has('is_archive')) {
                    $queuing->is_archive = request()->input('is_archive');
                }
            }
    
            $queuing->save();
    
            return response()->json(['message' => 'Status updated successfully']);
        } else {
            // Handle the case where no Queuing record is found for the given studTrans_id
            return response()->json(['error' => 'No Queuing record found for the given studTrans_id'], 404);
        }
    }
    



public function getIsCallStatus($windows)
{
    // Convert $windows to an array if it's not already an array
    if (!is_array($windows)) {
        $windows = [$windows];
    }

    // Initialize arrays to store unique department names, corresponding priority_nums, student details, and transaction types
    $uniqueDepartments = [];
    $priorityNums = [];
    $studentDetails = [];
    $transactionTypes = [];

    // Iterate through each window
    foreach ($windows as $window) {
        // Fetch all records for the specified window where is_call is true, is_done is not equal to 1, and studtrans_id is not null
        $queuings = Queuing::where('windows', $window)
                            ->where('is_call', true)
                            ->where('is_done', '!=', 1)
                            ->whereNotNull('studtrans_id')
                            ->get();

        // Iterate through the queuings for the current window
        foreach ($queuings as $queuing) {
            // Fetch the department associated with the department ID
            $department = Department::find($queuing->department_id);

            // Check if department name is already processed
            if (!in_array($department->name, $uniqueDepartments)) {
                // Store the unique department name
                $uniqueDepartments[] = $department->name;
                // Initialize arrays to store priority_nums, student details, and transaction types for each department name
                $priorityNums[$department->name] = [];
                $studentDetails[$department->name] = [];
                $transactionTypes[$department->name] = [];
            }

            // Store the priority_num and studtrans_id for the current department name
            $priorityNums[$department->name][] = $queuing->priority_num;
            $studtransId = $queuing->studtrans_id;
            
            // Fetch the corresponding studtrans record to get the student_id and transaction_id
            $studtrans = Studtrans::find($studtransId);
            if ($studtrans) {
                // Fetch the student details using the student_id
                $student = $studtrans->student()->first();
                if ($student) {
                    // Store the student details (e.g., Firstname) for the current department name
                    $studentDetails[$department->name][] = $student->Firstname;
                    // Fetch the transaction record to get the transaction_type
                    $transaction = $studtrans->transaction()->first();
                    if ($transaction) {
                        // Store the transaction_type for the current department name
                        $transactionTypes[$department->name][] = $transaction->transaction_type;
                    } else {
                        // If transaction record not found, add a placeholder or handle accordingly
                        $transactionTypes[$department->name][] = null;
                    }
                } else {
                    // If student record not found, add a placeholder or handle accordingly
                    $studentDetails[$department->name][] = null;
                    // If student record not found, add a placeholder or handle accordingly
                    $transactionTypes[$department->name][] = null;
                }
            } else {
                // If studtrans record not found, add a placeholder or handle accordingly
                $studentDetails[$department->name][] = null;
                // If studtrans record not found, add a placeholder or handle accordingly
                $transactionTypes[$department->name][] = null;
            }
        }
    }

    // Return the unique department names along with corresponding priority_nums, student details, and transaction types
    return response()->json([
        'windows' => $windows,
        'departments' => $uniqueDepartments,
        'priority_nums' => $priorityNums,
        'student_details' => $studentDetails,
        'transaction_types' => $transactionTypes // Change 'transaction_ids' to 'transaction_types'
    ]);
}











}
