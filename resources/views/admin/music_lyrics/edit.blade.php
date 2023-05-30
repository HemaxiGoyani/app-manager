@extends('admin.layouts.master')

@section('title')
    Edit Music Lyric{{ $musicLyric->name ? (': '.$musicLyric->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicLyrics.index') }}">Music Lyrics</a></li>
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
                                    <h3>Edit Music Lyric {{ $musicLyric->name ? (' - '.$musicLyric->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.music_lyrics.datatables_actions', ['uuid' => $musicLyric->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($musicLyric, ['route' => ['admin.musicLyrics.update', $musicLyric->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.music_lyrics.fields', ['type' => 'edit'])
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
    @include('admin.music_lyrics.createEditScripts')
@endpush
