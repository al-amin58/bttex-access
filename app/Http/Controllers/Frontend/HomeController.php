<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Http\Request;
use function App\Http\Helpers\getSetting;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $navCatsIds = json_decode(getSetting('nav_cats'));
        $navCats = [];
        if($navCatsIds !== null && count($navCatsIds) > 0){
            $navCats = Category::whereIn('id', $navCatsIds??[])->with('childrenRecursive')->where('parent_id', 0)->get();
        }

        $boxOneCatsIds = json_decode(getSetting('box1_cats'));
        $boxOneCats = [];
        if($boxOneCatsIds !== null && count($boxOneCatsIds) > 0){
            $boxOneCats = Category::whereIn('id', $boxOneCatsIds??[])->get();
        }

        $boxTwoCatsIds = json_decode(getSetting('box2_cats'));
        $boxTwoCats = [];
        if($boxTwoCatsIds !== null && count($boxTwoCatsIds) > 0){
            $boxTwoCats = Category::whereIn('id', $boxTwoCatsIds??[])->get();
        }

        $boxOneBrandsIds = json_decode(getSetting('box1_brands'));
        $boxOneBrands = [];
        if($boxOneBrandsIds !== null && count($boxOneBrandsIds) > 0){
            $boxOneBrands = Brand::whereIn('id', $boxOneBrandsIds??[])->get();
        }

        $boxTwoBrandsIds = json_decode(getSetting('box2_brands'));
        $boxTwoBrands = [];
        if($boxTwoBrandsIds !== null && count($boxTwoBrandsIds) > 0){
            $boxTwoBrands = Brand::whereIn('id', $boxTwoBrandsIds??[])->get();
        }

        $featuredProductIds = json_decode(getSetting('featured_products'));
        $featuredProducts = [];

        if($featuredProductIds !== null && count($featuredProductIds) > 0) {
            $featuredProducts = Product::query()->whereIn('id', $featuredProductIds)->with('images', 'category', 'brand')->get();
        }

        $topSellingProductIds = json_decode(getSetting('top_selling_products'));
        $topsellingProducts = [];

        if($topSellingProductIds !== null && count($topSellingProductIds) > 0) {
            $topsellingProducts = Product::query()->whereIn('id', $topSellingProductIds)->with('images', 'category', 'brand')->get();
        }


        return inertia('Frontend/Index', [
            'navCats'            =>     $navCats,
            'boxOne'             =>     getSetting('home_box_one'),
            'boxTwo'             =>     getSetting('home_box_two'),
            'boxOneCats'         =>     $boxOneCats,
            'boxTwoCats'         =>     $boxTwoCats,
            'boxOneBrands'       =>     $boxOneBrands,
            'boxTwoBrands'       =>     $boxTwoBrands,
            'featuredProducts'   =>     $featuredProducts,
            'topSellingProducts' =>     $topsellingProducts,
            'brands'             =>     Brand::latest()->get(),
            'categories'         =>     Category::query()->where('parent_id', 0)->get(),
            'products'           =>     Product::with('images', 'category', 'brand')->latest()->get(),
            'clients'            =>     Client::all(),
            'bSettings' => [
                'seo_content'    =>     getSetting('seo_content'),
            ],

        ]);
    }

    public function boxOneProducts(Request $request)
    {
        $boxOneCatsIds = json_decode(getSetting('box1_cats'));
        $products = Product::query()
            ->with('category', 'images', 'brand')
            ->whereIn('category_id', $boxOneCatsIds??[])
            ->when($request->input("category_id"), function ($query) use ($request) {
                $query->where('category_id', $request->input('category_id'));
            })
            ->when($request->input("brand_id"), function ($query) use ($request) {
                $query->where('brand_id', $request->input('brand_id'));
            })
            ->take(12)
            ->get();

        return response()->json($products);
    }

    public function boxTwoProducts(Request $request)
    {
        $smallCatsIds = json_decode(getSetting('box2_cats'));
        $products = Product::query()
            ->with('category', 'images', 'brand')
            ->whereIn('category_id', $smallCatsIds)
            ->when($request->input("small_category_id"), function ($query) use ($request) {
                $query->where('category_id', $request->input('small_category_id'));
            })
            ->when($request->input("small_brand_id"), function ($query) use ($request) {
                $query->where('brand_id', $request->input('small_brand_id'));
            })
            ->take(12)
            ->get();

        return response()->json($products);
    }

    public function showContactPage()
    {
        return inertia('Frontend/Contact');
    }

    public function showAboutPage()
    {
        return inertia('Frontend/About',[
            'bSettings' => [
                'about_content' => getSetting('about_content'),
            ]
        ]);
    }

    public function showCalibrationPage()
    {
        return inertia('Frontend/Calibration/Index',[
            'bSettings' => [
                'calibration_content' => getSetting('calibration_content'),
            ]
        ]);
    }
}
