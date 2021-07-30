<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Details;

class HomepageController extends Controller
{
    public function homePage()
    {

        $brands = Details::pluck('signatures')->toArray();
        $brand_list = $brands;
        $results = array_unique($brand_list);
        $images = [
            'Rolex'=>'/images/random-images/rolex.png',
            'Franck Muller'=>'/images/random-images/frank_muller.jpg',
            'Glashutte'=>'/images/random-images/glashutte.jpg',
            'Hublot'=>'/images/random-images/hublot.png',
            'Panerai'=>'/images/random-images/Panerai1.png',
            'Omega'=>'/images/random-images/omega.jpg',
            'Cartier'=>'/images/random-images/Cartier.png',
            'Breitling'=>'/images/random-images/breitling1.png',
            'Oris'=>'/images/random-images/Oris.png',
            'Patek Philippe'=>'/images/random-images/Patek Philippe.png',
            'Breguet'=>'/images/random-images/breguet.svg',
            'Frederique Constant'=>'/images/random-images/Frederique Constant.png',
            'Longines'=>'/images/random-images/Longines.png',
            'Girard Perregaux'=>'/images/random-images/Girard Perregaux.jpg',
            'H. Moser & Cie'=>'/images/random-images/H. Moser & Cie.jpg',
            'Jaeger Le-Coultre'=>'/images/random-images/Jaeger Le-Coultre.jpg',
            'Tag Heuer'=>'/images/random-images/Tag Heuer.jpg',
            'IWC'=>'/images/random-images/IWC.svg',
            'Tiffany & Co'=>'/images/random-images/Tiffany & Co.jpg',
            'Ulysse Nardin'=>'/images/random-images/ulysse nardin.jpg',
            'Tudor'=>'/images/random-images/Tudor.png',
            'Zenith'=>'/images/random-images/Zenith.jpg',
            'Ressence'=>'/images/random-images/Ressence.jpg',
            'Audemars Piguet'=>'/images/random-images/Audemars Piguet.png',
            'Bvlgari'=>'/images/random-images/Bvlgari.png',
        ];
//        dd($results);
        foreach ($images as $key=>$image){
            foreach ($results as $result){
                if($result == $key){
                    $images[$result] = $image;
                }
            }
        }


        return view('homePage', [
            'images' => $images,
        ]);
    }

    public function priceRange()
    {

    }
}
