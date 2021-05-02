<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
    public function mainPage()
    {
//        $recommendedProducts = Category::query()->with('products')->get()->map(function($category) {
//            $category->setRelation('products', $category->products->take(5));
//            return $category;
//        });

        DB::raw("SET @rank := 0");
        DB::raw("SET @group := 0");
        $recommendedProducts = DB::select("
            SELECT * from (
                SELECT 
                products.product_id,
                products.created_at,
                products.category_id,
                products.name,
                products.price,
                products.description,
                products.attributes,
                categories.name as category_name,
                @rank := IF(@group=products.category_id, @rank+1, 1) as rank,
                @group := products.category_id as grp
                from 
                products
                left join
                categories
                on
                products.category_id = categories.category_id,
                (select @rank := 0, @group := 0) as vars order by products.category_id asc, products.created_at desc)
                as
                limited_products
                where rank <= 5"
        );

        return view('welcome', ['recommendedProducts' => $recommendedProducts]);
    }
}
