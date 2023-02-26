<?php

namespace App\Http\Controllers;

use App\Models\WareHouse;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{
    public function create(Request $request)
    {
        WareHouse::create($request->all());
        return response()->json(['success'=>'ok']);
    }
    
    public function delete(Request $request)
    {
        $type = WareHouse::findOrFail($request->id);
        $type->delete();
        return response()->json(['success'=>'ok']);
    }

    public function show(Request $request)
    {
        $type = WareHouse::findOrFail($request->id);
        return response()->json([$type]);
    }

    public function update(Request $request)
    {
        WareHouse::findOrFail($request->id)->update($request->all());
        return response()->json(['success'=>'ok']);
    }
}
