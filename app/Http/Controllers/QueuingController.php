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
        // Fetch all Queuing records with studtrans_id and guest_id
        $queuingRecords = Queuing::with('studTrans')->select('studtrans_id', 'guest_id')->get();

        return response()->json($queuingRecords);
    }
}