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
        return $this->belongsTo(Student::class);
        return $this->belongsTo(Student::class, 'student_id');

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
    public function getWindowAttribute()
    {
        return $this->windows;
    }
    
}
