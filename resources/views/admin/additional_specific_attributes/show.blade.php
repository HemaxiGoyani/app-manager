@extends('admin.layouts.master')

@section('title')
    View Additional Specific Attribute{{ $additionalSpecificAttribute->name ? (': '.$additionalSpecificAttribute->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.additionalSpecificAttributes.index') }}">Additional Specific Attributes</a></li>
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
                                    <h3>View Additional Specific Attribute{{ $additionalSpecificAttribute->name ? (' - '.$additionalSpecificAttribute->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.additional_specific_attributes.datatables_actions', ['uuid' => $additionalSpecificAttribute->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="showadditionalSpecificAttribute">
                                {!! Form::model($additionalSpecificAttribute, ['route' => ['admin.additionalSpecificAttributes.update', $additionalSpecificAttribute->id], 'method' => 'patch',  'files' => true]) !!}
                                <div class="row">
                                    @include('admin.additional_specific_attributes.fields')
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
    disableInputsForView($('#showadditionalSpecificAttribute'));
</script>
@endpush
