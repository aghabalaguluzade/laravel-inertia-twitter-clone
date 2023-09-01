<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Tweet extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'liked' => 'boolean',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->belongsToMany(User::class, 'liked_tweets')->withTimestamps();
    }

    public function media(): MorphMany {
        return $this->morphMany(Media::class, 'model');
    }

}