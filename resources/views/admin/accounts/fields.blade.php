<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name of account', 'maxlength' => '200']) !!}
</div>

<!-- Privacy Policy Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('privacy_policy_url', 'Privacy Policy Url:') !!}
    {!! Form::text('privacy_policy_url', null, ['class' => 'form-control', 'placeholder' => 'URL of privacy policy']) !!}
</div>

<!-- Play Console Url Field -->
<div class="form-group col-sm-6">
    {!! Form::label('play_console_url', 'Play Console Url:') !!}
    {!! Form::text('play_console_url', null, ['class' => 'form-control', 'placeholder' => 'URL of play console']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-success rspSuccessBtns']) !!}
    <a href="{{ route('admin.accounts.index') }}" class="btn btn-default">Cancel</a>
</div>
@push('stackedScripts')
    @include('admin.layouts.scripts.regAnotherScript')
    @include('admin.layouts.scripts.swalAjax')
    <script>
        $('.submitsByAjax').submit(function (e) {
            e.preventDefault();
            let type = '{{ $type ?? '' }}'
            let dataToPass = new FormData($(this)[0]);
            ajaxCallFormSubmit($(this), false, 'Loading! Please wait...', dataToPass,
                type === 'create' ? postCreate : undefined);
        });

        function postCreate(){
            switch_between_register_to_registerAnother_btn($('.submitsByAjax'), false)
        }
    </script>
@endpush
