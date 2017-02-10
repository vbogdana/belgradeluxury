<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Belgrade Luxury') }}</title>

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
                            <li class='dropdown'>
                                <a href='#' class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    Services<span class="caret"></span>
                                </a>
                                <ul class='dropdown-menu'>
                                    <li><a href='{{ route('cms.accommodation') }}'>accommodation</a></li>
                                    <li><a href='{{ route('cms.vehicles') }}'>vehicles</a></li>
                                </ul>
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

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ url ("") }}/js/app.js"></script>
</body>
</html>
