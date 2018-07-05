
<form role="form" ref="form" method="POST" action="{{ route('invitation.addMessage') }}">
    {{ csrf_field() }}
    <input type="hidden" name="invitationId" value="{{ $request->uuid}}">

    <p class="control">
        <textarea name="body" class="textarea" rows="5" id="message" placeholder="{{ $request->getTextByUserRole($type) }}"></textarea>
    </p>
    
    <p class="control">

        @if($request->isAccepted())
        <div class="control is-grouped">
            <p class="control">
                <input type="submit" value="{{ __('common.sendMessage') }}" class="button is-primary ">
            </p>
            <p class="control">
                <a @click="showCancelModal = true" class="button is-link" value="Cancel">Cancel</a>
                @include('request._modal-cancel-'.$type)
            </p>
        </div>
        @elseif($request->isPending() && $request->userRole == 'guest')
        <div class="control is-grouped">
            <p class="control">
                <button class="button is-primary" @click="formSent = true" type="submit" name="accept" value="accept" v-bind:class="{ 'is-loading': formSent }" >{{ __('common.accept', ['price' => '$25']) }}</button>
                <span class="button is-link help" @click="showHelpAcceptModal = true">
                    {{ __('What happen if Accept') }}
                </span>
            </p>
            <p>
                <modal v-if="showHelpAcceptModal" @close="showHelpAcceptModal = false">
                    <template slot="header">{{ __('What happen if Accept') }}</template>
                    <template slot="body">
                        {{ __('If you decide to Accept this invitation') }}
                        <ul>
                            <li>{{ __("You'll be charge", ['price' => '$25']) }}</li>
                            <li>{{ __("You won't be able to recieve more invitations for this specific request.") }}</li>
                            <li>{{ __("If You have other invitations pending in this City, all of them will be decline.") }}</li>
                        </ul>
                    </template>
                </modal>
            </p>
            <p class="control">
                <input type="submit" name="decline" v-show="! formSent " class="button is-link" value="{{ __('common.decline') }}">
            </p>
        </div>
    </p>
    @endif

</form>
