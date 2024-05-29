<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queuing;
use App\Models\StudTrans;

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


 
    public function getIsCallStatus($window)
{
    // Find the Queuing record for the specified window with is_call status true and is_done not equal to 1
    $queuing = Queuing::where('windows', $window)->where('is_call', true)->where('is_done', '!=', 1)->first();

    // If the Queuing record exists and is_call is true, and is_done is not equal to 1, return department_id and priority_num
    if ($queuing) {
        return response()->json([
            'department_id' => $queuing->department_id,
            'priority_num' => $queuing->priority_num
        ]);
    } else {
        // If no Queuing record is found for the window with is_call true and is_done not equal to 1, return an empty response
        return response()->json([]);
    }
}

}
