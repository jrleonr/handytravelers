@extends('handytravelers')
@section('content')
@include('errors.list')
<section class="section">

    <div id="message" class="container">

        <p class="title is-4"></p>
        
        <div class="columns">
            <div class="column  is-two-thirds">
                <div class="box">
                    @include('request._textformInvitation')
                </div>
                <article class="message">
                    <div class="message-body">
                        <p class="title is-4"><i class="fa fa-shield"></i> {{ trans('common.safety') }}</p>
                        <p class="subtitle is-6">  {{ trans('common.readProfilesCarefully') }} </p>
                    </div>
                </article>
                
                    @include('request._message', ['messages' => $request->messages])
            </div>
            <div id="aside" class="column  is-offset-1  ">
                <div class="message">
                    <div class="message-header">
                        <p>{{ trans('common.aboutThisRequest') }}</p>
                    </div>
                    <div class="message-body">
                        <div class="content">
                            <p>
                                <strong> {{ trans('common.destination') }} </strong><br> {{$request->place->name}}
                            </p>
                            <p>
                                <strong> {{ trans('common.from') }} </strong><br> {{$request->check_in->format('l jS \\of F')}}
                            </p>
                            <p>
                                <strong>{{ trans('common.to') }}</strong> <br> {{$request->check_out->format('l jS \\of F')}}
                            </p>
                            <p>
                                {{$request->people}} {{ trans('common.guest') }}
                                ·
                                {{ $request->check_in->diffInDays($request->check_out) }} {{ trans('common.nights') }}
                            </p>
                            @if($request)
                            <span class="label {{$request->status}}">{{ \Lang::get('common.'.$request->status) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($request && $type == 'guest')
                <div class="message">
                    <div class="message-header">
                        <p>About this home </p>
                    </div>
                    <div class="message-body">
                        <div class="content">
                            <p>
                    
                                <strong> Who live here </strong><br> A {{ ucfirst($request->user->home->type) }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                
                <h2 class="title is-5">In this Conversation</h2>

                    @if($request)
                    @foreach($request->participants AS $participant)
                    @if($participant->type != $request->userRole($participant->user))
                    <div class="box" >
                    <a href="{{route('profile',[$participant->user->username])}}">
                    
                        <article class="media">
                            <div class="media-left">
                                <figure class="image is-64x64">
                                    <img  alt="{{$participant->user->first_name}}" src="{{$participant->user->getMainPhoto()}}">
                                </figure>
                            </div>
                            <div class="media-content">
                                <div class="content">
                                    <p>
                                        <strong>{{$participant->user->first_name}}</strong>
                                        <br>
                                        <span class="text-muted">
                                        {{$participant->user->home->place->name}}
                                        </span><br>
                                        <span class="text-muted">{{ trans('common.memberSince') }}  {{ $participant->user->created_at->year }}</span>        </p>
                                    </div>
                                </div>
                            </article>

                        </a>
                         </div>
                        @endif
                        @endforeach
                        @endif
                   
                </div>
            </div>
        </div>
    </section>
    @stop

