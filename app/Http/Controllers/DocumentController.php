<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentProduct;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            $document = new Document();
            $document->address = $request->address;
            $document->name = $request->name;
            $document->user_id = Auth::id();
            $document->role_id = Auth::user()->role_id;
            $document->save();
            $document_id = $document->id;
            $products = $request->products;
            foreach ($products as $product) {
                $this->addProduct($document_id, $product);
            }
            DB::commit();
            return response()->json(['success' => 'ok']);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json([
                'error' => [
                    "message" => $e->getMessage()
                ]
            ], 503);
        }
    }

    public function addProduct(int $document_id, array $data)
    {

        $product = new DocumentProduct();
        $product->document_id = $document_id;
        $product->title = $data['title'];
        $product->measure = $data['measure'];
        $product->price = $data['price'];
        $product->count = $data['count'];
        $product->save();

    }
}
