<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{



    protected $fillable = [
        "text",
        "sub_id",
        "admin_id",
        "date",
    ];
}
