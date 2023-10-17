<?php

namespace App\Models\Frontend\Gaestebuch;

use Illuminate\Database\Eloquent\Model;

class Gaestebuch extends Model
{
    protected $fillable = ['name', 'email', 'message', 'facebook', 'tiktok', 'instagram', 'webseite', 'ip_adresse', 'published', 'published_at'];

    protected $casts = ['published_at' => 'datetime'];
}
