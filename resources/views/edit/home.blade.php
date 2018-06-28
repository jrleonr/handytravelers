@extends('edit.layout')
@section('forms')
<form action="{{route('edit.home')}}" method="post">
    {{ csrf_field() }}
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">{{ trans('common.aboutYourhome') }}</p>
        </header>
        <div class="card-content">
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
            <div class="columns">
                <div class="column is-8">
                    <label for="interaction" class="label">{{__('edit.interactionWithGuests')}}</label>
                    <textarea name="interaction" class="textarea" rows="5">{{ $home->interaction }}</textarea>
                </div>
                <div class="column is-3 help-block">
                    {{ trans('edit.howMuchInteractWith') }}
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column is-8">
                    <label for="rules" class="label">{{__('edit.houseRules')}}</label>
                    <textarea name="rules" class="textarea"  rows="5">{{ $home->rules }}</textarea>
                </div>
                <div class="column is-3 help-block">
                    {{ trans('edit.howGuestToBehave') }}
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column is-8">
                    <label for="accommodation" class="label">{{__('edit.accommodation')}}</label>
                    <textarea name="accommodation" class="textarea" rows="5">{{ $home->accommodation }}</textarea>
                </div>
                <div class="column is-3 help-block">
                    {{ trans('edit.whereGuestWillSleep') }}
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column is-8">
                    <label for="gettingAround" class="label">{{__('edit.gettingAround')}}</label>
                    <textarea name="getting_around" class="textarea" rows="5">{{ $home->getting_around }}</textarea>
                </div>
                <div class="column is-3 help-block">
                    <span class="help-block">{{ trans('edit.howTogetToYourHome') }}</span>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column is-8">
                    <label for="otherThings" class="label">{{__('edit.otherThings')}}</label>
                    <textarea name="other" class="textarea" rows="5">{{ $home->other }}</textarea>
                </div>
                <div class="column is-3 help-block">
                    {{ trans('edit.otherDetailsYouShare') }}
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="button is-large is-primary">{{ trans('common.save') }}</button>
</form>
@endsection
