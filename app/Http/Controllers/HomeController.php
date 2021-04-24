<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class HomeController extends Controller
{
    //
    public function scrape()
    {
       
        $client = new Client();
        // dd($client);

        $crawler = $client->request('GET', 'https://www.symfony.com/blog/');
        //dd($crawler);

        $crawler->filter('h2 > a')->each(function ($node) {
            print $node->text()."\n";
        });

        

        // dd("This is the scrape page");
    }
}
