@extends('admin.layouts.master')

@section('title')
    View Musician{{ $musician->name ? (': '.$musician->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.musicians.index') }}">Musicians</a></li>
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
                                    <h3>View Musician{{ $musician->name ? (' - '.$musician->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.musicians.datatables_actions', ['uuid' => $musician->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="showmusician">
                                {!! Form::model($musician, ['route' => ['admin.musicians.update', $musician->id], 'method' => 'patch',  'files' => true]) !!}
                                <div class="row">
                                    @include('admin.musicians.fields')
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
<script>
    disableInputsForView($('#showmusician'));
</script>
@endpush
