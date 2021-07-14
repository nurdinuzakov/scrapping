<?php


namespace App\Http\Controllers;


use App\Models\Links;
use App\Models\Temp;
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

//    public function collectPrideLinks($start1 = 1)
//    {
//        for($i = $start1; $i < 17; $i++) {
//            $doc = new HtmlWeb();
//            $html = $doc->load('https://www.luxurybazaar.com/catalog/category/list/id/10458?p=' . $i .
//                '&https://www.luxurybazaar.com/watches');
//
//            $watches = $html->find('li.item');
//
//            foreach($watches as $watch){
//                Links::insert([
//
//                    'href' => $watch->find('h2.product-name a', 0)->attr['href'],
//                ]);
//            }
//        }
//        dd('Links where successfully collected!');
//    }
}
