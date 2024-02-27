<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\EmailAudit;

class EmailAuditController extends Controller
{
    public function index() {
        return inertia('Admin/EmailAudit/Index', [
            'emailAudits' => EmailAudit::query()
                ->orderByDesc('created_at')
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function show(String $emailAudit) {
        return inertia('Admin/EmailAudit/Show', [
            'emailAudit' => EmailAudit::findOrFail($emailAudit),
        ]);
    }
}
