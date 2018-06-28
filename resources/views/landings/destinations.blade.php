@extends('handytravelers')

@section('robots')
    <meta name="robots" content="index,follow">
@endsection

@section('content')

<div class="container">

<div class="row">
    <div class="col-sm-12">
        <h1>{{ trans('common.places') }}</h1>
        <div class="row">
            @foreach($places AS $place)
                <div class="col-sm-3">
                    <p class="h4">
                        <a href="{{LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),$place->slug)}}">
                            {{$place->name}}
                        </a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>

</div>

@endsection
