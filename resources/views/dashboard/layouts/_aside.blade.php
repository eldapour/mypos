<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-right image">
                <img src="{{ asset('uploads/users_images/' . auth()->user()->image) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</p>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search ...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                        class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">@lang('site.control_panel')</li>
            <li class="active">
                <a href="{{ route('dashboard.home') }}">
                    <i class="fa fa-dashboard"></i> <span>@lang('site.dashboard')</span>
                </a>
                @if(auth()->user()->hasPermission('read_categories'))
                    <a href="{{ route('dashboard.categories.index') }}">
                        <i class="fa fa-th"></i> <span>@lang('site.categories')</span>
                    </a>
                @endif
                @if(auth()->user()->hasPermission('read_products'))
                    <a href="{{ route('dashboard.products.index') }}">
                        <i class="fa fa-product-hunt"></i> <span>@lang('site.products')</span>
                    </a>
                @endif
                @if(auth()->user()->hasPermission('read_clients'))
                    <a href="{{ route('dashboard.clients.index') }}">
                        <i class="fa fa-id-badge"></i> <span>@lang('site.clients')</span>
                    </a>
                @endif
                @if(auth()->user()->hasPermission('read_orders'))
                    <a href="{{ route('dashboard.orders.index') }}">
                        <i class="fa fa-shopping-cart"></i> <span>@lang('site.orders')</span>
                    </a>
                @endif
                @if(auth()->user()->hasPermission('read_users'))
                    <a href="{{ route('dashboard.users.index') }}">
                        <i class="fa fa-users"></i> <span>@lang('site.users')</span>
                    </a>
                @endif
            </li>  <!-- /.li - active -->
        </ul> <!-- /.sidebar-menu -->
    </section> <!-- /.section -->
</aside> <!-- /.sidebar -->
