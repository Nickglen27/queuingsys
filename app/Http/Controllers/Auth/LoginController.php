<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/department/index'; // <-- Update this line

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Check if the user is an admin
        if ($user->user_type === 'admin') {
            return redirect('/home'); // Redirect to the home page for admin users
        }

        // Redirect users based on their department
        if ($user->department) {
            // Assuming you have a route named 'department.index' for the department dashboard
            return redirect()->route('department.index', ['id' => $user->department->id]);
        } else {
            // Redirect to default route if user's department is not found
            return redirect($this->redirectTo);
        }
    }
}
