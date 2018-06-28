@extends('handytravelers')

@section('content')
<section class="section">
    <div class="container">

        <div class="content has-text-centered">
            <h1 class="title is-3">{{ __('Please, provide your email address') }}</h1>
            <p class="subtitle is-5">{!! __('You’ll need to confirm your email address before you can travel or host people') !!}</p>
        </div>
        
        <div class="column is-half is-offset-3">
        <div class="box">
            <form role="form" method="POST" action="{{ route('user.email') }}">
                {{ csrf_field() }}
                
                <div class="control">
                    <label for="email" class=" label">{{__('common.email')}}</label>
                    <div class="">
                        <input type="email" class="input" name="email">
                    </div>
                </div>
               
            <input type="submit" value="{{ trans('common.continue') }}" class="button is-primary ">
        </div>
    </div>
</section>
@endsection
