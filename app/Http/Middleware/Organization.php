<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Organization
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if ($request->user()->organizations()->doesntExist()) {
            return redirect()->route('backoffice.organizations.request');
        }

        return $next($request);
    }
}
