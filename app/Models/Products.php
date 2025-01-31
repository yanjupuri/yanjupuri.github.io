<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'isAvailable',
        'status',
        'quantity'
    ];

    // public function cart(): BelongsToMany
    // {
    //     return $this->belongsToMany(Cart::class);
    // }
}
