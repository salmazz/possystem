@extends('layouts.dashboard.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('site.orders')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('site.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('site.orders')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="box box-primary">

            <div class="box-header p-3 with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.orders')

                </h3>


            </div>
            <div class="row">
                <div class="col-md-6">
                    {{-- @if($orders->count() > 0) --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.categories')</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="accordion" id="accordionExample">
                                @foreach ($categories as $category )

                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#{{ str_replace(' ', '-', $category->name) }}"" aria-expanded="
                                                true" aria-controls="collapseOne">
                                                {{$category->name}}
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="{{ str_replace(' ', '-', $category->name) }}" class="collapse show"
                                        aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('site.name')</th>
                                                        <th>@lang('site.stock')</th>
                                                        <th>@lang('site.price')</th>
                                                        <th>@lang('site.add')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($category->products as $product)
                                                    <tr>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->stock }}</td>
                                                        <td>{{ number_format($product->sale_price, 2) }}</td>
                                                        <td>
                                                            <a href="" id="product-{{ $product->id }}"
                                                                data-name="{{ $product->name }}"
                                                                data-id="{{ $product->id }}"
                                                                data-price="{{ $product->sale_price }}"
                                                                class="btn btn-success btn-sm add-product-btn">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
																						</table>
																						<!-- end of table-->
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                            </div>
                        </div>
                        {{-- {{ $orders->appends(request()->query())->links() }} --}}

                        {{-- @else

                        <h2>@lang('site.no_date_found')</h2>

                        @endif --}}
                    </div>
                </div>

                <div class="col-md-6">
                    <form action="{{ route('dashboard.clients.orders.store', $client->id) }}" method="post">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        @include('partials._error')

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('site.product')</th>
                                    <th>@lang('site.quantity')</th>
                                    <th>@lang('site.price')</th>
                                </tr>
                            </thead>

                            <tbody class="order-list">


                            </tbody>

                        </table><!-- end of table -->

                        <h4>@lang('site.total') : <span class="total-price">0</span></h4>

                        <button class="btn btn-primary btn-block disabled" id="add-order-form-btn"><i
                                class="fa fa-plus"></i> @lang('site.add_order')</button>

                    </form>
                </div>
    </section>
</div>
@endsection
