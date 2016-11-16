<?php

namespace App\Http\Middleware;

use Closure;

class DetectLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $segments = explode('.', $request->getHttpHost());
        $subdomain = $segments[0];

        $languages = config('app.available_locales');

        if (in_array($subdomain, $languages)) {
            trans()->setLocale($subdomain);
        }

        return $next($request);
    }
}