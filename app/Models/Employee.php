<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function PHPSTORM_META\map;

class Employee extends Model
{

    use HasFactory;
    protected $fillable = [
        "firstname",
        "lastname",
        'email',
        'department_id',
        'user_id',
    ];
}
