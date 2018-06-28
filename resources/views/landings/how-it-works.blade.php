@extends('handytravelers')
@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.8&appId=1425499691081527";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
