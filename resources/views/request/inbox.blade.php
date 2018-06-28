@extends('handytravelers')
@section('content')
<section class="section">
    <div class="container">
        @if(!$requests->isEmpty())
        <p class="title is-3">{{ __('Invitations for your requests') }}</p>
        
        @foreach($requests as $request)
        
        For your request in {{ $request->place->name }} from
        {{ $request->check_in->toFormattedDateString() }} -
        {{ $request->check_out->toFormattedDateString() }} ·
        {{ $request->people }} {{ trans('common.guest') }}
        <table class="table">
            <tbody>
                
                @foreach($request->invitations as $invitation)
                
                @include('request._invitation')
                @endforeach
                
            </tbody>
        </table>
        @endforeach
        @endif
        @if(!$invitations->isEmpty())
        <p class="title is-3">{{ __('Invitations sent') }}</p>
        <table class="table">
            <tbody>
                @foreach($invitations as $invitation)
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
