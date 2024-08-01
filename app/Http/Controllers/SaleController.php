<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sales\createSaleRequest;
use App\Models\Product;
use App\Models\sale;
use Illuminate\Http\Request;
use App\Interfaces\ProductInterface;
use App\Interfaces\SaleInterface;
use App\Models\SaleItem;

class SaleController extends Controller
{
    private ProductInterface $productInterface;
    private SaleInterface $saleInterface;

    public function __construct(ProductInterface $productInterface,  SaleInterface $saleInterface)
    {

        $this->productInterface = $productInterface;
        $this->saleInterface = $saleInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Récupérer toutes les ventes avec les détails des produits associés
        $sales = Sale::with('saleItems.product')->get();

        return view('sales.index', compact('sales'));
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

    public function store(Request $request)
    {
        $selectedProducts = $request->input('products', []);
        $quantities = $request->input('quantities', []);
        $saleDate = $request->input('sale_date');

        if (empty($selectedProducts)) {
            return redirect()->back()->with('error', 'Aucun produit sélectionné.');
        }

        // Créer une nouvelle vente
        $sale = Sale::create([
            'date' => $saleDate,
        ]);

        // Préparer les données des produits
        foreach ($selectedProducts as $productId) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'quantity' => $quantities[$productId] ?? 0,
                'price' => Product::find($productId)->price,
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Vente enregistrée avec succès!');
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
