<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GateWordMiddleware
{
    private array $words = ['zero','one','two','three','four','five','six','seven','eight','nine'];


    public function handle(Request $request, Closure $next, int $index): Response
    {
        $expected = $this->words[$index] ?? null;
        $provided = $request->query('gate');

        if (!$expected || $provided !== $expected) {
            return response('Forbidden (gate middleware)', 403);
        }
        return $next($request);
    }
}
