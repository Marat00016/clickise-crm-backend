<?php

namespace App\Policies;

use App\Models\SalesStatus;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SalesStatusPolicy
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
    public function view(User $user, SalesStatus $salesStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the sales-statuses space.
     */
    public function viewSpaces(User $user, SalesStatus $salesStatus): bool
    {
        return $this->view($user, $salesStatus);
    }

    /**
     * Determine whether the user can view the sales-statuses contact.
     */
    public function viewContacts(User $user, SalesStatus $salesStatus): bool
    {
        return $this->view($user, $salesStatus);
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
    public function update(User $user, SalesStatus $salesStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SalesStatus $salesStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SalesStatus $salesStatus): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SalesStatus $salesStatus): bool
    {
        return false;
    }
}
