<tr>
    <td>
        <a href="{{route('request.show', [$invitation['uuid']])}}">
            @foreach($invitation->participants as $participant)
            <img class="photo-round" height="45" width="45" title="{{$participant->first_name}}"
            src="{{$participant->user->getMainPhoto()}}"
            alt="{{$participant->user->first_name}}"
            >
            {{ $participant->first_name }}
            @endforeach
        </a>
    </td>
    
    <td >
        
    </td>
    <td >
        <span class="label {{$invitation['status']}} ">
            {{ \Lang::get('common.' . $invitation['status'])}}
        </span> <br>
    </td>
</tr>
