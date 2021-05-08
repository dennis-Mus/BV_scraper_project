<?php

namespace App\Http\Controllers;

use App\Models\Price;

use Illuminate\Http\Request;

class ProductDisplayController extends Controller
{
    //
    public function home()
    {
       // dd("we in here");

        $prods =  Price::all();
        return view('home', compact('prods'));
    }
}
