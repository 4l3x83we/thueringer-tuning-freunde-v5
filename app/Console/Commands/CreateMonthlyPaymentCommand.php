<?php

namespace App\Console\Commands;

use App\Models\Frontend\Team\Team;
use App\Models\Intern\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateMonthlyPaymentCommand extends Command
{
    protected $signature = 'create:monthly-payment';

    protected $description = 'Erstelle automatisch jeden Monat die offene Zahlung und versende eine Mail.';

    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $firstOfQuarter = Carbon::parse($now)->firstOfQuarter()->month;
        $lastOfQuarter = Carbon::parse($now)->endOfQuarter()->month;
        $teams = Team::all();

        for ($i = 0; $i <= $lastOfQuarter - $firstOfQuarter; $i++) {
            foreach ($teams as $team) {
                if (! Payment::where('team_id', $team->id)->where('payment_for_month', Carbon::parse($now)->endOfQuarter()->startOfMonth())->latest()->first()) {
                    Payment::create([
                        'team_id' => $team->id,
                        'name' => $team->fullname(),
                        'betrag' => $team->zahlung,
                        'payment_for_month' => Carbon::parse($now)->addMonths($i)->startOfMonth(),
                        'date_of_payment' => null,
                    ]);
                }
            }
        }

    }
}
