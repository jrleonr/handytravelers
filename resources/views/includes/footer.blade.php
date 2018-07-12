<footer class="footer">
    <div class="container">
        <div class="columns">
            <div class="column">
                <h5>{{trans('common.company')}}</h5>
                <ul>
                    <li><a href="{{route('about')}}">{{ trans('common.about') }}</a></li>
                    <li><a href="{{route('how-it-works')}}">{{ trans('common.how-it-works') }}</a></li>
                    <li><a href="{{route('places.list')}}">{{ trans('common.places') }}</a></li>
                </ul>
            </div>
            <div class="column">
                <h5>{{ trans('common.contact') }}</h5>
                <ul>
                    <li><a href="//www.facebook.com/handytravelers"> Facebook </a></li>
                    <li><a href="//twitter.com/handytravelers"> Twitter </a></li>
                </ul>
            </div>
            <div class="column">
                <h5>{{ trans('common.legal') }}</h5>
                <ul>
                    <li><a href="{{route('privacyTerms')}}">{{ trans('common.termsPrivacy') }}</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="content copyright has-text-centered">
            <p>
                © Handytravelers
            </p>
        </div>
    </div>
</footer>
