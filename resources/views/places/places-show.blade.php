@extends('handytravelers')
@section('meta-title', "Blabla")
@section('meta-description', "Blabla ")
@section('content')
<div class="section">
    <div class="container">

        <nav class="breadcrumb" aria-label="breadcrumbs">
          <ul>
            <li><a href="{{ route('places.list') }}">Places</a></li>
            <li @empty($city) class="is-active" @endempty ><a href="{{ route('places.country', [$country]) }}">{{ $country }}</a></li>
            @isset($city) <li class="is-active"><a href="{{ route('places.city', [$country, $city]) }}" aria-current="page">{{ $city }}</a></li> @endisset 
          </ul>
        </nav>

        <h1 class="title is-2">Stay with Locals in @isset($city) {{ $city }} @endisset @isset($country) {{ $country }} @endisset </h1>
            <h2 class="title is-4">Surf for locals and stay in a couch in  @isset($city) {{ $city }} @endisset @isset($country) {{ $country }} @endisset</h2>
        <div class="columns">
            
            <div class="primary column is-12">
                <ul >
                    <div class=" columns is-multiline is-mobile">
                        @foreach($homes AS $home)
                        <li class="user-list-item column is-3 ">
                            <div class="user-list-details card">
                                <div class="card-image">
                                    <figure class="image ">
                                        <a class="title is-4"  href="{{route('profile' ,$home['users'][0]['username']) }}" >
                                            <img src="{{ $home['users'][0]['image'] }}">
                                        </a>
                                        
                                    </figure>
                                </div>
                                <div class="card-content">
                                    <div class="media">
                                        
                                        <div class="media-content">
                                            <a class="title is-4" href="{{route('profile' ,$home['users'][0]['username']) }}">{{ $home['users'][0]['first_name'] }}</a>
                                        </div>
                                        
                                    </div>
                                    <div class="content">
                                        <div class="tags">
                                            <span class="tag is-primary">{{  $home['type'] }}</span>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </li>
                        @endforeach
                    </div>
                </ul>
            </div>
        </div>

        @isset($descendants)
        <h2 class="title is-4">Find local hosts in {{ $country }} in these cities and regions</h2>
            <div class="columns is-multiline">
            @foreach($descendants AS $place)
            <div class=" column is-3 ">
                <a href="{{ route('places.city', [$country,$place['slug']]) }}">
                    Stay, work and live with locals in {{ $place['name'] }}
                </a>
            </div>
            @endforeach
        @endisset



    </div>
</div>
@endsection
