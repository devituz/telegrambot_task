<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'date',
        'status',
    ];

    /**
     * Attendance belongs to a student.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


    public function getStatusLabelAttribute(): string
    {
        return $this->status ? '✅ Keldi' : '❌ Kelmadi';
    }

    public function getFormattedDateAttribute(): string
    {
        return \Carbon\Carbon::parse($this->date)
            ->timezone('Asia/Tashkent')
            ->format('Y-m-d');
    }
}
