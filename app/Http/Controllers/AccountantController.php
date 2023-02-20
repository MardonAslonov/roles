<?php

namespace App\Http\Controllers;

use App\Models\Accountant;
use Illuminate\Http\Request;

class AccountantController extends Controller
{
    public function index(Request $request)
    {
        return Accountant::all();
    }
}
