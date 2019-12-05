<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    //
    public function create(Client $client){

        // category with products 
        $categories = Category::with('products')->get();
        $orders = Order::all();

        return view('dashboard.clients.orders.create',compact('categories','client','orders'));
    }
}
