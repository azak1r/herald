<?php

namespace nullx27\Herald\Policies;

use nullx27\Herald\Models\User;
use nullx27\Herald\Models\Announcement;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncementPolicy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        if($user->admin)
            return true;
    }

    /**
     * Determine whether the user can view the announcement.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @param  \nullx27\Herald\Models\Announcement  $announcement
     * @return mixed
     */
    public function view(User $user, Announcement $announcement)
    {
        return true;
    }

    /**
     * Determine whether the user can create announcements.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the announcement.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @param  \nullx27\Herald\Models\Announcement  $announcement
     * @return mixed
     */
    public function update(User $user, Announcement $announcement)
    {
        return $user->id == $announcement->event->user_id;
    }

    /**
     * Determine whether the user can delete the announcement.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @param  \nullx27\Herald\Models\Announcement  $announcement
     * @return mixed
     */
    public function delete(User $user, Announcement $announcement)
    {
        return $user->id == $announcement->event->user_id;
    }
}
