<?php

namespace App\Http\Middleware;

use App\Models\User;
use Cache;
use Carbon\Carbon;
use Closure;
use DateTime;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Http\Request;

class ActivityByUser
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->check()) {
            $expiresAt = Carbon::now()->addMinutes(5); // 5 Minute online bleiben
            Cache::put('user-is-online-'.$this->auth->user()->id, true, $expiresAt);
            // zuletzt gesehen
            User::where('id', $this->auth->user()->id)->update(['last_seen' => (new DateTime())->format('Y-m-d H:i:s')]);
        }

        return $next($request);
    }
}
