<?php

namespace App\Models\Intern;

use App\Models\Frontend\Team\Team;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Payment extends Model
{
    use LogsActivity;

    protected $fillable = ['bezahlt', 'name', 'betrag', 'payment_for_month', 'date_of_payment', 'team_id'];

    protected $casts = ['payment_for_month' => 'datetime', 'date_of_payment' => 'date:Y-m-d'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}")
            ->useLogName('Payment')
            ->dontSubmitEmptyLogs();
    }
}
