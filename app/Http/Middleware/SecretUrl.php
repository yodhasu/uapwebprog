<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecretUrl
{
    public function handle(Request $request, Closure $next)
    {
        $referrer = $request->headers->get('referer');

        // Replace 'your-url.com' with the page allowed to access the route
        if (!$referrer || !str_contains($referrer, 'http://127.0.0.1:8000/admin')) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
