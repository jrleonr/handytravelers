
<form ref="form" method="POST" action="{{ route('request.invite') }}">
    {{ csrf_field() }}
    <input type="hidden" name="requestId" value="{{ $request->uuid }}">
    <p class="control">
        <textarea name="body" class="textarea" rows="5" id="message" placeholder="{{ $request->getTextByUserRole($type) }}"></textarea>
    </p>
    <p class="control">
        <button type="submit" class="button is-primary">
            Invite to Your Home
        </button>
    </p>
</form>

