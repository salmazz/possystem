@extends('layouts.dashboard.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('site.categories')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('site.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('site.categories')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="box box-primary">

            <div class="box-header p-3 with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.categories')
                    <small>{{ $categories->total() }}</small>
                </h3>

                <form action="{{ route('dashboard.categories.index') }}" method="get">

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

                            @if(auth()->user()->hasPermission('create_categories'))
                            <a class="btn btn-primary" href="{{route('dashboard.categories.create')}}">
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
                    @if($categories->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.categories')</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.products_count')</th>
                                        <th>@lang('site.related_products')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $index=>$category )
                                    <tr>
                                        <td>{{$index +1 }}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->products->count()}}</td>
                                        <td><a href="{{route('dashboard.products.index',['category_id'=>$category->id])}}" class="btn btn-info">@lang('site.related_products')
                                        </a></td> 
                                        <td>
                                            <a class="btn btn-info btn-sm" style="display:inline-block"
                                                href="{{route('dashboard.categories.edit',$category->id)}}">
                                                <i class="fa fa-edit"></i> @lang('site.edit')</a>
                                            <form action="{{route('dashboard.categories.destroy',$category->id)}}"
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
                        {{ $categories->appends(request()->query())->links() }}

                        @else

                        <h2>@lang('site.no_date_found')</h2>

                        @endif
                    </div>
                </div>
    </section>
</div>
@endsection
