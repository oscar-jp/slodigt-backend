<?php

namespace App\Policies;

use App\Models\Business;
use App\Models\User;

class BusinessPolicy
{
    /**
     * Determine whether the user can view the business.
     */
    public function view(?User $user, Business $business): bool
    {
        return true;
    }
    /**
     * Determine whether the user can create a business.
     */
    public function create(User $user): bool
    {
        // Only users with the business role may create businesses
        return $user->role === 'business';
    }

    /**
     * Determine whether the user can update the business.
     */
    public function update(User $user, Business $business): bool
    {
        return $user->id === $business->user_id;
    }

    /**
     * Determine whether the user can delete the business.
     */
    public function delete(User $user, Business $business): bool
    {
        return $user->id === $business->user_id;
    }
}
