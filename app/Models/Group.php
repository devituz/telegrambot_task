<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'attendance_taken',
        'students_count',
    ];

    protected $casts = [
        'attendance_taken' => 'boolean',
        'start_time' => 'datetime:H:i',
    ];
}
