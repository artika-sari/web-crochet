@extends('tamplete.navbar', ['title' => 'Order Data'])

@section('content-dinamis')
    <form action="{{ route('orders.store' )}}" method="POST" class="card d-block mx-auto my-3 p-5">
        @csrf
        <h1 class="tect-center">Make a new purchase</h1>
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        <div class="form-group">
            <label for="nameCustomer" class="form-label">Customer Name</label>
            <input type="text" name="name_customer" id="name_customer" class="form-control"
                value="{{ old('nameCustomer') }}">
            @error('nameCustomer')
                <small>{{ $masssage }}</small>
            @enderror
        </div>
        @if (old('crochets'))
            @foreach (old('crochets') as $no => $item)
                <div class="form-group" id="crochets-{{ $no }}" <label for="crochets" class="form-label">Crochet
                    {{ $no + 1 }}</label>
                    @if ($no > 0)
                        <span style="cursor: pointer; font-weight: bold; padding: 5px; color:brown;"
                            onclick="deleteSelect('crochets-{{ $no }}')">X</span>
                    @endif
                    <select name="crochets[]" id="crochets" class="form-select">
                        <option disabled selected hidden>SELECT</option>
                        @foreach ($crochets as $crochet)
                            <option value="{{ $crochet['id'] }}" {{ $item == $crochet['id'] ? 'selected' : '' }}>
                                {{ $crochet['name'] }} - Rp.
                                {{ number_format($crochet['price'], 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        @else
            <div class="form-group">
                <option disabled selected hidden>----PILIH----</option>
                <label for="crochets" class="form-label">Crochet 1 :</label>
                <select name="crochets[]" id="crochets" class="form-select">
                    @foreach ($crochets as $crochet)
                        <option value="{{ $crochet['id'] }}">{{ $crochet['name'] }} - Rp.
                            {{ number_format($crochet['price'], 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div id="crochets-more"></div>
            <span class="text-primary" style="font-weight:bold; cursor:pointer;" id="btn-more">+ Add</span>
            <button type="submit" class="btn btn-primary">Buy</button>
        </form>
@endsection


@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        let no = {{ old('crochets') ? count(old('crochets')) + 1 : 2 }};
        $("btn-more").on("click", function() {
            let elSelect = ` <div class="form-group" id="crochets-${no}"
                    <label for="crochets" class="form-label">Crochet ${no}</label>
                    <span style="cursor: pointer; font-weight: bold; padding: 5px; color:brown;" 
                    onclick="deleteSelect('crochets-${no}')">X</span>
                    <select name="crochets[]" id="crochet" class="form-select">
                        <option disabled selected hidden>SELECT</option>
                        @foreach ($crochets as $crochet)
                            <option value="{{ $crochet['id'] }}" >{{ $crochet['name'] }} - Rp.
                                {{ number_format($crochet['price'], 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>`
            $("#crochets-more").append(elSelect);
            no++;
        });

        function deleteSelect(elementId) {
            let elementIdForDelete = "#" + elementId;
            $(elementIdForDelete).remove();
            no--;
        }
    </script>
@endpush
