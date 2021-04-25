<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $mappedOrders = [];
        $query = Order::query()
            ->with('customer')
            ->doesntHave('shipment')
            ->where('state', '!=', 'delivered')
            ->orderBy('order_date')
            ->get()
            ->each(function($order) use(&$mappedOrders) {
                $mappedOrders [Carbon::parse($order->order_date)->addDays(5)->toDateString()] [] = $order;
            });

        return view('admin_order.shipments', ['mappedOrders' => $mappedOrders]);
    }
}
