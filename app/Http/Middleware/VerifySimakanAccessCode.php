<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifySimakanAccessCode
{
    /**
     * Gate the public Ustadz Simakan link behind a shared secret code.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $code = (string) $request->route('code');
        $expected = (string) Setting::getOrCreateSimakanAccessCode();

        if ($code === '' || !hash_equals($expected, $code)) {
            abort(404);
        }

        return $next($request);
    }
}

