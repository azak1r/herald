<?php

namespace nullx27\Herald\Listeners;

use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use nullx27\Herald\Jobs\RemoveOldMessage;
use nullx27\Herald\Models\Message;

class AnnoucementSentEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        $old_messages = Message::where('event_id', '=', $event->notifiable->id)->get();

        // there can only be one message!
        foreach ($old_messages as $msg) {
            dispatch(new RemoveOldMessage($msg));
            $msg->delete();
        }

        $message = new Message();
        $message->message_id = $event->response['id'];
        $message->channel_id = $event->response['channel_id'];
        $message->event_id = $event->notifiable->id;
        $message->body = $event->response['content'];
        $message->embeds = serialize($event->response['embeds']);

        $message->save();
    }
}
