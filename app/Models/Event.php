<?php

namespace nullx27\Herald\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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

    public function routeNotificationForDiscordWebhook() {
        return config('services.discord.webhook');
    }

    public function active() {
        return $this->due > Carbon::now();
    }

}
