<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queuing;
use App\Models\StudTrans;

class TvController extends Controller
{
    public function fetchQueuing()
    {
        // Fetch all Queuing records with related StudTrans, student, department, and transaction data
        $queuingData = Queuing::with([
            'studTrans.student', 
            'studTrans.department', 
            'studTrans.transaction'
        ])
        ->orderBy('priority_num')
        ->get();

        // Transform data to include 'windows' field from StudTrans
        $queuingData->transform(function($item) {
            $item->windows = $item->studTrans->windows;
            return $item;
        });

        return response()->json($queuingData);
    }

    public function updateQueue(Request $request)
    {
        $studTransId = $request->input('stud_trans_id');
        $priorityNum = $request->input('priority_num');

        // Update the Queuing record
        $queue = Queuing::updateOrCreate(
            ['stud_trans_id' => $studTransId],
            ['priority_num' => $priorityNum]
        );

        return response()->json(['success' => true, 'queue' => $queue]);
    }
}
