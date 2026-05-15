<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('cliente.dashboard', absolute: false) . '?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        $user = $request->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard')->with('verified', 1);
        } elseif ($user->hasRole('mecanico')) {
            return redirect()->route('mecanico.dashboard')->with('verified', 1);
        } elseif ($user->hasRole('cliente')) {
            return redirect()->route('cliente.dashboard')->with('verified', 1);
        }

        return redirect('/');
    }
}
