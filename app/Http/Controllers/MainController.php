<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryInterface;
use App\Interfaces\ProductInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\User;
use App\Models\User as ModelsUser;

class MainController extends Controller
{
    private CategoryInterface $categoryInterface;
    private ProductInterface $productInterface;

    public function __construct(CategoryInterface $categoryInterface, ProductInterface $productInterface)
    {
        $this->categoryInterface = $categoryInterface;
        $this->productInterface = $productInterface;
    }

    public function home() {

        

        $categories = count($this->categoryInterface->index());
        $products = count($this->productInterface->index());

        // ModelsUser::find(2)->delete();

        // ModelsUser::create([
        //     'name' => 'damaz',
        //     'email' => 'damaz@gmail.com',
        //     'password' => Hash::make('1212')

        // ]);

        // ModelsUser::create([
        //     'name' => 'Caissier',
        //     'email' => 'caissier@gmail.com',
        //     'password' => '5555',
        // ]);


        return view('welcome', [
            "categories" => $categories,
            "products" => $products,
            "product_chart_by_category" => $this->productInterface->chartByCategory()
        ]);
    }
}
