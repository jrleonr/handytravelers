<nav class="navbar is-transparent">
  <div class="container">
    <div class="navbar-brand">
      <a class="navbar-item" href="{{ url('/') }}">
        <img src="/img/logo.png"  title="Handytravelers" alt="Handytravelers: Surfing around the world to find couch and work" >
      </a>
      <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div  class="navbar-menu">
      
      <div class="navbar-end">
        @if (Auth::check())

        <a class="nav-item" href="{{route('inbox')}}">
          @if($messagesCount)
          <span class="tag is-warning">{{$messagesCount}}</span>
          @endif
          <span class="icon">
            <i class="fas fa-envelope"></i>
          </span>
        </a>
        
        <div class="navbar-item has-dropdown is-hoverable">
          <a class="navbar-link" href="{{route('profile', [Auth::user()->username])}}">
            <img src="{{ Auth::user()->getMainPhoto() }}" class="image is-circle">
          </a>
          
          <div class="navbar-dropdown is-boxed">
            <a class="navbar-item" href="/documentation/overview/start/">
              Overview
            </a>
            <hr class="navbar-divider">
            <a class=" navbar-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ trans('common.logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
            
          </div>
        </div>

        @else
        <div class="navbar-item">
          <div class="field is-grouped">
            <p class="control">
              <a class="button is-facebook" href="{{ route('login.facebook') }}"">
                <span class="icon">
                  <i class="fab fa-facebook"></i>
                </span>
                <span>
                  {{ trans('common.continueWithFacebook') }}
                </span>
              </a>
            </p>
            
          </div>
        </div>
        @endif
      </div>


    </div>
  </nav>
