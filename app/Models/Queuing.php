<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queuing extends Model
{
    use HasFactory;

    protected $fillable = [
        'studtrans_id',
        'guest_id'
    ];

    /**
     * Get the studtrans record associated with the queuing.
     */
    public function studtrans()
    {
        return $this->belongsTo(StudTrans::class);
    }

    /**
     * Get the guest associated with the queuing.
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}