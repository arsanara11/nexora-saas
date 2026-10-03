<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],
        ]);

        $result = DB::transaction(function () use ($request, $validated) {
            /*
             * Create the user.
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
             * Create the user's first company.
             *
             * The current registration form does not collect
             * a separate company name, so the company name is
             * generated from the registered user's name.
             */
            $companyName = trim(
                $validated['name'] . "'s Company"
            );

            /*
             * Make sure the company slug is unique.
             */
            $baseSlug = Str::slug($companyName);

            if ($baseSlug === '') {
                $baseSlug = 'company';
            }

            $slug = $baseSlug;
            $counter = 2;

            while (
                Company::where('slug', $slug)->exists()
            ) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $company = Company::create([
                'name' => $companyName,
                'slug' => $slug,
                'timezone' => 'Asia/Jakarta',
                'currency' => 'IDR',
            ]);

            /*
             * Create the Owner role for this company.
             */
            $ownerRole = Role::create([
                'company_id' => $company->id,
                'name' => 'Owner',
                'slug' => 'owner',
                'description' => 'Full access to the company.',
            ]);

            /*
             * NEXORA defines permissions globally.
             * Give the new company's Owner role all
             * currently available permissions.
             */
            $permissionIds = Permission::query()
                ->pluck('id')
                ->all();

            if (empty($permissionIds)) {
                throw new \RuntimeException(
                    'NEXORA permissions have not been seeded.'
                );
            }

            $ownerRole->permissions()->attach(
                $permissionIds
            );

            /*
             * Attach the registered user to the company
             * as its Owner.
             */
            $user->companies()->attach(
                $company->id,
                [
                    'role_id' => $ownerRole->id,
                ]
            );

            return [
                'user' => $user,
                'company' => $company,
            ];
        });

        $user = $result['user'];
        $company = $result['company'];

        /*
         * Fire the normal Laravel registration event.
         */
        event(new Registered($user));

        /*
         * Authenticate the newly registered user.
         */
        Auth::login($user);

        /*
         * Regenerate the session after authentication.
         */
        $request->session()->regenerate();

        /*
         * Establish the tenant context immediately.
         */
        $request->session()->put(
            'current_company_id',
            $company->id
        );

        return redirect(
            route(
                'dashboard',
                absolute: false
            )
        );
    }
}