@extends('handytravelers')
@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-4">
                <div class="content">
                    <p>{!! __('Payment Page?') !!}</p>
                    {!! __('common.paymentDetailsDes') !!}
                </div>
            </div>
            <div class="column">
                <create-customer inline-template>
                <div>
                    <div class="card">
                        <div v-show="error" class="alert alert-common alert-danger notification is-warning" role="alert">
                            @{{ error }}
                        </div>
                        <div class="card-content">
                            <form ref="form" id="createCustomerForm" method="POST" action="{{route('request.postCreateCustomer')}}" @submit.prevent="">
                                {{ csrf_field() }}
                                <input type="hidden"  name="stripeToken" ref="input">
                                <input type="hidden"  name="requestId" value="{{$requestId}}">
                                <span class="payment-errors"></span>
                                <label class="label" for="name">{{ __('Full Name') }}</label>
                                <div class="control">
                                    <input type="text" class="input" v-model="name" placeholder="{{ __('Full Name') }}" >
                                    <small id="emailHelp" class="form-text text-muted">{{ __('The name as appers on your card') }}</small>
                                </div>
                                <label class="label" for="cardNumber">{{ __('Card Number') }}</label>
                                <div class="control">
                                    <input type="text" class="input" v-model="number" placeholder="4242 4242 4242 4242" />
                                </div>
                                <div class="columns">
                                    <div class="column is-3">
                                        <label class="label" for="expityMonth">{{ __('Expiry Month') }}</label>
                                        <input type="text" class="input" placeholder="01" maxlength="2" v-model="month" />
                                    </div>
                                    <div class="column is-4">
                                        <label class="label" for="expityMonth">{{ __('Expiry Year') }}</label>
                                        <input type="text" class="input" maxlength="4" v-model="year" placeholder="2020" />
                                    </div>
                                    <div class="column is-4 is-offset-1">
                                        <label class="label" for="cvCode">{{ __('CVC Code') }}</label>
                                        <input  class="input" maxlength="4" v-model="cvc" placeholder="123" />
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label" for="addressZip">{{ __('Postal Code') }}</label>
                                    <input type="text" class="input" v-model="addressZip" >
                                </div>
                                <button type="submit" class="button is-medium is-primary" :class="{'is-loading': formSent}" role="button" @click.prevent="createToken">{{ __('Add my Credit Card') }}</button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                </create-customer>
            </div>
        </div>
        
        <div class="section"></div>
        <div class="content has-text-centered">
            <p class="title is-3">{{ __("Frequently Asked Questions") }}</p>
        </div>
        <div class="columns is-multiline ">
            
            <div class="column is-5">
                <p class="title is-4">{{ __("Is this a subscription?") }}</p>
                <p class="subtitle is-6">{{ __("No. It's a one time fee we only charge you for a confirmed trip.") }}</p>
            </div>
            <div class="column is-1"></div>
            <div class="column is-5">
                <p class="title is-4">{{ __("Am I paying the host to stay?") }}</p>
                <p class="subtitle is-6">{{ __("This a Handytravelers fee") }}</p>
            </div>
            <div class="column is-1"></div>
            <div class="column is-5">
                <p class="title is-4">{{ __("How much it cost") }}</p>
                <p class="subtitle is-6">{{ __("The price to accept an invitation is $25.") }}</p>
            </div>
            <div class="column is-1"></div>
            <div class="column is-5">
                <p class="title is-4">{{ __("Why is $25 the price?") }}</p>
                <p class="subtitle is-6">{{ __("It's a price around one night in one nice hostel in a lot of places around the world.") }}</p>
            </div>
            
        </div>
        <section class="section content has-text-centered">
            <p class="">{!! __("If you think") !!}</p>
        </section>
    </div>
</section>
@stop
