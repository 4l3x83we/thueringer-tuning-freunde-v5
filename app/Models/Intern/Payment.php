<?php

namespace App\Models\Intern;

use App\Models\Frontend\Team\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['bezahlt', 'betrag', 'payment_for_month', 'date_of_payment', 'team_id'];

    protected $casts = ['payment_for_month' => 'datetime', 'date_of_payment' => 'date:Y-m-d'];

    public static function sort_by_month()
    {

        return self::whereBetween('payment_for_month', [now()->subYears(date('Y') - 2017), now()->addYear()])
            ->orderBy('payment_for_month', 'DESC')
            ->get()
            ->groupBy(function ($val) {
                return Carbon::parse($val->payment_for_month)->isoFormat('MMMM YYYY');
            });
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
