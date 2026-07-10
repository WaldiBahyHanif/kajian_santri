<?php

namespace App\Http\Controllers;

use App\Models\AdminActivityLog;

class AdminActivityLogController extends Controller
{
    public function index()
    {
        $logs = AdminActivityLog::with('admin')
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('admin.activity-log.index', compact('logs'));
    }
}
