@extends('tamplete.navbar', ['title' => 'Home Store'])

@section('content-dinamis')
@csrf
@if (Session::get('failed'))
    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif
    
<head>
    
    <style>
        .hero-section {
            background: #EEEEEE;
            background-size: cover;
            color: rgb(0, 0, 0);
            padding: 100px 0;
            min-height: 441px;
        }
    </style>
</head>
<body>
    @if (Auth::user()->role == 'customer')
   
    <section class="hero-section text-center">
        <div class="container">
            <h1>Welcome {{ Auth::user()->name }}!</h1>
            <p>Discover various interesting knitted works!</p>
            <a href="{{ route('orders') }}" class="btn btn-light btn-lg mt-3">Start Exploring</a>
        </div>
    </section>
    @endif
    
    @if (Auth::user()->role == 'admin')
    <section class="hero-section text-center">
        <div class="container">
            <h1>Welcome {{ Auth::user()->name }}!</h1>
            <p>Discover various interesting knitted works!</p>
            <a href="crochets" class="btn btn-light btn-lg mt-3">Start Exploring</a>
        </div>
    </section>
    @endif
    
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 Knitting Website. All Rights Reserved.</p>
    </footer>

    
</body>
</html>

@endsection