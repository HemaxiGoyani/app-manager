@extends('admin.layouts.master')

@section('title')
    Edit App Additional Specific Value{{ $appAdditionalSpecificValue->name ? (': '.$appAdditionalSpecificValue->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.appAdditionalSpecificValues.index') }}">App Additional Specific Values</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-secondary">
                            <div class="row card-head-row">
                                <div class="col-md-11">
                                    <h3>Edit App Additional Specific Value {{ $appAdditionalSpecificValue->name ? (' - '.$appAdditionalSpecificValue->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.app_additional_specific_values.datatables_actions', ['uuid' => $appAdditionalSpecificValue->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($appAdditionalSpecificValue, ['route' => ['admin.appAdditionalSpecificValues.update', $appAdditionalSpecificValue->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.app_additional_specific_values.fields', ['type' => 'edit'])
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
