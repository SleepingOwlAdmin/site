<?php

namespace App\Http\Middleware;

use Closure;

class Webhook
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
        $hash = $request->header('X-Hub-Signature');
        $body = $request->getContent();

        $calculatedHash = 'sha1=' . hash_hmac('sha1', $body, config('github.hook_secret'));

        if ($hash != $calculatedHash) {
            abort(403);
        }

        $allowedRepositories = config('github.repositories', []);
        $repository = $request->json('repository.full_name');

        if (! array_key_exists($repository, $allowedRepositories)) {
            abort(403);
        }

        return $next($request);
    }
}