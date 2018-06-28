
<script async defer src="https://maps.googleapis.com/maps/api/js?&v=3&key={{ env('GOOGLE_API_KEY_WEB') }}&libraries=places&language=en"></script>
<script type="text/javascript" >


    $('.modal-body input').click(function() {
        setLanguages();
    });

    $(document).ready( function() {
        var options = {
          types: ['(cities)'],
          componentRestrictions: {}
      };
      $("#from").geocomplete(options);  
      $("#live").geocomplete(options);  

      setLanguages();
  });

    function setLanguages()
    {
        var languages = '';

        type = $('.modal-body input:checkbox').map(function(){
            return this.checked ? this.value : [];
        }).get();

        type.forEach( function(element) {
            languages = languages + element + ', ';
        });

        $("#spokenLanguages").html(languages.replace(/,\s*$/, ""));

    }

</script>
