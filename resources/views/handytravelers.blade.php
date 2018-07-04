<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    @yield('css')

    <!-- Scripts -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?&v=3&key={{ env('GOOGLE_API_KEY_WEB') }}&libraries=places&language=en"></script>

    <!-- Metas -->
    <title>@yield('title', trans('common.stayWithLocalsMeta')) - Handytravelers</title>
    <meta name="title" content="@yield('title', trans('common.stayWithLocalsMeta')) - Handytravelers"/>
    <meta name="description" content="@yield('description', trans('common.metaDescription'))"/>
    <meta property="og:locale" content="{{ trans('common.locale') }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="@yield('title', trans('common.stayWithLocalsMeta')) - Handytravelers"/>
    <meta property="og:description" content="@yield('description', trans('common.metaDescription'))"/>
    <meta property="og:url" content="https://handytravelers.com"/>
    <meta property="og:site_name" content="Handytravelers social travel network"/>
    <meta property="og:image" content="https://handytravelers.com/img/handytravelers-big-owl.jpg"/>
    <meta property="og:image:width" content="2000"/>
    <meta property="og:image:height" content="900"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="@yield('description', trans('common.metaDescription'))"/>
    <meta name="twitter:title" content="@yield('title', trans('common.stayWithLocalsMeta')) - Handytravelers"/>
    <meta name="twitter:site" content="@jrleonr"/>
    <meta name="twitter:image" content="https://handytravelers.com/img/handytravelers-big-owl.jpg"/>
    <meta name="twitter:creator" content="@jrleonr"/>

    <script>
        window.Handytravelers = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'stripeKey' => config('services.stripe.key'),
            'user' => [ 
                'email' => Auth::user()->email ?? null, 
                'name' => (Auth::user()->first_name ?? null) . ' ' . (Auth::user()->last_name ?? null)
            ] 
        ]); ?>
    </script> 
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1687454141547980'); // Insert your pixel ID here.
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1687454141547980&ev=PageView&noscript=1"
    /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-25709567-2', 'auto');
        ga('send', 'pageview');
    </script>
    <meta name='B-verify' content='1b58a8ae489cd1514cbc6535487ca85b3fe87893' />
  </head>
    @yield('pixel') 
  <body>
    
    @include('includes.nav')
    
    @include('errors.message')

    <div id="app">
      @yield('content')
    </div>
    @include('includes.footer')
    <!-- Scripts -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
      Stripe.setPublishableKey('{{ config('services.stripe.key') }}');
    </script>
    @yield('javascript')
  </body>
</html>
