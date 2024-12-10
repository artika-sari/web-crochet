@extends('tamplete.navbar', ['title' => 'Crochet List'])

@section('content-dinamis')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Crochets List</h2>
        <a href="{{ route('crochets.add') }}" class="btn btn-dark">+ Add List</a>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table table-striped text-center" style="cursor:default">
        <thead class="thead-dark">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Type</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if ($crochets->count() > 0)
                @foreach ($crochets as $index => $item)
                    <tr>
                        <td>{{ ($crochets->currentPage() - 1) * $crochets->perPage() + ($index + 1) }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['type'] }}</td>
                        <td>Rp. {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="{{ $item['stock'] <= 3 ? 'bg-danger text-white' : '' }}"
                            onclick="editStockModal('{{$item->id}}','{{$item->stock}}')">{{ $item['stock'] }}</td>
                        <td class="d-flex justify-content-center py-1 gap-2">
                            <a href="{{ route('crochets.edit', $item['id']) }}" class="btn btn-secondary">Edit</a>
                            <button type="submit" class="btn btn-danger" onclick="showModal('{{$item->id}}', '{{$item->name}}')">Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" class="font-weight-bold">Data is empty</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3">
        {{ $crochets->links() }}
    </div>
</div>

{{-- modal delete --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="delete-data" method="POST">
            @csrf
            @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="warning-delete" id="exampleModalLabel">Warning delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete <span id="name-crochet"></span> data
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModal(id, name) {
            let action = '{{ route("crochets.delete", ":id") }}';
            action = action.replace(':id', id);
            $('#delete-data').attr('action', action);
            $('#exampleModal').modal('show');
            $('#name-crochet').text(name);
        }
    </script>
@endpush