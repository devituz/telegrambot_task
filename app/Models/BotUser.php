<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotUser extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'username',
    ];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

}
