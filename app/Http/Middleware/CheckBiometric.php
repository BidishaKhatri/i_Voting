<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBiometric
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // must be logged in first
        if (!session('voter_id')) {
            return redirect('/login');
        }

        // if not verified yet, force biometric page
        if (!session('biometric_verified')) {

            // allow ONLY biometric page
            if ($request->path() !== 'biometric' && $request->path() !== 'verify-face') {
                return redirect('/biometric');
            }
        }

        return $next($request);
    }
}
