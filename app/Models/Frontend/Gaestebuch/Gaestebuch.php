<?php

namespace App\Models\Frontend\Gaestebuch;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Gaestebuch extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'email', 'message', 'facebook', 'tiktok', 'instagram', 'webseite', 'ip_adresse', 'published', 'published_at'];

    protected $casts = ['published_at' => 'datetime'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('Gästebuch')
            ->dontSubmitEmptyLogs();
    }
}
