@extends('handytravelers')
@section('css')
<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop
@section('content')
@include('errors.list')
<section class="section">
    <div class="container">
        <div class="content has-text-centered">
            <p class="title is-4">{{ __("Share your Travel Plans with hundreds of Hosts") }}</p>
        </div>
        <div class="columns">
            <div class="column is-4 content">
                {!! __('common.requestDescription', ['this' => "<a href=".route('how-it-works').">". trans('common.how-it-works')."</a>"]) !!}
            </div>
            <div class="column ">
                <div class="card">
                    <div class="card-content">
                        <form action="{{route('request.form')}}" method="post">
                            <input type="hidden"  name="_token" value="{{ csrf_token() }}">
                            <p class="control">
                                <label for="place" class=" label ">{{__('common.whereLookingLocalHome')}}</label>
                                <input value="{{ old('place') }}" name="place" id="from" class="input">
                            </p>
                            
                            <div class="columns">
                                <div class="column ">
                                    <div class="control">
                                        <label for="check_in" class=" label ">{{__('common.from')}}</label>
                                        <input value="{{ old('check_in') }}" name="check_in" id="check_in" placeholder='yyyy/mm/dd' autocomplete="off" class="input">
                                    </div>
                                </div>
                                <div class="column is-one-is-third">
                                    <div class="control">
                                        <label for="check_out" class=" label ">{{__('common.to')}}</label>
                                        <input value="{{ old('check_out') }}"  name="check_out" id="check_out" placeholder='yyyy/mm/dd' autocomplete='off' class="input">
                                    </div>
                                </div>
                                <div class="column is-one-is-third">
                                    <div class="control">
                                        <label for="place" class=" label ">{{__('common.people')}}</label>
                                        <span class="select">
                                            <select name="people">
                                                @for($i=1;$i<=5;$i++)
                                                <option value="{{$i}}" {{ (old("people") == $i) ? "selected" : "" }} >{{$i}}</option>
                                                @endfor
                                            </select>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <p class="control help">{!! __("You can only send a Request for the next 15 days.") !!}</p>
                            
                            <div class="control">
                                <label for="body" class=" label ">{{__('common.describeYourTrip')}}</label>
                                <textarea name="body" class="textarea" rows="5" placeholder={{trans('common.writeHereYourMessage')}}>{{ old('body') }}</textarea>
                            </div>
                            
                            <div class="control is-grouped">
                                <p class="control">
                                    <button @click="formSent = true" :class="{ 'is-loading': formSent }" type="submit" class="button is-primary ">
                                    {{ trans('common.sendMessage') }}
                                    </button>
                                    
                                </p>
                                <span class=" help" >
                                        {{ __("After you send it, you won't be able to edit or delete it. Think of this as when you send an email.") }}
                                    </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('javascript')
@include('edit._js')
<script src="{{ asset('js/datepicker.js') }}"></script>
@stop