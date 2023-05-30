@extends('admin.layouts.master')

@section('title')
    Edit Music Band{{ $musicBand->name ? (': '.$musicBand->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicBands.index') }}">Music Bands</a></li>
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
                                    <h3>Edit Music Band {{ $musicBand->name ? (' - '.$musicBand->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.music_bands.datatables_actions', ['uuid' => $musicBand->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($musicBand, ['route' => ['admin.musicBands.update', $musicBand->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.music_bands.fields', ['type' => 'edit'])
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
    @include('admin.music_bands.createEditScripts')
@endpush
