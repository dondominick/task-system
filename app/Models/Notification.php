<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        "user_id",
        "notif_title",
        "notif_summary",
        "notif_body",
        "to_whom",
    ];
}
