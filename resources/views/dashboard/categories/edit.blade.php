@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-bottom: 20px;">
            <h1>
                @lang('site.categories')
                <small>@lang('site.control_panel')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.categories.index') }}">@lang('site.categories')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        <!-- general form elements -->
        <div class="col-xs-12">
            <div class="box box-primary ">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                @include('dashboard.include.error')
                <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post">
                    @csrf
                    {{ method_field('put') }}
                    <div class="box-body">
                        <div class="form-group">
                            <label>@lang('site.name')</label>
                            <input type="text" class="form-control" name="name" placeholder="@lang('site.name')" required value="{{ $category->name }}">
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i style="margin-left: 5px;" class="fa fa-edit"></i>@lang('site.edit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
