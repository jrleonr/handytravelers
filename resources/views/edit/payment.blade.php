@extends('handytravelers')
@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            @include('edit._menu')
            <div class="column">
                <create-customer request-id="" route="{{route('edit.payment')}}"></create-customer>
            </div>
        </div>
    </div>
</section>
@stop
