<?php

namespace App\Listeners;

use App\Events\LoginEvent;
use Carbon\Carbon;
use DB;

class LoginListener
{
    public function __construct()
    {
    }

    public function handle(LoginEvent $event): void
    {
        $time = Carbon::now()->toDateTimeString();
        $vorname = $event->vorname;
        $nachname = $event->nachname;
        $email = $event->email;
        DB::table('login_history')->insert([
            'vorname' => $vorname,
            'nachname' => $nachname,
            'email' => $email,
            'ip_adresse' => request()->getClientIp(),
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }
}
