<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Sale;
// use App\Models\SaleItem;

// class StatisticalController extends Controller
// {
//     public function monthlyStatistics()
//     {
//         $sales = SaleItem::selectRaw('strftime("%Y", created_at) as year, strftime("%m", created_at) as month, SUM(quantity*price) as total_amount')
//             ->groupBy('year', 'month')
//             ->orderBy('year', 'asc')
//             ->orderBy('month', 'asc')
//             ->get();

//         return view('DamSalesChart.salechart', compact('sales'));
//     }
// }



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleItem;
use Carbon\Carbon;

class StatisticalController extends Controller
{
     public function monthlySalesChart()
     {
    //     $data = SaleItem::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total_amount')
    //         ->groupBy('year', 'month')
    //         ->orderBy('year', 'asc')
    //         ->get();
    return view('DamSalesChart.salechart');
    //     $months = [];
    //     $amounts = [];

    //     foreach ($data as $sale) {
    //         $months[] = Carbon::createFromDate($data->year, $sale->month, 1)->format('F Y');
    //         $amounts[] = $data->total_amount;
        }

         
}
