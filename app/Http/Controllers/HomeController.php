<?php


// https://stackoverflow.com/questions/36673638/how-to-crawl-with-php-goutte-and-guzzle-if-data-is-loaded-by-javascript
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

use Symfony\Component\DomCrawler\Crawler;

class HomeController extends Controller
{
    protected $theproducts = null;

    public function __Construct()
    {
        
    }

    //
    public function scrape()
    {
       
        $client = new Client();
        // dd($client);

        $crawler = $client->request('GET', 'https://www.symfony.com/blog/');
        dd($crawler);

        $crawler->filter('h2 > a')->each(function ($node) {
            print $node->text()."\n";
        });

        // dd("This is the scrape page");
    }

    public function scapeMe()
    {
        $this->theproducts = new Products();

        // Scraping walmart
        //$this->scrapeTrial1();

        // Scraping trial 2
        $this->scrapeFromBestBuy();

        ($this->theproducts)->display();

    }
    protected function scrapeFromBestBuy()
    {
        $client = new Client();
        $url = 'https://www.bestbuy.ca/en-ca/category/laptops-macbooks/20352';
        $crawler = $client->request('GET', $url);

            //single price for testing 
        //$price = ($crawler->evaluate('//*[@id="root"]/div/div[3]/div[1]/div/main/div[1]/div[3]/div[2]/div[2]/ul/div/div[19]/div/a/div/div/div[2]/div[3]/span/span'))->text();

            // single product for testing 
        //print ($crawler->evaluate('//*[@id="root"]/div/div[3]/div[1]/div/main/div[1]/div[3]/div[2]/div[2]/ul/div/div[19]/div/a/div/div/div[2]/div[1]/text()'))->text();
       
        //Scrape product names
        $productNames = $crawler
            ->filterXpath('//*[@id="root"]/div/div[3]/div[1]/div/main/div[1]/div[3]/div[2]/div[2]/ul/div//div/div/a/div/div/div[2]/div[1]')
            ->extract(['_name', '_text', 'class']);

        //Scrape prices 
        $prices = $crawler
            ->filterXpath('//*[@id="root"]/div/div[3]/div[1]/div/main/div[1]/div[3]/div[2]/div[2]/ul/div//div/div/a/div/div/div[2]/div[3]/span/span')
            ->extract(['_name', '_text', 'class']);

        for ($i = 0; $i < count($productNames); $i++) 
        {

            $product_to_add = new Product( $productNames[$i][1], $prices[$i][1], $url, 'USD', 'TECH' );
            ($this->theproducts)->addProduct( $product_to_add );

        }
 
    }
    

    protected function scrapeTrial1()
    {
        // create client instance 
        $client = new Client();

        $crawler = $client->request('GET', 'https://www.walmart.ca/browse/electronics/10003?icid=homepage_HP_TopCategory_Electronics_WM');
        $html = $client->getResponse()->getContent();
        
        
        $newCrawler = new Crawler();
        $newCrawler->addHtmlContent($html);

        print ($newCrawler->evaluate('//*[@id="product-results"]/div[1]/div/a/div/div[2]/div[1]/div[1]/p'))->text();

    }
    
}




class Products
{
    protected $product_list = [];

    public function addProduct(Product $new_product)
    {
        $this->product_list[] = $new_product;
    }

    public function removeProduct()
    {
        //Implent removing of product
    }
    
    public function display()
    {

        print "<html>\n<body>";

        print "<p><b> SCRAPED PRODUCTS </b></p>";

        print "\n<ul>";

        foreach($this->product_list as $product) {
            print "<li> PRICE: ".$product->product_cost."   ||   NAME : ".$product->product_name."</li>";

        }
        print "</ul>\n</body>\n</html>";
    }


}


class Product{

    public $product_name;
    public $product_cost;
    public $url;
    public $currency;
    public $product_type;

    public function __Construct( $product_name, $product_cost, $url, $currency, $product_type  )
    {
        $this->product_name = $product_name;
        $this->product_cost = $product_cost;
        $this->url = $url;
        $this->currency = $currency;
        $this->product_type = $product_type;

    }
    
}
