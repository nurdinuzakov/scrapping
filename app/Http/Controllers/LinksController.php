<?php


namespace App\Http\Controllers;


use App\Models\Gentleman_links;
use App\Models\Links;
use App\Models\Pride_links;
use App\Models\Temp;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlWeb;

class LinksController extends Controller
{

    public function collectLinks($start = 1)
    {
        set_time_limit(120);

        for($i = $start; $i < 17; $i++) {
            $doc = new HtmlWeb();
            $html = $doc->load('https://www.luxurybazaar.com/catalog/category/list/id/10458?p=' . $i .
                '&https://www.luxurybazaar.com/watches');


            $watches = $html->find('li.item');

            foreach($watches as $watch){
                Links::insert([

                    'href' => $watch->find('h2.product-name a', 0)->attr['href'],
                ]);
            }
        }
        dd('Links where successfully collected!');
    }

    public function collectCurlLinks($start = 1)
    {
        for($i = $start; $i < 4; $i++) {
            $url = ('https://prideandpinion.com/collections/new-arrivals?page=' . $i . "'");
            $getUrl = getUrl($url);
            $doc = new HtmlDocument();
            $html = $doc->load($getUrl);

            $watches = $html->find('h2.productitem--title');
            foreach($watches as $watch){
                Pride_links::insert([

                    'href' => $watch->find('a', 0)->attr['href'],
                ]);
            }
        }
        dd('Links where successfully collected!');
    }

    public function gentlemanCollectLinks($start = 1)
    {
        for($i = $start; $i < 7; $i++) {
            $url = ('https://thetimepiecegentleman.com/collections/watches?page=' . $i . "'");
            $getUrl = getUrl($url);
            $doc = new HtmlDocument();
            $html = $doc->load($getUrl);

            $watches = $html->find('div.ProductItem__Wrapper');
            foreach($watches as $watch){
                Gentleman_links::insert([

                    'href' => $watch->find('a.ProductItem__ImageWrapper ', 0)->attr['href'],
                ]);
            }
        }
        dd('Links where successfully collected!');
    }
}
