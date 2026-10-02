<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        return view(
            'settings.index',
            compact('company')
        );
    }

    public function update(Request $request)
    {
        $company = $request->attributes->get('currentCompany');

        abort_unless($company, 403);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique(
                    'companies',
                    'slug'
                )->ignore($company->id),
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'address' => [
                'nullable',
                'string',
            ],

            'timezone' => [
                'required',
                'string',
                'max:100',
            ],

            'currency' => [
                'required',
                'string',
                'size:3',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $logoPath = $company->logo;

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete(
                    $company->logo
                );
            }

            $logoPath = $request
                ->file('logo')
                ->store(
                    'logos',
                    'public'
                );
        }

        $company->update([
            'name' => $validated['name'],
            'slug' => Str::slug(
                $validated['slug']
            ),
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'address' => $validated['address'] ?? null,
            'logo' => $logoPath,
            'timezone' => $validated['timezone'],
            'currency' => strtoupper(
                $validated['currency']
            ),
        ]);

        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'Company settings updated successfully.'
            );
    }
}