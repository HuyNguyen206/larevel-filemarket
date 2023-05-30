<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn(int $price) => money($price),
            set: fn(float $price) => $price * 100
        )->withoutObjectCaching();
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function scopeLive(Builder $builder)
    {
        $builder->where('live', true);
    }
}
