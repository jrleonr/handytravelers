@extends('edit.layout')

@section('forms')

<div class="box">
    <h3>{{ trans('edit.housemates') }}</h3>

    <div class="col-sm-12">
        <h4>{{ trans('edit.withWhomDoYouLive') }}</h4>
    </div>
    @include('edit.forms._housemates')

    <div class="clearfix"></div>

</div>


@endsection


@section('javascript')
    @include('edit.js.housemates')
@stop
