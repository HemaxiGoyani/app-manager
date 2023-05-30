@extends('admin.layouts.master')

@section('title')
    Edit Musician Video{{ $musicianVideo->name ? (': '.$musicianVideo->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicianVideos.index') }}">Musician Videos</a></li>
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
                                    <h3>Edit Musician Video {{ $musicianVideo->name ? (' - '.$musicianVideo->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.musician_videos.datatables_actions', ['uuid' => $musicianVideo->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($musicianVideo, ['route' => ['admin.musicianVideos.update', $musicianVideo->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.musician_videos.fields', ['type' => 'edit'])
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
    @include('admin.musician_videos.createEditScripts')
@endpush
