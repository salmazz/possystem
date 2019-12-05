@extends('layouts.dashboard.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('site.clients')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('site.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('site.clients')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="box box-primary">

            <div class="box-header p-3 with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('site.clients')
                    <small>{{ $clients->total() }}</small>
                </h3>

                <form action="{{ route('dashboard.clients.index') }}" method="get">

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

                            @if(auth()->user()->hasPermission('create_clients'))
                            <a class="btn btn-primary" href="{{route('dashboard.clients.create')}}">
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
                    @if($clients->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.clients')</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('site.name')</th>
                                        <th>@lang('site.phone')</th>
                                        <th>@lang('site.address')</th>
                                        <th>@lang('site.add_order')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $index=>$client )
                                    <tr>
                                        <td>{{$index +1 }}</td>
                                        <td>{{$client->name}}</td>
                                        <td>{{ is_array($client->phone) ? implode($client->phone, '-') : $client->phone }}</td>
                                        <td>{{$client->address}}</td>
                                    <td><a href="{{ route('dashboard.clients.orders.create',$client->id )}}" class="btn btn-primary">@lang('site.add_order')</a></td>
                                   
                                        <td>
                                                @if (auth()->user()->hasPermission('update_clients'))
                                                    <a href="{{ route('dashboard.clients.edit', $client->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                                @endif
                                                @if (auth()->user()->hasPermission('delete_clients'))
                                                    <form action="{{ route('dashboard.clients.destroy', $client->id) }}" method="post" style="display: inline-block">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                    </form><!-- end of form -->
                                                @else
                                                    <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                @endif
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $clients->appends(request()->query())->links() }}

                        @else

                        <h2>@lang('site.no_date_found')</h2>

                        @endif
                    </div>
                </div>
    </section>
</div>
@endsection
