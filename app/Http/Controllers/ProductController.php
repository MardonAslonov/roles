<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // public function index()
    // {

    //     $product = Product::with('category')->get();
    //     return $product;

    // }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return ($product);

        if(Auth::user()->role_id=='1'){
            // return $next($request);
            return response()->json(['error'=>'You are Admin'], 401);
        }else{
            return response()->json(['error'=>'You are not Admin'], 401);
        };
    }

    // public function show($id)
    // {
    //     return new ProductResource(Product::findOrFail($id));
    // }

    // public function update(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->update($request->all());
    //     return $product;
    // }

    // public function destroy($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->delete();
    //     return Product::all();
    // }
}
