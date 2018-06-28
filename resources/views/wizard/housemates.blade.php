@extends('handytravelers')

@section('content')
<section class="section">
    <div class="container">

        <div class="content has-text-centered">
            <h1 class="title is-3">{{ trans('edit.withWhomDoYouLive') }}</h1>
            <p class="subtitle is-5">{{ __('edit.housematesDescription') }}</p>
        </div>

        <div class="column is-half is-offset-3">
                
        <div class="box">
            @include('edit.forms._housemates')

            

        </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
    @include('edit.js.housemates')
@stop
