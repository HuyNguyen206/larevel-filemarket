<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{

    /**
     * Determine whether the user can view the model.
     * @param User|null $user
     * @param Product $product
     * @return bool
     */
    public function view(?User $user, Product $product): bool
    {
        return $product->live;
    }

}
