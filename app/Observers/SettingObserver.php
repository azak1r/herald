<?php

namespace nullx27\Herald\Observers;

use Illuminate\Support\Facades\Cache;
use nullx27\Herald\Models\Setting;


class SettingObserver {

    private function cache(Setting $setting) {
        Cache::forever($setting->key, $setting->value);
    }

    private function flush(Setting $setting)
    {
        Cache::forget($setting->key);
    }

    public function created(Setting $setting) {
        $this->cache($setting);
    }

    public function saved(Setting $setting)
    {
        $this->flush($setting);
        $this->cache($setting);
    }

    public function updated(Setting $setting)
    {
        $this->flush($setting);
        $this->cache($setting);
    }

    public function deleted(Setting $setting) {
        $this->flush($setting);
    }
}
