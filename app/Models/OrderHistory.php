<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'purchased_date',
        'total_amount',
        'status',
        'user_id',
        'quantity',
        'base_price',
        'order_id',
        'mode_of_payment',
        'product_id'
    ];

    protected $table = 'order_history';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
