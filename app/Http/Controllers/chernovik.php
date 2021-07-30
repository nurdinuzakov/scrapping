<?php


namespace App\Http\Controllers;


class chernovik extends Controller
{
    public function chernovik1()
    {
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
