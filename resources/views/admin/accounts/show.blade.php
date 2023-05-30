@extends('admin.layouts.master')

@section('title')
    View Account{{ $account->name ? (': '.$account->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">Accounts</a></li>
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
                                    <h3>View Account{{ $account->name ? (' - '.$account->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.accounts.datatables_actions', ['uuid' => $account->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="showaccount">
                                {!! Form::model($account, ['route' => ['admin.accounts.update', $account->id], 'method' => 'patch',  'files' => true]) !!}
                                <div class="row">
                                    @include('admin.accounts.fields')
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
    disableInputsForView($('#showaccount'));
</script>
@endpush
