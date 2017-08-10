<?php

namespace nullx27\Herald\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use nullx27\Herald\Jobs\AnnounceEvent;
use nullx27\Herald\Models\Announcement;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'herald:announce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled announcements';

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
        $announcements = Announcement::where('date', '>=', Carbon::now())->get();

        foreach ($announcements as $announcement) {
            dispatch(new AnnounceEvent($announcement->event));
            $announcement->delete();
        }

    }
}
