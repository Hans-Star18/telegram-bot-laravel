<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\TokenReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $reports = TokenReport::all();

        return view('reports.index', compact('reports'));
    }
}
