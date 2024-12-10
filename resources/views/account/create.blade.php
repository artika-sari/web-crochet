@extends('tamplete.navbar', ['title' => 'Create user Data'])

@section('content-dinamis')
    <div class="m-auto" style="width: 65%">
        <form action="" class="p-4 mt-2" style="border: 1px solid black" action="{{ route('users.add.store') }}" method="POST">
            @if (Session::get ('failed'))
                <div class="alert alert-danger">{{Session::get('failed')}}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf

            <div>
                <label for="name" class="form-label">Account Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div>
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
            </div>
            <div>
                <label for="role" class="form-label">Account Role</label>
                <select name="role" id="role" class="form-select">
                    <option hidden selected disabled>Select Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }} >Customer</option>
                </select>
            </div>
            <div>
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" id="password" class="form-control" value="{{ old('password') }}">
            </div>

            <button class="btn btn-dark mt-3">Send Data</button>
        </form>
    </div>
@endsection