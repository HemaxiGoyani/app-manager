@extends('admin.layouts.master')

@section('title')
    App Additional Specific Values - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">App Additional Specific Values</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="float-left mt-1">App Additional Specific Values</h3>
                            <h3 class="float-sm-right">
                                @include('admin.layouts.templates.filter_btn_group')
                                <a class="btn btn-primary btn-sm mb-1" href="{{ route('admin.appAdditionalSpecificValues.create') }}">Add New</a>
                            </h3>
                        </div>

                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.app_additional_specific_values.filter')
                            @include('admin.app_additional_specific_values.table')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

