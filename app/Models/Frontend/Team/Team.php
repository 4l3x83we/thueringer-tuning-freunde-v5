<?php

namespace App\Models\Frontend\Team;

use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Intern\Calendar;
use App\Models\Intern\Payment;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Team extends Model
{
    use LogsActivity, Sluggable;

    protected static $logAttributes = ['vorname', 'nachname'];

    protected $fillable = ['user_id', 'fahrzeuges_id', 'slug', 'anrede', 'vorname', 'nachname', 'strasse', 'plz', 'wohnort', 'telefon', 'mobil', 'email', 'geburtsdatum', 'beruf', 'description', 'tiktok', 'instagram', 'facebook', 'funktion', 'ip_adresse', 'fahrzeug_vorhanden', 'photo_id', 'path', 'published', 'published_at'];

    protected $casts = [
        'geburtsdatum' => 'date:Y-m-d',
        'published_at' => 'datetime',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug',
            ],
        ];
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fahrzeuges()
    {
        return $this->hasMany(Fahrzeuge::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class, 'user_id');
    }

    public function photos()
    {
        return $this->hasMany(Photos::class, 'user_id');
    }

    public function photosFahrzeuge()
    {
        return $this->hasMany(Photos::class, 'fahrzeuges_id');
    }

    public function photosProfil()
    {
        return $this->hasMany(Photos::class, 'team_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function fullname()
    {
        return $this->vorname.' '.$this->nachname;
    }

    public function plzOrt()
    {
        return $this->plz.' '.$this->wohnort;
    }

    public function kontaktTeamUser()
    {
        $telefon = $this->telefon;
        $mobil = $this->mobil;
        $email = $this->email;
        $kontakt = null;
        if ($telefon and $mobil and $email) {
            $kontakt = '<a href="tel:'.$telefon.'">'.$telefon.'</a> / '.'<a href="tel:'.$mobil.'">'.$mobil.'</a><br><a href="mailto:'.$email.'">'.$email.'</a>';
        } elseif ($telefon and $email) {
            $kontakt = '<a href="tel:'.$telefon.'">'.$telefon.'</a><br><a href="mailto:'.$email.'">'.$email.'</a>';
        } elseif ($mobil and $email) {
            $kontakt = '<a href="tel:'.$mobil.'">'.$mobil.'</a><br><a href="mailto:'.$email.'">'.$email.'</a>';
        }

        return $kontakt;
    }

    public function geburtsdatum()
    {
        return Carbon::parse($this->geburtsdatum)->isoFormat('DD.MM.YYYY');
    }

    public function alter()
    {
        return Carbon::parse($this->geburtsdatum)->age.' Jahre';
    }

    public function profilBild()
    {

        if ($this->photo_id) {
            $image = Photos::where('id', $this->photo_id)->first()->images;

            return asset($this->path.'/'.$image);
        }

        return null;
    }

    public function profilBildMeta()
    {
        if ($this->photo_id) {
            foreach ($this->photosProfil as $photo) {
                if ($photo->id === $this->photo_id) {
                    return asset($this->path.'/'.$photo->images);
                }
            }
        } else {
            return 'images/logo.svg';
        }
    }

    public function payments()
    {
        $this->hasMany(Payment::class);
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*', 'users.name', 'users.email'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('Team')
            ->dontSubmitEmptyLogs();
    }
}
