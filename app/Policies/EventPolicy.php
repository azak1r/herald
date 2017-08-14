<?php

namespace nullx27\Herald\Policies;

use nullx27\Herald\Models\User;
use nullx27\Herald\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->admin)
            return true;
    }

    /**
     * Determine whether the user can view the event.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @param  \nullx27\Herald\Models\Event  $event
     * @return mixed
     */
    public function view(User $user, Event $event)
    {
        return true;
    }

    /**
     * Determine whether the user can create events.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the event.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @param  \nullx27\Herald\Models\Event  $event
     * @return mixed
     */
    public function update(User $user, Event $event)
    {
        return $user->id == $event->user_id; //@todo: admins should be able to edit everything
    }

    /**
     * Determine whether the user can delete the event.
     *
     * @param  \nullx27\Herald\Models\User  $user
     * @param  \nullx27\Herald\Models\Event  $event
     * @return mixed
     */
    public function delete(User $user, Event $event)
    {
        return $user->id == $event->user_id; //@todo: admins should be able to delete everything
    }
}
