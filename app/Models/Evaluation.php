<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Evaluation extends Model
{
    protected $fillable = [
        'group_student_id',
        'score',
        'desc',
        'date',
    ];

    /**
     * Evaluation belongs to group_student.
     */
    public function groupStudent(): BelongsTo
    {
        return $this->belongsTo(GroupStudent::class);
    }

    /**
     * Evaluation belongs to a student through groupStudent.
     */
    public function student()
    {
        return $this->groupStudent?->student();
    }

    /**
     * Evaluation belongs to a group through groupStudent.
     */
    public function group()
    {
        return $this->groupStudent?->group();
    }

    /**
     * O‘zbekiston vaqtiga formatlangan sana
     */
    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->date)
            ->setTimezone('Asia/Tashkent')
            ->format('Y-m-d');
    }
}
