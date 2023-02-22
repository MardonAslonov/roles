<?php

namespace App\Http\Controllers;

use App\Models\Chief;
use App\Models\UserClient;
use Illuminate\Http\Request;

class UserClientController extends Controller
{
    public function store(Request $request)
    {
        $client = UserClient::create($request->all());
        return ($client);
    }

    public function show(Request $request)
    {
        $client = UserClient::findOrFail($request->id);
        return ($client);
    }

    public function index(Request $request)
    {
        // return UserClient::all()->with('products');

        $categoryies = UserClient::with('products')->get();
        return $categoryies;
    }

    public function destroy(Request $request)
    {
        UserClient::findOrFail($request->id)->delete();
        return 'Delete done successful';
    }

    public function update(Request $request)
    {
        $client = UserClient::findOrFail($request->id);
        $client->update($request->all());
        return $client;

    }

    public function send(Request $request)
    {
        $client = UserClient::findOrFail($request->id);
        $client->worker_name = $request->user()->name;
        $clientChief = new  Chief;
        $clientChief->name = $client->name;
        $clientChief->address = $client->address;
        $clientChief->used_product = $client->used_product;
        $clientChief->worker_name = $client->worker_name;
        $clientChief->commit = $client->commit;
        $clientChief->save();
        UserClient::findOrFail($request->id)->delete();
        return 'client dokument send to chief';
    }




    

    public function director(Request $request)
    {
        return 'You are director';
    }

    public function accountant(Request $request)
    {
        return 'You are accountant';
    }
}
