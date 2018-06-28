@extends('handytravelers')
@section('content')
<div class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-8 content is-offset-2 is-large">
                {!! $page->content->rendered !!}
            </div>
        </div>
    </div>
</div>
@stop
