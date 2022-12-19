<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--<script src="{ { asset('js/app.js') }}" defer></script>-->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body style="margin: 0px;">
    <div id="app">
        <div class="navbar">
            <div>
                @guest
                <a class="navbar-brand" href="{{ url('/') }}">
                    Citas
                </a>
                @else
                <a class="navbar-brand" href="{{ url('/') }}">
                    Citas
                </a>
                <a href="/home">Mantenimiento de citas</a>
                <a href="/notas">Notas</a>
                <a href="/expediente">Expedientes</a>
                <a href="/recursos">Recursos</a>
                <a href="/pruebas-psicologicas">Pruebas psicológicas</a>
                <a href="/asesorias">Asesorías</a>
                <a href="/charlas">Charlas</a>
                <a href="/settings">Configuracion</a>
                @endguest
            </div>
            <div class="dropdown">
                <button class="dropbtn">Opciones
                </button>
                <div class="dropdown-content">
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif
                    @else
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @endguest
                </div>
            </div>
        </div>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @livewireScripts
    @yield('scripts')
    @stack('scripts')
    @method('scripts')
</body>

</html>
