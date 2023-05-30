@extends('admin.layouts.master')

@section('title')
    View Application{{ $application->name ? (': '.$application->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.applications.index') }}">Applications</a></li>
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
                                    <h3>View Application{{ $application->name ? (' - '.$application->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.applications.datatables_actions', ['uuid' => $application->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="showapplication">
                                {!! Form::model($application, ['route' => ['admin.applications.update', $application->id], 'method' => 'patch',  'files' => true]) !!}
                                <div class="row">
                                    @include('admin.applications.fields')
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
    @include('admin.applications.createEditScripts')
<script>
    disableInputsForView($('#showapplication'));
</script>
@endpush
