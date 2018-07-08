$(function()
{

    $( "#check_in" ).datepicker({
        defaultDate: "+1w",
        dateFormat: 'yy-mm-dd',
        minDate: '+1D',
        maxDate: "+30D",
        onClose: function( selectedDate ) {
            tomorrow = new Date(selectedDate);
            tomorrow.setDate(tomorrow.getDate() +1);

            availableDays = new Date(selectedDate);
            availableDays.setDate(tomorrow.getDate() + 6);


            $( "#check_out" ).datepicker( "option", "minDate", tomorrow );
            $( "#check_out" ).datepicker( "option", "maxDate", availableDays );
            $( "#check_out" ).datepicker( "option", "disabled", false );

        }
    });

    $( "#check_out" ).datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        disabled: true
    });

    if( $( "#check_out" ).val() !== '') {
        $( "#check_out" ).datepicker( "option", "disabled", false );
    }

});
