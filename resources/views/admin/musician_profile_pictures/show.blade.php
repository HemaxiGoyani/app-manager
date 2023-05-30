@extends('admin.layouts.master')

@section('title')
    View Musician Profile Picture{{ $musicianProfilePicture->name ? (': '.$musicianProfilePicture->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicianProfilePictures.index') }}">Musician Profile Pictures</a></li>
    <li class="breadcrumb-item active">View</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header bg-info">
                            <div class="row card-head-row">
                                <div class="col-md-11">
                                    <h3>View Musician Profile Picture{{ $musicianProfilePicture->name ? (' - '.$musicianProfilePicture->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.musician_profile_pictures.datatables_actions', ['uuid' => $musicianProfilePicture->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="showmusicianProfilePicture">
                                {!! Form::model($musicianProfilePicture, ['route' => ['admin.musicianProfilePictures.update', $musicianProfilePicture->id], 'method' => 'patch',  'files' => true]) !!}
                                <div class="row">
                                    @include('admin.musician_profile_pictures.fields')
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('stackedScripts')
    @include('admin.musician_profile_pictures.createEditScripts')
<script>
    disableInputsForView($('#showmusicianProfilePicture'));
</script>
@endpush
