@extends('edit.layout')

@section('forms')
    <div class="box">
        <h3>{{ trans('edit.listing') }}</h3>
        <div class="form">
            {!! Form::open([ 'class' => '', 'route' => ["home.listing"] ]) !!}
                <div class="col-sm-4">
                    <h4>{{ trans('edit.aboutThisListing') }}</h4>
                    <span class="help-block"></span>
                </div>
                <div class="col-sm-7 col-sm-push-1">
                    <div class="row">
                        @include('home.forms.listing')
                        <div class="form-group">
                            {!! Form::submit(trans('common.save'), ['class' => 'btn btn-primary col-sm-4 ']) !!}
                        </div>

                    </div>
                </div>

            {!! Form::close() !!}
            <div class="clearfix"></div>
            
        </div>
    </div>
@endsection

