<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
class TypeController extends Controller
{
    public function create(Request $request)
    {
        Type::create($request->all());
        return response()->json(['success'=>'ok']);
    }

    public function delete(Request $request)
    {
        $type = Type::findOrFail($request->id);
        $type->delete();
        return response()->json(['success'=>'ok']);
    }

    public function show(Request $request)
    {
        $type = Type::findOrFail($request->id);
        return response()->json([$type]);
    }

    public function update(Request $request)
    {
        Type::findOrFail($request->id)->update($request->all());
        return response()->json(['success'=>'ok']);
    }

    public function list(Request $request)
    {
        return Type::paginate($request->per_page);
    }
}
