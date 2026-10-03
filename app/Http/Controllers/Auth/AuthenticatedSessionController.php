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

            $company = $user?->companies()
                ->orderBy('companies.id')
                ->first();

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

        abort_unless($user, 401);

        /*
         * Determine the user's default company.
         *
         * The company is deliberately resolved through the
         * user's memberships, never from an arbitrary company.
         */
        $company = $user->companies()
            ->orderBy('companies.id')
            ->first();

        /*
         * A user without a company membership cannot enter
         * the tenant area of the application.
         */
        if (! $company) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Your account is not associated with any company.',
            ]);
        }

        /*
         * Establish the initial tenant context immediately
         * after authentication.
         */
        $request->session()->put(
            'current_company_id',
            $company->id
        );

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

        $companyId = $request->session()->get(
            'current_company_id'
        );

        $company = null;

        if ($user && $companyId) {
            $company = $user->companies()
                ->where(
                    'companies.id',
                    $companyId
                )
                ->first();
        }

        /*
         * Fallback only if the session does not contain
         * a valid current company.
         */
        if ($user && ! $company) {
            $company = $user->companies()
                ->orderBy('companies.id')
                ->first();
        }

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