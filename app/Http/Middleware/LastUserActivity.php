<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;

class LastUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        }

        // Checks users last active state, updates if it is in the past

        if (! $request->user()) {
            return $next($request);
        }

        if (! $request->user()->last_activity || $request->user()->last_activity->isPast()) {
            $request->user()->update([
                'last_activity' => now(),
            ]);
        }

        return $next($request);
    }
}
