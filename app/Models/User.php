<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Auditable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)
            ->withPivot('role_id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'company_user',
            'user_id',
            'role_id'
        );
    }

    public function hasPermission(string $permission): bool
    {
        $company = $this->companies()->first();

        if (! $company) {
            return false;
        }

        $role = $this->roles()
            ->where('roles.company_id', $company->id)
            ->with('permissions')
            ->first();

        if (! $role) {
            return false;
        }

        return $role->permissions
            ->contains('name', $permission);
    }
}