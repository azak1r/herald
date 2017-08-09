<?php

namespace nullx27\Herald\Notifications;

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

        return (new DiscordWebhookMessage())
            ->from('AnnouncementBot')
            ->content('Annoucement')
            ->embed(function ($embed) use ($notifiable) {
                $embed->title($notifiable->title)
                    ->color(249)
                    ->description($notifiable->description)
                    ->field('Due', $notifiable->due, true)
                    ->field('Created by', $notifiable->creator->name, true);
            });
    }
}
