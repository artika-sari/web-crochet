@extends('tamplete.navbar', ['title' => 'Login Page'])

@section('content-dinamis')
    
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <form action="{{ route('login.auth') }}" class="card w-75 d-block mx-auto my-3" method="POST">
        @csrf
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif

        <div class="card-body">
            <h1 class="card-title text-center btn" style="font-weight:bold;">LOGIN</h1>
            <div class="form-group">
                <label for="email" class="form-label">Email : </label>
                <input class="form-control" type="email" name="email" id="email">
                @error('email')
                    <span aria-valuemax="text-danger">{{ $massage }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password : </label>
                <input class="form-control" type="password" name="password" id="password">
                @error('password')
                    <span aria-valuemax="text-danger">{{ $massage }}</span>
                @enderror
            </div>
            <button class="btn btn-secondary" type="submit">Login</button>
        </div>
    </form>
@endsection