<?php

namespace nullx27\Herald\Console\Commands;

use Illuminate\Console\Command;
use nullx27\Herald\Helpers\Discord;
use nullx27\Herald\Models\Attendee;
use nullx27\Herald\Models\Message;
use nullx27\Herald\Models\Setting;

class UpdateAttendees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'herald:attendees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $messages = Message::all();

        $emoji = Setting::key('rsvp_emoji');
        $guild_id = Setting::key('discord_guild_id');

        foreach($messages as $message) {

            $global_users = app(Discord::class)->get_message_reactions($message->channel_id, $message->message_id, $emoji);

            foreach($global_users as $user) {
                $guild_member = app(Discord::class)->get_guild_member($guild_id, $user['id']);

                $attendee = Attendee::firstOrCreate(
                    [
                        'discord_name' => $guild_member['user']['username'] . '#' . $guild_member['user']['discriminator'],
                        'discord_nick' => $guild_member['nick'],
                        'discord_id'   => $guild_member['user']['id'],
                        'event_id'     => $message->event->id
                    ]
                );
            }

        }
    }
}
