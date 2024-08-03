<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        // Récupérer toutes les ventes
        $sales = Sale::with('saleItems.product')->get(); // Assurez-vous de charger les relations nécessaires
        $totalFinal = $sales->sum(function ($sale) {
            return $sale->saleItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });
        });

        return view(
            'invoices.index',
            [
                'sales' => $sales,
                'totalFinal' => $totalFinal

            ]
        );
    }


    public function show($sale_id)
    {
        // Récupérer la vente spécifique avec ses détails
        $sale = Sale::with('saleItems.product')->findOrFail($sale_id);

        // Calculer le total de la vente
        $total_sale = $sale->saleItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        // Passer les données à la vue
        return view('invoices.show', [
            'sale' => $sale,
            'total_sale' => $total_sale
        ]);
    }

    
    public function generatePDF($sale_id)
    {
        // Récupérer la vente spécifique avec ses détails
        $sale = Sale::with('saleItems.product')->findOrFail($sale_id);

        // Calculer le total de la vente
        $total_sale = $sale->saleItems->sum(function ($item) {
            return $item->quantity * $item->price;
        });

        $data =  [
            'sale' => $sale,
            'total_sale' => $total_sale
        ];
        // Générer le PDF de la facture
        $pdf = Pdf::loadView('pdf.invoice', $data);

        // Télécharger le PDF avec un nom de fichier spécifique
        return $pdf->download('invoice_' . $sale->id . '.pdf');
    }
}
