<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite('resources/css/app.css')
</head>

<body>
    <div id="app">
        <!-- Navbar -->
        <div class="navbar bg-base-100 shadow-lg">
            <div class="navbar-start">
                <!-- Dropdown Menu for Small Screens -->
                <div class="dropdown">
                    <button tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </button>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-10 mt-3 w-52 p-2 shadow">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        @if (Auth::user()->peran == 'admin')
                            <li><a href="{{ route('user') }}">Pengguna</a></li>
                        @endif
                        <li><a href="{{ route('produk') }}">Produk</a></li>
                        <li><a href="{{ route('transaksi') }}">Transaksi</a></li>
                        <li><a href="{{ route('laporan') }}">Laporan</a></li>
                    </ul>
                </div>
                <a class="btn btn-ghost normal-case text-xl" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="{{ route('home') }}">Beranda</a></li>
                    @if (Auth::user()->peran == 'admin')
                        <li><a href="{{ route('user') }}">Pengguna</a></li>
                    @endif
                    <li><a href="{{ route('produk') }}">Produk</a></li>
                    <li><a href="{{ route('transaksi') }}">Transaksi</a></li>
                    <li><a href="{{ route('laporan') }}">Laporan</a></li>
                </ul>
            </div>
            <div class="navbar-end">
                @guest
                    @if (Route::has('login'))
                        <a class="btn btn-primary mx-1" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                    @if (Route::has('register'))
                        <a class="btn btn-outline-primary mx-1" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <div class="dropdown dropdown-end">
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="User Avatar" />
                            </div>
                        </label>
                        <ul tabindex="0" class="menu dropdown-content mt-3 bg-base-100 rounded-box w-52 z-50 shadow">
                            <li>
                                <a class="justify-between">
                                    {{ Auth::user()->name }}
                                    <span class="badge">New</span>
                                </a>
                            </li>
                            <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>
                        </ul>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>

        <!-- Main Content -->
        <main class="py-4">
            <div class="container">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
