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
            $watchesData =[];
         foreach ($links as $link){
             $watchesDoc = new HtmlWeb();
             $watchesHtml = $watchesDoc->load("{$link}");
             if($title = $watchesHtml->find('h1', 0)) {
                 $item['title'] = trim($title->plaintext);
             } else {
                 $item['title'] = 'Unknown title';
             }

             if($details = $watchesHtml->find('div.std', 0)) {
                 $item['details'] = trim($details->plaintext);
             } else {
                 $item['details'] = '...';
             }

             if($webid = $watchesHtml->find('div.web-id', 0)) {
                 $item['webid'] = trim($webid->plaintext);
             } else {
                 $item['webid'] = '';
             }

             if($model = $watchesHtml->find('div.model', 0)) {
                 $item['model'] = trim($model->plaintext);
             } else {
                 $item['model'] = '';
             }

             if($price = $watchesHtml->find('span.price', 0)) {
                 $item['price'] = trim($price->plaintext);
             } else {
                 $item['price'] = '';
             }

             if($savings = $watchesHtml->find('div.product-list-savings', 0)) {
                 $item['savings'] = trim($savings->plaintext);
             } else {
                 $item['savings'] = '';
             }

             if($image = $watchesHtml->find('img#image-main', 0)) {
                 $item['image'] = trim($image->attr['data-cfsrc']);
             } else {
                 $item['image'] = '';
             }

             if($image1 = $watchesHtml->find('img#image-1', 0)) {
                 $item['image1'] = trim($image1->attr['data-cfsrc']);
             } else {
                 $item['image1'] = '';
             }

             if($image2 = $watchesHtml->find('img#image-2', 0)) {
                 $item['image2'] = trim($image2->attr['data-cfsrc']);
             } else {
                 $item['image2'] = '';
             }

             if($image3 = $watchesHtml->find('img#image-3', 0)) {
                 $item['image3'] = trim($image3->attr['data-cfsrc']);
             } else {
                 $item['image3'] = '';
             }

             if($image4 = $watchesHtml->find('img#image-4', 0)) {
                 $item['image4'] = trim($image4->attr['data-cfsrc']);
             } else {
                 $item['image4'] = '';
             }

             if($image5 = $watchesHtml->find('img#image-5', 0)) {
                 $item['image5'] = trim($image5->attr['data-cfsrc']);
             } else {
                 $item['image5'] = '';
             }

             if($alsoKnown = $watchesHtml->find('div.data', 0)) {
                 $item['alsoKnown'] = trim($alsoKnown->plaintext);
             } else {
                 $item['alsoKnown'] = '';
             }
                $addInfo = [];
             foreach($watchesHtml->find('div.attributes-table-details') as $details){
                 $label = $details->find('div.label', 0)->innertext;
                 $data = $details->find('div.data', 0)->innertext;
                 $addInfo[$label] = $data;
             }
             dd($addInfo);
//                 dd($details->innertext);
//                 echo $details->innertext . '<br>' . PHP_EOL;


             dd($item);
         }


        $watchesName = $watchesData->find('h1', 0);
         dd($watchesName);

//        dd($link);
//        dd($links);



//         $link = $watches->children(0)->children(0)->children(0)->attr['href'];
        $link = $watches->find('a.product-image', 0)->attr['href'];
         dd($link);

////             Find the title of the current watch
            if($title = $watches->find('div.description', 0)) {
                $item['title'] = trim($title->plaintext);
            } else {
                $item['title'] = 'Unknown title';
            }
//        dd($item);

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
