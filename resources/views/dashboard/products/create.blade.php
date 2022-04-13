@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-bottom: 20px;">
            <h1>
                @lang('site.products')
                <small>@lang('site.control_panel')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index') }}">@lang('site.products')</a></li>
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
            <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                        <label>@lang('site.categories')</label>
                        <div class="form-group">
                            <select class="form-control" name="category_id" >
                                <option value=""> @lang('site.all_cat')</option>
                                @foreach($categories as $category)
                                    <option class="pull-right" value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label>@lang('site.name')</label>
                        <input type="text" class="form-control" name="name" placeholder="@lang('site.name')" required value="{{ old('name') }}">
                    </div> <!-- name -->
                    <div class="form-group">
                        <label>@lang('site.desc')</label>
                        <textarea type="text" class="form-control ckeditor" name="desc" placeholder="@lang('site.desc')" required></textarea>
                    </div> <!-- description -->
                    <div class="form-group">
                        <label>@lang('site.purchase_price')</label>
                        <input type="text" class="form-control" name="purchase_price" placeholder="@lang('site.purchase_price')" required>
                    </div> <!-- purchase price -->
                    <div class="form-group">
                        <label>@lang('site.sale_price')</label>
                        <input type="text" class="form-control" name="sale_price" placeholder="@lang('site.sale_price')" required>
                    </div> <!-- sale price -->
                    <div class="form-group">
                        <label>@lang('site.stock')</label>
                        <input type="text" class="form-control" name="stock" placeholder="@lang('site.stock')" required>
                    </div> <!-- stock -->
                    <div class="form-group">
                        <label>@lang('site.image_product')</label>
                        <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="form-group">
                        <img id="output" src="{{ asset('uploads/products_images/default.png') }}" width="100px" class="img-thumbnail"/>
                        <script>
                            var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src) // free memory
                                }
                            };
                        </script>
                    </div> <!-- image Div-->
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
