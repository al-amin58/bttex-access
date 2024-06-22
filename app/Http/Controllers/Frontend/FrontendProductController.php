<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use function App\Http\Helpers\getSetting;

class FrontendProductController extends Controller
{

    public function searchProduct(Request $request)
    {
        $data = Product::query()
            ->with('images')
            ->when($request->input('query'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('query') . '%')
                ->orderBy('title');
            })
            ->get();

        return response()->json($data);
    }
    public function allProducts(Request $request)
    {
        return inertia('Frontend/Products', [
            'categories' => Category::query()->where('parent_id', 0)->get(),
        ]);
    }

    public function getAllProducts(Request $request)
    {
        $products = Product::query()
        ->with('category', 'images', 'brand')

        ->when($request->input('query'), function ($query) use ($request) {
            $query->where('title', 'like', '%' . $request->input('query') . '%')
            ->orderBy('title');
        })
        ->when($request->input("category_id"), function ($query) use ($request) {
            $query->where('category_id', $request->input('category_id'));
        })
        ->when($request->input("brand_id"), function ($query) use ($request) {
            $query->where('brand_id', $request->input('brand_id'));
        })
        ->get();

        return response()->json($products);
    }


    public function getTitle()
    {
        $products = Product::query()->with('category')->get();
        return response()->json($products);
    }

    public function getBrands()
    {
        $brands = Brand::all();
        return response()->json($brands);
    }

    public function getCategories()
    {

        $navCatsIds = json_decode(getSetting('nav_cats'));
        $navCats = [];
        if($navCatsIds !== null && count($navCatsIds) > 0){
            $navCats = Category::whereIn('id', $navCatsIds??[])->with('childrenRecursive')->where('parent_id', 0)->get();
        }
        return response()->json($navCats);

    }

    public function productDetail($category, $slug) {
        $product = Product::where('slug', $slug)
            ->withCount('reviews')
            ->withSum('reviews', 'rating')
            ->first();
        $relatedProducts = Product::query()
            ->where('category_id', $category)
            ->whereNot('slug', $slug)
            ->with('images', 'category')
            ->get();

        $totalReviews = $product->reviews_count;
        $totalRatings = $product->reviews_sum_rating;
        $averageRating = $totalReviews > 0 ? $totalRatings / $totalReviews : 0;


        return inertia('Frontend/ProductDetail', [
            'product' => Product::where('slug', $slug)->with('images', 'category', 'brand', 'questions', 'questions.user', 'reviews', 'reviews.user')->first(),
            'ProductAverageRating' => $averageRating,
            'relatedProducts' => $relatedProducts
        ]);
    }

    public function categoryProduct($id)
    {
        return inertia('Frontend/CategoryProduct/Index', [
            'categories' => Category::query()->where('parent_id', 0)->get(),
            'category' => Category::query()->where('id', $id)->with('products','products.images', 'products.category', 'products.brand')->first()
        ]);
    }

    public function brandProduct($id)
    {
        return inertia('Frontend/BrandProduct/Index', [
            'brands' => Brand::all(),
            'brand' => Brand::query()->where('id', $id)->with('products','products.images', 'products.category', 'products.brand')->first()
        ]);
    }
}
