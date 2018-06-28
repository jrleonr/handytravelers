@if(Session::has('error'))
<div class="alert alert-common alert-danger notification is-warning" role="alert">
    <button class="delete" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"></span></button>
    {!! \Session::get('error') !!}
</div>
@endif
