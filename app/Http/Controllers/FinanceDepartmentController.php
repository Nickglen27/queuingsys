<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinanceDepartmentController extends Controller
{
    public function index()
    {
        return view('registration.cashier');
    }
}
