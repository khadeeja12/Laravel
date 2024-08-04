<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\Product\Order;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Users\UsersController;

class UsersController extends Controller
{
    //
    public function myOrders()
    {
        $orders=Order::select()->where('user_id',Auth::user()->id)->get();

        return view('users.myorders',compact('orders'));
    }
}
