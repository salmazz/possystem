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
                        <li class="breadcrumb-item"><a href="#">@lang('site.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('site.products')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="box box-primary">

            <div class="box-header p-3 with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.products')
                    <small>{{ $products->total() }}</small>
                </h3>

                <form action="{{ route('dashboard.products.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                                @lang('site.search')
                            </button>

                            @if(auth()->user()->hasPermission('create_products'))
                            <a class="btn btn-primary" href="{{route('dashboard.products.create')}}">
                                <i class="fa fa-plus"></i>
                                @lang('site.add')
                            </a>

                            @else
                            <a href="#" class="btn disabled btn-primary">
                                @lang('site.add')
                            </a>
                            @endif
                        </div>

                    </div>
                </form><!-- end of form -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($products->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.products')</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.description')</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.purchase_price')</th>
                                        <th>@lang('site.sale_price')</th>
                                        <th>@lang('site.stock')</th>

                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $index=>$product )
                                    <tr>
                                        <td>{{$index +1 }}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{!!  $product->description  !!}</td>
                                        <td><img style="width:100px;height:100px" src="{{$product->image_path}}" alt=""></td>
                                        <td>{{$product->purchase_price}}</td>
                                        <td>{{$product->sale_price}}</td>
                                        <td>{{$product->stock}}</td>
                            
                                        <td>
                                            <a class="btn btn-info btn-sm" style="display:inline-block"
                                                href="{{route('dashboard.products.edit',$product->id)}}">
                                                <i class="fa fa-edit"></i> @lang('site.edit')</a>
                                            <form action="{{route('dashboard.products.destroy',$product->id)}}"
                                                method="post" style="display:inline-block">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                    @lang('site.delete') </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $products->appends(request()->query())->links() }}

                        @else

                        <h2>@lang('site.no_date_found')</h2>

                        @endif
                    </div>
                </div>
    </section>
</div>
@endsection
