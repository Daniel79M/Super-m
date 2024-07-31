<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sales\createSaleRequest;
use App\Models\Product;
use App\Models\sale;
use Illuminate\Http\Request;
use App\Interfaces\ProductInterface;
use App\Interfaces\SaleInterface;

class SaleController extends Controller
{
    private ProductInterface $productInterface;
    private SaleInterface $saleInterface;

    public function __construct( ProductInterface $productInterface,  SaleInterface $saleInterface)
    {
        
        $this->productInterface = $productInterface;
        $this->saleInterface = $saleInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $this->saleInterface->index();

        return view('sales.index')->with('success', 'Values saved successfully!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $this->productInterface->index();

        return view('sales.create', [
            'page' => 'sales',
            'products' => $data,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(createSaleRequest $request)
    {

        if (empty($selectedProducts)) {
            return redirect()->back()->with('error', 'No products selected.');
        }

        // Créer une nouvelle vente
        $sale = Sale::create([]);//'date' => $saleDate

        // Ajouter des produits à la vente
        foreach ($selectedProducts as $productId) {
            $quantity = $quantity[$productId] ?? 0;

            Sale::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
    
        }
        return view('Sales.index')->with('success', 'Sale saved successfully!');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sale $sale)
    {
        //
    }
}
