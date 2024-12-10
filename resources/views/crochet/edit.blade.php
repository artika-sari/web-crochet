@extends('tamplete.navbar', ['title' => 'Edit Data'])

@section('content-dinamis')
    <form action="{{ route('crochets.edit.update', $crochet['id']) }}" method="POST" class="m-auto" style="width: 65%">
        @if (Session::get ('failed'))
            <div class="alert alert-danger">{{ Session::get ('failed') }}</div>
        @endif
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $crochet['name'] }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select">
                <option hidden selected disabled>Select Type</option>
                <option value="keychain" {{ $crochet['type'] == 'keychain' ? 'selected' : '' }}>Keychain</option>
                <option value="doll" {{ $crochet['type'] == 'doll' ? 'selected' : '' }}>Doll</option>
                <option value="bag" {{ $crochet['type'] == 'bag' ? 'selected' : '' }}>Bag</option>
            </select>
            @error('type')
                <small class="text-danger">{{ $massage }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $crochet['price'] }}">
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="stock" class="form-label">Stock</label>
            <input type="text" name="stock" id="stock" class="form-control" value="{{ $crochet['stock'] }}">
            @error('stock')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-dark m-3">Send Data</button>
    </form>
@endsection