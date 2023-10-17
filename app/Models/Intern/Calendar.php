<?php

namespace App\Models\Intern;

use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Calendar extends Model
{
    use LogsActivity;

    protected $fillable = ['team_id', 'start', 'end', 'status', 'is_all_day', 'title', 'description', 'event_id', 'event_color', 'event_background_color', 'event_border_color', 'event_text_color', 'color', 'colorID'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function eventDate()
    {
        if ($this->is_all_day === 1) {
            $start = Carbon::parse($this->start)->format('d.m.y H:i');
            $end = Carbon::parse($this->end)->format('d.m.y H:i');

            return 'Ganztägig <br>'.$start.' - '.$end;
        }

        $start = Carbon::parse($this->start)->format('d.m.y H:i');
        $end = Carbon::parse($this->end)->format('d.m.y H:i');

        return $start.' - '.$end;
    }

    public function eventToday()
    {
        $endDate = Carbon::parse($this->end)->format('d.m.y');
        $endTime = Carbon::parse($this->end)->format('d.m.y H:i');

        return [
            'endDate' => $endDate === date('d.m.y'),
            'endTime' => $endTime >= date('d.m.y H:i'),
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('Kalender')
            ->dontSubmitEmptyLogs();
    }
}
