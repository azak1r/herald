<?php

namespace nullx27\Herald\Console\Commands;

use Illuminate\Console\Command;
use nullx27\Herald\Jobs\UpdateMessage;
use nullx27\Herald\Models\Message;

class UpdateMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'herald:update';

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
     * @return void
     */
    public function handle()
    {
        $messages = Message::all();

        foreach($messages as $message) {

            // Remove message objects for messages that have been updated
            if(!$message->event->active()) {
                $message->delete();
            }

            dispatch(new UpdateMessage($message));
        }
    }
}
