<?php

namespace App\Policies;

use App\Models\Space;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SpacePolicy
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
    public function view(User $user, Space $space): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the space's user.
     */
    public function viewUsers(User $user, Space $space): bool
    {
        return $this->view($user, $space);
    }

    /**
     * Determine whether the user can view the space's bot.
     */
    public function viewBots(User $user, Space $space): bool
    {
        return $this->view($user, $space);
    }

    /**
     * Determine whether the user can view the space's sales-status.
     */
    public function viewSalesStatuses(User $user, Space $space): bool
    {
        return $this->view($user, $space);
    }

    /**
     * Determine whether the user can view the space's support-status.
     */
    public function viewSupportStatuses(User $user, Space $space): bool
    {
        return $this->view($user, $space);
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
    public function update(User $user, Space $space): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Space $space): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Space $space): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Space $space): bool
    {
        return false;
    }
}
