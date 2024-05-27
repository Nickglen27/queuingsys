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
        'studtrans_id',
        'priority_num',
        'guest_id'
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
}