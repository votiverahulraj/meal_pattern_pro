<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * View any products
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * View single product
     */
    public function view(User $user, Product $product)
    {
        // admin can view all
        if ($user->hasRole('admin')) {
            return true;
        }

        // district user can view their own product
        if ($user->hasRole('district')) {
            return $user->district_id == $product->district_id;
        }

        return false;
    }

    /**
     * Create product
     */
    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    /**
     * Update product
     */
    public function update(User $user, Product $product)
    {
        return $user->hasRole('admin');
    }

    /**
     * Delete product
     */
    public function delete(User $user, Product $product)
    {
        return $user->hasRole('admin');
    }
}
