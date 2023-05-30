@extends('admin.layouts.master')

@section('title')
    Create Music Album - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicAlbums.index') }}">Music Albums</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-success">
                            <h3>Create Music Album</h3>
                        </div>

                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::open(['route' => 'admin.musicAlbums.store',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.music_albums.fields', ['type' => 'create'])
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
    @include('admin.music_albums.createEditScripts')
@endpush
