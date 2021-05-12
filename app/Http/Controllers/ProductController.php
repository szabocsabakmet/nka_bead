<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buyIndex()
    {
        $products = Product::with('category')->get();
        return view('product.buy_product', ['products' => $products]);
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
        $attributes = $this->attributesArrayFromFormString($request->get('attributes'));
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

    public function buy(Request $request)
    {
        $productsWithQuantity = [];
        $productPrices = Product::query()
            ->whereIn('product_id', array_keys($request->get('quantity')))
            ->pluck('price', 'product_id');
        $totalPrice = 0;

        foreach (array_filter($request->get('quantity')) as $productId => $quantity)
        {
            $productsWithQuantity [] = [
                'product_id' => $productId,
                'quantity' => $quantity
            ];

            $totalPrice += ($productPrices[$productId] * $quantity);
        }

        $user = $request->user();
        $userBalance = $user->balance;

        if ($totalPrice > $userBalance) {
            return 'TÚL ALACSONY EGYENLEG';
        }

        $order = new Order([
            'customer_id' => $user->getKey(),
            'order_date' => Carbon::today(),
            'products_with_quantity' => $productsWithQuantity,
            'state' => 'not paid'
        ]);

        $order->save();

        $user->balance = $userBalance - $totalPrice;
        $user->save();


        return redirect(route('userorders'));

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
