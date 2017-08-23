<?php

namespace nullx27\Herald\Policies;

use nullx27\Herald\Models\User;
use nullx27\Herald\Models\Setting;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->admin)
            return true;
    }

    /**
     * Determine whether the user can view the setting.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can create settings.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the setting.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @param  \nullx27\Herald\Models\Setting  $setting
     * @return mixed
     */
    public function update(User $user, Setting $setting)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the setting.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @param  \nullx27\Herald\Models\Setting  $setting
     * @return mixed
     */
    public function delete(User $user, Setting $setting)
    {
        return false;
    }
}
