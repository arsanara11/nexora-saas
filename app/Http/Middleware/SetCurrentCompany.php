<?php

namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentCompany
{
    /**
     * Handle an incoming request.
     *
     * Resolves and stores the authenticated user's current company.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Guest
        |--------------------------------------------------------------------------
        |
        | This middleware may eventually be attached to authenticated routes.
        | If a guest reaches it, simply continue and let the auth middleware
        | handle the request.
        |
        */

        if (! $user) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | Resolve Current Company
        |--------------------------------------------------------------------------
        |
        | First try the company stored in the session.
        | If it is missing or no longer belongs to the user, fall back to the
        | first company the user belongs to.
        |
        */

        $companyId = $request->session()->get('current_company_id');

        $company = null;

        if ($companyId) {
            $company = $user->companies()
                ->where('companies.id', $companyId)
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Fallback
        |--------------------------------------------------------------------------
        */

        if (! $company) {
            $company = $user->companies()
                ->orderBy('companies.id')
                ->first();

            if ($company) {
                $request->session()->put(
                    'current_company_id',
                    $company->id
                );
            } else {
                $request->session()->forget('current_company_id');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Make Current Company Available
        |--------------------------------------------------------------------------
        |
        | Controllers and other middleware can retrieve the resolved company
        | from the request without repeatedly using companies()->first().
        |
        */

        $request->attributes->set(
            'currentCompany',
            $company
        );

        return $next($request);
    }
}