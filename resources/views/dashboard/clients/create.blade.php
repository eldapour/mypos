@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-bottom: 20px;">
            <h1>
                @lang('site.clients')
                <small>@lang('site.control_panel')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>
        <!-- general form elements -->
    <div class="col-xs-12">
        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @include('dashboard.include.error')
            <form action="{{ route('dashboard.clients.store') }}" method="post">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>@lang('site.name')</label>
                        <input type="text" class="form-control" name="name" placeholder="@lang('site.name')" required value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.phone')</label>
                        <input type="text" class="form-control" name="phone" placeholder="@lang('site.phone')" required value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.address')</label>
                        <textarea type="text" class="form-control" name="address" placeholder="@lang('site.address')" required value="{{ old('address') }}"></textarea>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i style="margin-left: 5px;" class="fa fa-plus"></i>@lang('site.add')</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
