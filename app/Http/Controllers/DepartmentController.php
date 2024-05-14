<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string',

        ]);

        // Create a new Department instance
        $department = new Department();
        $department->name = $validatedData['name'];
    

        // Save the Department instance
        $department->save();

        // Return a response indicating success
        return response()->json($department);
    }

    public function destroy($id)
    {
        // Find the department by ID
        $department = Department::find($id);

        // If the department exists, delete it
        if ($department) {
            $department->delete();
            return response()->json(['message' => 'Department deleted successfully']);
        }

        // If the department doesn't exist, return an error response
        return response()->json(['error' => 'Department not found'], 404);
    }
}
