<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
class OrderController extends Controller
{
    //

    public function index(Request $request){
        $orders = Order::whereHas('client', function ($q) use ($request) {

            return $q->where('name', 'like', '%' . $request->search . '%');

        })->paginate(5);

        return view('dashboard.orders.index', compact('orders'));
    }
    public function products(Order $order){
      $products =$order->products;
      
      return view('dashboard.orders._products',compact('products','order'));
    }

    public function destroy(Order $order){
        foreach ($order->products as $product){
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }
        // dd('done');
        $order->delete();
        session()->flash('success',__('site.deleted_successfullly'));
        return redirect()->route('dashboard.orders.index');

     }
}
