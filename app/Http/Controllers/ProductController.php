<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     */
    public function index() {
        try {
            return Product::all();

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
            $product = Product::find($id);

            return $product;
        } catch (\Exception $error) {

            return response()->json([
                'massage' => $error
            ], 500);
        }
    }
}
