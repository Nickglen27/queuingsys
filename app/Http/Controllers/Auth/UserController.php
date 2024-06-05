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
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'status' => $user->status, // Assuming 'status' is a field in the User model
                    'department_id' => $user->department ? $user->department->name : null,
                    'window' => $user->window,
                ];
            }),
        ]);
    }








    
    // New method for editing a user
//     public function edit($id)
// {
//     $user = User::find($id);
//     return response()->json(['user' => $user]);
// }

    // New method for updating a user
    public function update(Request $request, $id)
{
    // Find the user by ID
    $user = User::find($id);

    if (!$user) {
        \Log::error('User not found for update. ID: ' . $id);
        return response()->json(['error' => 'User not found'], 404);
    }

    // Log received data
    \Log::info('Received data for user update:', $request->all());

    // Validate the request data
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        'user_type' => ['required', 'max:255'],
        'department_id' => ['required', 'integer'],
        'window' => ['required', 'integer'],
        'status' => ['required', 'integer', 'in:0,1'], // Validate the status field
        'password' => ['nullable', 'string', 'min:8'], // Password validation rules
    ]);

    if ($validator->fails()) {
        // Log validation errors
        \Log::error('Validation errors:', $validator->errors()->toArray());
        return response()->json(['error' => $validator->errors()], 400);
    }

    // Update the user
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->user_type = $request->input('user_type');
    $user->department_id = $request->input('department_id');
    $user->window = $request->input('window');
    $user->status = $request->input('status'); // Update the status field

    // Update password if provided
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    // Log successful update
    \Log::info('User updated successfully:', $user->toArray());

    return response()->json(['message' => 'User updated successfully', 'user' => $user]);
}
    
    
    public function show($id)
    {
        try {
            // Retrieve the user by ID
            $user = User::find($id);


            return response()->json($user);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            // Log the error
            \Log::error('User not found: ' . $exception->getMessage());
            
            // Return a JSON response with a 404 status code
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    
}
