<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyLiqoAccessCode
{
    /**
     * Handle an incoming request.
     *
     * Gates the public Liqo attendance link behind a shared secret code
     * stored in settings.liqo_access_code. Mismatch returns 404 instead
     * of 403 so the existence of the route isn't revealed.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $code = (string) $request->route('code');
        $expected = (string) Setting::getOrCreateLiqoAccessCode();

        if ($code === '' || !hash_equals($expected, $code)) {
            abort(404);
        }

        return $next($request);
    }
}
