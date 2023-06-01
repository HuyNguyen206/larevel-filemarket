<?php

namespace App\Models;

use App\Trait\HasPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sale extends Model
{
    use HasFactory, HasPrice;
    protected $guarded = [];
    protected $casts = [
        'paid_at' => 'datetime'
    ];

    protected static function booted()
    {
      static::creating(function (Sale $sale){
          $sale->token = Str::random(128);
      });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
