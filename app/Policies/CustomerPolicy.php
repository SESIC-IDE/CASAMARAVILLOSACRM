<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Customer;

class CustomerPolicy
{
    public function viewAny(User $user)
    {
        return in_array($user->role, ['admin', 'manager', 'seller']);
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function update(User $user, Customer $customer)
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function delete(User $user, Customer $customer)
    {
        return $user->role === 'admin';
    }
}
