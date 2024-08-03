<?php

namespace App\Http\Controllers;

use App\Models\sale;
use App\Models\SaleItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{



    public function index()
    {
        $page = 'reports.index';
        return view('reports.index', [
            'page' => $page
        ]);
    }

    public function generateReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $start = Carbon::parse($request->input('start_date'));
        $end = Carbon::parse($request->input('end_date'));

        $totalRevenue = SaleItem::select(DB::raw('SUM(price * quantity) as total_revenue'))
            ->whereBetween('Sale_date', [$start, $end])
            ->get();

        $totalQuantity = SaleItem::select(DB::raw('SUM(quantity) as total_quantity'))
            ->whereBetween('Sale_date', [$start, $end])
            ->get();


        $report = [
            'totalRevenue' => $totalRevenue,
            'totalQuantity' => $totalQuantity,
        ];

        return view('reports.index', ['report' => $report]);
    }
}