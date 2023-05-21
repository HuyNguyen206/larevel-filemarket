<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfStripeAccountEnableAlready
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$user = $request->user()) {
            return redirect()->route('login');
        }
        if ($user->stripe_account_enable) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
