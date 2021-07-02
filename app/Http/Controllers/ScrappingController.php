<?php


namespace App\Http\Controllers;

use simplehtmldom\HtmlWeb;

class ScrappingController extends Controller
{
    public function firstScrapping()
    {
        $doc = new HtmlWeb();
        $html = $doc->load('https://www.luxurybazaar.com/watches');

// Loop through all articles in the page
         $watches =$html->find('ul.infinite-load-items-wrapper',0);
         $links = [];

         foreach($watches->children() as $watch){
             $links[] = $watch->find('a.product-image', 0)->attr['href'];
         }
        dd($links);

//         $link = $watches->children(0)->children(0)->children(0)->attr['href'];
        $link = $watches->find('a.product-image', 0)->attr['href'];
         dd($link);

////             Find the title of the current watch
//            if($title = $watches->find('h2', 0)) {
//                $item['title'] = trim($title->plaintext);
//            } else {
//                $item['title'] = 'Unknown title';
//            }
////        dd($item);

        //     Find the title of the current watch
            if($link = $watches->find('a', 0)) {
                $item['link'] = trim($link->plaintext);
            } else {
                $item['link'] = 'Unknown title';
            }
        dd($link);
//
////            // Find the description of the current article
////            if($details = $article->find('div.description', 0)) {
////                $item['details'] = trim($details->plaintext);
////            } else {
////                $item['details'] = '...';
////            }
////
////            // Find the tags for the current article
////            if($diggs = $article->find('a[rel="tag"]', 0)) {
////                $item['diggs'] = trim($diggs->plaintext);
////            } else {
////                $item['diggs'] = '';
////            }
//
//            $data[] = $item;
//        }
//
//// (optional) Release memory
//        $html->clear();
//        unset($html);
//
//// Display your own page to the user
//        foreach($data as $item) {
//            echo <<<EOD
//
//<h2>{$item['title']}</h2>
////<ul>
////<li>{$item['details']}</li>
////<li>{$item['diggs']}</li>
////</ul>
//
//EOD;
//        }

    }
}
