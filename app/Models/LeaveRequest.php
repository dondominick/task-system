<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LeaveRequest extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'start_date',
        'end_date',
        'description'
    ];
}
