<?php


namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Description;
use App\Models\Details;
use App\Models\Gentleman_links;
use App\Models\Links;
use App\Models\Pride_links;
use App\Models\Temp;
use App\Models\Watches;
use App\Models\Images;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlWeb;

class ScrappingController extends Controller
{
    public function scrapping()
    {
        set_time_limit(8000);

        $links = Links::pluck('href')->toArray();


        foreach ($links as $link) {
            $Doc = new HtmlWeb();
            $Html = $Doc->load("{$link}");


            $item = [];

//            $s = $Html->find('span.price', 0)->plaintext;
//            dump($s);
            $item['title'] = data_get($Html->find('h1', 0), 'plaintext', 'Unknown title') ?? null;
            $item['webid'] = data_get($Html->find('div.web-id', 0), 'plaintext', '-') ?? null;
            $item['model'] = data_get($Html->find('div.model', 0), 'plaintext', '-') ?? null;
            $item['price'] = data_get($Html->find('span.price', 0), 'plaintext', '-') ?? null;
            $item['savings'] = data_get($Html->find('div.product-list-savings', 0), 'plaintext', '-') ?? null;
            $item['alsoKnown'] = data_get($Html->find('div.data', 0), 'plaintext', '-') ?? null;


            Watches::insert([
                'title' => $item['title'],
                'web_id' => $item['webid'],
                'model' => $item['model'],
                'price' => $item['price'],
                'savings' => $item['savings'],
                'also_known' => $item['alsoKnown'],
            ]);


            $images = [];

            $images['image'] = data_get($Html->find('img#image-main', 0), 'attr.data-cfsrc', '-');
            $images['image1'] = data_get($Html->find('img#image-1', 0), 'attr.data-cfsrc', '-');
            $images['image2'] = data_get($Html->find('img#image-2', 0), 'attr.data-cfsrc', '-');
            $images['image3'] = data_get($Html->find('img#image-3', 0), 'attr.data-cfsrc', '-');
            $images['image4'] = data_get($Html->find('img#image-4', 0), 'attr.data-cfsrc', '-');
            $images['image5'] = data_get($Html->find('img#image-5', 0), 'attr.data-cfsrc', '-');


            $id = Watches::latest('id')->first()->id;

            Images::insert([
                'watch_id' => $id,
                'image' => $images['image'],
                'image1' => $images['image1'],
                'image2' => $images['image2'],
                'image3' => $images['image3'],
                'image4' => $images['image4'],
                'image5' => $images['image5'],
            ]);


            $addInfo = [];

            foreach ($Html->find('div.attributes-table-details') as $details) {
                $label = $details->find('div.label', 0)->innertext;
                $data = $details->find('div.data', 0)->innertext;
                $addInfo[$label] = $data;
            }


            $reference = $addInfo['Reference Number'] ?? '-';
            $also_known = $addInfo['Also Known'] ?? '-';
            $band_type = $addInfo['Band Type'] ?? '-';
            $bezel = $addInfo['Bezel'] ?? '-';
            $caliber = $addInfo['Caliber'] ?? '-';
            $case_back = $addInfo['Case Back'] ?? '-';
            $case_material = $addInfo['Case Material'] ?? '-';
            $case_size = $addInfo['Case Size'] ?? '-';
            $clasp_type = $addInfo['Clasp Type'] ?? '-';
            $condition = $addInfo['Condition'] ?? '-';
            $crown = $addInfo['Crown'] ?? '-';
            $dial_color = $addInfo['Dial Color'] ?? '-';
            $watch_functions = $addInfo['Watch Functions'] ?? '-';
            $included = $addInfo['Included'] ?? '-';
            $lug_material = $addInfo['Lug Material'] ?? '-';
            $movement = $addInfo['Movement'] ?? '-';
            $power_reserve = $addInfo['Power Reserve'] ?? '-';
            $power_reserve_unit = $addInfo['Power Reserve Unit'] ?? '-';
            $signatures = $addInfo['Signatures'] ?? '-';
            $strap_color = $addInfo['Strap Color'] ?? '-';
            $discontinued = $addInfo['Discontinued'] ?? '-';
            $limited_edition = $addInfo['Limited Edition'] ?? '-';
            $gender = $addInfo['Gender'] ?? '-';


            Details::insert([
                'watch_id' => $id,
                'reference_number' => $reference,
                'also_known' => $also_known,
                'band_type' => $band_type,
                'bezel' => $bezel,
                'caliber' => $caliber,
                'case_back' => $case_back,
                'case_material' => $case_material,
                'case_size' => $case_size,
                'clasp_type' => $clasp_type,
                'condition' => $condition,
                'crown' => $crown,
                'dial_color' => $dial_color,
                'watch_functions' => $watch_functions,
                'gender' => $gender,
                'included' => $included,
                'lug_material' => $lug_material,
                'movement' => $movement,
                'power_reserve' => $power_reserve,
                'power_reserve_unit' => $power_reserve_unit,
                'signatures' => $signatures,
                'strap_color' => $strap_color,
                'discontinued' => $discontinued,
                'limited_edition' => $limited_edition,
            ]);

//            $Html->find('div.attributes-table-details');
//            $text = $Html->find('div.std', 0)->innertext;
            $text = data_get($Html->find('div.std', 0), 'plaintext', '-');

            Description::insert([
                'watch_id' => $id,
                'description' => $text,
            ]);

        }
    }

