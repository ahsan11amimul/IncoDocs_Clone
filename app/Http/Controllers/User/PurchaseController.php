<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    //
    public function index()
    {
        return view('users.purchases.index');
    }
}
