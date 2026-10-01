<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    protected static function bootAuditable(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Created
        |--------------------------------------------------------------------------
        */

        static::created(function ($model) {
            static::writeAuditLog(
                $model,
                'created',
                null,
                $model->getAttributes()
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Updated
        |--------------------------------------------------------------------------
        */

        static::updated(function ($model) {
            $changes = $model->getChanges();

            unset($changes['updated_at']);

            if (empty($changes)) {
                return;
            }

            $oldValues = [];

            foreach (array_keys($changes) as $field) {
                $oldValues[$field] = $model->getRawOriginal($field);
            }

            static::writeAuditLog(
                $model,
                'updated',
                $oldValues,
                $changes
            );
        });

        /*
        |--------------------------------------------------------------------------
        | Deleted
        |--------------------------------------------------------------------------
        */

        static::deleted(function ($model) {
            static::writeAuditLog(
                $model,
                'deleted',
                $model->getAttributes(),
                null
            );
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Write Audit Log
    |--------------------------------------------------------------------------
    */

    protected static function writeAuditLog(
        $model,
        string $action,
        ?array $oldValues,
        ?array $newValues
    ): void {
        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Resolve Company
        |--------------------------------------------------------------------------
        |
        | Prioritaskan company_id yang memang dimiliki oleh model.
        |
        | Jika model tidak memiliki company_id, gunakan current company
        | yang disimpan oleh SetCurrentCompany di session.
        |
        */

        $companyId = $model->company_id ?? null;

        if (! $companyId) {
            $currentCompanyId = session('current_company_id');

            if (! $currentCompanyId) {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Verify User Membership
            |--------------------------------------------------------------------------
            |
            | Pastikan user yang sedang login memang merupakan member
            | dari current company tersebut.
            |
            */

            if ($user) {
                $isMember = $user->companies()
                    ->where('companies.id', $currentCompanyId)
                    ->exists();

                if (! $isMember) {
                    return;
                }
            }

            $companyId = $currentCompanyId;
        }

        /*
        |--------------------------------------------------------------------------
        | Create Audit Log
        |--------------------------------------------------------------------------
        */

        AuditLog::create([
            'company_id' => $companyId,
            'user_id' => $user?->id,
            'action' => $action,
            'auditable_type' => get_class($model),
            'auditable_id' => $model->getKey(),
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}