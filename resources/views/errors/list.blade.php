@if( $errors->any() )
    <div class="alert alert-common alert-danger notification is-warning" role="alert">
        <button class="delete" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach( $errors->all() AS $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


