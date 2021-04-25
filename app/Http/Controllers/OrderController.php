<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
}
