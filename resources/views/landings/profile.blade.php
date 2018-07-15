@extends('handytravelers')
@section('css')
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop
@section('content')
<section class="section">
    <div id="show" class="container">
        <div class="columns">
            <div id="aside" class="column is-3">
                <div class="card">
                    <div class="card-image">
                        
                        <figure class="image is-square">
                            <img src="{{ $profile->getMainPhoto(300) }}" alt="Image">
                        </figure>
                        
                    </div>
                    <div class="card-content">
                        <div class="content">
                            
                            @if($profile->from)
                            <p><strong>{{ trans('common.from') }}</strong></p>
                            <p>{{$profile->from->getFullPlace() }}</p>
                            @endif
                            @if($profile->home->place)
                            <p><strong>{{ trans('common.lives') }}</strong></p>
                            <p>
                                {{ $profile->home->place->getFullPlace() }}
                            </p>
                            
                            @endif
                            @if($profile->date_of_birth)
                            <p><strong>{{ trans('common.age') }}</strong></p>
                            <p>{{$profile['date_of_birth']->age}}</p>
                            
                            @endif
                            @if(count($profile->languages) > 0)
                            <p><strong>{{ trans('common.languages') }}</strong></p>
                            <ul>
                                @foreach($profile->languages AS $key => $lang)
                                <li>{{$lang['title']}}</li>
                                @endforeach
                            </ul>
                            
                            @endif
                            
                        </div>
                    </div>
                </div>
                </div> <!-- aside -->
                <div id="main" class="column ">
                    <div class="columns">
                        <div class="column  ">
                    <a href="{{ route('request.form') }}/{{$profile->home->getUuid()}}" class="button is-primary is-medium ">Request to Stay with {{ $profile->first_name }}</a>
                </div>
                    </div>
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                {{ trans('common.aboutUser', ['name' => $profile->first_name]) }}
                            </p>
                            @if(Auth::id() == $profile->id)
                            <a href="{{ route('edit.profile') }}" class="card-header-icon">
                                <span class="icon">
                                    <i class="fa fa-pencil-square-o"></i>
                                </span>
                            </a>
                            @endif
                            
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <p>{!!nl2br(strip_tags($profile['about']))!!}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($profile->home->summary)
                    <hr>
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                {{ trans('common.aboutUserhome', ['name' => $profile->first_name]) }}
                            </p>
                            @if(Auth::id() == $profile->id)
                            <a href="{{ route('edit.home') }}" class="card-header-icon">
                                <span class="icon">
                                    <i class="fa fa-pencil-square-o"></i>
                                </span>
                            </a>
                            @endif
                            
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <p>{!!nl2br(strip_tags($profile->home->summary))!!}</p>
                                @if(!empty($profile->home->rules))
                                <h4>{{ trans('common.rules') }}</h4>
                                <p>{!!nl2br(strip_tags($profile->home->rules))!!}</p>
                                @endif
                                @if(!empty($profile->home->interaction))
                                <h4>{{ trans('common.interaction') }}</h4>
                                <p>{!!nl2br(strip_tags($profile->home->interaction))!!}</p>
                                @endif
                                @if(!empty($profile->home->accommodation))
                                <h4>{{ trans('common.accommodationDescription') }}</h4>
                                <p>{!!nl2br(strip_tags($profile->home->accommodation))!!}</p>
                                @endif
                                @if(!empty($profile->home->getting_around))
                                <h4>{{ trans('common.gettingAround') }}</h4>
                                <p>{!!nl2br(strip_tags($profile->home->getting_around))!!}</p>
                                @endif
                                @if(!empty($profile->home->other))
                                <h4>{{ trans('common.otherThingsToNote') }}</h4>
                                <p>{!!nl2br(strip_tags($profile->home->other))!!}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    </div> <!-- row -->
</div>
</section>
@stop
@section('javascript')
@if(count($images) > 1)
<script src="{{ asset('js/jcarousel.js') }}"></script>
@endif
@stop
