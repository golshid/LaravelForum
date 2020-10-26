<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            
            <div class="container">
                <div class="row">
                <div class="col-md-4">
                <div class="card" style="background-color:#2076bd;">
                    <div class="card-body">
                        <a href="/forum" style="text-decoration:none; color:#fff; text-align:center;">
                            <h5>Home</h5>
                        </a>
                    </div>
                </div>
                <a href="{{route('discussions.create')}}" class="form-control mt-2 btn btn-primary">Create a new discussion</a>
                @auth
               @if (Auth::user()->admin > 0)
                <a href="/controlpanel" class="form-control btn text-white mt-2" style="background-color:deepskyblue;">Admin Control Panel</a>
                @endif
                <a href="/inbox" class="form-control btn text-white mt-2" style="background-color:#9370db;">My Discussions</a>
                @endauth

                    <div class="card card-primary mt-2">
                        <div class="card-header text-center" style="background-color:#e45fa8; color:white;">
                       @if (Auth::check() && Auth::user()->admin>0)
                            <a class="text-white" style="text-decoration:none;" href="/channels">Channels</a>
                        @else 
                         Channels
                        @endif
                        </div>
                        <div class="card-body" style="background-color:#fae1ef; text-align:center;">
                            @foreach ($channels as $channel)
                            <li class="list-group-item" style="background-color:#fef7fb;">
                                <a href="{{route('channel',['slug'=>$channel->slug])}}"
                                    style="text-decoration:none;color:#EA75AC;">{{$channel->title}}</a>
                            </li>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    @yield('content')
                </div>
            </div>
            </div>
        </main>
    </div>
</body>
</html>
