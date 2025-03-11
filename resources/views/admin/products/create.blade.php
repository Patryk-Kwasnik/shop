@extends('layouts.admin.admin')
@section('content')
    <div class="box-content p-4">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>{{ __('products.create') }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('admin.products.index') }}"> {{ __('system.back') }}</a>
                </div>
            </div>
        </div>
        <x-alert-error :errors="$errors" />
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>{{ __('products.name') }}:</strong>
                        <input type="text" name="name" placeholder="{{ __('products.name') }}" class="form-control" value="{{ old('name') }}">
                        <x-input-error field="name" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>{{ __('products.slug') }}:</strong>
                        <input type="text" name="slug" placeholder="{{ __('products.slug') }}" class="form-control" value="{{ old('slug') }}">
                        <x-input-error field="slug" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>{{ __('products.sku') }}:</strong>
                        <input type="text" name="sku" placeholder="{{ __('products.sku') }}" class="form-control" value="{{ old('sku') }}">
                        <x-input-error field="sku" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>{{ __('products.ean') }}:</strong>
                        <input type="text" name="ean" placeholder="{{ __('products.ean') }}" class="form-control" value="{{ old('ean') }}">
                        <x-input-error field="ean" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>{{ __('products.category') }}:</strong>
                        <select name="category_id" class="form-control">
                            <option value="">{{ __('system.select') }}</option>
                            @foreach ($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        <x-input-error field="category_id" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-5">
                    <div class="form-group">
                        <strong>{{ __('products.status') }}:</strong>
                        <select name="status" class="form-control">
                            @foreach (\App\Enums\ActiveStatusEnum::getList() as $value => $label)
                                <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error field="status" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>{{ __('products.description') }}:</strong>
                        <textarea name="description" class="form-control" placeholder="{{ __('products.description') }}">{{ old('description') }}</textarea>
                        <x-input-error field="description" />
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 pull-left">
                    <button type="submit" class="btn btn-primary">{{ __('system.save') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection