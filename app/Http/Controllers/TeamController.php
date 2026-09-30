<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function index()
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $members = $company->users()
            ->with('roles')
            ->orderBy('name')
            ->get();

        $roles = Role::where(
            'company_id',
            $company->id
        )
            ->orderBy('name')
            ->get();

        return view(
            'team.index',
            compact(
                'members',
                'roles'
            )
        );
    }


    public function create()
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $roles = Role::where(
            'company_id',
            $company->id
        )
            ->orderBy('name')
            ->get();

        return view(
            'team.create',
            compact('roles')
        );
    }


    public function store(Request $request)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role_id' => [
                'required',
                Rule::exists('roles', 'id')
                    ->where(function ($query) use ($company) {
                        $query->where(
                            'company_id',
                            $company->id
                        );
                    }),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Create User
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make(
                $validated['password']
            ),
            'is_active' => true,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Attach Company + Role
        |--------------------------------------------------------------------------
        */

        $company->users()->attach(
            $user->id,
            [
                'role_id' => $validated['role_id'],
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Audit Role Assignment
        |--------------------------------------------------------------------------
        */

        $role = Role::where(
            'company_id',
            $company->id
        )->find(
            $validated['role_id']
        );

        if ($role) {

            AuditLog::create([
                'company_id' => $company->id,
                'user_id' => auth()->id(),
                'action' => 'role_assigned',
                'auditable_type' => User::class,
                'auditable_id' => $user->id,
                'old_values' => null,
                'new_values' => [
                    'role_id' => $role->id,
                    'role' => $role->name,
                ],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }


        return redirect()
            ->route('team.index')
            ->with(
                'success',
                'Team member added successfully.'
            );
    }


    public function edit(User $user)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $member = $company->users()
            ->where('users.id', $user->id)
            ->with('roles')
            ->first();

        abort_unless($member, 404);

        $roles = Role::where(
            'company_id',
            $company->id
        )
            ->orderBy('name')
            ->get();

        $currentRole = $member->roles->first();

        return view(
            'team.edit',
            compact(
                'member',
                'roles',
                'currentRole'
            )
        );
    }


    public function update(
        Request $request,
        User $user
    ) {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);


        /*
        |--------------------------------------------------------------------------
        | Load Member + Current Role
        |--------------------------------------------------------------------------
        */

        $member = $company->users()
            ->where('users.id', $user->id)
            ->with('roles')
            ->first();

        abort_unless($member, 404);

        $currentRole = $member->roles->first();


        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'role_id' => [
                'required',
                Rule::exists('roles', 'id')
                    ->where(function ($query) use ($company) {
                        $query->where(
                            'company_id',
                            $company->id
                        );
                    }),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Basic User Information
        |--------------------------------------------------------------------------
        */

        $member->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Password
        |--------------------------------------------------------------------------
        */

        if (! empty($validated['password'])) {

            $member->update([
                'password' => Hash::make(
                    $validated['password']
                ),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Resolve New Role
        |--------------------------------------------------------------------------
        */

        $newRole = Role::where(
            'company_id',
            $company->id
        )->findOrFail(
            $validated['role_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Check Whether Role Changed
        |--------------------------------------------------------------------------
        */

        $oldRoleId = $currentRole?->id;
        $oldRoleName = $currentRole?->name;

        $newRoleId = $newRole->id;
        $newRoleName = $newRole->name;

        $roleChanged = (int) $oldRoleId !== (int) $newRoleId;


        /*
        |--------------------------------------------------------------------------
        | Update Company Role
        |--------------------------------------------------------------------------
        */

        $company->users()->updateExistingPivot(
            $member->id,
            [
                'role_id' => $newRoleId,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | Audit Role Change
        |--------------------------------------------------------------------------
        */

        if ($roleChanged) {

            AuditLog::create([
                'company_id' => $company->id,
                'user_id' => auth()->id(),
                'action' => 'role_changed',
                'auditable_type' => User::class,
                'auditable_id' => $member->id,
                'old_values' => [
                    'role_id' => $oldRoleId,
                    'role' => $oldRoleName,
                ],
                'new_values' => [
                    'role_id' => $newRoleId,
                    'role' => $newRoleName,
                ],
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }


        return redirect()
            ->route('team.index')
            ->with(
                'success',
                'Team member updated successfully.'
            );
    }


    public function toggleStatus(User $user)
    {
        $company = auth()->user()->companies()->first();

        abort_unless($company, 403);

        $member = $company->users()
            ->where('users.id', $user->id)
            ->first();

        abort_unless($member, 404);


        /*
        |--------------------------------------------------------------------------
        | Prevent Self Deactivation
        |--------------------------------------------------------------------------
        */

        if ($member->id === auth()->id()) {

            return redirect()
                ->route('team.index')
                ->with(
                    'error',
                    'You cannot deactivate your own account.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Toggle Status
        |--------------------------------------------------------------------------
        */

        $member->update([
            'is_active' => ! $member->is_active,
        ]);


        $message = $member->is_active
            ? 'Team member activated successfully.'
            : 'Team member deactivated successfully.';


        return redirect()
            ->route('team.index')
            ->with(
                'success',
                $message
            );
    }
}