<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{


    protected $fillable = [
        "status",
        "sub_date",
        "task_id",
        "employee_id",
        "file"
    ];
}
