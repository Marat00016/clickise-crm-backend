<?php

namespace App\Policies;

use App\Models\Bot;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BotPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Bot $bot): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the bot's space.
     */
    public function viewBots(User $user, Bot $bot): bool
    {
        return $this->view($user, $bot);
    }

    /**
     * Determine whether the user can view the bot's dialog.
     */
    public function viewDialogs(User $user, Bot $bot): bool
    {
        return $this->view($user, $bot);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Bot $bot): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Bot $bot): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Bot $bot): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Bot $bot): bool
    {
        return false;
    }
}
