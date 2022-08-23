<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CallLog;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $callLogs = CallLog::get();
        return view('backend.reports.index', compact('callLogs'));
    }
}
