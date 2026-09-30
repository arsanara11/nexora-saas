<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(
        Request $request,
        Closure $next,
        string $permission
    ): Response {
        $user = $request->user();

        abort_unless($user, 401);

        $company = $user->companies()->first();

        abort_unless($company, 403);

        $role = $user->roles()
            ->where('roles.company_id', $company->id)
            ->with('permissions')
            ->first();

        abort_unless($role, 403);

        $hasPermission = $role->permissions
            ->contains('name', $permission);

        abort_unless($hasPermission, 403);

        return $next($request);
    }
}