<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminAuditLogController extends Controller
{
    public function __invoke()
    {
        return view('admin.audit-logs');
    }
}
