@extends('dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('site.dashboard')
                <small>@lang('site.control_panel')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active"></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $category_count }}</h3>

                            <p>@lang('site.categories')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-list"></i>
                        </div>
                        <a href="{{ route('dashboard.categories.index') }}" class="small-box-footer">@lang('site.more')<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $product_count }}</h3>

                            <p>@lang('site.products')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-cart"></i>
                        </div>
                        <a href="{{ route('dashboard.products.index') }}" class="small-box-footer">@lang('site.more')<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3>{{ $client_count }}</h3>

                            <p>@lang('site.clients')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="{{ route('dashboard.clients.index') }}" class="small-box-footer">@lang('site.more')<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>{{ $user_count }}</h3>

                            <p>@lang('site.users')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-usb"></i>
                        </div>
                        <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">@lang('site.more')<i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs pull-right">
                            <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                            <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                        </ul>
                        <div class="tab-content no-padding">
                            <!-- Morris chart - Sales -->
                            <div class="chart tab-pane active" id="revenue-chart"
                                 style="position: relative; height: 300px;"></div>
                            <div class="chart tab-pane" id="sales-chart"
                                 style="position: relative; height: 300px;"></div>
                        </div>
                    </div><!-- /.box -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>

@endsection
