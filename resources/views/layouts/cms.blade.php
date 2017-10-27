<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Belgrade Luxury') }}</title>
    <!-- favicons  -->       	      
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url("") }}/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="{{ url("") }}/images/icons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ url("") }}/images/icons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="{{ url("") }}/images/icons/manifest.json">
    <link rel="mask-icon" href="{{ url("") }}/images/icons/safari-pinned-tab.svg" color="#C5B358">
    <link rel="shortcut icon" href="{{ url("") }}/images/icons/favicon.ico">
    <meta name="msapplication-config" content="{{ url("") }}/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#C5B358">

    <!-- Styles -->
    <link href="{{ url ("") }}/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ route('cms') }}">
                        {{ config('app.name', 'Belgrade Luxury') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('cms.login') }}">Login</a></li>
                            <!-- 
                                da ne prikazuje register treba drugi login kontroler koji
                                redefinise showLoginForm metodu
                            <li><a href="{{ route('cms.register') }}">Register</a></li>
                            -->
                        @else
                            <li>
                                <a href='{{ route('cms') }}' role="button">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <strong>Portal</strong>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a href='{{ route('cms.portal') }}'>Portal</a></li>
                                    <li><a href='{{ route('cms.portal.articles', ['category' => 'Society']) }}'>Society</a></li>
                                    <li><a href='{{ route('cms.portal.articles', ['category' => 'Nightlife']) }}'>Nightlife</a></li>
                                    <li><a href='{{ route('cms.portal.articles', ['category' => 'Culture']) }}'>Culture</a></li>
                                    <li><a href='{{ route('cms.portal.articles', ['category' => 'Gastronomy']) }}'>Gastronomy</a></li>
                                    <li><a href='{{ route('cms.portal.articles', ['category' => 'Sites']) }}'>Sites</a></li>
                                    <li><a href='{{ route('cms.portal.articles', ['category' => 'Other']) }}'>Other</a></li>
                                </ul>
                            </li>
                            <li class='dropdown'>
                                <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Packages<span class="caret"></span>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a href='{{ route('cms.packages') }}'>All packages</a></li>
                                    <li><a href='{{ route('cms.packages.reorder') }}'>Reorder packages</a></li>
                                    <li><a href='{{ route('cms.packages.create') }}'>New package</a></li>
                                </ul>
                            </li>
                            <li class='dropdown'>
                                <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Promotions<span class="caret"></span>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a href='{{ route('cms.promotions') }}'>All promotions</a></li>
                                    <li><a href='{{ route('cms.promotions.create') }}'>New promotion</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href='{{ route('cms.testemonials') }}' role="button">
                                    Testemonials
                                </a>
                            </li>
                            <li>
                                <a href='{{ route('cms.events') }}' role="button">
                                    Events
                                </a>
                            </li>
                            <li class='dropdown'>
                                <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Services<span class="caret"></span>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a href='{{ route('cms.accommodation') }}'>accommodation</a></li>
                                    <li><a href='{{ route('cms.vehicles') }}'>vehicles</a></li>
                                    <li><a href='{{ route('cms.host') }}'>host</a></li>
                                    <li><a href='{{ route('cms.places.gastronomy') }}'>gastronomy</a></li>
                                    <li><a href='{{ route('cms.places.nightlife') }}'>nightlife</a></li>
                                    <li><a href='{{ route('cms.services.texts', ['service' => 'Wellness & Spa']) }}'>wellness & spa</a></li>
                                    <li><a href='{{ route('cms.services.texts', ['service' => 'Sightseeing']) }}'>sightseeing</a></li>
                                    <li><a href='{{ route('cms.services.texts', ['service' => 'Personel']) }}'>personel</a></li>
                                    <li><a href='{{ route('cms.services.texts', ['service' => 'Diamond']) }}'>diamond</a></li>
                                    <li><a href='{{ route('cms.services.texts', ['service' => 'Tickets']) }}'>tickets</a></li>
                                    <li><a href='{{ route('cms.services.texts', ['service' => 'Business']) }}'>business</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href='{{ route('cms.partners') }}' role="button">
                                    Partners
                                </a>
                            </li>
                            <li class='dropdown'>
                                <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Users<span class="caret"></span>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a href='{{ route('cms.register') }}'>New user</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('cms.logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('cms.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        @include('cms.instructions.compress-images')

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ url ("") }}/js/app.js"></script>
    
    @section('scripts')
    @show
</body>
</html>
