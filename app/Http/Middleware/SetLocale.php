<?php

// app/Http/Middleware/SetLocale.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($locale = $request->get('locale')) {
            Session::put('locale', $locale);
        }

        App::setLocale(Session::get('locale', config('app.locale')));

        return $next($request);
    }
}