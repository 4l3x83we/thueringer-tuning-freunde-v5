<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Frontend\Alben\Album;
use App\Models\Frontend\Alben\Photos;
use App\Models\Frontend\Fahrzeuge\Fahrzeuge;
use App\Models\Frontend\Team\Team;
use App\Notifications\WillkommenNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, LogsActivity, Notifiable, ReceivesWelcomeNotification;

    protected static $logAttributes = ['name', 'email'];

    protected static $ignoreChangedAttributes = ['password', 'updated_at'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vorname',
        'nachname',
        'email',
        'password',
        'last_seen',
        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function userActivity($id)
    {
        return self::where('id', $id)->first()->fullname();
    }

    public function fullname()
    {
        return auth()->user()->vorname.' '.auth()->user()->nachname;
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function fahrzeuges()
    {
        return $this->hasMany(Fahrzeuge::class);
    }

    public function teams()
    {
        return $this->hasOne(Team::class, 'user_id');
    }

    public function profilBild()
    {
        if (auth()->user()->teams && auth()->user()->teams->photo_id) {
            foreach (auth()->user()->teams->photos as $photo) {
                return asset(auth()->user()->teams->path.'/'.$photo->images);
            }

        }

        return null;
    }

    public function photos()
    {
        return $this->hasMany(Photos::class);
    }

    public function teamID()
    {
        return Frontend\Team\Team::where('user_id', auth()->id())->first()->id;
    }

    public function sendWelcomeNotification(Carbon $validUntil)
    {
        $this->notify(new WillkommenNotification($validUntil));
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('User')
            ->dontSubmitEmptyLogs();
    }
}
