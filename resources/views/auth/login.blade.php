@extends('handytravelers')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<a class="button button is-large is-facebook" href="{{ route('login.facebook') }}">
                <span class="icon is-medium"> <i class="fab fa-facebook"></i></span>
                <span>{{ trans('common.continueWithFacebook') }}</span>
                <a class="help" href="{{route('privacyTerms')}}">{{ trans('common.bySigningIAgree') }}   {{ trans('common.termsAndPrivacy') }}</a>
            </a>


            </div>
        </div>
    </div>
</div>
@endsection
