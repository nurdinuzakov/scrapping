<?php


namespace App\Http\Controllers;


use App\Models\Links;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlWeb;

class CollectPrideLinksController extends Controller
{
    public function collectPrideLinks($start = 1)
    {

        $curl = new CurlPost('https://prideandpinion.com');

        try {
            // execute the request
            echo $curl([
                'username' => 'user1',
                'password' => 'passuser1',
                'gender'   => 1,
            ]);
        } catch (\RuntimeException $ex) {
            // catch errors
            die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }

//        for($i = $start; $i < 5; $i++) {
//            $post = [
//                'username' => 'user1',
//                'password' => 'passuser1',
//                'gender'   => 1,
//            ];
//
//            $ch = curl_init('https://prideandpinion.com/');
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//
//            $response = curl_exec($ch);
//
//            curl_close($ch);
//
//            $doc = new HtmlDocument();
//
//            $html = $doc->load($response,true,false);
//
//            dd($html);
//
//            $watches = $html->find('article.product--outer',0);
//
//            dd($watches);
//
//            foreach($watches as $watch){
//                Links::insert([
//
//                    'href' => $watch->find('h2.product-name a', 0)->attr['href'],
//                ]);
//            }
//        }
//        dd('Links where successfully collected!');
    }

}
