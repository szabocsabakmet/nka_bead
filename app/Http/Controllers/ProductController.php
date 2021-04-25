<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('product.product', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategoriesForForm();
        return view('product.product_create_form', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->attributesArrayFromFormString($request->attributes);
        $request->merge(['attributes' => $attributes]);
        $product = new Product($request->all());
        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::query()->with('category')->where('product_id', '=', $id)->first();

        $attributeString = '';

        if (!is_null($product->attributes)) {
            foreach ($product->attributes as $key => $attribute)
            {
                $attributeString .= $key . '=' . $attribute . ',';
            }

            $attributeString = substr($attributeString, 0, -1);
        }

        $categories = $this->getCategoriesForForm();
        return view('product.product_edit_form', ['product' => $product, 'categories' => $categories, 'attributeString' => $attributeString]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**
         * @var $product Product
         */
        $product = Product::findOrFail($id);

        $attributes = $this->attributesArrayFromFormString($request->get('attributes'));
        $request->merge(['attributes' => $attributes]);

        $product->fill($request->all());
        $product->save();
        return redirect(route('products.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**
         * @var $product Product
         */
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect(route('products.index'));
    }

    /**
     * Returns the categories for the form radio elements
     *
     * @return \Illuminate\Support\Collection
     */
    private function getCategoriesForForm()
    {
        return Category::query()->pluck('name', 'category_id');
    }

    /**
     * @param string $formString
     * @return array
     */
    private function attributesArrayFromFormString($formString)
    {
        $attributes = [];
        $rawAttributes = explode(',', $formString);
        if (is_array($rawAttributes)) {
            foreach ($rawAttributes as $attribute)
            {
                $attribute = explode('=', $attribute);
                $attributes[array_shift($attribute)] = array_shift($attribute);
            }
        }

        return $attributes;
    }
}
