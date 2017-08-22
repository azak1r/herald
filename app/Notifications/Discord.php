<?php

namespace nullx27\Herald\Notifications;

use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;


class Discord extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     * @return array
     * @internal param mixed $notifiable
     */
    public function via()
    {
        return [DiscordChannel::class];
    }


    public function toDiscord($notifiable) {

        $embed = $notifiable->create_embed();

        return new DiscordMessage('**Annoucement**', $embed);
    }
}
