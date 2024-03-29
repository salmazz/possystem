  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
   
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('dashboard_files/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">

              {{auth()->user()->first_name}} 
              {{auth()->user()->last_name}}
             
            </a>
          </div>
        </div>
  
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
            <a href="{{route('dashboard.welcome')}}" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  @lang('site.dashboard')
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                @if(auth()->user()->hasPermission('read_users'))
                <li class="nav-item">
                  <a href="{{route('dashboard.users.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p> @lang('site.users')
                    </p>
                  </a>
                </li>
                @endif


                @if(auth()->user()->hasPermission('read_products'))
                <li class="nav-item">
                  <a href="{{route('dashboard.products.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p> @lang('site.products')
                    </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('read_categories'))
                <li class="nav-item">
                  <a href="{{route('dashboard.categories.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p> @lang('site.categories')
                    </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('read_clients'))
                <li class="nav-item">
                  <a href="{{route('dashboard.clients.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p> @lang('site.clients')
                    </p>
                  </a>
                </li>
                @endif
                @if(auth()->user()->hasPermission('read_orders'))
                <li class="nav-item">
                  <a href="{{route('dashboard.orders.index')}}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p> @lang('site.orders')
                    </p>
                  </a>
                </li>
                @endif
            
              </ul>
        
          
            <li class="nav-item">
                <a href="{{ route('logout') }}" class="btn btn-default text-dark btn-block" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">@lang('site.logout')</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>


        </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  