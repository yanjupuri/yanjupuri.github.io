<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [
        'types',
        'rating',
        'comments',
        'image',
        'category',
        'replies'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
