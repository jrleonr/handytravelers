@foreach($messages AS $message)

<article class="media">

  <figure class="media-left">
    <p class="image is-64x64">
        <a href="{{ route('profile', [$message->user->username]) }}">
          <img title="{{$message->user->first_name}}" src="{{$message->user->getMainPhoto()}}" alt="{{$message->user->first_name}}">
        </a>
    </p>
  </figure>
  <div class="box  media-content">
    <div class="content">
      <p>
        <strong>{{ $message->user->first_name }}</strong>  <small>{{$message->created_at->diffForHumans() }}</small>
        <br>
        {!!nl2br(strip_tags($message->body))!!}
      </p>
    </div>

  </div>

  </article>
@endforeach
