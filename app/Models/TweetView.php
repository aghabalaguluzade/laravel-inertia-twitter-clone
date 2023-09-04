<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TweetView extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tweet_id',
        'ip_address',
        'user_agent'
    ];

    public function tweet() {
        return $this->belongsTo(Tweet::class);
    }
    
}
