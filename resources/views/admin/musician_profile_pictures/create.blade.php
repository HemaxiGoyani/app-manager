@extends('admin.layouts.master')

@section('title')
    Create Musician Profile Picture - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicianProfilePictures.index') }}">Musician Profile Pictures</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-success">
                            <h3>Create Musician Profile Picture</h3>
                        </div>

                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::open(['route' => 'admin.musicianProfilePictures.store',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.musician_profile_pictures.fields', ['type' => 'create'])
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
    @include('admin.musician_profile_pictures.createEditScripts')
@endpush
