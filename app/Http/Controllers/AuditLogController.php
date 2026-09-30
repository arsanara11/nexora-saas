<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\View\View;

class AuditLogController extends Controller
{
    public function index(Request $request): View
    {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        $query = $this->filteredQuery($request, $company->id);

        $logs = $query
            ->paginate(15)
            ->withQueryString();

        $actions = AuditLog::where('company_id', $company->id)
            ->whereNotNull('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        $summary = [
            'total' => AuditLog::where(
                'company_id',
                $company->id
            )->count(),

            'today' => AuditLog::where(
                'company_id',
                $company->id
            )
                ->whereDate('created_at', today())
                ->count(),

            'users' => AuditLog::where(
                'company_id',
                $company->id
            )
                ->whereNotNull('user_id')
                ->distinct('user_id')
                ->count('user_id'),

            'entities' => AuditLog::where(
                'company_id',
                $company->id
            )
                ->distinct('auditable_type')
                ->count('auditable_type'),
        ];

        return view(
            'audit-logs.index',
            compact(
                'logs',
                'actions',
                'summary'
            )
        );
    }


    public function export(Request $request): StreamedResponse
    {
        $company = $request->user()->companies()->first();

        abort_unless($company, 403);

        $logs = $this->filteredQuery(
            $request,
            $company->id
        )
            ->with('user')
            ->get();


        $filename = 'nexora-audit-log-' . now()->format('Y-m-d-H-i-s') . '.csv';


        return response()->streamDownload(
            function () use ($logs) {

                $handle = fopen('php://output', 'w');

                /*
                |--------------------------------------------------------------------------
                | CSV Header
                |--------------------------------------------------------------------------
                */

                fputcsv($handle, [
                    'Timestamp',
                    'User',
                    'Email',
                    'Action',
                    'Entity',
                    'Entity ID',
                    'IP Address',
                    'Old Values',
                    'New Values',
                ]);


                /*
                |--------------------------------------------------------------------------
                | CSV Rows
                |--------------------------------------------------------------------------
                */

                foreach ($logs as $log) {

                    $oldValues = $this->maskSensitiveValues(
                        $log->old_values ?? []
                    );

                    $newValues = $this->maskSensitiveValues(
                        $log->new_values ?? []
                    );


                    fputcsv($handle, [
                        optional($log->created_at)
                            ->format('Y-m-d H:i:s'),

                        $log->user?->name ?? 'System',

                        $log->user?->email ?? '',

                        $log->action,

                        class_basename(
                            $log->auditable_type
                        ),

                        $log->auditable_id,

                        $log->ip_address ?? '',

                        json_encode(
                            $oldValues,
                            JSON_UNESCAPED_UNICODE |
                            JSON_UNESCAPED_SLASHES
                        ),

                        json_encode(
                            $newValues,
                            JSON_UNESCAPED_UNICODE |
                            JSON_UNESCAPED_SLASHES
                        ),
                    ]);

                }


                fclose($handle);

            },
            $filename,
            [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Build Filtered Query
    |--------------------------------------------------------------------------
    */

    protected function filteredQuery(
        Request $request,
        int $companyId
    ) {
        $query = AuditLog::with('user')
            ->where('company_id', $companyId)
            ->latest();


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim(
                $request->string('search')->toString()
            );


            $query->where(function ($q) use ($search) {

                $q->where(
                    'action',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'auditable_type',
                    'like',
                    "%{$search}%"
                )

                ->orWhere(
                    'ip_address',
                    'like',
                    "%{$search}%"
                )

                ->orWhereHas('user', function ($userQuery) use ($search) {

                    $userQuery
                        ->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'email',
                            'like',
                            "%{$search}%"
                        );

                });

            });

        }


        /*
        |--------------------------------------------------------------------------
        | Action Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('action')) {

            $query->where(
                'action',
                $request->string('action')->toString()
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Date From
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_from')) {

            $query->whereDate(
                'created_at',
                '>=',
                $request->date('date_from')
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Date To
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_to')) {

            $query->whereDate(
                'created_at',
                '<=',
                $request->date('date_to')
            );

        }


        return $query;
    }


    /*
    |--------------------------------------------------------------------------
    | Mask Sensitive Values
    |--------------------------------------------------------------------------
    */

    protected function maskSensitiveValues(
        array $values
    ): array {

        $sensitiveKeys = [
            'password',
            'password_confirmation',
            'token',
            'remember_token',
            'access_token',
            'refresh_token',
            'secret',
            'api_key',
            'private_key',
        ];


        foreach ($values as $key => $value) {

            if (
                is_string($key)
                &&
                in_array(
                    strtolower($key),
                    $sensitiveKeys,
                    true
                )
            ) {

                $values[$key] = '[MASKED]';

                continue;
            }


            if (is_array($value)) {

                $values[$key] = $this->maskSensitiveValues(
                    $value
                );

            }

        }


        return $values;
    }
}