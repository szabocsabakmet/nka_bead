<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function mainPage()
    {
        $recommendedProducts = Category::query()->with('products')->get()->map(function($category) {
            $category->setRelation('products', $category->products->take(5));
            return $category;
        });;

        return view('welcome', ['recommendedProducts' => $recommendedProducts]);
    }
}
