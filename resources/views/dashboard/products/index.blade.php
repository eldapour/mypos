@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('site.products')
                <small>{{ $products->total() }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.products')</li>
            </ol>
        </section>
        <!-- Table -->
        <div class="col-xs-12" style="margin-top: 15px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.products')</h3>
                    @if(auth()->user()->hasPermission('create_products'))
                            <a class="btn btn-sm btn-primary" href="{{ route('dashboard.products.create') }}">
                                <i style="margin-left: 5px;" class="fa fa-plus"></i>@lang('site.add')
                            </a>
                    @endif
                    <div class="box-tools">
                        <form action="{{ route('dashboard.products.index') }}" method="get">
                            @csrf
                            <div class="form-group-sm" style="width: 500px">
                            <div class="input-group input-group-sm" style="width: 100%">
                                <input type="text" name="search" style="width: 200px; margin-left: 3px" class="form-control pull-right" placeholder="@lang('site.search')" value="{{ request()->search }}">
                                <div class="input-group-btn pull-right">
                                    <select name="category_id" style="width: 200px" class="form-control">
                                    <option value="">@lang('site.all_cat')</option>
                                    @foreach($categories as $category)
                                        <option class="form-control" value="{{ $category->id }}" {{ request()->category_id == $category->id ? 'selected' : '' }} >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" style="margin-left: 10px"></i>@lang('site.search')</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        @if($products->count() > 0 )
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')<i class="fa fa-caret-down"></i></th>
                            <th>@lang('site.desc')<i class="fa fa-caret-down"></i></th>
                            <th>@lang('site.category')<i class="fa fa-caret-down"></i></th>
                            <th>@lang('site.image_product')</th>
                            <th>@lang('site.purchase_price')<i class="fa fa-arrow-circle-o-up"></i></th>
                            <th>@lang('site.sale_price')<i class="fa fa-arrow-circle-o-down"></i></th>
                            <th>@lang('site.profit_percent')<i class="fa fa-percent"></i></th>
                            <th>@lang('site.stock')<i class="fa fa-caret-down"></i></th>
                            <th>@lang('site.action')<i class="fa fa-caret-down"></i></th>
                        </tr>
                        @foreach($products as $index=>$product )
                        <tbody>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{!! $product->desc !!}</td>
                        <td>{{ $product->category->name }}</td>
                        <td><img src="{{ $product->image_path }}" width="60px" class="img-thumbnail" alt=""></td>
                        <td>{{ $product->purchase_price }}</td>
                        <td>{{ $product->sale_price }}</td>
                        <td>{{ $product->profit_percent }} %</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if(auth()->user()->hasPermission('update_products'))
                            <a class="btn btn-sm btn-info fa fa-edit" href="{{ route('dashboard.products.edit',$product->id) }}">
                                @lang('site.edit')
                            </a>
                            @endif
                            @if(auth()->user()->hasPermission('delete_products'))
                                <form style="display: inline-block" action="{{ route('dashboard.products.destroy',$product->id) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button class="btn btn-sm btn-danger fa fa-trash" type="submit">
                                        @lang('site.delete')
                                    </button>
                                </form>
                            @endif
                        </td>
                        </tbody>
                        @endforeach
                        @else
                            <h1 class="alert">@lang('site.on_files')<h1>
                        @endif
                    </table>
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
