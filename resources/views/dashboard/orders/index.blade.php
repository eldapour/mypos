@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('site.orders')
                <small>{{ $orders->total() }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.orders')</li>
            </ol>
        </section>
        <!-- Table -->
        <div class="col-md-8" style="margin-top: 15px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.orders')</h3>
                    <div class="box-tools">
                        <form action="{{ route('dashboard.orders.index') }}" method="get">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 400px;">
                                <input type="text" name="search" class="form-control pull-right" placeholder="@lang('site.search')" value="{{ request()->search }}">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        @if($orders->count() > 0 )
                            <tr>
                                <th>#</th>
                                <th>@lang('site.client_name')</th>
                                <th>@lang('site.price')</th>
{{--                                <th>@lang('site.status')</th>--}}
                                <th>@lang('site.created_at')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            @foreach($orders as $order )
                                <tbody>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->client->name }}</td>
                                <td>{{ number_format($order->total_price,2) }}</td>
{{--                                <td>--}}
{{--                                    <button--}}
{{--                                    data-status="@lang('site.' . $order->status)"--}}
{{--                                    data-url="{{ route('dashboard.orders.update_status',) }}"--}}
{{--                                    data-method="put"--}}
{{--                                    data-availabel-status='["@lang('site.processing')"," "]'--}}
{{--                                    class="order-status-btn btn {{ $order->status == 'process' }}"--}}
{{--                                    >--}}
{{--                                        @lang('site.' . $order->status)--}}
{{--                                    </button>--}}
{{--                                </td>--}}
                                <td>{{ $order->created_at->toFormattedDateString() }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm order-products-btn"
                                            data-url="{{ route('dashboard.orders.products', $order->id ) }}"
                                            data-method="get">
                                        <i class="fa fa-list"></i>
                                        @lang('site.show')
                                    </button>
                                    @if(auth()->user()->hasPermission('update_categories'))
                                        <a class="btn btn-sm btn-info fa fa-edit" href="{{ route('dashboard.clients.orders.edit', ['client' => $order->client->id, 'order' => $order->id ]) }}">
                                            @lang('site.edit')
                                        </a>
                                    @endif
                                    @if(auth()->user()->hasPermission('delete_categories'))
                                        <form style="display: inline-block" action="{{ route('dashboard.orders.destroy',$order->id) }}" method="post">
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
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            </div> <!-- box box-primary -->
        </div> <!-- col-md-8 -->
        <div class="col-md-4" style="margin-top: 15px">
            <div class="box box-primary">
                <div class="box-body table-responsive no-padding">
                    <div class="box-header">
                        <h3 class="box-title">@lang('site.order_show')</h3>
                    </div>
                    <div id="order-products-list">

                    </div>
                </div> <!-- box-body table-responsive no-padding -->
            </div> <!-- box box-primary -->
        </div> <!-- col-md-4 -->
    </div>
@endsection
