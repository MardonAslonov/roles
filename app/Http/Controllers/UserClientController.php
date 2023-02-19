<?php

namespace App\Http\Controllers;

use App\Models\UserClient;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class UserClientController extends Controller
{
    public function store(Request $request)
    {
        $client = UserClient::create($request->all());
        return ($client);

        // return ('salom');
    }
}
