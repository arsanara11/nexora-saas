<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $roles = Role::where(
            'company_id',
            $company->id
        )
            ->with('permissions')
            ->withCount('permissions')
            ->orderBy('name')
            ->get();

        return view(
            'roles.index',
            compact('roles')
        );
    }

    public function create(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $permissions = Permission::orderBy('name')
            ->get();

        return view(
            'roles.create',
            compact('permissions')
        );
    }

    public function store(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ]);

        $role = Role::create([
            'company_id' => $company->id,
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        $permissionIds = $validated['permissions'] ?? [];

        $role->permissions()->sync(
            $permissionIds
        );

        /*
        |--------------------------------------------------------------------------
        | Audit Permission Assignment
        |--------------------------------------------------------------------------
        */

        if (! empty($permissionIds)) {
            $permissionNames = Permission::whereIn(
                'id',
                $permissionIds
            )
                ->orderBy('name')
                ->pluck('name')
                ->values()
                ->toArray();

            AuditLog::create([
                'company_id' => $company->id,
                'user_id' => $request->user()?->id,
                'action' => 'permissions_updated',
                'auditable_type' => Role::class,
                'auditable_id' => $role->id,
                'old_values' => null,
                'new_values' => [
                    'role' => $role->name,
                    'permissions' => $permissionNames,
                ],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Role created successfully.'
            );
    }

    public function edit(
        Request $request,
        Role $role
    ) {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $role->company_id === $company->id,
            404
        );

        $permissions = Permission::orderBy('name')
            ->get();

        $role->load('permissions');

        return view(
            'roles.edit',
            compact(
                'role',
                'permissions'
            )
        );
    }

    public function update(
        Request $request,
        Role $role
    ) {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $role->company_id === $company->id,
            404
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Capture Existing Permissions Before Sync
        |--------------------------------------------------------------------------
        */

        $oldPermissionIds = $role->permissions()
            ->pluck('permissions.id')
            ->sort()
            ->values()
            ->toArray();

        $oldPermissionNames = Permission::whereIn(
            'id',
            $oldPermissionIds
        )
            ->orderBy('name')
            ->pluck('name')
            ->values()
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Update Role
        |--------------------------------------------------------------------------
        */

        $role->update([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Sync Permissions
        |--------------------------------------------------------------------------
        */

        $permissionIds = $validated['permissions'] ?? [];

        $newPermissionIds = collect($permissionIds)
            ->map(
                fn ($id) => (int) $id
            )
            ->sort()
            ->values()
            ->toArray();

        $role->permissions()->sync(
            $newPermissionIds
        );

        /*
        |--------------------------------------------------------------------------
        | Audit Permission Changes
        |--------------------------------------------------------------------------
        */

        if ($oldPermissionIds !== $newPermissionIds) {
            $newPermissionNames = Permission::whereIn(
                'id',
                $newPermissionIds
            )
                ->orderBy('name')
                ->pluck('name')
                ->values()
                ->toArray();

            AuditLog::create([
                'company_id' => $company->id,
                'user_id' => $request->user()?->id,
                'action' => 'permissions_updated',
                'auditable_type' => Role::class,
                'auditable_id' => $role->id,
                'old_values' => [
                    'role' => $role->name,
                    'permissions' => $oldPermissionNames,
                ],
                'new_values' => [
                    'role' => $role->name,
                    'permissions' => $newPermissionNames,
                ],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Role updated successfully.'
            );
    }

    public function destroy(
        Request $request,
        Role $role
    ) {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        abort_unless(
            $role->company_id === $company->id,
            404
        );

        if ($role->name === 'Owner') {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'The Owner role cannot be deleted.'
                );
        }

        if ($role->users()->exists()) {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'This role is currently assigned to team members.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Capture Permissions Before Deletion
        |--------------------------------------------------------------------------
        */

        $permissionIds = $role->permissions()
            ->pluck('permissions.id')
            ->sort()
            ->values()
            ->toArray();

        $permissionNames = Permission::whereIn(
            'id',
            $permissionIds
        )
            ->orderBy('name')
            ->pluck('name')
            ->values()
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Detach Permissions
        |--------------------------------------------------------------------------
        */

        $role->permissions()->detach();

        /*
        |--------------------------------------------------------------------------
        | Audit Permission Detach
        |--------------------------------------------------------------------------
        */

        if (! empty($permissionNames)) {
            AuditLog::create([
                'company_id' => $company->id,
                'user_id' => $request->user()?->id,
                'action' => 'permissions_detached',
                'auditable_type' => Role::class,
                'auditable_id' => $role->id,
                'old_values' => [
                    'role' => $role->name,
                    'permissions' => $permissionNames,
                ],
                'new_values' => [
                    'permissions' => [],
                ],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Role
        |--------------------------------------------------------------------------
        */

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Role deleted successfully.'
            );
    }
}