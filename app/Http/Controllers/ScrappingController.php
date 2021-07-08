<?php


namespace App\Http\Controllers;

use App\Models\Details;
use App\Models\Watches;
use App\Models\Images;
use simplehtmldom\HtmlWeb;
use Illuminate\Support\Facades\DB;

class ScrappingController extends Controller
{
    public function firstScrapping()
    {
        $doc = new HtmlWeb();
        $html = $doc->load('https://www.luxurybazaar.com/watches');


         $watches =$html->find('ul.infinite-load-items-wrapper',0);
         $links = [];




         foreach($watches->children() as $watch){
             $links[] = $watch->find('a.product-image', 0)->attr['href'];
         }

        $keys = (array_keys($links));

        $chunkedLinks = array_chunk($links, 10, true);
        //dd($chunkedLinks);
        foreach ($chunkedLinks as $chunkedLink){
            $watchesData =[];
            $item = [];
            $watchesDetails = [];
            foreach ($chunkedLink as $link){
                $watchesDoc = new HtmlWeb();
                $watchesHtml = $watchesDoc->load("{$link}");
                if($title = $watchesHtml->find('h1', 0)) {
                    $item['title'] = trim($title->plaintext);
                } else {
                    $item['title'] = 'Unknown title';
                }

                if($webid = $watchesHtml->find('div.web-id', 0)) {
                    $item['webid'] = trim($webid->plaintext);
                } else {
                    $item['webid'] = '-';
                }

                if($model = $watchesHtml->find('div.model', 0)) {
                    $item['model'] = trim($model->plaintext);
                } else {
                    $item['model'] = '-';
                }

                if($price = $watchesHtml->find('span.price', 0)) {
                    $item['price'] = trim($price->plaintext);
                } else {
                    $item['price'] = '-';
                }

                if($savings = $watchesHtml->find('div.product-list-savings', 0)) {
                    $item['savings'] = trim($savings->plaintext);
                } else {
                    $item['savings'] = '-';
                }

                if($image = $watchesHtml->find('img#image-main', 0)) {
                    $images['image'] = trim($image->attr['data-cfsrc']);
                } else {
                    $images['image'] = '-';
                }

                if($image1 = $watchesHtml->find('img#image-1', 0)) {
                    $images['image1'] = trim($image1->attr['data-cfsrc']);
                } else {
                    $images['image1'] = '-';
                }

                if($image2 = $watchesHtml->find('img#image-2', 0)) {
                    $images['image2'] = trim($image2->attr['data-cfsrc']);
                } else {
                    $images['image2'] = '-';
                }

                if($image3 = $watchesHtml->find('img#image-3', 0)) {
                    $images['image3'] = trim($image3->attr['data-cfsrc']);
                } else {
                    $images['image3'] = '-';
                }

                if($image4 = $watchesHtml->find('img#image-4', 0)) {
                    $images['image4'] = trim($image4->attr['data-cfsrc']);
                } else {
                    $images['image4'] = '-';
                }

                if($image5 = $watchesHtml->find('img#image-5', 0)) {
                    $images['image5'] = trim($image5->attr['data-cfsrc']);
                } else {
                    $images['image5'] = '-';
                }

                if($alsoKnown = $watchesHtml->find('div.data', 0)) {
                    $item['alsoKnown'] = trim($alsoKnown->plaintext);
                } else {
                    $item['alsoKnown'] = '-';
                }
                $addInfo = [];
                $watchDetails = [];
                foreach($watchesHtml->find('div.attributes-table-details') as $details){
                    $label = $details->find('div.label', 0)->innertext;
                    $data = $details->find('div.data', 0)->innertext;
                    $addInfo[$label] = $data;
                }


                $watchesData[]=$item;
                $watchesDetails[] = $watchDetails;


                foreach($watchesData as $watchesSchema) {
                    Watches::insert ([
                        'title' => $watchesSchema['title'],
                        'web_id' => $watchesSchema['webid'],
                        'model' => $watchesSchema['model'],
                        'price' => $watchesSchema['price'],
                        'savings' => $watchesSchema['savings'],
                        'also_known' => $watchesSchema['alsoKnown'],
                    ]);
                    $id =  Watches::latest('id')->first()->id;

                    Images::insert([
                        'watch_id' => $id,
                        'image' => $images['image'],
                        'image1' => $images['image1'],
                        'image2' => $images['image2'],
                        'image3' => $images['image3'],
                        'image4' => $images['image4'],
                        'image5' => $images['image5'],
                    ]);



                    Details::insert([
                        'watch_id' => $id,
                        'reference_number' => $addInfo['Reference Number'],
                        'also_known' => $addInfo['Also Known'],
                        'band_type' => $addInfo['Band Type'],
                        'bezel' => $addInfo['Bezel'],
                        'caliber' => $addInfo['Caliber'],
                        'case_back' => $addInfo['Case Back'],
                        'case_material' => $addInfo['Case Material'],
                        'case_size' => $addInfo['Case Size'],
                        'clasp_type' => $addInfo['Clasp Type'],
                        'condition' => $addInfo['Condition'],
                        'crown' => $addInfo['Crown'],
                        'dial_color' => $addInfo['Dial Color'],
                        'watch_functions' => $addInfo['Watch Functions'],
                        'gender' => $addInfo['Gender'],
                        'included' => $addInfo['Included'],
                        'lug_material' => $addInfo['Lug Material'],
                        'movement' => $addInfo['Movement'],
                        'power_reserve' => $addInfo['Power Reserve'],
                        'power_reserve_unit' => $addInfo['Power Reserve Unit'],
                        'signatures' => $addInfo['Signatures'],
                        'strap_color' => $addInfo['Strap Color'],
                        'discontinued' => $addInfo['Discontinued'],
                        'limited_edition' => $addInfo['Limited Edition'],
                    ]);

                }
            }
        }
        // Release memory
        $html->clear();
        unset($html);
//         $link = $watches->children(0)->children(0)->children(0)->attr['href'];

    }
}
