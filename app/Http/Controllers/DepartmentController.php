<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Transaction;

class DepartmentController extends Controller
{

    public function index()
    {
        return view('department.index');
    }


    public function fetchDepartments()
    
    {
        $departments = Department::all();

        return response()->json([
            'departments' => $departments
        ]);
    }





    /**
     * Store a newly created department in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDepartmentById($departmentId)
    {
        // Fetch department details by ID
        $department = Department::find($departmentId);

        if (!$department) {
            // If department not found, return a JSON response with an error message
            return response()->json(['message' => 'Department not found'], 404);
        }

        // If department found, return a JSON response with department details
        return response()->json(['department' => $department], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
        ]);

        $department = Department::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['success' => true, 'message' => 'Department successfully added', 'data' => $department], 201);
    }

    /**
     * Remove the specified department from storage.
     *
     * @param  string  $name
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($name)
    {
        $department = Department::where('name', $name)->first();

        if (!$department) {
            return response()->json(['success' => false, 'message' => 'Department not found'], 404);
        }

        $department->delete();

        return response()->json(['success' => true, 'message' => 'Department successfully deleted'], 200);
    }
    public function all()
    {
        $departments = Department::all();
        return response()->json(['departments' => $departments], 200);
    }
    public function transactionsForDepartment($departmentId)
    {
        $transactions = Transaction::where('department_id', $departmentId)->get();
    
        if ($transactions->isEmpty()) {
            return response()->json(['message' => 'No transactions found for the specified department'], 404);
        }
    
        return response()->json(['transactions' => $transactions], 200);
    }
     
    
    // In DepartmentController.php
    public function update(Request $request, Department $department)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $department->update($validatedData);

        return response()->json(['success' => true]);
    }
    

}