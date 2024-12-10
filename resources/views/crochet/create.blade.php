@extends('tamplete.navbar', ['title' => 'Create Data'])

@section('content-dinamis')
<div class="m-auto" style="width: 65%">
    <form class="p-4 mt-2" style="border: 1px solid black" action="{{ route('crochets.add') }}" method="POST" >
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
                <table for="name" class="form-label">Name</table>
                <input type="text" name="name" id="name" class="form-control" value=" {{ old('name') }} ">
            </div>
            <div>
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-select">
                    <option hidden selected disabled>Select Type</option>
                    <option value="keychain" {{ old('type') == 'keychain' ? 'selected' : '' }}>Keychain</option>
                    <option value="doll" {{ old('type') == 'doll' ? 'selected' : ' ' }}>Doll</option>
                    <option value="bag" {{ old('type') == 'bag' }}>Bag</option>
                </select>
            </div>
            <div>
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price')}}">
            </div>
            <div>
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name= "stock" id="stock" class="form-control" value="{{ old('stock')}}">
            </div>
            <button class="btn btn-dark mt-3">Send Data</button>
        </form>
        </div>
        </form>

    @endsection