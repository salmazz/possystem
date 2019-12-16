<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use App\User;
use App\Order;
use App\Client;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    //
    public function index(){
        $categories_count = Category::count();
        $products_count = Product::count();
        $orders_count = Order::count();
        $orders=Order::all();
        $categories=Category::all();
        // $products = DB::table('products')->latest()->limit(2)->get();
      
        // return response()->json($products);
                $users_count = User::whereRoleIs('admin')->count();
        $clients_count = Client::count();

        $sales_data = Order::select(
            DB::raw('YEAR(CURRENT_TIMESTAMP) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as sum')
        )->groupBy('month')->get();


        // dd($sales_data);
        // return response()->json($sales_data);


         return view('dashboard.welcome',compact('categories_count','products_count','orders_count','users_count','clients_count','sales_data','orders','categories'));
    }

}
