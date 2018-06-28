<script type="text/javascript">
$(document).ready(function()
{
    set_hover();

})

var type = '{{$home->type}}';
var numberOfHousemates = {{$housemates->count()}};

function housemateType(value)
{


    $('.housemateType').removeClass('housemateTypeActive');
    $("#"+value).addClass('housemateTypeActive').removeClass('hidden');
    $("#choose").removeClass('hidden');
    $('#type').val(value);

    if(type != value )
        {

           if ( (numberOfHousemates > 0 && value == 'single') || (numberOfHousemates > 1  && value == 'couple'))
           {
                $('#housemateChange').modal('show');
           }
           else
           {
                housemateUpdate();
           }
        }


}

function housemateUpdate()
{

   type = $('#type').val();

    //if change to single or couple remove the housemates
    if(type == 'single' || ( type == 'couple' && numberOfHousemates > 1))
        numberOfHousemates = 0;


       $.ajax({
           type: "POST",
           url: '{{route('edit.housemates')}}',
           data: {type: type,  _token: '{{csrf_token()}}'},
           })
           .done(function( partial ) {
                showButton();

                $("#homeHousemates").html(partial);
                @if(isset($wizard)) 
                  window.location.replace('{{route('edit.home')}}');
                @endif 
           }
       );
}


@if(isset($home->new))
    function showButton()
    {
        $("#buttonNext").removeClass("hidden");
    }
@else
    function showButton()
    {
       if ( ( type == 'couple' && numberOfHousemates == 0) || ( type == 'group') || ( type == 'family') )
       {
            $("#sendInvitation").removeClass("hidden");
       }
       else
       {
            $("#sendInvitation").addClass("hidden");
       }
    }
@endif



function set_hover()
{

    $( ".housemates" ).mouseenter(function() {
        $(this).find(".remove").css("display", "block");
    }).mouseleave(function() {
        $(this).find(".remove").css("display", "none");
    });

}

function removeHousemate(user_id)
{
    $.ajax({
       type: "POST",
       url: '{{route('edit.housemates')}}',
       data: {user_id: user_id,  _token: '{{csrf_token()}}'},
       })
       .done(function( partial ) {
            $("#homeHousemates").html(partial);
            set_hover()
       }
   );
}

function removeRequest(request_id)
{
    $.ajax({
       type: "POST",
       url: '{{route('edit.housemates')}}',
       data: {request_id: request_id,  _token: '{{csrf_token()}}'},
       })
       .done(function( partial ) {
            $("#homeHousemates").html(partial);
            set_hover()
       }
   );
}




$('#choose').click( function(){
    $('.housemateType').removeClass('hidden').removeClass('housemateTypeActive');
    $("#choose").addClass('hidden');
    $("#sendInvitation").addClass("hidden");

});


</script>
