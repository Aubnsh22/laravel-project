<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'recipients',
        'content',
    ];

    protected $casts = [
        'sent_at' => 'datetime', // Cast sent_at to a datetime (Carbon instance)
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
