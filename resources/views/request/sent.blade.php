@extends('handytravelers')

@section('pixel')
<script>fbq('track', 'AddPaymentInfo');</script>
@endsection

@section('content')


<section class="section">
    <div class="container has-text-centered">

        <div class="content ">
            <h1 class="title is-3">{{ __('Your Request is on its way') }}</h1>
            <p class="subtitle is-5">{!! __('Request Sent') !!}</p>
        </div>

        <a href="{{ route('dashboard') }}" class="button">Dashboard</a>
        <a href="{{ route('request.form') }}" class="button is-primary">Send a Request</a>
    </div>
</section>

@stop
