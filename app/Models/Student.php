<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', // Assuming 'id' is auto-incrementing
        'Firstname',
        'Middlename',
        'Lastname',
        'Grade',
        'Section',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['studTrans'];

    /**
     * Get the student transactions.
     */
    public function studTrans()
    {
        return $this->hasMany(StudTrans::class);
    }
}
