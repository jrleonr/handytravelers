@extends('handytravelers')
@section('content')
<section class="hero is-success is-large" style="   -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;    text-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
 background: no-repeat center center;
  background-size: cover; background-image:url('{{asset('img/homepage.jpg')}}');">
    <div class="hero-body">
        <div class="container has-text-centered">
            <h1 class="title is-1">{{trans('common.titleHome')}}</h1>
            <h2 class="subtitle is-3">{{trans('common.subTitleHome')}}</h2>
            <a class="button button is-large is-facebook" href="{{ route('login.facebook') }}">
                <span class="icon is-medium"> <i class="fab fa-facebook"></i></span>
                <span>{{ trans('common.continueWithFacebook') }}</span>
                <a class="help" href="{{route('privacyTerms')}}">{{ trans('common.bySigningIAgree') }}   {{ trans('common.termsAndPrivacy') }}</a>
            </a>
        </div>
    </div>
    <div class="hero-footer">
        <div class="container">
            
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column">
                <h3 class="title is-4">{{trans('common.stayWithLocals')}}</h3>
                <p class="subtitle is-6">{{trans('common.travelAnywhere')}}</p>
            </div>
            <div class="column">
                <h3 class="title is-4">{{trans('common.discover')}}</h3>
                <p class="subtitle is-6">{{trans('common.getInvolved')}}</p>
            </div>
            <div class="column">
                <h3 class="title is-4">{{trans('common.meetTravelers')}}</h3>
                <p class="subtitle is-6">{{trans('common.showTravelersHow')}}</p>
            </div>
        </div>
    </div>
</section>
@stop
