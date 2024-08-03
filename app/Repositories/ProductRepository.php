<?php

namespace App\Repositories;

use App\Charts\ProductChart;
use App\Interfaces\ProductInterface;
use App\Models\Category;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function store(array $data)
    {
        return Product::create($data);
    }

    public function update(array $data, $id)
    {
        return Product::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Product::destroy($id);
    }

    public function chartByCategory()
    {


        $data = Product::select('category_id')  // Sélectionne l'ID de la catégorie des produits.
            ->selectRaw('COUNT(*) as count')  // Compte le nombre de produits par catégorie.
            ->groupBy('category_id')  //  Regroupe les produits par catégorie.
            ->get();     //  Récupère les résultats.

        $json_data = json_decode($data, true); //Convertit les données récupérées en un tableau associatif PHP.

        $names = [];
        $count = [];

        $i = 0;

        foreach ($json_data as $item) {
            $i++;

            //$names pour les noms des catégories 
            //$count pour le nombre de produits par catégorie.
            $count[] = $item['count'];
            $names[] = Category::find($item['category_id'])->name;
        }

        //Création du graphique (classe ProductChart)
        $chart = new ProductChart;
        $chart->labels($names); //Définit les labels en haut du graphique avec les noms des catégories

        //Ajoute un jeu de données au graphique de type "pie" (camembert) avec les comptes de produits
        $chart->dataset("Top", "pie", $count)->options([
            'backgroundColor' => ['#046e24', "#dd4c09", "#0b7ad4", "#b20bd4", "#d1163e", "#178897", "#587512"],
        ]);

        return $chart;
    }

    public function chartTopProducts()
    {
        $data = Product::select('name')
            ->selectRaw('SUM(sale_items.quantity) as total_sales')
            ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sales')
            ->limit(10)
            ->get();

        $json_data = json_decode($data, true);

        $productNames = [];
        $salesCount = [];

        foreach ($json_data as $item) {
            $productNames[] = $item['name'];
            $salesCount[] = $item['total_sales'];
        }

        $chart = new ProductChart;
        $chart->labels($productNames);
        $chart->dataset("Top Produits", "bar", $salesCount)->options([
            'backgroundColor' => ["#d1163e", "#b20bd4", "#0b7ad4", "#178897"]
        ]);

        return $chart;
    }

    public function chartTopCategories()
    {
        $data = Category::select('categories.name')
            ->selectRaw('SUM(sale_items.quantity) as total_sales')
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('sale_items', 'products.id', '=', 'sale_items.product_id')
            ->groupBy('categories.id')
            ->orderByDesc('total_sales')
            ->limit(10)
            ->get();

        $json_data = json_decode($data, true);

        $categoryNames = [];
        $salesCount = [];

        foreach ($json_data as $item) {
            $categoryNames[] = $item['name'];
            $salesCount[] = $item['total_sales'];
        }

        $chart = new ProductChart;
        $chart->labels($categoryNames);
        $chart->dataset("Top Catégories", "bar", $salesCount)->options([
            'backgroundColor' => ["#0b7ad4", "#b20bd4", "#d1163e", "#178897", "#587512"],
        ]);

        return $chart;
    }
}
