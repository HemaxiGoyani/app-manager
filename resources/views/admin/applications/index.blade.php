@extends('admin.layouts.master')

@section('title')
    Applications - {{ config('app.name') }}
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active">Applications</li>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h3 class="float-left mt-1">Applications</h3>
                            <h3 class="float-sm-right">
                                <a class="btn btn-primary btn-sm mb-1" href="{{ route('admin.applications.create') }}">Add New</a>
                            </h3>
                        </div>

                        <div class="card-body">
                            @include('flash::message')
                            @include('admin.applications.table')
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stackedScripts')
    <script>
        function toggleVisibility(uuid, togglerRef, type){
            let url = '{{ route('admin.applications.visibilityToggler', '##uuid##') }}'

            $.ajax({
                type: 'POST',
                url: url.replace('##uuid##', uuid),
                data: {uuid: uuid},
                success: function (response) {
                    if (response['success']) {
                        $(togglerRef).removeAttr('class').addClass(response['class']).html(response['html']);
                        ajax_loadToastMsg({status: 200, message: response.msg});
                    }
                },
                error: function (error) {
                    var response = $.parseJSON(error.responseText);
                    toastr["error"](response['responseMsg']);
                    // printResponseMsg($("#categories_responseMsges"), response['responseMsg']);
                }
            });
        }
    </script>
@endpush

