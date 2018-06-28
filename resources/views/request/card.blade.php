<div class="column is-one-third">
    <div class="card">
        @if(!isset($hideImages))
        <div class="card-image">
            <figure class="image is-square">
                <img  src="{{ $request->user->getMainPhoto(300) }}" >

            </figure>
        </div>
        @endif
        <div class="card-content">
            <div class="media-content">

                <p class="title is-4"><a href="{{ route('request.show', [$request->uuid] ) }}" >{{ $request['first_name'] }}</a></p>

                <div class="content">
                    <p>{{ trans('common.from') }} {{ $request->check_in->toFormattedDateString() }} {{ trans('common.to') }} {{ $request->check_out->toFormattedDateString() }}</p>
                    <p>
                        {{ $request->people }} {{ trans('common.guest') }}
                        ·
                        {{ $request->check_in->diffInDays($request->check_out) }} {{ trans('common.nights') }}
                    </p>
                    {{ \Illuminate\Support\Str::words($request['text'],200) }}
                </div>
                <a class="button " href="{{ route('request.show', [$request->uuid] ) }}">
                    {{ trans('common.viewRequest') }}
                </a>

            </div>
        </div>
    </div>
</div>
