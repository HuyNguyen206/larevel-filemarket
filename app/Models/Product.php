<?php

namespace App\Models;

use App\Trait\HasPrice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasPrice;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function scopeLive(Builder $builder)
    {
        $builder->where('live', true);
    }

    public function applicationFeeAmount()
    {
        return $this->price->multiply(10)->divide(100);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
