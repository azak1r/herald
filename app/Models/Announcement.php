<?php

namespace nullx27\Herald\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['date'];
    public $timestamps = false;

    protected $dates = ['date'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
