@extends('layouts.admin.admin')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('users.all_users') }} </h3>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary mx-4 my-2" href="{{ route('admin.users.create') }}"> {{ __('users.create') }}</a>
                        </div>
                        <div class="box-body">
                            @session('success')
                                <div class="alert alert-success" role="alert"> 
                                    {{ $value }}
                                </div>
                            @endsession
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th>{{ __('users.user') }}</th>
                                        <th>{{ __('users.email') }}</th>
                                        <th>{{ __('users.phone') }}</th>
                                        <th>{{ __('users.roles') }}</th>
                                        <th class="col-3">{{ __('system.options') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $v)
                                                        <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href =" {{ route('admin.users.show',$user->id) }}" class= " btn btn-info"> <i class="fa fa-eye"></i> {{ __('system.preview') }} </a>
                                                <a href =" {{ route('admin.users.edit',$user->id) }}" class= " btn btn-dark" ><i class="fa fa-pencil"></i> {{ __('system.edit') }} </a>
                                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')                         
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>  {{ __('system.delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {!! $data->render() !!}
@endsection
