<?php

namespace App\Repositories;

use App\Charts\SaleChart;
use App\Models\sale;
use App\Models\SaleItem;
use App\Interfaces\SaleInterface;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleRepository implements SaleInterface
{
    public function index()
    {
        return sale::all();
    }

    public function show($id)
    {
        return Sale::findOrFail($id);
    }

    public function store(array $data)
    {
        return Sale::create($data);
    }

    public function update(array $data, $id)
    {
        return Sale::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Sale::destroy($id);
    }

    public function chartSalesByMonth()
    {
        $year = date('Y'); // L'année actuelle
    
        // Récupération du nombre total de ventes par mois
        $data = Sale::select(
            DB::raw('strftime("%m", created_at) as month'), // Extrait le mois de la date
            DB::raw('COUNT(*) as total_sales') // Compte le nombre de ventes
        )
        ->whereYear('created_at', $year) // Filtre pour l'année en cours
        ->groupBy(DB::raw('strftime("%m", created_at)')) // Groupe par mois
        ->orderBy(DB::raw('strftime("%m", created_at)')) // Trie par mois
        ->get();
    
        // Tableaux pour stocker les mois et le nombre de ventes
        $months = [];
        $salesCounts = [];
    
        // Tableau des noms de mois pour la conversion
        $monthNames = [
            '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
            '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug',
            '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'
        ];
    
        // Parcourez les données et remplissez les tableaux
        foreach ($data as $item) {
            $months[] = $monthNames[$item->month]; // Utilise le tableau pour obtenir le nom du mois
            $salesCounts[] = $item->total_sales;
        }
    
        // Créez le graphique
        $chart = new SaleChart;
        $chart->labels($months);
        $chart->dataset("Nombre de Ventes par Mois", "bar", $salesCounts)->options([
            'backgroundColor' => '#0b7ad4',
        ]);
    
        return $chart;
    }

    public function chartRevenueByMonth()
{
    $year = date('Y'); // L'année actuelle

    // Récupération des chiffres d'affaires totaux par mois
    $data = SaleItem::select(
        DB::raw('strftime("%m", created_at) as month'), // Extrait le mois de la date
        DB::raw('SUM(price * quantity) as total_revenue') // Calcule le chiffre d'affaires total
    )
    ->whereYear('created_at', $year) // Filtre pour l'année en cours
    ->groupBy(DB::raw('strftime("%m", created_at)')) // Groupe par mois
    ->orderBy(DB::raw('strftime("%m", created_at)')) // Trie par mois
    ->orderBy(DB::raw('strftime("%Y", created_at)')) // Trie par mois
    ->get();

    // Tableaux pour stocker les mois et les chiffres d'affaires
    $months = [];
    $revenues = [];

    // Tableau des noms de mois pour la conversion
    $monthNames = [
        '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr',
        '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug',
        '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'
    ];

    // Parcourez les données et remplissez les tableaux
    foreach ($data as $item) {
        $months[] = $monthNames[$item->month]; // Utilise le tableau pour obtenir le nom du mois
        $revenues[] = $item->total_revenue;
    }

    // Créez le graphique
    $chart = new SaleChart;
    $chart->labels($months);
    $chart->dataset("Chiffre d'Affaires par Mois", "bar", $revenues)->options([
        'backgroundColor' => '#046e24',
    ]);

    return $chart;
}

public function salesAmounts()
    {
        $data = SaleItem::select(
            DB::raw('SUM(price * quantity) as total_revenue')
        )->get();

        return $data;
}

public function monthlySalesChart()
    {
        // $year = date('Y');

        // $data = DB::table('sale_items')
        // ->select(DB::raw("strftime('year', date) as year"),
        //         DB::raw("strftime('month', date) as month"),
        //         DB::raw("SUM(amount) as total_amount"))
        // ->groupBy('year', 'month')
        // ->orderBy('year', 'asc')
        // ->orderBy('month', 'asc')
        // ->get();


        // $data = SaleItem::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total_amount')
        //     ->groupBy('year', 'month')
        //     ->orderBy('year', 'asc')
        //     ->get();

        // $months = [];
        // $amounts = [];

        // foreach ($data as $item) {
        //     $months[] = Carbon::createFromDate($item->year, $item->month, 1)->format('F Y');
        //     $amounts[] = $item->total_amount;
        // }

        // return $data;
    }



// public function totalBySale(){
//     $data = DB::table('sale')
//     ->join('sale_items', 'sale.id', '=', 'sale_items.sale_id')
//     ->select(DB::raw('SUM(sale_items.quantity * sale_items.price) as total_sales'))
//     ->get();

//     return $data;
// }

}

?>
