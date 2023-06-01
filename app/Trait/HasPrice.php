<?php

namespace App\Trait;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPrice
{
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn(int $price) => money($price),
            set: fn(float $price) => $price * 100
        )->withoutObjectCaching();
    }
}
