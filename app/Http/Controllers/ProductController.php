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
    public function product($watch_id)
    {
        $watch = DB::table('watches')
            ->join('images', 'watches.id', '=', 'images.watch_id')
            ->join('details', 'watches.id', '=', 'details.watch_id')
            ->where('watches.id', '=', intval($watch_id))
            ->get();

        $images = [];
        foreach ($watch as $watchData){
            $images[] = $watchData->image;
            $images[] = $watchData->image1;
            $images[] = $watchData->image2;
            $images[]= $watchData->image3;
            $images[] = $watchData->image4;
        }

        $brand = $watchData->signatures;

        $watches = DB::table('watches')
            ->join('images', 'watches.id', '=', 'images.watch_id')
            ->join('details', 'watches.id', '=', 'details.watch_id')
            ->where('signatures', '=', $brand)
            ->inRandomOrder()
            ->take(15)
            ->get()
            ->toArray();

        return view('product.product-details', ['watch' => $watch, 'images' => array_chunk($images, 3), 'watches' => array_chunk($watches, 3)]);
    }

    public function productDetails($product_id)
    {
        $product = Watches::find($product_id);

//        $subcategory_id = $product->subcategory_id;
//        $products = Products::where('subcategory_id', '=', $subcategory_id)->inRandomOrder()->take(15)->get()->toArray();

//        $categories = Category::all();
        $images = Images::where('watch_id', $product_id)->pluck('image')->toArray();

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
        $watchBrands = array_filter(array_unique($brands));

        $data = [];

        foreach ($watchBrands as $watchBrand) {
                $data[$watchBrand] = trim($watchBrand);
        }

        $sidebar['Brands'] = $data;

        $data = [];
        $keys = ['New', 'Pre-Owned', 'Excellent', 'Unworn', 'Good'];

        foreach ($keys as $key){
            $data[$key] = $key;
        }

        $sidebar['Condition'] = $data;


        $data = [];
        $keys = ['Manual', 'Automatic', 'Quartz'];

        foreach ($keys as $key){
            $data[$key] = $key;
        }

        $sidebar['Movement'] = $data;

        $data = [];
        $keys = ['Steel', 'Leather', 'Rubber', 'Gold', 'Strap', 'Titanium', 'Mesh'];

        foreach ($keys as $key){
            $data[$key] = $key;
        }

        $sidebar['Band type'] = $data;

        $data = [];
        $keys = ['Diamond', 'Steel', 'Gold', 'Ceramic', 'Titanium', 'Platinum', 'Aluminum', 'Carbon'];

        foreach ($keys as $key){
            $data[$key] = $key;
        }

        $sidebar['Case material'] = $data;

        $watches = DB::table('watches')
            ->join('images', 'watches.id', '=', 'images.watch_id')
            ->join('details', 'watches.id', '=', 'details.watch_id')
            ->where('signatures', '=', $brand)
            ->paginate(15);

        if(!$watches){
            throw new NotFoundHttpException('The watches was\'nt found!');
        }

//        dd($sidebar);

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
