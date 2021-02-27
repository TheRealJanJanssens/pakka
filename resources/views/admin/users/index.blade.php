@extends('pakka::admin.default')

@section('page-header')
    Users <small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.users.create') }}" class="btn btn-info">
            {{ trans('pakka::app.add_button') }}
        </a>
    </div>


    <div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-bordered -->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.email') }}</th>
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
            
            <tbody>
                @foreach ($items as $item)
                	@if(($item->role == 10 && checkAcces("permission_user_admin_edit")) || $item->role !== 10)
	                    <tr>
	                        <td><a href="{{ route(ADMIN . '.users.edit', $item->id) }}">{{ $item->name }}</a></td>
	                        <td>{{ $item->email }}</td>
	                        <td>
	                            <ul class="list-inline">
	                                <li class="list-inline-item">
	                                    <a href="{{ route(ADMIN . '.users.edit', $item->id) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
	                                <li class="list-inline-item">
	                                    {!! Form::open([
	                                        'class'=>'delete',
	                                        'url'  => route(ADMIN . '.users.destroy', $item->id), 
	                                        'method' => 'DELETE',
	                                        ]) 
	                                    !!}
	
	                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
	                                        
	                                    {!! Form::close() !!}
	                                </li>
	                            </ul>
	                        </td>
	                    </tr>
                    @endif
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection