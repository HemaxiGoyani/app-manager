@extends('admin.layouts.master')

@section('title')
    Create App Additional Specific Value - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.appAdditionalSpecificValues.index') }}">App Additional Specific Values</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-success">
                            <h3>Create App Additional Specific Value</h3>
                        </div>

                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::open(['route' => 'admin.appAdditionalSpecificValues.store',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.app_additional_specific_values.fields', ['type' => 'create'])
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('stackedScripts')
    @include('admin.app_additional_specific_values.createEditScripts')
@endpush
