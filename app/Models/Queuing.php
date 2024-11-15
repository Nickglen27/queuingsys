<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queuing extends Model
{
    use HasFactory;

    // Specify the table if it doesn't follow the naming convention
    protected $table = 'queuings';

    // Define the fillable properties
    protected $fillable = [
        'department_id',
        'studtrans_id',
        'priority_num',
        'windows',
        'guest_id',
        'is_call', // Add is_call column to fillable
        'is_done', // Add is_done column to fillable
        'is_archive', // Add is_archive column to fillable
    ];

    /**
     * Get the StudTrans associated with the queuing.
     */
    public function studTrans()
    {
        return $this->belongsTo(StudTrans::class, 'studtrans_id');
    }

    /**
     * Get the guest associated with the queuing.
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function student()
{
    return $this->belongsTo(Studtrans::class, 'studtrans_id');
}
}