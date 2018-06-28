@extends('handytravelers')
@section('css')
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop
@section('pixel')
<script>fbq('track', 'CompleteRegistration');</script>
@endsection
@section('content')
<section class="section">
    <div class="container">

        <div class="content has-text-centered">
            <h1 class="title is-3">{{ trans('edit.welcomeToHandytravelers') }} , {{$user->first_name}}!</h1>
            <p class="subtitle is-5">{{ trans('edit.beforeFirstExperienceComplete') }} <br> {{ trans('edit.writeAboutYouHelpHost') }}</p>
        </div>
        
        <div class="column is-half is-offset-3">
        <div class="box">
            <form role="form" method="POST" action="{{ route('edit.profile') }}">
                {{ csrf_field() }}
                <input type="hidden" name="wizard" value="1" >
                
                @if(!$user->last_name)
                <div class="control">
                    <label for="last_name" class=" label">{{__('edit.lastName')}}</label>
                    <div class="">
                        <input type="text" class="input" name="last_name" value="{{$user->last_name}}">
                    </div>
                </div>
                @endif
                @if(!$user->date_of_birth)
                <div class="control">
                    <div class="">
                        <label for="from" class=" label">{{__('edit.dateOfBirth')}}</label>
                        <input type="text" class="input" name="date_of_birth" id="dateOfBirth" placeholder='yyyy/mm/dd' autocomplete='off'>
                    </div>
                </div>
                @endif
                

                <label for="from" class=" label">{{__('edit.whereAreYouFrom')}}</label>
                            
                <p class="control">
                    <input type="text" class="input" name="from" id="from" value="{{$user->placeName}}">
                </p>
                
                <label for="live" class=" label">{{__("What city do you live in?")}}</label>
                <p class="control">
                    <input type="text" class="input" name="live" id="live" value="{{ $home->placeName }}">
                </p>

                
            @if(!$user->about)
            <div class="control">
                <label for="about" class=" label">{{__('edit.aboutYou')}}</label>
                <div class="">
                    <textarea name="about" class="textarea" rows="5">{{$user->about}}</textarea>
                </div>
                <div class="">
                    <span class="help-block">
                        {{ trans('edit.helpOtherPeopleGetKnowU') }}
                        <br>
                        {{ trans('edit.AboutThingsYouLike') }}
                    </span>
                </div>
            </div>
            @endif
            <div class="clearfix"></div>
            <input type="submit" value="{{ trans('common.continue') }}" class="button is-primary ">
        </div>
    </div>
</section>
@endsection
@section('javascript')
@include('edit._js')
<script type="text/javascript">
$( function() {
$( "#dateOfBirth" ).datepicker({
changeMonth: true,
changeYear: true,
dateFormat: 'dd/mm/yy',
yearRange: '1910:2010',
minDate: new Date(1910,0,1),
maxDate: new Date(2010,0,1),
});
} );
</script>
@endsection
