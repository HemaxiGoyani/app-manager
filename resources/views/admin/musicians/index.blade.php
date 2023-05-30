@extends('admin.layouts.master')

@section('title')
    Musicians - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Musicians</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="float-left mt-1">Musicians</h3>
                            <h3 class="float-sm-right">
                                <a class="btn btn-primary btn-sm mb-1" href="{{ route('admin.musicians.create') }}">Add New</a>
                            </h3>
                        </div>

                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.musicians.table')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

