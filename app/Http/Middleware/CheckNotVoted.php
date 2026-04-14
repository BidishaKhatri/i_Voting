<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNotVoted
{
    //prevents double voting
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('has_voted')) {
            return redirect('/thank-you')->with('error', 'You already voted');
        }
        return $next($request);
    }
}