    public function prideScrapping()
    {
        set_time_limit(450);

        $links = Pride_links::pluck('href')->toArray();

        foreach ($links as $link){
            $link ?? exit();
            $url = ('https://prideandpinion.com' . $link);
            $getUrl = getUrl($url);
            $doc = new HtmlDocument();
            $html = $doc->load($getUrl);

            $item = [];

            $item['title'] = data_get($html->find('h1', 0), 'plaintext', 'Unknown title');
            $item['brand'] = data_get($html->find('div.product-vendor', 0)->find('a', 0), 'plaintext', 'Unknown model');
            $text = data_get($html->find('div.product-sku', 0)->find('span', 0), 'innertext', '-');
            $item['webid'] = substr($text,0, 6);
            $temp = $html->find('div.price--main', 0);
            $temp == null ?  ($temp2 = '-') : $temp1 = $temp->find('span.money', 0);
            ($temp1 == null) ? ($temp2 = '-') : ($temp2 = data_get($temp1, 'plaintext'));
            $item['price'] = $temp2;


            Watches::insert([
                'title' => $item['title'],
                'web_id' => $item['webid'],
                'price' => $item['price'],
            ]);


            $input = data_get($html->find('img.product-gallery--thumbnail', 0), 'attr.srcset', '-');
            $input1 = data_get($html->find('img.product-gallery--thumbnail', 1), 'attr.srcset', '-');
            $input2 = data_get($html->find('img.product-gallery--thumbnail', 2), 'attr.srcset', '-');
            $input3 = data_get($html->find('img.product-gallery--thumbnail', 3), 'attr.srcset', '-');
            $input4 = data_get($html->find('img.product-gallery--thumbnail', 4), 'attr.srcset', '-');
            $input5 = data_get($html->find('img.product-gallery--thumbnail', 5), 'attr.srcset', '-');

            $takeTheLink=function($item){
                $t = explode(",", $item); $x = end($t);
                return $x;
            };

            $images = [];
            $images['image'] =  $takeTheLink($input);
            $images['image1'] =  $takeTheLink($input1);
            $images['image2'] =  $takeTheLink($input2);
            $images['image3'] =  $takeTheLink($input3);
            $images['image4'] =  $takeTheLink($input4);
            $images['image5'] =  $takeTheLink($input5);

            $id = Watches::latest('id')->first()->id;

            Images::insert([
                'watch_id' => $id,
                'image' => $images['image'],
                'image1' => $images['image1'],
                'image2' => $images['image2'],
                'image3' => $images['image3'],
                'image4' => $images['image4'],
                'image5' => $images['image5'],
            ]);


            $data = [];
            foreach ($html->find('div#tab-2') as $details) {
                for($i =0; $i <=8; $i++){
                    $label = data_get($details->find('th', $i), 'innertext', '-');
                    $data[$label] = data_get($details->find('td', $i), 'innertext', '-');
                }
            }

            $data1 = [];
            foreach ($html->find('div#tab-3') as $details){
                for($i =0; $i <=5; $i++) {
                    $label = data_get($details->find('th', $i), 'innertext', '-');
                    $data1[$label] = data_get($details->find('td', $i), 'innertext', '-');
                }
            }


            $reference = $data['Reference'] ?? '-';
            $bracelet = $data['Bracelet'] ?? '-';
            $clasp = $data['Clasp'] ?? '-';
            $movement = $data['Movement'] ?? '-';
            $caliber = $data['Caliber'] ?? '-';
            $bezel = $data['Bezel'] ?? '-';
            $case = $data['Material (Case)'] ?? '-';
            $size = $data['Size (Case)'] ?? '-';
            $dial = $data['Dial'] ?? '-';
            $glass = $data['Glass'] ?? '-';
            $year = $data1['Year'] ?? '-';
            $condition = $data1['Condition'] ?? '-';
            $warranty = $data1['Warranties'] ?? '-';
            $box = $data1['Box'] ?? '-';
            $sigantures = $item['brand'] ?? '-';


            Details::insert(array(
                'watch_id' => $id,
                'reference_number' => $reference,
                'caliber' => $caliber,
                'movement' => $movement,
                'band_type' => $bracelet,
                'bezel' => $bezel,
                'clasp_type' => $clasp,
                'case_material' => $case,
                'case_size' => $size,
                'dial_color' => $dial,
                'glass' => $glass,
                'year' => $year,
                'condition' => $condition,
                'warranty' => $warranty,
                'box' => $box,
                'signatures' => $sigantures,
            ));
        }
    }

