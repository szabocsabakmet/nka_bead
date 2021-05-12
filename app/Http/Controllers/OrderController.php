<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        /**
         * @var $user User
         */
        $user = \request()->user();
        $myOrders = $user->orders()->get();

        return view('user_order.user_order', ['orders' => $myOrders]);
    }

    public function show($id)
    {
        $order = Order::query()->with(['customer', 'shipment'])->where('order_id', '=', $id)->first();
        $productIds = [];
        $quantities = [];

        foreach ($order->products_with_quantity as $product)
        {
            $productIds [] = $product['product_id'];
            $quantities [$product['product_id']] = $product['quantity'];
        }

        $products = Product::query()->whereIn('product_id', $productIds)->get();

        return view('user_order.user_order_show', ['order' => $order, 'products' => $products, 'quantities' => $quantities]);
    }

}
