<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Queuing; // Import the Queuing model

class StudTrans extends Model
{
    use HasFactory;

    // Specify the table if it doesn't follow the naming convention
    protected $table = 'studtrans';

    // Define the fillable properties
    protected $fillable = [
        'student_id',
        'department_id',
        'transaction_id',
        'windows' // Fixed typo here
    ];

    /**
     * Get the student that owns the transaction.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'Stud_Id');
    }

    /**
     * Get the department associated with the transaction.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the transaction type.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * The "booted" method of the model.
     * Listen for the `created` event and create a Queuing record.
     */
    protected static function booted()
    {
        static::created(function ($studTrans) {
            // Find the current maximum priority_num in the queuing table
            $maxPriorityNum = Queuing::max('priority_num');
    
            // Increment the priority_num by 1 for the new record
            $newPriorityNum = is_null($maxPriorityNum) ? 1 : $maxPriorityNum + 1;
    
            // Calculate the window number based on the new priority_num
            $window = ($newPriorityNum % 3) + 1; // Assuming 3 windows, adjust as needed
    
            // Create a new Queuing record with the incremented priority_num and window
            Queuing::create([
                'studtrans_id' => $studTrans->id,
                'priority_num' => $newPriorityNum,
                'guest_id' => null, // Allow guest_id to be null
                'windows' => $window // Fixed field name here
            ]);
        });
    }
}