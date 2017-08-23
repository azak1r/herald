<?php

namespace nullx27\Herald\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use nullx27\Herald\Models\Announcement;
use nullx27\Herald\Models\Event;
use nullx27\Herald\Models\Setting;
use nullx27\Herald\Policies\AnnouncementPolicy;
use nullx27\Herald\Policies\EventPolicy;
use nullx27\Herald\Policies\SettingPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Event::class => EventPolicy::class,
        Announcement::class => AnnouncementPolicy::class,
        Setting::class => SettingPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
