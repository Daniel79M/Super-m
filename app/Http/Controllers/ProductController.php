<?php

namespace App\Http\Controllers;

use App\Classes\ResponseClass;
use App\Http\Requests\Products\CreateProductRequest;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private CategoryInterface $categoryInterface;
    private ProductInterface $productInterface;

    public function __construct(CategoryInterface $categoryInterface, ProductInterface $productInterface)
    {
        $this->categoryInterface = $categoryInterface;
        $this->productInterface = $productInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->productInterface->index();

        return view('products.index', [
            'page' => 'products',
            'products' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryInterface->index();

        return view("products.create", [
            "page" => "products.create",
            "categories" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->storeAs('public/images', $imageName);

        $data = [
            "name" => $request->name,
            "image" => $request->imageName,
            "category_id" => $request->category_id,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "short_description" => $request->short_description,
            "long_description" => $request->long_description,
            "short_description" => $request->short_description,
        ];  
        
        DB::beginTransaction();

        try {
            $this->productInterface->store($data);
            DB::commit();

            return ResponseClass::success();
        } catch (\Throwable $th) {
            return ResponseClass::rollback();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
