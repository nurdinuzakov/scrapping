<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Details;
use App\Models\Image;
use App\Models\Images;
use App\Models\Subcategory;
use App\Models\Watches;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductController extends Controller
{
    public function product($watch_id)
    {
        $watch = Watches::find($watch_id);
        $brand = $watch->details()->value('signatures');
        $watches = $watch->getRecomendedWatches($brand);
        dd($watches);
        dump($watch->images()->get());
        $images = $watch->images()->get()->makeHidden(['id', 'watch_id'])->toArray();
        $details = $watch->details()->get()->makeHidden(['signatures', 'id', 'watch_id'])->toArray();

        dd($details);


//        $additionalInformation = [];
//        foreach ($watch as $key => $watch1) {
//            $keySkip = ['id', 'title', 'price', 'watch_id', 'image', 'image1', 'image2', 'image3', 'image4', 'image5',
//                'signatures', 'description'];
//            $watch1Skip = [null, 'N/A', '-'];
//            if (in_array($key, $keySkip)) {
//                continue;
//            } elseif (in_array($watch1, $watch1Skip)) {
//                continue;
//            }
//
//            $underline = '_';
//            $key = ucfirst(str_replace($underline, " ", $key));
//            $additionalInformation[$key] = $watch1;
//        }


        $images[] = $watch->image;
        $images[] = $watch->image1;
        $images[] = $watch->image2;
        $images[] = $watch->image3;
        $images[] = $watch->image4;


        $watches = DB::table('watches')
            ->join('images', 'watches.id', '=', 'images.watch_id')
            ->join('details', 'watches.id', '=', 'details.watch_id')
            ->where('signatures', '=', $brand)
            ->where('price', '>', 1)
            ->inRandomOrder()
            ->take(15)
            ->get()
            ->toArray();

//        $sidebar = [];
//        $detailsData = Details::all();
//
//        $brands = $detailsData->pluck('signatures')->toArray();
//        $watchBrands = array_filter(array_unique($brands));


        return view('product.product-details', ['watch' => $watch, 'images' =>
            array_chunk($images, 3), 'watches' => array_chunk($watches, 3), 'details' => $additionalInformation]);
    }

    public function productDetails($product_id)
    {
        $product = Watches::find($product_id);

//        $subcategory_id = $product->subcategory_id;
//        $products = Products::where('subcategory_id', '=', $subcategory_id)->inRandomOrder()->take(15)->get()->toArray();

//        $categories = Category::all();
        $images = Images::where('watch_id', $product_id)->pluck('image')->toArray();

        if (!$product) {
            throw new NotFoundHttpException('The product was\'nt found!');
        }

        return view('product.product-details', ['product' => $product, 'products' => array_chunk($products, 3),
            'categories' => $categories, 'images' => array_chunk($images, 3)]);
    }

    public function brandModels($brand)
    {
        $sidebar = [];
        $detailsData = Details::all();

        $brands = $detailsData->pluck('signatures')->toArray();
        $watchBrands = array_filter(array_unique($brands));

        $data = [];

        foreach ($watchBrands as $watchBrand) {
            $data[trim($watchBrand)] = trim($watchBrand);
        }

        $sidebar['Brands'] = $data;

        $data = [];
        $keys = ['New', 'Pre-Owned', 'Excellent', 'Unworn', 'Good'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Condition'] = $data;


        $data = [];
        $keys = ['Manual', 'Automatic', 'Quartz'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Movement'] = $data;

        $data = [];
        $keys = ['Steel', 'Leather', 'Rubber', 'Gold', 'Strap', 'Titanium', 'Mesh'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Band type'] = $data;

        $data = [];
        $keys = ['Diamond', 'Steel', 'Gold', 'Ceramic', 'Titanium', 'Platinum', 'Aluminum', 'Carbon'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Case material'] = $data;

        $data = [];
        $keys = ['Women', 'Men', 'Unisex'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Gender'] = $data;

        $watches = DB::table('watches')
            ->join('images', 'watches.id', '=', 'images.watch_id')
            ->join('details', 'watches.id', '=', 'details.watch_id')
            ->where('signatures', '=', $brand)
            ->where('price', '>', 0)
            ->paginate(15);


        if (!$watches) {
            throw new NotFoundHttpException('The watches was\'nt found!');
        }

//        dd($sidebar);

        return view('product.products', compact('watches', 'sidebar'));
    }

    public function request($value)
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

        $data = [];
        $keys = ['New', 'Pre-Owned', 'Excellent', 'Unworn', 'Good'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Condition'] = $data;


        $data = [];
        $keys = ['Manual', 'Automatic', 'Quartz'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Movement'] = $data;

        $data = [];
        $keys = ['Steel', 'Leather', 'Rubber', 'Gold', 'Strap', 'Titanium', 'Mesh'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Band type'] = $data;

        $data = [];
        $keys = ['Diamond', 'Steel', 'Gold', 'Ceramic', 'Titanium', 'Platinum', 'Aluminum', 'Carbon'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Case material'] = $data;

        $data = [];
        $keys = ['Women', 'Men', 'Unisex'];

        foreach ($keys as $key) {
            $data[$key] = $key;
        }

        $sidebar['Gender'] = $data;

        $watches = DB::table('watches')
            ->join('images', 'watches.id', '=', 'images.watch_id')
            ->join('details', 'watches.id', '=', 'details.watch_id')
            ->where('price', '>', 0)
            ->where('signatures', 'LIKE', '%' . $value . '%')
            ->orWhere('condition', 'LIKE', '%' . $value . '%')
            ->orWhere('movement', 'LIKE', '%' . $value . '%')
            ->orWhere('band_type', 'LIKE', '%' . $value . '%')
            ->orWhere('gender', 'LIKE', '%' . $value . '%')
            ->paginate(15);


        return view('product.products', compact('watches', 'sidebar'));
    }

    public function filters($selected)
    {
        $jsons = json_decode($selected, true);


        $brands = [];
        $condition = [];
        $movement = [];
        $band_type = [];
        $gender = [];
        $case_material = [];

        foreach ($jsons as $json) {
            foreach ($json as $key => $value) {
                if ('Brands' == $key) {
                    $brands = Arr::prepend($brands, $value);
                }
                if ('Condition' == $key) {
                    $condition = Arr::prepend($condition, $value);
                }
                if ('Movement' == $key) {
                    $movement = Arr::prepend($movement, $value);
                }
                if ('Band type' == $key) {
                    $band_type = Arr::prepend($band_type, $value);
                }
                if ('Gender' == $key) {
                    $gender = Arr::prepend($gender, $value);
                }
                if ('Case material' == $key) {
                    $case_material = Arr::prepend($case_material, $value);
                }
            }
        }


        $query = Details::from('details')->with('images', 'watch');


        if (!$brands == []) {
            $query = $query->whereIn('signatures', $brands);
        }

        if (!$condition == []) {
            $query = $query->whereIn('condition', $condition);
        }

        if (!$movement == []) {
            $query = $query->whereIn('movement', $movement);
        }

        if (!$band_type == []) {
            $query = $query->whereIn('band_type', $band_type);
        }

        if (!$gender == []) {
            $query = $query->whereIn('gender', $gender);
        }

        if (!$case_material == []) {
            $query = $query->whereIn('case_material', $case_material);
        }


        $watches = $query ? $query->paginate(15) : [];

//        dd($watches);

        $sidebar = [];
        $brands = Details::pluck('signatures')->toArray();
        $watchBrands = array_filter(array_unique($brands));

        $data = [];

        foreach ($watchBrands as $watchBrand) {
            $data[trim($watchBrand)] = trim($watchBrand);
        }

        $sidebar['Brands'] = $data;

        $lookFrom = $query ? $query->get() : [];

        $condition = [];
        $movement = [];
        $band_type = [];
        $case_material = [];
        $gender = [];


        foreach ($lookFrom as $value) {
            if ($value->condition == 'N/A') {
                continue;
            }
            $condition[] = $value->condition;
        }
        $sidebar['Condition'] = array_unique($condition);

        foreach ($lookFrom as $value) {
            if ($value->movement == 'N/A') {
                continue;
            }
            $movement[] = $value->movement;
        }
        $sidebar['Movement'] = array_unique($movement);

        foreach ($lookFrom as $value) {
            if ($value->band_type == 'N/A') {
                continue;
            }
            $band_type[] = $value->band_type;
        }
        $sidebar['Band type'] = array_unique($band_type);

        foreach ($lookFrom as $value) {
            if ($value->case_material == 'N/A') {
                continue;
            }
            $case_material[] = $value->case_material;
        }
        $sidebar['Case material'] = array_unique($case_material);

        foreach ($lookFrom as $value) {
            if ($value->gender == 'N/A') {
                continue;
            }
            $gender[] = $value->gender;
        }
        $sidebar['Gender'] = array_unique($gender);

        if (!$watches) {
            abort(404);
        }
//        dd($sidebar);

        $watchHTML = view('product.watch')->with('watches', $watches)->render();
        $sidebarHTML = view('product.sidebar')->with(compact('sidebar', 'jsons'))->render();
        return response()->json(array('success' => true, 'html' => $watchHTML, 'htmlSidebar' => $sidebarHTML));

    }
}
