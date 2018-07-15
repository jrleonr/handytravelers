@extends('handytravelers')
@section('title', "Stay, work and live with Locals around the world")
@section('description', "Surf for locals and stay in a couch in all these places ")
@section('content')
<div class="section">
    <div class="container">
        <h1 class="title is-2">Stay, work and live with Locals around the world </h1>
            <h2 class="title is-4">Surf for locals and stay in a couch in all these places</h2>
        <div class="columns">
            
            <div class="primary column is-12">
                <ul >
                    <div class=" columns is-multiline is-mobile">
                        @foreach($places AS $place)
                        <li class="user-list-item column is-3 ">
                            <a href="{{ route('places.country', [$place['slug']]) }}">
                                {{ $place['name'] }}
                            </a>
                        </li>
                        @endforeach
                    </div>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
