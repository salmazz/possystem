<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        //
        $products = Product::paginate(2);
        return view('dashboard.products.index',compact('products'));
    }

    
    public function create()
    {
        //
        $categories = Category::all();
        return view('dashboard.products.create',compact('categories'));
    }

    
    public function store(Request $request)
    {
        //
        $rules=[

            'category_id'=>'required'
        ];
        foreach(config('translatable.locales') as $locale ){
         $rules += [$locale . '.name'=>'required|unique:product_translations,name'];
         $rules += [$locale . '.description'=>'required'];

        }
        
        $rules += [
        'purchase_price'=>'required',
        'sale_price'=>'required',
        'stock'=>'required'
        ];

        $request->validate($rules);

        $request_data = $request->all();
    
        if ($request->image) {
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));
            $request_data['image'] = $request->image->hashName();
        }
        // dd($request_date);
        $user = Product::create($request_data);
  ;

        session()->flash('success', 'site.added_successfully');

        return redirect()->route('dashboard.products.index');
    }

   
    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    
    public function destroy(Product $product)
    {
        //
    }
}  // end of controller 
