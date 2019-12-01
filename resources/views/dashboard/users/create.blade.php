@extends('layouts.dashboard.app')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@lang('site.users')</h1>
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
         <form action="{{route('dashboard.users.store')}}" method="post" enctype="multipart/form-data">
            
                {{ csrf_field() }}
                {{ method_field('post') }}
                 <div class="form-group">
                     <label for="">@lang('site.first_name')</label>
                 <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}">
                 </div>
                 <div class="form-group">
                        <label for="">@lang('site.last_name')</label>
                    <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}">
                    </div>
                    <div class="form-group">
                            <label for="">@lang('site.email')</label>
                        <input type="email" name="email" class="form-control" value="{{old('email')}}">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('site.image')</label>
                        <input type="file" name="image" class="form-control image">
                        </div>

                        <div class="form-group">
                        <img src="{{asset('uploads/user_images/default.png')}}" alt="" class="img-fluid img-preview" style="width:100px">
                        </div>
                        <div class="form-group">
                          <label for="">@lang('site.permissions')</label>
                       
                            <!-- Custom Tabs -->
            <div class="card">
                <div class="card-header d-flex p-0">
                    @php 
                 $models= ['users','categories','products'];
                 $maps = ['create','read','update','delete'];
                   
                    @endphp

                  <ul class="nav nav-pills ml-auto p-2">
                  @foreach ($models as $index=>$model )
                  <li class="nav-item">
                      <a class="nav-link {{$index == 0 ? 'active' : ' '}}" href="#{{$model}}" data-toggle="tab">@lang('site. ' . $model)</a></li>
                  @endforeach
                  
                 
            
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    {{-- users permission  --}}
              

                    @foreach ($models as $index=>$model )

                    
                    <div class="tab-pane  {{$index == 0 ? 'active' : ' '}}" id="{{$model}}">
                        @foreach ($maps as $map )
                      <div class="form-check">
                      <input type="checkbox"  name="permissions[]" class="form-check-input" value="{{$map . '_' . $model}}" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">@lang('site.' . $map)</label>
 
                  </div>
                                
                    @endforeach
                    </div>
                    @endforeach
                  
                  </div>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>
              <!-- ./card -->
                         </div>
                       </div>
                        <div class="form-group">
                                <label for="">@lang('site.password')</label>
                            <input type="password" name="password" class="form-control" >
                            </div>
                            <div class="form-group">
                                    <label for="">@lang('site.password_confirmation')</label>
                                <input type="password" name="password_confirmation" class="form-control" >
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