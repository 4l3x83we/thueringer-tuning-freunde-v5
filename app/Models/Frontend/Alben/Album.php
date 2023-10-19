<?php

namespace App\Models\Frontend\Alben;

use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use Sluggable;

    protected $fillable = ['title', 'slug', 'size', 'description', 'kategorie', 'path', 'published', 'published_at', 'thumbnail_id', 'user_id'];

    protected $casts = ['published_at' => 'datetime'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
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

    /*public function fahrzeuges()
    {
        return $this->belongsTo(Fahrzeuge::class, 'fahrzeug_id');
    }*/

    public function photosCount()
    {
        return $this->photos()->count();
    }

    public function photos()
    {
        return $this->hasMany(Photos::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function thumbnail()
    {
        if ($this->thumbnail_id) {
            return asset($this->path.'/'.Photos::where('id', $this->thumbnail_id)->first()->images_thumbnail);
        }

        return null;
    }
}
