<?php

namespace App\Models\Frontend\Alben;

use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Photos extends Model
{
    use LogsActivity, Sluggable;

    protected $fillable = ['user_id', 'album_id', 'fahrzeuges_id', 'team_id', 'slug', 'size', 'images', 'images_thumbnail', 'thumbnail', 'published', 'published_at'];

    protected $casts = ['published_at' => 'datetime'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'id',
            ],
        ];
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function teams()
    {
        return $this->belongsTo(Team::class, 'user_id');
    }

    public function albums()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function fahrzeuges()
    {
        return $this->belongsTo(Fahrzeuge::class, 'fahrzeug_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('Photo')
            ->dontSubmitEmptyLogs();
    }
}
