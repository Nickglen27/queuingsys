<?php

// app/Http/Controllers/TransactionController.php

// App\Http\Controllers\TransactionController.php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
 public function store(Request $request)
    {
        $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'transaction_type' => 'required|string|max:255',
        ]);

        try {
            $transaction = new Transaction();
            $transaction->department_id = $request->department_id;
            $transaction->transaction_type = $request->transaction_type;
            $transaction->save();

            return response()->json(['message' => 'Transaction created successfully', 'transaction' => $transaction], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create transaction', 'error' => $e->getMessage()], 500);
        }
    }

        public function getTransactionsByDepartment($departmentId)
        {
            try {
                // Validate departmentId (optional but recommended)
                if (!$departmentId) {
                    return response()->json(['message' => 'Department ID is required'], 400);
                }
        
                // Retrieve transactions for the specified department
                $transactions = Transaction::where('department_id', $departmentId)->get();
        
                // Check if transactions are found
                if ($transactions->isEmpty()) {
                    return response()->json(['message' => 'No transactions found for the specified department'], 404);
                }
        
                // Return the transactions
                return response()->json(['transactions' => $transactions], 200);
            } catch (\Exception $e) {
                // Log the exception for debugging
                Log::error('Failed to fetch transactions: ' . $e->getMessage());
        
                // Return an error response
                return response()->json(['message' => 'Failed to fetch transactions', 'error' => $e->getMessage()], 500);
            }
        }
        

    
    }


