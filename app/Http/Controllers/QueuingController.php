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
        if ($queuing->is_call == 1 && !request()->has('is_done')) {
            // Update is_done to 1
            $queuing->is_done = 1;
        } else {
            // Update is_call attribute to 1
            $queuing->is_call = 1;

            // Update is_done attribute only if provided
            if (request()->has('is_done')) {
                $queuing->is_done = request()->input('is_done');
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

    // Initialize arrays to store unique department names, corresponding priority_nums, and studtrans_ids
    $uniqueDepartments = [];
    $priorityNums = [];
    $studtransIds = [];

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
                // Initialize an array to store priority_nums for each department name
                $priorityNums[$department->name] = [];
                // Initialize an array to store studtrans_ids for each department name
                $studtransIds[$department->name] = [];
            }
            // Store the priority_num and studtrans_id for the current department name
            $priorityNums[$department->name][] = $queuing->priority_num;
            $studtransIds[$department->name][] = $queuing->studtrans_id;
        }
    }

    // Return the unique department names along with corresponding priority_nums and studtrans_ids
    return response()->json([
        'windows' => $windows,
        'departments' => $uniqueDepartments, // Change 'department_ids' to 'departments'
        'priority_nums' => $priorityNums, // Add priority_nums to the response
        'studtrans_ids' => $studtransIds // Add studtrans_ids to the response
    ]);
}

}
