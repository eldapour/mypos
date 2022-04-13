@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('site.users')
                <small>{{ $users->total() }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li class="active">@lang('site.users')</li>
            </ol>
        </section>
        <!-- Table -->
        <div class="col-xs-12" style="margin-top: 15px">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">@lang('site.users')</h3>
                    @if(auth()->user()->hasPermission('create_users'))
                            <a class="btn btn-sm btn-primary" href="{{ route('dashboard.users.create') }}">
                                <i style="margin-left: 5px;" class="fa fa-plus"></i>@lang('site.add')
                            </a>
                    @endif
                    <div class="box-tools">
                        <form action="{{ route('dashboard.users.index') }}" method="get">
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
                        @if($users->count() > 0 )
                        <tr>
                            <th>#</th>
                            <th>@lang('site.image')</th>
                            <th>@lang('site.first_name')</th>
                            <th>@lang('site.last_name')</th>
                            <th>@lang('site.email')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                        @foreach($users as $user )
                        <tbody>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ $user->image_path }}" style="width: 70px" class="img-thumbnail"></td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(auth()->user()->hasPermission('update_users'))
                            <a class="btn btn-sm btn-info fa fa-edit" href="{{ route('dashboard.users.edit',$user->id) }}">
                                @lang('site.edit')
                            </a>
                            @endif
                            @if(auth()->user()->hasPermission('delete_users'))
                                <form style="display: inline-block" action="{{ route('dashboard.users.destroy',$user->id) }}" method="post">
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
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
