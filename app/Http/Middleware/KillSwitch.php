<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

class KillSwitch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Fetch 'kill' flag from the settings table
        $kill = Setting::where('id', 1)->value('kill');

        if ($kill == 1) {
            // Show a custom "site down" page
            return response()->view('error.kill', [], 503);
        }

        return $next($request);
    }
}
