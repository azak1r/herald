<?php

namespace nullx27\Herald\Console\Commands;

use Illuminate\Console\Command;
use nullx27\Herald\Models\User;

class MakeUserAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'herald:admin {character_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Toggle user admin status';

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
        $character_id = $this->argument('character_id');

        $user = User::where('character_id', '=', $character_id)->firstOrFail();
        $user->admin = !$user->admin;
        $user->save();

        $this->info($user->name . ' is now ' . ($user->admin ? '' : 'not ') . 'an Admin');


    }
}
