<div id="images" class="columns is-multiline">
    @forelse( $images AS $image)
    <div id="{{ $image['id']}}" class="column image is-one-quarter photo" >
        <img  src="{{asset($image['url'])}}">
        <div class="star">
            <div class="star-default @if($image['main']) hidden @endif " onclick="setMain({{$image['id']}})"></div>
            @if($image['main'])
            <div id="star"></div>
            @endif
        </div>
        <div onclick="deletePhoto({{  $image['id'] }})" type="submit" class="button is-danger delete"></div>
    </div>
    @empty
    <div id="photoUpload" class="has-text-centered">
            <i class="fa fa-camera"></i>
            <h2 class="title is-3">{{ trans('edit.uploadPhotosOfYou') }}</h2>
            <p class="subtitle is-5 text-muted">{{ trans('edit.uploadPhotosOfYouDescription') }} </p>
    </div>
    @endforelse
</div>
