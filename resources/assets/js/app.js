/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('blueimp-file-upload');

import InstantSearch from 'vue-instantsearch';
import VueGoogleAutocomplete from 'vue-google-autocomplete';
import autosize from 'autosize';

window.Vue = require('vue');

Vue.use(InstantSearch);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('scan-view', require('./views/scan-view.vue'));
Vue.component('Modal', require('./components/bulma/Modal.vue'));


const app = new Vue({
    el: '#app',


    components: { VueGoogleAutocomplete },
    data: function() {
        return {
            showCancelModal: false,
            showHelpAcceptModal: false,
            formSent: false,
            showLanguagesModal: false,
        }
    }
});


autosize($('textarea'));


$('.modal-body input').click(function() {
    setLanguages();
});

function setLanguages() {
    var languages = '';

    var type = $('.modal-body input:checkbox').map(function() {
        return this.checked ? this.value : [];
    }).get();

    type.forEach(function(element) {
        languages = languages + element + ', ';
    });

    $("#spokenLanguages").html(languages.replace(/,\s*$/, ""));

}


$('.modal-body input').click(function() {
    setLanguages();
});

$(document).ready(function() {
    setLanguages();
});

document.addEventListener('DOMContentLoaded', () => {

    // Get all "navbar-burger" elements
    const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {

        // Add a click event on each of them
        $navbarBurgers.forEach(el => {
            el.addEventListener('click', () => {

                // Get the target from the "data-target" attribute
                const target = el.dataset.target;
                const $target = document.getElementById(target);

                // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                el.classList.toggle('is-active');
                $target.classList.toggle('is-active');

            });
        });
    }

});
