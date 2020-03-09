<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Cassandra;
use Closure;
use Sentinel;
use Redirect;
use Session;

class SentinelUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $value = Session::get('pass');
        $time = Session::get('pass_time');
        if(!$value){
            return Redirect::route('login');
        }
        $delta = Carbon::now()->diffInSeconds($time);
        if ($delta > 600) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return Redirect::route('login');
            }
        } else {
            return $next($request);
        }
    }
}
