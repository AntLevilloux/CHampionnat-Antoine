<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
        if ( session()::has('lang')) {
            // Récupération de la 'lang' dans Session et activation
            app()::setLocale(session()::get('lang'));
        }

        return $next($request);
    }
}
