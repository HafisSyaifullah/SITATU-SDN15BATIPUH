<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogService
{
    public static function catat(string $activity, string $module): void
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'module' => $module,
        ]);
    }
}