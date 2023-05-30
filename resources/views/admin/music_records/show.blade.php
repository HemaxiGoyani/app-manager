@extends('admin.layouts.master')

@section('title')
    View Music Record{{ $musicRecord->name ? (': '.$musicRecord->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicRecords.index') }}">Music Records</a></li>
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
                                    <h3>View Music Record{{ $musicRecord->name ? (' - '.$musicRecord->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.music_records.datatables_actions', ['uuid' => $musicRecord->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="showmusicRecord">
                                {!! Form::model($musicRecord, ['route' => ['admin.musicRecords.update', $musicRecord->id], 'method' => 'patch',  'files' => true]) !!}
                                <div class="row">
                                    @include('admin.music_records.fields')
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
    @include('admin.music_records.createEditScripts')
<script>
    disableInputsForView($('#showmusicRecord'));
</script>
@endpush
