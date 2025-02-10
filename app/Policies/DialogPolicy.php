<?php

namespace App\Policies;

use App\Models\Dialog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DialogPolicy
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
    public function view(User $user, Dialog $dialog): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the dialog's user.
     */
    public function viewUsers(User $user, Dialog $dialog): bool
    {
        return $this->view($user, $dialog);
    }

    /**
     * Determine whether the user can view the dialog's contact.
     */
    public function viewContacts(User $user, Dialog $dialog): bool
    {
        return $this->view($user, $dialog);
    }

    /**
     * Determine whether the user can view the dialog's message.
     */
    public function viewMessages(User $user, Dialog $dialog): bool
    {
        return $this->view($user, $dialog);
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
    public function update(User $user, Dialog $dialog): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Dialog $dialog): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Dialog $dialog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Dialog $dialog): bool
    {
        return false;
    }
}
