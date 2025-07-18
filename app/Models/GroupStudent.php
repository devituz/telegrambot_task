<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class GroupStudent extends Model
{
    protected $table = 'group_student';

    protected $fillable = [
        'group_id',
        'student_id',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function debts()
    {
        return $this->hasMany(Debt::class);
    }

    public function debt(): HasOne
    {
        return $this->hasOne(Debt::class);
    }
}
