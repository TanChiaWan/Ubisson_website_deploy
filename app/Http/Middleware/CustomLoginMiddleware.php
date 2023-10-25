<?php

namespace App\Http\Middleware;

use Closure;

class CustomLoginMiddleware
{
    public function handle($request, Closure $next)
    {
        $organizationId = $request->route('organizationid');

        // Add your conditions to determine if the redirection should be prevented
        if ($organizationId) {
            if (Auth::check()) {
                // User is logged in, redirect to a different page
                return redirect()->route('home');
            }
            // Redirect to a different page or return an error response
            return redirect()->route('custom-login', ['organizationid' => $organizationId]);
        }

        return $next($request);
    }
}