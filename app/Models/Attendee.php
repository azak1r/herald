<?php

namespace nullx27\Herald\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = ['event_id', 'discord_name', 'discord_nick', 'discord_id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
