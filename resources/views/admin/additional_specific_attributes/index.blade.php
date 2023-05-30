@extends('admin.layouts.master')

@section('title')
    Additional Specific Attributes - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Additional Specific Attributes</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="float-left mt-1">Additional Specific Attributes</h3>
                            <h3 class="float-sm-right">
                                <a class="btn btn-primary btn-sm mb-1" href="{{ route('admin.additionalSpecificAttributes.create') }}">Add New</a>
                            </h3>
                        </div>

                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.additional_specific_attributes.table')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

