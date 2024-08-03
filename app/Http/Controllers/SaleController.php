<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sales\createSaleRequest;
use App\Models\Product;
use App\Models\sale;
use Illuminate\Http\Request;
use App\Interfaces\ProductInterface;
use App\Interfaces\SaleInterface;
use App\Models\SaleItem;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        // return $request;

        $validatedData = $request->validate([
            'sale_date' => 'required|date', 
            'products' => 'required|array', // Valide que 'products' est un tableau
            'products.*' => 'integer|exists:products,id', 
            'quantities' => 'required|array', 
            'quantities.*' => 'integer|min:1',
        ]);

        
        $selectedProducts = $validatedData['products'];
        $quantities = $validatedData['quantities'];
        foreach ($selectedProducts as $productId) {
            $product = Product::find($productId);
            $quantityRequested = $quantities[$productId] ?? 0;
    
            if ($product->quantity < $quantityRequested) {
                return redirect()->back()->withErrors([
                    'quantities' => "La quantité disponible pour le produit {$product->name} est insuffisante."
                ]);
            }
        };
    

        // Créer une nouvelle vente avec la date personnalisée
        $sale = Sale::create([
            'date' => $validatedData['sale_date'] ,
        ]);

        // Préparer les données des produits
        foreach ($selectedProducts as $productId) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $productId,
                'quantity' => $quantities[$productId] ?? 0,
                'price' => Product::find($productId)->price,
                'Sale_date' => $validatedData['sale_date'] // Utilisez la date de la vente créée
            ]);

            // Mettre à jour la quantité de produit
            $product->quantity -= $quantityRequested;
            $product->save();
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
    public function destroy($id)
    {
        // Trouver la vente à supprimer
        $sale = Sale::find($id);

        if (!$sale) {
            return redirect()->route('sales.index')->with('error', 'Vente non trouvée.');
        }

        // Restaurer les quantités des produits associés
        foreach ($sale->saleItems as $saleItem) {
            $product = Product::find($saleItem->product_id);
            $product->quantity += $saleItem->quantity;
            $product->save();
        }

        // Supprimer les éléments de vente associés
        $sale->saleItems()->delete();

        // Supprimer la vente
        $sale->delete();

        return redirect()->route('sales.index')->with('success', 'Vente supprimée avec succès!');
    }
}
