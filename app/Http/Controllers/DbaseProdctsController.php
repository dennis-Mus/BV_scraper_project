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
        //dd("heyyyoooo ");
        $price = new Price;


        //var_dump($products);

        foreach($products as $product)
        {
            //var_dump($product->getName());
            $price->product_name = $product->getName();
            $price->product_cost = $product->getCost();
            $price->url = $product->getUrl();
            $price->currency = $product->getCurrency();
            $price->save();

            var_dump($product->getName());

            $price = new Price;
        }

        

    }
}
