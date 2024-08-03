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
    // 
}
