<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
        } catch (ValidationException $e) {
            $attemptedEmail = $request->input('email');

            $user = User::where(
                'email',
                $attemptedEmail
            )->first();

            $company = $user?->companies()->first();

            if ($user && $company) {
                AuditLog::create([
                    'company_id' => $company->id,
                    'user_id' => $user->id,
                    'action' => 'login_failed',
                    'auditable_type' => User::class,
                    'auditable_id' => $user->id,
                    'old_values' => [
                        'email' => $attemptedEmail,
                    ],
                    'new_values' => null,
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }

            throw $e;
        }

        $request->session()->regenerate();

        $user = Auth::user();

        $company = $user?->companies()->first();

        if ($user && $company) {
            AuditLog::create([
                'company_id' => $company->id,
                'user_id' => $user->id,
                'action' => 'login',
                'auditable_type' => User::class,
                'auditable_id' => $user->id,
                'old_values' => null,
                'new_values' => [
                    'email' => $user->email,
                ],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return redirect()->intended(
            route(
                'dashboard',
                absolute: false
            )
        );
    }

    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $company = $user?->companies()->first();

        if ($user && $company) {
            AuditLog::create([
                'company_id' => $company->id,
                'user_id' => $user->id,
                'action' => 'logout',
                'auditable_type' => User::class,
                'auditable_id' => $user->id,
                'old_values' => [
                    'email' => $user->email,
                ],
                'new_values' => null,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}