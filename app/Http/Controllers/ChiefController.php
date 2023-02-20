<?php

namespace App\Http\Controllers;

use App\Models\Chief;
use App\Models\Director;
use App\Models\UserClient;
use Illuminate\Http\Request;
class ChiefController extends Controller
{

    public function index(Request $request)
    {
        return Chief::all();
    }

    public function abort(Request $request)
    {
        $clientChief = Chief::findOrFail($request->id);
        $clientworker = new UserClient;
        $clientworker -> address = $clientChief -> address;
        $clientworker -> name = $clientChief -> name;
        $clientworker -> used_product = $clientChief -> used_product;
        $clientworker -> commit = $request -> commit;
        $clientworker->save();
        $clientChief->delete();
        return ([
            'Abort done successful'
        ]);
    }

    public function send(Request $request)
    {
        $clientChief = Chief::findOrFail($request->id);
        $clientChief->chief_name = $request->user()->name;
        $clientDirector = new Director;
        $clientDirector->name = $clientChief->name;
        $clientDirector->address = $clientChief->address;
        $clientDirector->used_product = $clientChief->used_product;
        $clientDirector->chief_name = $clientChief->chief_name;
        $clientDirector->save();
        $clientChief->delete();
        return 'client dokument send to director successful';
    }
}
