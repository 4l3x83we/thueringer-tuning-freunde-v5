<?php

namespace App\Models\Frontend\Fahrzeuge;

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Fahrzeuge extends Model
{
    use LogsActivity, Sluggable;

    protected $fillable = ['user_id', 'album_id', 'team_id', 'fahrzeug', 'slug', 'baujahr', 'besonderheiten', 'motor', 'karosserie', 'felgen', 'fahrwerk', 'bremsen', 'innenraum', 'anlage', 'description', 'path', 'published', 'published_at'];

    protected $casts = ['published_at' => 'datetime', 'baujahr' => 'date:Y-m-d'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'fahrzeug',
            ],
        ];
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos()
    {
        return $this->belongsTo(Photos::class);
    }

    public function teams()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function baujahr()
    {
        return Carbon::parse($this->baujahr)->isoFormat('MMMM YYYY');
    }

    public function baujahrAlter()
    {
        return Carbon::parse($this->baujahr)->age;
    }

    public function fahrzeugBild()
    {
        if ($this->album_id) {
            foreach ($this->albums->photos as $photo) {
                if ($this->albums->thumbnail_id === $photo->id and $photo->published === 1) {
                    return asset($this->albums->path.'/'.$photo->images_thumbnail);
                }
            }
        }

        return null;
    }

    public function fahrzeugBildMeta()
    {
        if ($this->album_id) {
            foreach ($this->albums->photos as $photo) {
                if ($this->albums->thumbnail_id === $photo->id and $photo->published === 1) {
                    return $this->albums->path.'/'.$photo->images_thumbnail;
                }
            }
        } else {
            return 'images/logo.svg';
        }
    }

    public function albums()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('Fahrzeug')
            ->dontSubmitEmptyLogs();
    }
}
