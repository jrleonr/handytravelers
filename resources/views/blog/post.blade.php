@extends('handytravelers')

@section('title', $post->title->rendered )
@section('description', strip_tags($post->excerpt->rendered))

@section('content')
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-8 content is-offset-2 is-large">
                <h1 class="title is-3">
                {!! $post->title->rendered !!}
                </h1>
                <p class="subtitle is-5">
                    Escrito por <a href="{{route('profile',[$profile->username])}}">{{ $profile->first_name }}</a>
                </p>

                {!! $post->content->rendered !!}
                
            </div>
        </div>
        <div class="columns">
            <div class="column is-8 content is-offset-2">
                
                <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-150x150">
                                <a href="{{route('profile', [$profile->username])}}">
                                    <img src="{{ $profile->getMainPhoto() }}" class="image is-circle">
                                </a>
                            </figure>
                            
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p class="title is-4">
                                    Autor:
                                    <strong>{{ $profile->first_name }} {{ $profile->last_name }}</strong>
                                </p>
                                <p>{!!nl2br(strip_tags($profile->about))!!}</p>
                            </div>
                            
                        </div>
                    </article>
                </div>
                
            </div>
        </div>
    </div>
</div>
@stop
