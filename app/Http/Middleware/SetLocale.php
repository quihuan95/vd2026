<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if ($locale && in_array($locale, ['vi', 'en'])) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        } else {
            $sessionLocale = session('locale', 'vi');
            app()->setLocale($sessionLocale);
        }

        return $next($request);
    }
}
