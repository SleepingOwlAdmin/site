<?php

namespace App\Http\Middleware;

use App\Contracts\LocaleInterface;
use Closure;

class DetectLocaleMiddleware
{
    /**
     * @var LocaleInterface
     */
    protected $locale;

    /**
     * DetectLocaleMiddleware constructor.
     *
     * @param LocaleInterface $locale
     */
    public function __construct(LocaleInterface $locale)
    {
        $this->locale = $locale;
    }

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

        if (in_array($subdomain, $this->locale->getAvailableLocales())) {
            trans()->setLocale($subdomain);
        }

        return $next($request);
    }
}