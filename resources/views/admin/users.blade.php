@extends('handytravelers')
@section('content')
<div class="section">
    <div class="container">
        <div class="columns is-multiline">
                @foreach ($users as $user)
                <div class="column is-3">
                    <div class="card">
                        <div class="card-image">
                            
                            <figure class="image is-square">
                                <img src="{{ $user->getMainPhoto(300) }}" alt="Image">
                            </figure>
                            
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <a href="{{route('profile',[$user->username])}}">View</a>
                                <p>{{$user->first_name }}</p>
                                <p>{{$user->last_name }}</p>

                                @if($user->from)
                                <p><strong>{{ trans('common.from') }}</strong></p>
                                <p>{{$user->from->getFullPlace() }}</p>
                                @endif
                                @if($user->home->place)
                                <p><strong>{{ trans('common.lives') }}</strong></p>
                                <p>
                                    {{ $user->home->place->getFullPlace() }}
                                </p>
                                
                                @endif
                                @if($user->date_of_birth)
                                <p><strong>{{ trans('common.age') }}</strong></p>
                                <p>{{$user['date_of_birth']->age}}</p>
                                
                                @endif
                                @if(count($user->languages) > 0)
                                <p><strong>{{ trans('common.languages') }}</strong></p>
                                <ul>
                                    @foreach($user->languages AS $key => $lang)
                                    <li>{{$lang['title']}}</li>
                                    @endforeach
                                </ul>
                                
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    </div> <!-- aside -->
                    @endforeach
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @stop
