<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "endpoint",
        "request_body",
        "status_code",
        "response_body",
        "ip"
    ];

    public $timestamps = false;
}
