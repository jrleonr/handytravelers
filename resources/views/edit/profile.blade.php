@extends('handytravelers')
@section('css')
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@stop
@section('content')
<section class="section">
    <div id="edit" class="container">
        <div class="columns">
            @include('edit._menu')
            <div id="main" class="column">
                @include('errors.list')
                <nav class="card">

                    <header class="card-header">
                        <p class="card-header-title">
                            {{ trans('common.profile') }}
                        </p>
                    </header>
                    <div class="card-content">

                        <form action="{{route('edit.profile')}}" method="post">

                            {{ csrf_field() }}
                            
                            <label for="first_name" class="col-sm-12 label">{{__('edit.firstName')}}</label>
                            <p class="control">
                                <input type="text" class="input" name="first_name" value="{{$user->first_name}}">
                            </p>
                            
                            <label for="last_name" class="col-sm-12 label">{{__('edit.lastName')}}</label>
                            <p class="control">
                                <input type="text" class="input" name="last_name" value="{{$user->last_name}}">
                            </p>
                            
                            <p class="control">
                                <label for="from" class="label">{{__('edit.dateOfBirth')}}</label>
                                <input type="text" class="input" name="date_of_birth" id="dateOfBirth" placeholder='dd/mm/yyyy' autocomplete='off' value="{{$user->date_of_birth->format('d/m/Y')}}">
                            </p>
                            
                            <label for="gender" class="col-sm-12 label">{{__('common.gender')}}</label>
                            <p class="control">
                                <span class="select">
                                    <select name="gender">
                                        <option value="male" @if($user->gender == 'male') selected @endif>{{__('common.male')}}</option>
                                        <option value="female" @if($user->gender == 'female') selected @endif>{{__('common.female')}}</option>
                                    </select>
                                </span>
                                
                            </p>
                            
                            <label for="from" class="col-sm-12 label">{{__('edit.whereAreYouFrom')}}</label>
                            
                            <p class="control">
                                <input type="text" class="input" name="from" id="from" value="{{$user->placeName}}">
                            </p>
                            
                            <label for="live" class="col-sm-12 label">{{__('edit.whereDoYouLive')}}</label>
                            <p class="control">
                                <input type="text" class="input" name="live" id="live" value="{{ $home->placeName }}">
                            </p>
                            
                            @include('edit._languages')

                            <label for="about" class="col-sm-12 label">{{__('edit.aboutYou')}}</label>
                            <p class="control">
                                <textarea name="about" class="textarea" rows="5">{{$user->about}}</textarea>
                            </p>
                            
                            <input type="submit" value="{{trans('edit.save')}}" class="button is-primary is-medium ">
                            
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </section>
    @stop
    @section('javascript')
    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
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
    @stop
