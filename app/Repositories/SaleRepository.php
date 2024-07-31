<?php

namespace App\Repositories;

use App\Charts\SaleChart;
use App\Models\sale;
use App\Interfaces\SaleInterface;
use App\Models\Product;

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

    public function chartByProduct()
    {

        $data = Sale::select('product_id')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('product_id')
            ->get();

        $json_data = json_decode($data, true);

        $names = [];
        $count = [];

        $i = 0;

        foreach ($json_data as $item) {
            $i++;
            $count[] = $item['count'];
            $names[] = Product::find($item['category_id'])->name;
        }

        $chart = new SaleChart;
        $chart->labels($names);
        $chart->dataset("Ordinateurs", "pie", $count)->options([
            'backgroundColor' => ['#046e24', "#dd4c09", "#0b7ad4", "#b20bd4", "#d1163e", "#178897", "#587512"],
        ]);

        return $chart;
    }

}

?>