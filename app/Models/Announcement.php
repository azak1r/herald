<?php

namespace nullx27\Herald\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public function event()
    {
        return $this->belongsTo(Event::class, 'id', 'event_id');
    }
}
