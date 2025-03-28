@extends('layouts.admin.admin')
@section('content')
    <div class="box-content p-4">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> {{ __('system.preview') }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admin.roles.index') }}"> {{ __('system.back') }}</a>
                </div>
            </div>
        </div>
        <div class="box p-4">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ __('system.name') }}:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ __('roles.permission') }}:</strong>
                        @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                                <label class="label label-success">{{ $v->name }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
