<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'read',
    ];

    public function getUrl() {
        // Extract the URL from the notification content
        preg_match('/\bhttps?:\/\/\S+\b/', $this->content, $matches);
        return $matches[0];
    }

    public function getNotificationContentWithoutLink()
    {
        return preg_replace('/\bhttps?:\/\/\S+\b/', '', $this->content);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
