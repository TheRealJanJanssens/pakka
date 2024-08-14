@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif

	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(config('pakka.prefix.admin'). '.collections.create') }}" class="btn btn-info">
            {{ trans('pakka::app.add_button') }}
        </a>
    </div>


    <div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-list table-striped table-sort" cellspacing="0" width="100%"> <!-- table-bordered -->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.type') }}</th>
                    <th>{{ trans('pakka::app.status') }}</th>
                    <th></th>
                </tr>
            </thead>

<!--
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
-->

            <tbody data-action="/admin/collections/sort">
                @foreach ($collections as $collection)
                    <tr class="item" data-id="{{ $collection['id'] }}" data-position="">
                        <td><i class="handle ti-line-double"></i><a href="{{ route(config('pakka.prefix.admin'). '.collections.edit', $collection['id']) }}">{!! $collection['name'] !!}</a></td>
                        <td>
	                        @if ($collection['type'] == 1)
	                        	{{ trans('pakka::app.man_col') }}
	                        @endif

	                        @if($collection['type'] == 2)
	                        	{{ trans('pakka::app.auto_col') }}
	                        @endif

                        </td>
                        <td>
	                        @if ($collection['status'] == 1)
	                        	<div class="status-icon status-icon-green"></div>
	                        	{{ trans('pakka::app.online') }}
	                        @else
	                        	<div class="status-icon status-icon-red"></div>
	                        	{{ trans('pakka::app.offline') }}
	                        @endif
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(config('pakka.prefix.admin'). '.collections.edit', $collection['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(config('pakka.prefix.admin'). '.collections.destroy', $collection['id']),
                                        'method' => 'DELETE',
                                        ])
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>

                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection
