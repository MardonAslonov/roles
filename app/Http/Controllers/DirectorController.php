<?php

namespace App\Http\Controllers;

use App\Models\Accountant;
use App\Models\Chief;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index(Request $request)
    {
        return Director::all();
    }

    public function abort(Request $request)
    {
        $clientDirector = Director::findOrFail($request->id);
        $clientChief = new Chief;
        $clientChief -> address = $clientDirector -> address;
        $clientChief -> name = $clientDirector -> name;
        $clientChief -> used_product = $clientDirector -> used_product;
        $clientChief -> commit = $request -> commit;
        $clientChief->save();
        $clientDirector->delete();
        return ([
            'Abort done successful'
        ]);
    }

    public function send(Request $request)
    {
        $clientDirector = Director::findOrFail($request->id);
        $clientDirector->Director_name = $request->user()->name;
        $clientAccountant = new Accountant;
        $clientAccountant->name = $clientDirector->name;
        $clientAccountant->address = $clientDirector->address;
        $clientAccountant->used_product = $clientDirector->used_product;
        $clientAccountant->director_name = $clientDirector->chief_name;
        $clientAccountant->save();
        $clientDirector->delete();
        return 'client dokument send to accountant successful';
    }
}
