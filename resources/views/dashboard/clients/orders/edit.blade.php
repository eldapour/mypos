@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-bottom: 20px;">
            <h1>
                @lang('site.orders')
                <small>@lang('site.control_panel')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.clients')</a></li>
                <li><a href="{{ route('dashboard.clients.index') }}">@lang('site.orders')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        <!-- general form elements -->
        <div class="col-md-6">
            <div class="box box-primary ">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.categories')</h3>
                    <div class="row">
                        <div class="box-body">
                            @foreach($categories as $category)
                                <div class="panel-group">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                           <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                            <div class="panel-body">
                                                @if($category->products->count() > 0)

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.stock')</th>
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.add')</th>
                                                        </tr>
                                                        @foreach($category->products as $product)
                                                            <tbody>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->stock }}</td>
                                                            <td>{{ number_format($product->sale_price, 2) }}</td>
                                                            <td>
                                                                <a href=""
                                                                   id="product-{{$product->id}}"
                                                                   data-name="{{$product->name}}"
                                                                   data-id="{{ $product->id }}"
                                                                   data-price="{{ $product->sale_price }}"
                                                                   class="btn {{ in_array($product->id , $order->products->pluck('id')->toArray()) ? 'btn-danger btn-sm disabled' : ' btn-success btn-sm add-product-btn' }}">
                                                                    <i class="fa fa-plus"></i>
                                                                </a>
                                                            </td>
                                                            </tbody>
                                                        @endforeach
                                                    </table>
                                                @else
                                                    <h4>@lang('site.on_files')</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary ">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('site.orders')</h3>
                </div>
                <form action="{{ route('dashboard.clients.orders.update', ['order' => $order->id , 'client' => $client->id ] )}}" method="post">
                    @csrf
                    {{ method_field('put') }}
                    @include('dashboard.include.error')
                    <table class="table table-hover">
                        <tr>
                            <th>@lang('site.product')</th>
                            <th>@lang('site.mount')</th>
                            <th>@lang('site.price')</th>
                        </tr>
                        <tbody class="order-list">
                        @foreach($order->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td><input type="number" name="products[{{ $product->id }}][quantity]" data-price="{{ number_format($product->sale_price , 2) }}" class="form-control input-sm product-quantity" min="1" value="{{ $product->pivot->quantity }}"></td>
                                <td class="product-price">{{ number_format($product->sale_price * $product->pivot->quantity, 2) }}</td>
                                <td><button class="btn btn-sm btn-danger remove-product-btn" data-id="{{ $product->id }}"><span class="fa fa-trash"></span></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="box-footer">
                        <h4>@lang('site.collection')<span class="total-price">{{ $order->total_price }}</span></h4>
                    </div>
                    <button class="btn btn-sm btn-primary btn-block disabled" style="font-size: larger;" id="add-order-form-btn" type="submit"><span class="fa fa-edit">@lang('site.edit_order')</span></button>
                </form>
            </div>
        </div>
    </div>

@endsection
