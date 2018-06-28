<script type="text/javascript">
$(document).ready(function()
{
    set_hover();
})

$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        formData: {_token: '{{csrf_token()}}'},
        start: function (e, data)
        {
            $("#photoUpload").addClass('hidden');

            var photoPending = `
                <div class="column photoPending image is-one-quarter photo">
                    <img src="/img/unknown.jpg">
                    <div class="loadingPhoto">
                        <i class="fa fa-circle-o-notch fa-spin"></i>
                        <p class="uploading">Uploading...</p>
                    </div>
                </div>`;

            if( $("#images .photo:eq(0)").length )
                $( "#images .photo:eq(0)" ).after(photoPending);
            else
                $("#images").prepend(photoPending);


        },
        done: function (e, data)
        {

            if(data.result.main == 1) {
                var star = '<div class="star"><div class="star-default" style="width: 0px; height: 0px;" onclick="setMain('+data.result.id+')"></div><div id="star"></div></div>';
            } else {
                var star = '<div class="star"><div class="star-default" onclick="setMain('+data.result.id+')"></div></div>';
            }

            var photo = '<div id='+data.result.id+' class="column image is-one-quarter photo" ><img src="'+data.result.url+'">'+star+'<div onclick="deletePhoto('+data.result.id+')" type="submit" class="button is-danger delete"></div></div>';

            if( $("#images .photo:eq(0)").length ) {
                $( "#images .photo:eq(0)" ).after(photo);
            } else {
                $("#images").prepend(photo);
            }

            set_hover();

            $("#images .photoPending").last().remove();


        }
    });

});

function star(id)
{
    $("#star").remove();

    $('.star-default').css(
    {
        "width": "24px",
        "height": "24px"
    });


    $("#"+id).find('.star-default').css(
    {
        "width": "0px",
        "height": "0px"
    });

    $("#"+id).find('.star').append("<div id='star'></div>");
}

function setMain(id)
{
    star(id);

    $.ajax({
        type: "POST",
        url: '{{ route('edit.photos') }}',
        cache: false,
        data: {id: id, _method: 'PUT', _token: '{{csrf_token()}}'},
    });
}

function deletePhoto(id)
{
    $("#"+id).css(
        {
            "opacity": "0.7",
            "filter": "alpha(opacity=70)"
        });

    $("#"+id).find(".star").remove();
    $("#"+id).find(".photo-delete").remove();

    $("#"+id).append("<div class='loading-photos'></div>");

    $.ajax({
        type: "POST",
        url: '{{ route('edit.photos')  }}',
        cache: false,
        data: {id: id, _method: 'DELETE', _token: '{{csrf_token()}}' },
        success: function(photo)
        {
            $("#"+id).remove();
        }
    });

}

function set_hover()
{
    $(".photo").hover(function (){
            $(this).find(".delete").css("display", "inline");
            $(this).find(".star-default").css("display", "block");
        },function(){
            $(this).find(".delete").css("display", "none");
            $(this).find(".star-default").css("display", "none");
        }
    );
}
</script>
