<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Team Index
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

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


    /*
    |--------------------------------------------------------------------------
    | Create Team Member
    |--------------------------------------------------------------------------
    */

    public function create(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $currentUser = $request->user();

        $isOwner = $this->isCurrentUserOwner(
            $company,
            $currentUser
        );

        $rolesQuery = Role::where(
            'company_id',
            $company->id
        );

        /*
        |--------------------------------------------------------------------------
        | Manager cannot assign Owner
        |--------------------------------------------------------------------------
        */

        if (! $isOwner) {
            $rolesQuery->where(
                'slug',
                '!=',
                'owner'
            );
        }

        $roles = $rolesQuery
            ->orderBy('name')
            ->get();

        return view(
            'team.create',
            compact('roles')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Team Member
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $currentUser = $request->user();

        $isOwner = $this->isCurrentUserOwner(
            $company,
            $currentUser
        );

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
        | Resolve Selected Role
        |--------------------------------------------------------------------------
        */

        $role = Role::where(
            'company_id',
            $company->id
        )
            ->findOrFail(
                $validated['role_id']
            );


        /*
        |--------------------------------------------------------------------------
        | Prevent Manager From Assigning Owner
        |--------------------------------------------------------------------------
        */

        if (
            strtolower((string) $role->slug) === 'owner'
            && ! $isOwner
        ) {
            abort(
                403,
                'Only the company owner can assign the Owner role.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Create User + Company Membership + Audit
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $company,
            $role,
            $request
        ) {

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
                    'role_id' => $role->id,
                ]
            );


            /*
            |--------------------------------------------------------------------------
            | Audit Role Assignment
            |--------------------------------------------------------------------------
            */

            AuditLog::create([
                'company_id' => $company->id,
                'user_id' => $request->user()?->id,
                'action' => 'role_assigned',
                'auditable_type' => User::class,
                'auditable_id' => $user->id,
                'old_values' => null,
                'new_values' => [
                    'role_id' => $role->id,
                    'role' => $role->name,
                ],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        });


        return redirect()
            ->route('team.index')
            ->with(
                'success',
                'Team member added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Team Member
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        User $user
    ) {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $member = $company->users()
            ->where(
                'users.id',
                $user->id
            )
            ->with('roles')
            ->first();

        abort_unless($member, 404);


        /*
        |--------------------------------------------------------------------------
        | Current User Permission Level
        |--------------------------------------------------------------------------
        */

        $currentUser = $request->user();

        $isOwner = $this->isCurrentUserOwner(
            $company,
            $currentUser
        );


        /*
        |--------------------------------------------------------------------------
        | Resolve Member's Current Role
        |--------------------------------------------------------------------------
        */

        $currentRole = $member->roles->first();


        /*
        |--------------------------------------------------------------------------
        | Manager Cannot Manage Owner
        |--------------------------------------------------------------------------
        */

        if (
            $this->isOwnerRole($currentRole)
            && ! $isOwner
        ) {
            abort(
                403,
                'Only the company owner can manage the Owner account.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Available Roles
        |--------------------------------------------------------------------------
        */

        $rolesQuery = Role::where(
            'company_id',
            $company->id
        );


        /*
        |--------------------------------------------------------------------------
        | Manager Cannot Assign Owner
        |--------------------------------------------------------------------------
        */

        if (! $isOwner) {
            $rolesQuery->where(
                'slug',
                '!=',
                'owner'
            );
        }

        $roles = $rolesQuery
            ->orderBy('name')
            ->get();


        return view(
            'team.edit',
            compact(
                'member',
                'roles',
                'currentRole'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Team Member
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        User $user
    ) {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);


        /*
        |--------------------------------------------------------------------------
        | Load Member + Current Role
        |--------------------------------------------------------------------------
        */

        $member = $company->users()
            ->where(
                'users.id',
                $user->id
            )
            ->with('roles')
            ->first();

        abort_unless($member, 404);


        $currentRole = $member->roles->first();


        /*
        |--------------------------------------------------------------------------
        | Current User Permission Level
        |--------------------------------------------------------------------------
        */

        $currentUser = $request->user();

        $isOwner = $this->isCurrentUserOwner(
            $company,
            $currentUser
        );


        /*
        |--------------------------------------------------------------------------
        | Prevent Manager From Editing Owner
        |--------------------------------------------------------------------------
        */

        if (
            $this->isOwnerRole($currentRole)
            && ! $isOwner
        ) {
            abort(
                403,
                'Only the company owner can manage the Owner account.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

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

                Rule::unique(
                    'users',
                    'email'
                )->ignore($user->id),
            ],

            'role_id' => [
                'required',

                Rule::exists(
                    'roles',
                    'id'
                )->where(function ($query) use ($company) {

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
        | Resolve New Role
        |--------------------------------------------------------------------------
        */

        $newRole = Role::where(
            'company_id',
            $company->id
        )
            ->findOrFail(
                $validated['role_id']
            );


        /*
        |--------------------------------------------------------------------------
        | Prevent Manager From Assigning Owner
        |--------------------------------------------------------------------------
        */

        if (
            $this->isOwnerRole($newRole)
            && ! $isOwner
        ) {
            abort(
                403,
                'Only the company owner can assign the Owner role.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Check Whether Role Changed
        |--------------------------------------------------------------------------
        */

        $oldRoleId = $currentRole?->id;
        $oldRoleName = $currentRole?->name;

        $newRoleId = $newRole->id;
        $newRoleName = $newRole->name;

        $roleChanged =
            (int) $oldRoleId !== (int) $newRoleId;


        /*
        |--------------------------------------------------------------------------
        | Update Member + Role + Audit
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $member,
            $company,
            $request,
            $newRole,
            $newRoleId,
            $oldRoleId,
            $oldRoleName,
            $newRoleName,
            $roleChanged
        ) {

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
                    'user_id' => $request->user()?->id,
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

                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);
            }
        });


        return redirect()
            ->route('team.index')
            ->with(
                'success',
                'Team member updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Account Status
    |--------------------------------------------------------------------------
    */

    public function toggleStatus(
        Request $request,
        User $user
    ) {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);


        /*
        |--------------------------------------------------------------------------
        | Load Member
        |--------------------------------------------------------------------------
        */

        $member = $company->users()
            ->where(
                'users.id',
                $user->id
            )
            ->with('roles')
            ->first();

        abort_unless($member, 404);


        /*
        |--------------------------------------------------------------------------
        | Prevent Self Deactivation
        |--------------------------------------------------------------------------
        */

        if (
            $member->id === $request->user()?->id
        ) {

            return redirect()
                ->route('team.index')
                ->with(
                    'error',
                    'You cannot deactivate your own account.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Current User Permission Level
        |--------------------------------------------------------------------------
        */

        $isOwner = $this->isCurrentUserOwner(
            $company,
            $request->user()
        );


        /*
        |--------------------------------------------------------------------------
        | Prevent Manager From Changing Owner Status
        |--------------------------------------------------------------------------
        */

        $memberRole = $member->roles->first();

        if (
            $this->isOwnerRole($memberRole)
            && ! $isOwner
        ) {
            abort(
                403,
                'Only the company owner can change the Owner account status.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Toggle Status
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $member
        ) {

            $member->update([
                'is_active' => ! $member->is_active,
            ]);
        });


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


    /*
    |--------------------------------------------------------------------------
    | Check Current User Is Company Owner
    |--------------------------------------------------------------------------
    */

    private function isCurrentUserOwner(
        $company,
        ?User $user
    ): bool {

        if (! $user) {
            return false;
        }

        return $user->roles()
            ->where(
                'roles.company_id',
                $company->id
            )
            ->where(
                'roles.slug',
                'owner'
            )
            ->exists();
    }


    /*
    |--------------------------------------------------------------------------
    | Check Whether Role Is Owner
    |--------------------------------------------------------------------------
    */

    private function isOwnerRole(
        ?Role $role
    ): bool {

        if (! $role) {
            return false;
        }

        return strtolower(
            (string) $role->slug
        ) === 'owner';
    }
}