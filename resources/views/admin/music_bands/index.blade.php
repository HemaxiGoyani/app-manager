@extends('admin.layouts.master')

@section('title')
    Music Bands - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Music Bands</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="float-left mt-1">Music Bands</h3>
                            <h3 class="float-sm-right">
                                <a class="btn btn-primary btn-sm mb-1" href="{{ route('admin.musicBands.create') }}">Add New</a>
                            </h3>
                        </div>

                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.music_bands.table')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

