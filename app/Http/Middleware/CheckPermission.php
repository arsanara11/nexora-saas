<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {
        $user = $request->user();

        abort_unless($user, 401);

        /*
        |--------------------------------------------------------------------------
        | Current Company
        |--------------------------------------------------------------------------
        |
        | SetCurrentCompany middleware resolves the company that is currently
        | active for this authenticated user.
        |
        */

        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        /*
        |--------------------------------------------------------------------------
        | Resolve Role For Current Company
        |--------------------------------------------------------------------------
        */

        $role = $user->roles()
            ->where('roles.company_id', $company->id)
            ->with('permissions')
            ->first();

        abort_unless($role, 403);

        /*
        |--------------------------------------------------------------------------
        | Check Permission
        |--------------------------------------------------------------------------
        */

        $hasPermission = $role->permissions
            ->contains('name', $permission);

        abort_unless($hasPermission, 403);

        return $next($request);
    }
}