@if( \Session::has('message') )
    <div class="alert alert-common alert-blue" role="alert" >
        <div class="container">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {!! \Session::get('message') !!}
        </div>
    </div>
@endif
