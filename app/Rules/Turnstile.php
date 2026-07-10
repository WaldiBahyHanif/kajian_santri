<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Turnstile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Bypass Turnstile di environment local/non-production untuk memudahkan development
        if (! app()->environment('production')) {
            return;
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => env('TURNSTILE_SECRET_KEY', '1x0000000000000000000000000000000AA'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (! $response->json('success')) {
            $fail('Verifikasi Turnstile gagal. Silakan coba lagi.');
        }
    }
}
