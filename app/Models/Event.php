<?php

namespace nullx27\Herald\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'event_id', 'id');
    }
}
