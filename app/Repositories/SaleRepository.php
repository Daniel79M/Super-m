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
            DB::raw('strftime("%m", date) as month'), // Extrait le mois de la date
            DB::raw('COUNT(*) as total_sales') // Compte le nombre de ventes
        )
        ->whereYear('date', $year) // Filtre pour l'année en cours
        ->groupBy(DB::raw('strftime("%m", date)')) // Groupe par mois
        ->orderBy(DB::raw('strftime("%m", date)')) // Trie par mois
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
    $data = DB::table('sale_items')
        ->select(DB::raw("strftime('%Y', Sale_date) as year"),
                DB::raw("strftime('%m', Sale_date) as month"),
                DB::raw("SUM(price * quantity ) as total_revenue "))
                ->groupBy('sale_id', 'desc')
                ->orderBy('total_revenue')
                ->orderBy('%m', 'desc')
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
        'backgroundColor' => "#dd4c09"
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
        // 
    }
}

?>
