<?php

namespace App\Http\Middleware;

use App\Http\Enums\LanguageEnum;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allowed languages
        $supported = LanguageEnum::getLabels();

        // Read language from header
        $lang = $request->header('Accept-Language');

        // Normalize (e.g., az-AZ → az)
        if ($lang) {
            $lang = substr(strtolower($lang), 0, 2);
        }

        if (!in_array($lang, $supported)) {
            $lang = config('app.locale'); // fallback
        }

        App::setLocale($lang);

        return $next($request);
    }
}
