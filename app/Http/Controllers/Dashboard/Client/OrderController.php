<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    //
    public function create(Client $client){

        // category with products 
        $categories = Category::with('products')->get();
        $orders = Order::all();

        return view('dashboard.clients.orders.create',compact('categories','client','orders'));
    }

    public function store(Request $request,Client $client){
        $request->validate([
            'products'=>'required|array',
            // 'quantities'=>'required|array'

        ]);
        $order = $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price = 0;
      
         foreach ($request->products as $id=>$quantity){

             $product = Product::FindOrFail($id);
             $total_price += $product->sale_price * $quantity['quantity'];

             $product->update([
                'stock'=>$product->stock - $quantity['quantity']
            ]);
         }



         $order->update([
            'total_price' => $total_price
        ]);
        // dd($total_price);


        return redirect()->route('dashboard.orders.index');
    }
}
