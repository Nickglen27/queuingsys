<?php

// App\Models\Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['department_id', 'transaction_type'];

    // Define the relationship if associating transactions with departments
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}