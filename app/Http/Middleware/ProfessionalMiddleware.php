<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Professional;


class ProfessionalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
  

public function handle($request, Closure $next)
{
    if (Auth::check()) {
        $professional = Auth::user();
        $professional_id = $professional->professional_id;
        $user = Professional::where('professional_id', $professional_id)->first();
        
     $view->with('user', $user);
    }
    
    return $next($request);
}
}
