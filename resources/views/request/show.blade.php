@extends('handytravelers')
@section('content')
@include('errors.list')
<section class="section">

    <div id="message" class="container">

        <p class="title is-4"></p>
        
        <div class="columns">
            <div class="column  is-two-thirds">
                <div class="box">
                    @if($invitation && (!$invitation->isInactive() && ( $invitation->isPending() && $type == 'guest')  || $invitation->isAccepted() ) )
                        @include('request._textformInvitation')
                    @elseif(!$invitation && $request->user_id !== Auth::id() )
                        @include('request._textformRequest')
                    @else
                        @if($invitation && $invitation->isInactive())
                            <p class="title is-4">This request is closed</p>
                        @elseif($invitation && $invitation->isPending())
                            <p class="title is-4">Waiting for the guest to anwser</p>
                        @else
                            <p class="title is-4">This is your request</p>
                        @endif    
                    @endif
                </div>
                <article class="message">
                    <div class="message-body">
                        <p class="title is-4"><i class="fa fa-shield"></i> {{ trans('common.safety') }}</p>
                        <p class="subtitle is-6">  {{ trans('common.readProfilesCarefully') }} </p>
                    </div>
                </article>
                @if($invitation)
                    @include('request._message', ['messages' => $invitation->messages])
                @endif
                @include('request._message', ['messages' => [$request]])
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
                            @if($invitation && $invitation->isFromDifferentPlace())
                            <p>
                                <strong> {{ __('Invitation To') }} </strong><br> {{$invitation->sentBy->home->place->name}} ( < 40km {{$request->place->name}})
                            </p>
                            @endif
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
                            @if($invitation)
                            <span class="label {{$invitation->status}}">{{ \Lang::get('common.'.$invitation->status) }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                @if($invitation && $type == 'guest')
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

                    @if($invitation)
                    @foreach($invitation->participants AS $participant)
                    @if($participant->type != $invitation->userRole)
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

