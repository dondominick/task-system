<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LeaveRequest extends Model
{
    protected $fillable = [
        'user_id',
        'leave_title',
        'start_date',
        'end_date',
        'leave_text'
    ];
}
