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
            

            
        </div>
    </section>
    @stop
