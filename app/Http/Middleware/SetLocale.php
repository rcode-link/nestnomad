<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

final class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = Session::get('locale', config('app.locale'));

        if (in_array($locale, array_keys(config('app.available_locales')))) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
