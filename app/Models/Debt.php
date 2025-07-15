<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Debt extends Model
{
    protected $fillable = [
        'group_student_id',
        'debt',
        'is_active',
    ];

    public function groupStudent(): BelongsTo
    {
        return $this->belongsTo(GroupStudent::class);
    }

    /**
     * Debt belongs to a student.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Debt belongs to a group.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}
