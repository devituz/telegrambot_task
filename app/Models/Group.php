<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'active',
        'bot_user_id',
        ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'group_student')->withTimestamps();
    }

    public function botUser()
    {
        return $this->belongsTo(BotUser::class);
    }


}
