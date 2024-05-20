<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewDepartment extends Model
{
    use HasFactory;

    protected $table = 'newdep';

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'new_department_id');
    }
}
