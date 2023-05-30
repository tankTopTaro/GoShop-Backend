<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'description',
        'price',
        'rating_rate',
        'rating_count',
        'image'
    ];

    public function carts() {
        return $this->hasMany(Cart::class);
    }
}
