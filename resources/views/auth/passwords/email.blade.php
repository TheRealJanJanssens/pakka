@extends('layouts.app')

@section('content')

    <h4 class="fw-300 c-grey-900 mB-40">{{ trans('pakka::auth.reset_password') }}</h4>
               
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="text-normal text-dark">{{ trans('pakka::auth.email') }}</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                {{ trans('pakka::auth.send_reset_password') }}
            </button>
        </div>
    </form>
    
@endsection
