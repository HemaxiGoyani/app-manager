@extends('admin.layouts.master')

@section('title')
    Edit Wallpaper Tag{{ $wallpaperTag->name ? (': '.$wallpaperTag->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.wallpaperTags.index') }}">Wallpaper Tags</a></li>
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
                                    <h3>Edit Wallpaper Tag {{ $wallpaperTag->name ? (' - '.$wallpaperTag->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.wallpaper_tags.datatables_actions', ['uuid' => $wallpaperTag->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('adminlte-templates::common.errors')
                            {!! Form::model($wallpaperTag, ['route' => ['admin.wallpaperTags.update', $wallpaperTag->uuid], 'method' => 'patch',  'files' => true, 'class' => 'submitsByAjax']) !!}
                            <div class="row">
                                @include('admin.wallpaper_tags.fields', ['type' => 'edit'])
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
