@extends('handytravelers')

@section('content')

<section class="section">
    <div class="container has-text-centered">

        <div class="content ">
            <h1 class="title is-3">{{ __('edit.youHaveCompleteProfile') }}</h1>
            <p class="subtitle is-5">{{ __('edit.youHaveCompleteProfileDes') }}</p>
        </div>

        <a href="{{ route('edit.housemates') }}" class="button">{{ __('edit.completeYourhomeInfo') }}</a>
        <a href="{{ route('request.form') }}" class="button is-primary">{{ __('edit.sendFirstRequest') }}</a>
    </div>
</section>

@stop
