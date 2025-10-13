<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QueryModeMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $mode = strtolower((string) ($request->query('mode') ?? $request->query('gate')));

        if (!in_array($mode, ['one','two','three'], true)) {
            abort(403, 'ACCESS DENIED: add ?mode=one (або two/three) до URL');
        }


        $request->attributes->set('mode', $mode);
        view()->share('mode', $mode);

        return $next($request);
    }


}
