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
            <li class="breadcrumb-item">
                <a href="{{route('dashboard.welcome')}}">
                
                @lang('site.dashboard')</a></li>
              <li class="breadcrumb-item">
                  
              <a href="{{route('dashboard.clients.index')}}">
            
                    @lang('site.clients')
            </a>
            </li>
              <li class="breadcrumb-item active">@lang('site.edit')</li>
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
         <form action="{{route('dashboard.clients.update',$client->id)}}" method="post" enctype="multipart/form-data">
            
                {{ csrf_field() }}
                {{ method_field('put') }}

                <div class="form-group">
                    <label for="">@lang('site.name')</label>
                <input type="text" name="name" 
                class="form-control" value="{{$client->name}}">
                </div>
                @for ($i = 0; $i < 2; $i++)
                <div class="form-group">
                    <label>@lang('site.phone')</label>
                    <input type="text" name="phone[]" class="form-control" value="{{ $client->phone[$i] ?? '' }}">
                </div>
            @endfor
                
             

                    
                <div class="form-group">
                        <label for="">@lang('site.address')</label>
                   
                        <textarea name="address" class="form-control" id="" cols="30" rows="10"> {{ $client->address}}
                        </textarea>
                    </div>
        
           

                                <div class="form-group">
                                    <input type="submit" value="@lang('site.edit')" class="btn btn-primary" >
                                    </div>
             </form>
         </div>
     </div>
</div>


  <!-- /.card -->

</section>
</div>
@endsection