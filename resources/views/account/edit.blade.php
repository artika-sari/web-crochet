@extends('tamplete.navbar', ['title' => 'Edit Account'])

@section('content-dinamis')
    <form action=" {{ route('users.edit.update', $user['id']) }} " method="POST" style="width: 65%" class="m-auto">
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user['name'] }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="role" class="form-label">Account Role</label>
            <select name="role" id="role" class="form-select">
                <option hidden selected disabled>Select Role</option>
                <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="customer" {{ $user['role'] == 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="{{ $user['email'] }}">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input type="text" name="password" id="password" class="form-control">
            @error('[password]')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-dark mt-3">Send Data</button>
    </form>
@endsection