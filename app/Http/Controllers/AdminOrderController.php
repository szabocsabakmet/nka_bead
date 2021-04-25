<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders ['pending'] = Order::query()->with(['customer', 'shipment'])->where('state', '=', 'not paid')->get();
        $orders ['paid'] = Order::query()->with(['customer', 'shipment'])->where('state', '=', 'paid')->get();
        $orders ['delivered'] = Order::query()->with(['customer', 'shipment'])->where('state', '=', 'delivered')->get();

        return view('admin_order.admin_order', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = Order::query()->with(['customer', 'shipment'])->first();
        $productIds = [];
        $quantities = [];

        foreach ($order->products_with_quantity as $product)
        {
            $productIds [] = $product['product_id'];
            $quantities [$product['product_id']] = $product['quantity'];
        }

        $products = Product::query()->whereIn('product_id', $productIds)->get();

        return view('admin_order.admin_order_show', ['order' => $order, 'products' => $products, 'quantities' => $quantities]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**
         * @var $order Order
         */
        $order = Order::findOrFail($id);
        return view('admin_order.order_edit_form', ['order' => $order]);
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
         * @var $order Order
         */
        $order = Order::findOrFail($id);
        $order->state = $request->get('state');
        $shipment = new Shipment([
            'order_id' => $order->getKey(),
            'shipment_date' => $request->get('shipment_date')
        ]);
        $shipment->save();
        $order->save();
        return redirect(route('orders.index'));
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
         * @var $order Order
         */
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect(route('orders.index'));
    }




    /*
     * Just a query i could wrote to have the products with one query, but it's impossible due to the several orderable products
SELECT orders.*, products.name as product_name, users.name as user_name, shipments.shipment_date as shipment_date FROM `orders`

LEFT JOIN products ON JSON_UNQUOTE(JSON_EXTRACT(orders.products_with_quantity, "$.product_id")) = products.product_id

LEFT JOIN users ON orders.customer_id = users.customer_id

LEFT JOIN shipments ON shipments.order_id = orders.order_id
     */
}
