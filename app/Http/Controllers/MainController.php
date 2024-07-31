<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\SaleInterface;

class MainController extends Controller
{
    private CategoryInterface $categoryInterface;
    private ProductInterface $productInterface;
    private SaleInterface $saleInterface;

    public function __construct(CategoryInterface $categoryInterface, ProductInterface $productInterface, SaleInterface $saleInterface)
    {
        $this->categoryInterface = $categoryInterface;
        $this->productInterface = $productInterface;
        $this->saleInterface = $saleInterface;
    }

    public function home() {

        $categories = count($this->categoryInterface->index());
        $products = count($this->productInterface->index());
        $sales = count($this->saleInterface->index());

        return view('welcome', [
            "categories" => $categories,
            "products" => $products,
            "sales" => $sales,
            "product_chart_by_category" => $this->productInterface->chartByCategory(),
            "sale_chart_by_product" => $this->saleInterface->chartByProduct()
        ]);
    }
}
