@extends('handytravelers')
@section('content')
<section class="section">
    <div class="container  ">
        <div class="content has-text-centered">
            <h1 class="title is-3">{{ trans('edit.welcomeToHandytravelers') }}</h1>
            <p class="subtitle is-5">{{ trans('edit.beforeFirstExperienceComplete') }} <br> {{ trans('edit.writeAboutYouHelpHost') }}</p>
        </div>
        
        <div class="column is-two-thirds is-offset-2">
            <div class="box">
                <form action="{{route('edit.home')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="wizard" value="1" >
                    <div class="columns">
                        <div class="column is-8">
                            <label for="summary" class="label">{{__('edit.summary')}}</label>
                            <textarea name="summary" class="textarea" rows="7">{{ $home->summary }}</textarea>
                        </div>
                        <div class="column is-3 help-block">
                            <span class="help-block">{{ trans('edit.aboutYourSpace') }}</span>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="button is-primary">
                    {{ trans('common.save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('javascript')
@include('edit._js')
@endsection
