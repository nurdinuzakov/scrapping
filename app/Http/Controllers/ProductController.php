<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Details;
use App\Models\Images;
use App\Models\Products;
use App\Models\Watches;
use Illuminate\Support\Facades\DB;
use App\Models\ProductVariants;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Subcategory;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function PHPUnit\Framework\throwException;
use Illuminate\Support\Arr;

class ProductController extends Controller
{
    public function product(Request $request, $watch_id)
    {
//        $categories = Category::all();
//        if(!$subcategory_id){
//            throw new NotFoundHttpException('The category was\'nt found!');
//        }
//        $products = Products::where('subcategory_id', '=', $subcategory_id)
//            ->whereBetween('price', [$request->get('min_price', 0), $request->get('max_price', 600)])
//            ->paginate(9);
        $watch = DB::table('watches')
            ->join('images', 'watches.id', '=', 'images.watch_id')
            ->join('details', 'watches.id', '=', 'details.watch_id')
            ->where('watches.id', '=', intval($watch_id))
            ->get();

        return view('product.product-details', compact('watch'));
    }

    public function productDetails($product_id)
    {
        $product = Watches::find($product_id);

//        $subcategory_id = $product->subcategory_id;
//        $products = Products::where('subcategory_id', '=', $subcategory_id)->inRandomOrder()->take(15)->get()->toArray();

//        $categories = Category::all();
        $images = Images::where('watch_id', $product_id)->pluck('image')->toArray();
        dd($images);

        if(!$product){
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
        $watchBrands = array_unique($brands);

        $data = [];
        $searchKeys = [];
        foreach ($watchBrands as $value){
            $searchKeys[] = $value;
        }


        foreach ($searchKeys as $searchKey){
            foreach ($watchBrands as $watchBrand) {
                if (str_contains($watchBrand, $searchKey)) {
                    $data[$searchKey][] = trim($watchBrand);
                }
            }
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

        $watches = DB::table('watches')
            ->join('images', 'watches.id', '=', 'images.watch_id')
            ->join('details', 'watches.id', '=', 'details.watch_id')
            ->where('signatures', '=', $brand)
            ->get();

        if(!$watches){
            throw new NotFoundHttpException('The watches was\'nt found!');
        }


        return view('product.products', compact('watches', 'sidebar'));
    }

    public function adminProductTable()
    {
        $products = Products::paginate(15);

        return view('admin.product-table', ['products' => $products]);
    }

    public function productInput()
    {
        return view('admin.product-input');
    }
}
