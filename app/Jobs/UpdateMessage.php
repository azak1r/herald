<?php

namespace nullx27\Herald\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use nullx27\Herald\Helpers\Discord;
use nullx27\Herald\Models\Message;
use Vinkla\Hashids\Facades\Hashids;

class UpdateMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;

    /**
     * Create a new job instance.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = $this->message->body;

        $embed = $this->message->event->create_embed();

        app(Discord::class)->update($this->message->channel_id, $this->message->message_id, $content, $embed);

        $this->message->embeds = serialize($embed);
        $this->message->save();
    }
}
