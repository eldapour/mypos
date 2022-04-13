@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('site.categories')
                <small>{{ $categories->total() }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.categories')</li>
            </ol>
        </section>
        <!-- Table -->
        <div class="col-xs-12" style="margin-top: 15px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.categories')</h3>
                    @if(auth()->user()->hasPermission('create_categories'))
                            <a class="btn btn-sm btn-primary" href="{{ route('dashboard.categories.create') }}">
                                <i style="margin-left: 5px;" class="fa fa-plus"></i>@lang('site.add')
                            </a>
                    @endif
                    <div class="box-tools">
                        <form action="{{ route('dashboard.categories.index') }}" method="get">
                            @csrf
                            <div class="input-group input-group-sm" style="width: 150px;">
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
                        @if($categories->count() > 0 )
                        <tr>
                            <th>#</th>
                            <th>@lang('site.name')</th>
                            <th>@lang('site.product_count')</th>
                            <th>@lang('site.product_related')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        @foreach($categories as $category )
                        <tbody>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->products->count() }}</td>
                        <td><a href="{{ route('dashboard.products.index',['category_id'=> $category->id]) }}" class="btn btn-sm btn-success">@lang('site.product_related')</a></td>
                        <td>
                            @if(auth()->user()->hasPermission('update_categories'))
                            <a class="btn btn-sm btn-info fa fa-edit" href="{{ route('dashboard.categories.edit',$category->id) }}">
                                @lang('site.edit')
                            </a>
                            @endif
                            @if(auth()->user()->hasPermission('delete_categories'))
                                <form style="display: inline-block" action="{{ route('dashboard.categories.destroy',$category->id) }}" method="post">
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
                    {{ $categories->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
