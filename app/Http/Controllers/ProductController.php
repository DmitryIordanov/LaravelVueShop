<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\FilterRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     */
    public function index(FilterRequest $request) {
        try {
            $data = $request->validated();

            $filter = app()->make(ProductFilter::class, ['queryParams' => $data]);

            $product = Product::filter($filter)->paginate(9);

            return $product;

        } catch (\Exception $error) {

            return response()->json([
                'massage' => $error
            ], 500);
        }
    }

    /**
     * Creating a new product and upload image.
     */
    public function create(ProductRequest $request) {
        try {
            $data = $request->validated();
            $data['image'] = Storage::put('/images', $data['image']);
            $product = Product::create($data);

            return $product;
        } catch (\Exception $error) {

            return response()->json([
                'massage' => $error
            ], 500);
        }
    }

    /**
     * Display the specified product.
     */
    public function show($id) {
        try {
            return Product::find($id);

        } catch (\Exception $error) {

            return response()->json([
                'massage' => $error
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, $id){
        try {
            $product = Product::find($id);
            $product->update($request->all());

            return $product;
        } catch (\Exception $error) {

            return response()->json([
                'massage' => $error
            ], 500);
        }
    }

    /**
     * Delete the specified product.
     */
    public function delete($id) {
        try {
            return Product::find($id)->delete();

        } catch (\Exception $error) {

            return response()->json([
                'massage' => $error
            ], 500);
        }
    }
}
