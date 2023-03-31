<?php

namespace App\Http\Controllers\Dashboard;

use App\Export\TokensReport;
use App\Models\TokenReport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $reports = TokenReport::all();

        return view('reports.index', compact('reports'));
    }

    public function exportToExcel()
    {
        $tokensReport = TokenReport::all();

        return Excel::download(new TokensReport($tokensReport), 'tokensReport.xlsx');
    }
}
