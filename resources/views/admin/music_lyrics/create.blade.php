@extends('admin.layouts.master')

@section('title')
    Create Music Lyric - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicLyrics.index') }}">Music Lyrics</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-success">
                            <h3>Create Music Lyric</h3>
                        </div>

                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::open(['route' => 'admin.musicLyrics.store',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.music_lyrics.fields', ['type' => 'create'])
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
