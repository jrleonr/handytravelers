@extends('handytravelers')
@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            @include('edit._menu')
            <div class="column is-three-quarters is-offset-1">
                @include('errors.list')
                @yield('forms')
            </div>
        </div>
    </div>
    </section>
    @stop
    @section('javascript')
    @include('edit._js')
    @stop
