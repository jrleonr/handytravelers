<template>
<form method="GET" :action="action" class="nav-search-form is-flex">
<input type="search" class="input" id="search" :placeholder="placeholder" name="q">

<button type="submit" class="button is-primary in-caps is-hidden-mobile">
	Search
</button>

</form>
</template>

<vue-google-autocomplete 
        id="map" 
        types="(cities)" 
        class="input is-large" 
        type="text" 
        ref="address"
        v-on:placechanged="getAddressData"
        placeholder="Where are you going?">
    </vue-google-autocomplete>