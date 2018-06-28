<div class="column is-2">
<aside class="menu">
  <p class="menu-label">
    {{ trans('common.profile') }}
  </p>
  <ul class="menu-list">
    <li><a href="{{route('edit.profile')}}">{{ trans('common.edit') }}</a></li>
    <li><a href="{{route('edit.photos')}}">{{ trans('common.photos') }}</a></li>
  </ul>

  <p class="menu-label">
    {{ trans('Home') }}
  </p>
  <ul class="menu-list">
    <li><a href="{{route('edit.home')}}">{{ trans('common.edit') }}</a></li>
    <li><a href="{{route('edit.housemates')}}">{{ trans('edit.housemates') }}</a></li>
  </ul>
</aside>
<hr>
<a class="button" href="{{route('profile', [$user->username])}}">{{ trans('common.viewProfile') }}</a>
</div>
