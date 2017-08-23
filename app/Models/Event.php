<?php

namespace nullx27\Herald\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Vinkla\Hashids\Facades\Hashids;

class Event extends Model
{
    use Notifiable;

    protected $dates = ['created_at', 'updated_at', 'due'];

    protected $fillable = ['title', 'description', 'due'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'event_id', 'id');
    }

    public function attendees()
    {
        return $this->hasMany(Attendee::class, 'event_id', 'id');
    }

    public function routeNotificationForDiscord() {
        return Setting::key('annoucement_channel_id');
    }

    public function active() {
        return $this->due > Carbon::now();
    }

    public function time_remaining() {
        if(!$this->active()){
            return false;
        }

        return $this->due->diffForHumans(null, true);
    }

    public function create_embed()
    {
        return [
            'title'         => $this->title,
            'color'         => 0xd20000,
            'description'   => $this->description,
            'fields'         => [
                [
                    'name' => 'Due',
                    'value' => $this->due->toDateTimeString() . ' EVE',
                    'inline' => true
                ],
                [
                    'name' => 'Created by',
                    'value' => $this->creator->name,
                    'inline' => true
                ],
                [
                    'name' => 'Event',
                    'value' => route('events.countdown', Hashids::encode($this->id)),
                    'inline' => false
                ],
            ],
            'footer' => [
                'text' => 'Starts in ' . $this->time_remaining()
            ]
        ];
    }

}
