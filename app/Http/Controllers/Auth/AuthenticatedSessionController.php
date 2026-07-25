<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $isAdminLogin = $request->boolean('admin');
        $guard = $isAdminLogin ? 'admin' : 'web';

        // Block alumni from logging in — single DB query, sebelum auth attempt
        if (!$isAdminLogin) {
            $student = \App\Models\Student::select('id', 'username', 'status_aktif')
                ->where('username', $request->username)
                ->first();
            if ($student && $student->status_aktif === 'Lulus') {
                return redirect()->route('login')
                    ->withInput($request->only('username'))
                    ->withErrors(['username' => 'Akun alumni tidak memiliki akses masuk.']);
            }
        }

        if (! Auth::guard($guard)->attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            return redirect()->route('login', ['admin' => $isAdminLogin ? 1 : null])
                ->withInput($request->only('username'))
                ->withErrors(['username' => trans('auth.failed')]);
        }

        $request->session()->regenerate();

        if ($isAdminLogin) {
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $wasAdmin = Auth::guard('admin')->check();

        // Logout dari kedua guard untuk memastikan session benar-benar bersih
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login yang sesuai
        if ($wasAdmin) {
            return redirect()->route('login', ['admin' => 1]);
        }

        return redirect('/');
    }
}
