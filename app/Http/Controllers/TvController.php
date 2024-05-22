<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queuing;

class TvController extends Controller
{
    public function fetchQueuing()
    {
        // Fetch all Queuing records with related StudTrans and student data
        $queuingData = Queuing::with(['studTrans.student'])
            ->orderBy('priority_num')
            ->get();

        return response()->json($queuingData);
    }
}
