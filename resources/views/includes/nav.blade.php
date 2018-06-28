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

  <div id="navbarExampleTransparentExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="https://bulma.io/">
        Home
      </a>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="/documentation/overview/start/">
          Docs
        </a>
        <div class="navbar-dropdown is-boxed">
          <a class="navbar-item" href="/documentation/overview/start/">
            Overview
          </a>
          <a class="navbar-item" href="https://bulma.io/documentation/modifiers/syntax/">
            Modifiers
          </a>
          <a class="navbar-item" href="https://bulma.io/documentation/columns/basics/">
            Columns
          </a>
          <a class="navbar-item" href="https://bulma.io/documentation/layout/container/">
            Layout
          </a>
          <a class="navbar-item" href="https://bulma.io/documentation/form/general/">
            Form
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="https://bulma.io/documentation/elements/box/">
            Elements
          </a>
          <a class="navbar-item is-active" href="https://bulma.io/documentation/components/breadcrumb/">
            Components
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
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
    </div>
  </div>
</nav>

<nav class="nav">
    <div class="container">

        <div id='nav-menu' class="nav-right nav-menu">
            @if (Auth::check())

            <a class="nav-item" href="{{route('inbox')}}">
                @if($messagesCount)
                <span class="tag is-warning">{{$messagesCount}}</span>
                @endif
                <span class="icon">
                    <i class="fa fa-envelope"></i>
                </span>
            </a>
            <a class="nav-item" href="{{route('profile', [Auth::user()->username])}}">
                <img src="{{ Auth::user()->getMainPhoto() }}" class="image is-circle">
            </a>
            
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            
            <span class="nav-item">
                <a href="{{ route('request.form') }}" class="button is-primary">
                    <span class="icon">
                        <i class="fa fa-home"></i>
                    </span>
                    
                    <span>{{ __('Publish Your Travel') }}</span>
                </a>
                
            </span>
            @endif
        </div>
    </div>
</div>
</nav>
