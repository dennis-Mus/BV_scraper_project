<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Products;
use App\Models\Price;
use Illuminate\Http\Request;

class DbaseProdctsController extends Controller
{
    //inserts all the scraped product in the price database
    public function insertAllToDb($products)
    {
  
        $price = new Price;

        foreach($products as $product)
        {
            $price->product_name = $product->getName();
            $price->product_cost = $product->getCost();
            $price->url = $product->getUrl();
            $price->currency = $product->getCurrency();
            $price->save();

            $price = new Price;
        }

        

    }
}
