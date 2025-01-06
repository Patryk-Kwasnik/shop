@extends('layouts.admin.admin')
@section('content')
    <div class="container-full">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('roles.roles') }} </h3>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary mx-4 my-2" href="{{ route('admin.roles.create') }}"> {{ __('system.create') }}</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>{{ __('system.nr') }}</th>
                                        <th>{{ __('system.name') }}</th>
                                        <th class="col-3">{{ __('system.options') }}</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($roles  as $key => $role)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td class="text-center">
                                                <a href ="{{ route('admin.roles.show',$role->id) }}" class="btn btn-info" title="{{ __('system.preview') }}"> <i class="fa fa-eye"></i></a>
                                                @can('role-edit')
                                                    <a href =" {{ route('admin.roles.edit',$role->id) }}" class="btn btn-warning" title="{{ __('system.edit') }}"><i class="fa fa-pencil"></i></a>
                                                @endcan
                                                @can('role-delete')
                                                    <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" style="display:inline" >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" title="{{ __('system.delete') }}"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.end col-12 -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
