@extends('admin.layouts.master')

@section('title')
    View Wallpaper{{ $wallpaper->name ? (': '.$wallpaper->name) : '' }} - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.wallpapers.index') }}">Wallpapers</a></li>
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
                                    <h3>View Wallpaper{{ $wallpaper->name ? (' - '.$wallpaper->name) : '' }}</h3>
                                </div>
                                <div class="col-md-1 float-right action_button">
                                    @include('admin.wallpapers.datatables_actions', ['uuid' => $wallpaper->uuid])
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="showwallpaper">
                                {!! Form::model($wallpaper, ['route' => ['admin.wallpapers.update', $wallpaper->id], 'method' => 'patch',  'files' => true]) !!}
                                <div class="row">
                                    @include('admin.wallpapers.fields')
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
    @include('admin.wallpapers.createEditScripts')
<script>
    disableInputsForView($('#showwallpaper'));
</script>
@endpush
