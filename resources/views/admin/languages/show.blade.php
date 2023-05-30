@extends('admin.layouts.master')

@section('title')
    View Language{{ $language->name ? (': '.$language->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.languages.index') }}">Languages</a></li>
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
                                    <h3>View Language{{ $language->name ? (' - '.$language->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.languages.datatables_actions', ['uuid' => $language->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="showlanguage">
                                {!! Form::model($language, ['route' => ['admin.languages.update', $language->id], 'method' => 'patch',  'files' => true]) !!}
                                <div class="row">
                                    @include('admin.languages.fields')
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
    disableInputsForView($('#showlanguage'));
</script>
@endpush
