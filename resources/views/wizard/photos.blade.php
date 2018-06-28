@extends('handytravelers')

@section('title')
    <h1>{{ trans('edit.uploadPhotosOfYou') }}</h1>
    <p>{{ trans('edit.uploadPhotosOfYouDescription') }}</p>
@endsection

@section('forms')
    <div class="box">
        <div id="home" class="col-sm-11 col-sm-push-1">
            @include('edit._photos_list', ['images' => $images])
        </div>
        <div class="clearfix"></div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/upload.js') }}"></script>
    @include('edit._photos_js')
@stop
