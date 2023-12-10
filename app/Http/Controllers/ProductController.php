<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        try {
            $product = Product::all();

            return response()->json([
                'Product' => $product
            ]);
        } catch (\Exception $error) {

            return response()->json([
                'massage' => $error
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProductRequest $request) {
        try {
            $data = $request->validated();
            $data['image'] = Storage::put('/images', $data['image']);
            $product = Product::create($data);

            return response()->json([
                'Product' => $product
            ]);
        } catch (\Exception $error) {

            return response()->json([
                'massage' => $error
            ], 500);
        }
    }
}