    public function gentlemanScrapping()
    {
        set_time_limit(250);

        $links = Gentleman_links::pluck('href')->toArray();

        foreach ($links as $link){

            $url = ('https://thetimepiecegentleman.com' . $link);
            $getUrl = getUrl($url);
            $doc = new HtmlDocument();
            $html = $doc->load($getUrl);


            $item = [];

            $str = $html->find('div.Rte', 0);
            $str1 = $str->find('p', 1);
            $checkStr = $str1 ?? $str->find('p', 0);
            $finalStr = data_get($checkStr, 'plaintext', '-');

            $split = preg_split('/\n|\r\n?/', $finalStr);

            foreach ($split as $key => $value){
                $value1 = preg_split('/:/', $value);
                $checkedValue = $value1[1] ?? '-';
                $split[$value1[0]] = $checkedValue;
                unset($split[$key]);
            }

            $item['title'] = data_get($html->find('h1.ProductMeta__Title', 0), 'plaintext', 'Unknown title');
            $item['brand'] = data_get($html->find('h2.ProductMeta__Vendor', 0), 'plaintext', 'Unknown model');
            $item['price'] = data_get($html->find('span.ProductMeta__Price', 0), 'plaintext', '-');
            $model = $split['Model'] ?? '-';
            $item['model'] = $model;


            Watches::insert([
                'title' => $item['title'],
                'price' => $item['price'],
                'model' => $item['model'],
            ]);

            $images = [];

            $images['image'] = data_get($html->find('img.Image--fadeIn', 0), 'attr.data-original-src', '-');
            $images['image1'] = data_get($html->find('img.Image--fadeIn', 1), 'attr.data-original-src', '-');
            $images['image2'] = data_get($html->find('img.Image--fadeIn', 2), 'attr.data-original-src', '-');
            $images['image3'] = data_get($html->find('img.Image--fadeIn', 3), 'attr.data-original-src', '-');
            $images['image4'] = data_get($html->find('img.Image--fadeIn', 4), 'attr.data-original-src', '-');

            $id = Watches::latest('id')->first()->id;

            Images::insert([
                'watch_id' => $id,
                'image' => $images['image'],
                'image1' => $images['image1'],
                'image2' => $images['image2'],
                'image3' => $images['image3'],
                'image4' => $images['image4'],
            ]);


            $reference = $split['Reference'] ?? '-';
            $bracelet = $split['Bracelet'] ?? '-';
            $bezel = $split['Bezel'] ?? '-';
            $case = $split['Case'] ?? '-';
            $size = $split['Size'] ?? '-';
            $dial = $split['Dial Color'] ?? '-';
            $crystal = $split['Crystal'] ?? '-';
            $year = $split['Year'] ?? '-';
            $resistance = $split['Water Resistance'] ?? '-';
            $condition = $split['Condition'] ?? '-';
            $warranty = $split['Warranty'] ?? '-';
            $sigantures = $item['brand'] ?? '-';

            Details::insert(array(
                'watch_id' => $id,
                'reference_number' => $reference,
                'band_type' => $bracelet,
                'bezel' => $bezel,
                'case_material' => $case,
                'case_size' => $size,
                'dial_color' => $dial,
                'glass' => $crystal,
                'year' => $year,
                'condition' => $condition,
                'water resistance' => $resistance,
                'warranty' => $warranty,
                'signatures' => $sigantures,
            ));
        }
        dd('Gentleman data\'s where successfully collected!');
    }

    public function brands()
    {
        $brands = Details::pluck('signatures')->toArray();
        $selectedBrands = array_filter(array_unique($brands));

        $i = 0;
        foreach ($selectedBrands as $selectedBrand){
            $i++;
            Brands::insert(array(
                'id' => $i,
                'brands' => $selectedBrand,
            ));
        }
        dd('Done!!!');
    }
}

