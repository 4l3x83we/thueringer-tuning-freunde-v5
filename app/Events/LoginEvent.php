<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class LoginEvent
{
    use Dispatchable;

    public $vorname;

    public $nachname;

    public $email;

    public function __construct($vorname, $nachname, $email)
    {
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->email = $email;
    }
}
