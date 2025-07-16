<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

abstract class BaseModel extends Model
{
    protected $guarded = [];

    protected $timezone = 'Asia/Tashkent';


    protected function formatTime($value): ?string
    {
        return $value
            ? Carbon::createFromFormat('H:i:s', $value, 'UTC')
                ->setTimezone($this->timezone)
                ->format('H:i')
            : null;
    }


    public function getStartTimeAttribute($value): ?string
    {
        return $this->formatTime($value);
    }


    public function getEndTimeAttribute($value): ?string
    {
        return $this->formatTime($value);
    }
}
