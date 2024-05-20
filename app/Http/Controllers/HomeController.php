<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        // Redirect based on user's role
        switch ($user->department) {
            case 'Admin':
                return redirect()->route('admin');
            case 'Registrar':
                return redirect()->route('registration.registrar');
            case 'Cashier':
                return redirect()->route('registration.cashier');
            default:
                return view('registration.cashier');
        }
    }
}
