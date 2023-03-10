<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentDeleteRequest;
use App\Http\Requests\DocumentRequest;
use App\Http\Requests\DocumentUpdateRequest;
use App\Models\Document;
use App\Models\DocumentProduct;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function create(DocumentRequest $request)
    {
        DB::beginTransaction();
        try {
            $document = new Document();
            $document->user_id = Auth::id();
            $document->senior_id = Auth::user()->senior_id;
            $document->title = $request->title;
            $document->address = $request->address;
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
            return response()->json(['error' => ["message" => $e->getMessage()]], 503);
        }
    }

    public function addProduct(int $document_id, array $data){
        $product = new DocumentProduct();
        $product->document_id = $document_id;
        $product->title = $data['title'];
        $product->measure = $data['measure'];
        $product->price = $data['price'];
        $product->count = $data['count'];
        $product->save();
    }

    public function update(DocumentUpdateRequest $request)
    {
        DB::beginTransaction();
        try {
            $document = Document::findOrFail($request->id);
           if(!is_null($request->title)) $document->title = $request->title;
           if(!is_null($request->address))$document->address = $request->address;
            $document->save();
            $products = $request->products;
            $this->deleteProduct($request->id);
            foreach ($products as $product) {
                $this->addProduct($request->id,$product);
            }
            DB::commit();
            return response()->json(['success' => 'ok']);
        } catch (QueryException $e) {
            DB::rollBack();
            return response()->json(['error' => ["message" => $e->getMessage()]],503);
        }
    }
    public function deleteProduct(int $document_id){
        DocumentProduct::where('document_id',$document_id)->delete();
    }
    public function delete(DocumentDeleteRequest $request){
        $document = Document::findOrFail($request->id);
        try{
            $document->delete();
            return response()->json(['success' => 'ok']);
        }catch(QueryException $e){
            return response()->json(['error' => ["message" => $e->getMessage()]],503);
        }
    }
    public function show(Request $request){
        return Document::where('id', $request->id)->with('products')->get();
    }
    public function list(Request $request){
        return Document::where('user_id',$request->user_id)->with('products')->paginate($request->per_page);
    }
}
