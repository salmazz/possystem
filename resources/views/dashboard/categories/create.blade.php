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
            <li class="breadcrumb-item">
                <a href="{{route('dashboard.welcome')}}">
                
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
         <form action="{{route('dashboard.categories.store')}}" method="post" enctype="multipart/form-data">
            
                {{ csrf_field() }}
                {{ method_field('post') }}

                @foreach (config('translatable.locales') as $locale)
                <div class="form-group">
                    <label>@lang('site.' . $locale . '.name')</label>
                    <input type="text" name="{{ $locale }}[name]" class="form-control" value="{{ old($locale . '.name') }}">
                </div>
            @endforeach
        
           

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