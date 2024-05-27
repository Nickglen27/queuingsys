<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Log; // Import Log facade
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        // Set the value of 'user_type' to 'dept_user'
        $data['user_type'] = 'dept_user';
    
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'], // Removed 'confirmed' rule
            'department_id' => ['required', 'integer'], // Adjusted to 'integer' if department_id is numeric
            'user_type' => ['required', 'string'], // No need for Rule::in(['dept_user'])
        ]);
    }
    
    protected function create(array $data)
{
    // Find the department by ID
    $department = Department::find($data['department_id']);

    // If department not found, return error
    if (!$department) {
        return response()->json([
            'message' => 'Department not found for id: ' . $data['department_id']
        ], 404);
    }

    // Create the user and associate it with the department
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'department_id' => $department->id,
        'user_type' => $data['user_type'],
        'status' => 1, // Set the status to 1 (Active)
        'window' => $data['window'], // Add window attribute
    ]);

    return $user;
}

    public function register(Request $request)
    {
        try {
            $validator = $this->validator($request->all());
    
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
    
            $user = $this->create($request->all());
            event(new Registered($user));
    
            return response()->json([
                'message' => 'User registered successfully',
                'user' => $user
            ], 201);
        } catch (\Exception $e) {
            Log::error('Error in registration', [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            return response()->json([
                'message' => 'Internal server error'
            ], 500);
        }
    }
    
    public function ShowUsers()
{
    $users = User::with('department')->get(); // Eager load the department relationship
    return response()->json([
        'message' => 'Users retrieved successfully',
        'data' => $users->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'status' => $user->status, // Assuming 'status' is a field in the User model
                'department_id' => $user->department ? $user->department->name : null,
                'window' => $user->window,
     
            ];
        }),
    ]);
}

    
}
