@extends('handytravelers')
@section('content')
<section class="section">
    <div class="container">
        @if(!$requests->isEmpty())
        <p class="title is-3">{{ __('Invitations sent') }}</p>
        <table class="table">
            <tbody>
                @foreach($requests as $invitation)
                @include('request._invitation')
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
</div>
</div>
</section>
@stop
