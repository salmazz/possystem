@extends('layouts.dashboard.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('site.users') <small>{{ $users->total() }}</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">@lang('site.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('site.users')</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="card card-primary">

            <div class="card-header p-3 with-border">


                <form action="{{ route('dashboard.users.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search"  class="form-control" placeholder="@lang('site.search')"
                                value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                                @lang('site.search')
                            </button>

                            @if(auth()->user()->hasPermission('create_users'))
                            <a class="btn btn-primary" href="{{route('dashboard.users.create')}}">
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
                    @if($users->count() > 0)
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('site.users')</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('site.first_name')</th>
                                        <th>@lang('site.last_name')</th>
                                        <th>@lang('site.email')</th>
                                        <th>@lang('site.image')</th>
                                        <th>@lang('site.action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index=>$user )
                                    <tr>
                                        <td>{{$index +1 }}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                        <img src="{{$user->image_path}}" class="img-fluid" style="width:100px" alt="">
                                        </td>
                                        <td>
                                            @if(auth()->user()->hasPermission('update_users'))
                                            <a class="btn btn-info btn-sm" style="display:inline-block"
                                                href="{{route('dashboard.users.edit',$user->id)}}">
                                                <i class="fa fa-edit"></i>

                                                @lang('site.edit')
                                            </a>
                                            @else
                                            <a href="#" class="btn btn-info disabled">
                                                <i class="fa fa-edit"></i>

                                                @lang('site.edit')
                                            </a>

                                            @endif
                                            @if(auth()->user()->hasPermission('delete_users'))
                                            <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post"
                                                style="display:inline-block">
                                                {{csrf_field()}}
                                                {{method_field('delete')}}
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                    @lang('site.delete')
                                                </button>
                                            </form>
                                            @else

                                            <button class="btn btn-danger disabled">
                                                <i class="fa fa-trash"></i>
                                              @lang('site.delete')</button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>

                                    </tr>
                                    <tr>

                                    </tr>
                                    <tr>

                                    </tr>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        {{-- <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div> --}}

                    {{ $users->appends(request()->query())->links() }}
                    @else

                    <h2>@lang('site.no_date_found')</h2>

                    @endif
                </div>
            </div>
    </section>
</div>
@endsection
