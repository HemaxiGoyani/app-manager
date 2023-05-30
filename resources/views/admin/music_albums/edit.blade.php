@extends('admin.layouts.master')

@section('title')
    Edit Music Album{{ $musicAlbum->name ? (': '.$musicAlbum->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicAlbums.index') }}">Music Albums</a></li>
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
                                    <h3>Edit Music Album {{ $musicAlbum->name ? (' - '.$musicAlbum->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.music_albums.datatables_actions', ['uuid' => $musicAlbum->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($musicAlbum, ['route' => ['admin.musicAlbums.update', $musicAlbum->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.music_albums.fields', ['type' => 'edit'])
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
