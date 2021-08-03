<?php


namespace App\Http\Controllers;


use App\Models\Details;

class chernovik extends Controller
{
    public function chernovik1()
    {
        $sidebar = [];
        $detailsData = Details::all();

        $brands = $detailsData->pluck('signatures')->toArray();
        $watchBrands = array_filter(array_unique($brands));

        $data = [];

        foreach ($watchBrands as $watchBrand) {
            $data[$watchBrand] = trim($watchBrand);
        }

        $sidebar['Brands'] = $data;

        $condition = $detailsData->pluck('condition')->toArray();
        $watchConditions = array_filter(array_unique($condition));

        $data = [];
        $searchKeys = ['New', 'Pre-Owned', 'Excellent', 'Unworn', 'Good'];

        foreach ($searchKeys as $searchKey){
            foreach ($watchConditions as $watchCondition) {
                if (str_contains($watchCondition, $searchKey)) {
                    $data[$searchKey][] = trim($watchCondition);
                }
            }
        }

        $sidebar['Condition'] = $data;


        $watchMovement = $detailsData->pluck('movement')->toArray();
        $movements = array_filter(array_unique($watchMovement));


        $data = [];
        $searchKeys = ['Manual', 'Automatic', 'Quartz'];

        foreach ($searchKeys as $searchKey){
            foreach ($movements as $movement) {
                if (str_contains($movement, $searchKey)) {
                    $data[$searchKey][] = trim($movement);
                }
            }
        }

        $sidebar['Movement'] = $data;


        $bandType = $detailsData->pluck('band_type')->toArray();
        $bands = array_filter(array_unique($bandType));

        $data = [];
        $searchKeys = ['Steel', 'Leather', 'Rubber', 'Gold', 'Strap', 'Titanium', 'Mesh'];

        foreach ($searchKeys as $searchKey){
            foreach ($bands as $band) {
                if (str_contains($band, $searchKey)) {
                    $data[$searchKey][] = trim($band);
                }
            }
        }

        $sidebar['Band type'] = $data;

        $caseMaterial = $detailsData->pluck('case_material')->toArray();
        $cases = array_filter(array_unique($caseMaterial));

        $data = [];
        $searchKeys = ['Diamond', 'Steel', 'Gold', 'Ceramic', 'Titanium', 'Platinum', 'Aluminum', 'Carbon'];

        foreach ($searchKeys as $searchKey){
            foreach ($cases as $case) {
                if (str_contains($case, $searchKey)) {
                    $data[$searchKey][] = trim($case);
                }
            }
        }

        $sidebar['Case material'] = $data;
        $exampleArrays = ['-'];
        $var1 = [];
        $var2 = [];
        foreach ($data as $key=>$data1){
            $s = strtolower(str_replace($exampleArrays, '', $key));
            $var1 [$s] = $data1;
            $next_array = next($data);
            $key1 = key($data);
            $t = strtolower(str_replace($exampleArrays, '', $key1));
            $var2 [$t] = $next_array;

            if(key($var1) == key($var2)){
                $data0 = array_merge($var1, $var2);
            }

        }
        dump($var2);
        dd($var1);


        $exampleArrays = ['-'];
        $s = [];
        foreach ($data as $key=>$datum){
            dump($datum);
            $t=[];
            $s = strtolower(str_replace($exampleArrays, '', $key));
            foreach ($data as $value){
                unset($data[$key]);
                $t[$s]=$value;
            }
            $data =$t;
        }
        dd($data);

        $new_array = preg_replace($exampleArrays,'', array_change_key_case($data, CASE_LOWER));
        dd($new_array);
        $result = array_merge($array1, $array2);
    }
}
