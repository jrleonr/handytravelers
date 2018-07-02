@extends('handytravelers')
@section('content')
<section class="section">
    <div id="dashboard" class="container">
        <div class="columns">
            <div class="column is-3">
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </p>
                        
                    </header>
                    <div class="card-content">
                        <div class="content">
                            {{ __("This is your dashboard") }}
                        </div>
                    </div>
                    <footer class="card-footer">
                        <a class="card-footer-item" href="{{ route('profile',[$user->username]) }}">{{ trans('common.viewProfile') }}</a>
                        <a class="card-footer-item" href="{{ route('edit.profile') }}">{{ trans('common.editProfile') }}</a>
                    </footer>
                </div>
                <hr>



                <a class="button is-medium "
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ trans('common.logout') }}
        </a>
                       
            </div>
            

            <div class="column">

                {{-- @if(count($requests) > 0)
                <p class="title is-3">{{ __('Travelers looking for a Host in your City') }}</p>
                <div class="columns  is-multiline is-mobile">
                    @foreach($requests AS $request)
                    @include('request.card', ['request' => $request])
                    @endforeach
                </div>
                @endif --}}
                
                @if(count($myRequests) > 0)
                <p class="title is-3">{{ __('Your requests') }}</p>
                <p class="subtitle is-6">{{ __('These are the request you have sent') }}</p>
                <div class="columns  is-multiline is-mobile">
                    
                    @foreach($myRequests AS $request)
                    @include('request.card', ['request' => $request, 'hideImages' => true])
                    @endforeach
                    
                </div>
                @endif

            </div>
            
        </div>
    </section>
    @stop
