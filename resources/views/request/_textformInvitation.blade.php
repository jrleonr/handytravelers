
<form role="form" ref="form" method="POST" action="{{ route('invitation.addMessage') }}">
    {{ csrf_field() }}
    <input type="hidden" name="requestId" value="{{ $request->uuid }}">


    <div class="field">
        <p class="control">
            <textarea name="body" class="textarea" rows="5" id="message" placeholder="{{ $request->getTextByUserRole($type) }}"></textarea>
        </p>
    </div>
    
    <p class="control">        
        @if($request->isPending() && $request->userRole(Auth::user()) == $request->waitingActionFor())
        <div class="field is-grouped is-grouped-right">
            <p class="control">
                <input type="submit" name="decline" v-show="! formSent " class="button is-link" value="{{ __('common.decline') }}">
            </p>
            <p class="control">
                <button class="button is-primary" @click="formSent = true" type="submit" name="accept" value="accept" v-bind:class="{ 'is-loading': formSent }" >{{ __('common.accept') }}</button>
            </p>
            
        </div>
    </p>
    @else
        <div class="field is-grouped is-grouped-right">
            @if($request->isAccepted())
            <p class="control">
                <a @click="showCancelModal = true" class="button is-text" value="Cancel">{{ __('common.cancelRequest') }}</a>
                @include('request._modal-cancel-'.$type)
            </p>
            @endif
            <p class="control">
                <input type="submit" value="{{ __('common.sendMessage') }}" class="button is-primary ">
            </p>
        </div>
    @endif

</form>
