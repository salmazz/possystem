@extends('layouts.dashboard.app')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.products')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard.index')}}">
                
                @lang('site.dashboard')</a></li>
              <li class="breadcrumb-item">
                  
              <a href="{{route('dashboard.users.index')}}">
            
                    @lang('site.users')
            </a>
            </li>
              <li class="breadcrumb-item active">@lang('site.add')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
<div class="container">
     <div class="box box-primary">
         <div class="box-header">
             <h3 class="box-title">
                 @lang('site.add')
             </h3>

         </div>
         <div class="box-body">

            @include('partials._error')
         <form action="{{route('dashboard.products.store')}}" method="post" enctype="multipart/form-data">
            
                {{ csrf_field() }}
                {{ method_field('post') }}

                <div class="form-group">
                  <label for="">@lang('site.all_categories')</label>
                  <select name="category_id" class="form-control" id="">
                  <option value="">@lang('site.all_categories')</option>
                      @foreach ( $categories as $category)
                  <option value="{{$category->id}}" {{old('category_id') == $category->id  ? 'selected' : ' '}}>

                        {{$category->name}}
                      </option>
                      @endforeach


                  </select>

                 
                </div>

                @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label>@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                </div>

                <div class="form-group">
                  <label>@lang('site.' . $locale . '.description')</label>
                  <textarea name="{{ $locale }}[description]" class="ckeditor form-control" > {{ old($locale . '.description') }} </textarea>
              </div>
            @endforeach

            <div class="form-group">
              <label for="">@lang('site.image')</label>
              <input type="file" name="image" class="form-control image">

            </div>

            <div class="form-group">
            <img src="{{asset('uploads/product_images/default.png')}}" class="img-thumbnail preview" style="height:100px;width:100px" alt="">
            </div>
            <div class="form-group">
                <label for="">@lang('site.purchase_price')</label>
                <input type="number" name="purchase_price" value="{{ old('purchase_price') }}" class="form-control ">
  
              </div>
              <div class="form-group">
                  <label for="">@lang('site.sale_price')</label>
                  <input type="number" name="sale_price" value="{{ old('sale_price') }}" class="form-control ">
    
                </div>
                <div class="form-group">
                    <label for="">@lang('site.stock')</label>
                    <input type="number" value="{{ old('stock') }}" name="stock" class="form-control ">
      
                  </div>
             
          
           

                                <div class="form-group">
                                    <input type="submit" value="@lang('site.add')" class="btn btn-primary" >
                                    </div>
             </form>
         </div>
     </div>
</div>


  <!-- /.card -->

</section>
</div>
@endsection