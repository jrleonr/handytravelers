@extends('handytravelers')
@section('content')
<div class="section">
    <div class="container">
                <h1 class="title is-3">{{ __('Blog Posts') }}</h1>
    
        <div class="columns">
            @foreach($posts AS $post)
            <div class="column is-8 content is-offset-2 is-large">
                <a href="{{ route('blog.post', [$post->slug]) }}">
                    {!! $post->title->rendered  !!}
                </a>
                {!! $post->excerpt->rendered  !!}
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop
