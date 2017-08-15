<?php

namespace nullx27\Herald\Notifications;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\DiscordWebhook\DiscordWebhookChannel;
use NotificationChannels\DiscordWebhook\DiscordWebhookMessage;


class Discord extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DiscordWebhookChannel::class];
    }


    public function toDiscordWebhook($notifiable) {

        $countdown_link = route('events.countdown', Hashids::encode($notifiable->id));

        return (new DiscordWebhookMessage())
            ->from('AnnouncementBot')
            ->content('*Annoucement*')
            ->embed(function ($embed) use ($notifiable, $countdown_link) {
                $embed->title($notifiable->title)
                    ->color(0xd20000)
                    ->description($notifiable->description)
                    ->field('Due', $notifiable->due->toDateTimeString(), true)
                    ->field('Created by', $notifiable->creator->name, true)
                    ->field('Countdown', $countdown_link, true);
            });
    }
}
