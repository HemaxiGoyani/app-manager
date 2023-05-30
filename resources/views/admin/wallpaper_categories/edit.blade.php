@extends('admin.layouts.master')

@section('title')
    Edit Wallpaper Category{{ $wallpaperCategory->name ? (': '.$wallpaperCategory->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.wallpaperCategories.index') }}">Wallpaper Categories</a></li>
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
                                    <h3>Edit Wallpaper Category {{ $wallpaperCategory->name ? (' - '.$wallpaperCategory->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.wallpaper_categories.datatables_actions', ['uuid' => $wallpaperCategory->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($wallpaperCategory, ['route' => ['admin.wallpaperCategories.update', $wallpaperCategory->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.wallpaper_categories.fields', ['type' => 'edit'])
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
    @include('admin.wallpaper_categories.createEditScripts')
@endpush
