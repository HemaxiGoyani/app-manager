@extends('admin.layouts.master')

@section('title')
    Edit Account{{ $account->name ? (': '.$account->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.accounts.index') }}">Accounts</a></li>
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
                                    <h3>Edit Account {{ $account->name ? (' - '.$account->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.accounts.datatables_actions', ['uuid' => $account->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($account, ['route' => ['admin.accounts.update', $account->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.accounts.fields', ['type' => 'edit'])
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
