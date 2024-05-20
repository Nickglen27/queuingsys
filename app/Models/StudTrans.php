<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudTrans extends Model
{
    use HasFactory;

    // Specify the table if it doesn't follow the naming convention
    protected $table = 'studtrans';

    // Define the fillable properties
    protected $fillable = [
        'student_id',
        'department_id',
        'transaction_id'
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
}
