<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $categories=Category::when($request->search,function($q) use ($request){

         return $q->where('name','like','%'.$request->search.'%');

        })->latest()->paginate(5);
        // $categories =Category::paginate(5);
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'ar.*'=>'required|unique:category_translations,name',
            
        ]);

        Category::create($request->all());
        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        return view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name'=>'required|unique:categories,name',
            
        ]);

        Category::update($request->all());
        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');
         

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $category->delete();
    
        session()->flash('success',__('site.deleted_successfully'));

        return redirect()->route('dashboard.categories.index');
    }
}
