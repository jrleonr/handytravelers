<div class="columns is-multiline ">
    <input id="type" type="hidden" value="{{$home->type}}">
    <div class="column is-half">
        <div id="single" onclick="housemateType('single')" class="  box has-text-centered housemateType @if( ($home->type == 'female' || $home->type == 'male') &&  !isset($steps)) housemateTypeActive @endif">
            <i class="fa fa-{{$user->gender}}"></i>
            <p>{{ trans('edit.justMyself') }}</p>
        </div>
    </div>
    <div class="column is-half">
        <div id="couple" onclick="housemateType('couple')" class=" box has-text-centered housemateType @if($home->type == 'couple') housemateTypeActive @endif">
            <i class="fa fa-heart"></i>
            <p>{{ trans('edit.weAreACouple') }}</p>
        </div>
    </div>
    <div class="column is-half">
        <div id="group" onclick="housemateType('group')" class=" box has-text-centered housemateType @if($home->type == 'group') housemateTypeActive @endif">
            <i class="fa fa-users"></i>
            <p>{{ trans('edit.groupOfFriends') }}</p>
        </div>
    </div>
    <div class="column is-half">
        <div id="family" onclick="housemateType('family')" class=" box has-text-centered housemateType @if($home->type == 'family') housemateTypeActive @endif">
            <i class="fa fa-home"></i>
            <p>{{ trans('edit.family') }}</p>
        </div>
    </div>
</div>
