
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import InstantSearch from 'vue-instantsearch';

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



          data: function () {
            return {
                showCancelModal: false,
        showHelpAcceptModal: false,
        formSent: false,
        showLanguagesModal: false,
              address: ''
            }
        },

        mounted() {
            // To demonstrate functionality of exposed component functions
            // Here we make focus on the user input
            //this.$refs.address.focus();
        },

        methods: {
            /**
            * When the location found
            * @param {Object} addressData Data of the found location
            * @param {Object} placeResultData PlaceResult object
            * @param {String} id Input container ID
            */
            // getAddressData: function (addressData, placeResultData, id) {
            //     this.address = addressData;
            // }
        }
});

//find a better place and better solution
import autosize from 'autosize';
autosize($('textarea'));

require('jquery-datepicker');
require('blueimp-file-upload');


    $('.modal-body input').click(function() {
        setLanguages();
    });

    $(document).ready( function() {
      setLanguages();
  });

    function setLanguages()
    {
        var languages = '';

        var type = $('.modal-body input:checkbox').map(function(){
            return this.checked ? this.value : [];
        }).get();

        type.forEach( function(element) {
            languages = languages + element + ', ';
        });

        $("#spokenLanguages").html(languages.replace(/,\s*$/, ""));

    }
