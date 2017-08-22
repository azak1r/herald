<?php

namespace nullx27\Herald\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function event() {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function getEmbedsAttribute($value)
    {
        return unserialize($value);
    }
}
