<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/yarn.jpeg') }}">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @stack('style')
</head>


<body style="background-color: #EEEEEE">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="backround-color: #184A45FF">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Crochet Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        @if (Auth::check())
                            
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" aria-current="page" 
                        href="{{ route('home') }}">Home</a>
                    </li>
                    @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('crochets') ? 'active' : '' }}"
                        href="{{ route('crochets') }}">Store Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('users') ? 'active' : '' }}" href="{{ route('users') }}">Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orders.admin') }}" class="nav-link">Purchase Data</a>
                    </li>
                    @endif
                    @if (Auth::user()->role == 'customer')
                        <li class="nav-item">
                            <a href="{{ route('orders') }}" class="nav-link">Purchase</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                    </li>
                </ul>
                @if (Route::is('crochets'))
                <form class="d-flex" role="search" action="{{ route('crochets')}}" method="GET">
                    @else
                    <form class="d-flex" role="search" method="GET" action="{{ route('users')}}">
                        @endif
                        
                        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" name="search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>
                    @endif
                </div>
        </div>
    </nav>

    @yield('content-dinamis')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    @stack('script')
</body>

</html>
