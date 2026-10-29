<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'liqo.access' => \App\Http\Middleware\VerifyLiqoAccessCode::class,
            'simakan.access' => \App\Http\Middleware\VerifySimakanAccessCode::class,
        ]);
        $middleware->appendToGroup('web', \App\Http\Middleware\CheckStatusAktif::class);

        // Dipanggil saat request gagal auth untuk guard yang dibutuhkan middleware 'auth'.
        // - Kalau sebenarnya sudah login di guard lain (admin kena rute santri, atau
        //   sebaliknya), arahkan ke dashboard guard itu alih-alih memaksa login ulang.
        // - Kalau benar-benar belum login sama sekali, arahkan ke halaman login yang
        //   sesuai (bukan ke /dashboard atau /admin/*, yang keduanya butuh auth lagi
        //   dan akan menyebabkan redirect loop tak berujung untuk tamu).
        $middleware->redirectGuestsTo(function ($request) {
            if (\Illuminate\Support\Facades\Auth::guard('admin')->check()) {
                return route('admin.dashboard');
            }
            if (\Illuminate\Support\Facades\Auth::guard('web')->check()) {
                return route('dashboard');
            }
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('login', ['admin' => 1]);
            }
            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
