@extends('tamplete.navbar', ['title' => 'User Data'])

@section('content-dinamis')
    <div class="container my-5">
        <div class="d-flex justify-content-between align-item-center mb-3">
            <h2>Management Accounts</h2>
            <a href="{{ route('users.add') }} " class="btn btn-dark">+ Add Account</a>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        <table class="table table-striped text-center" style="cursor: default:">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Name User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($user) > 0)
                    @foreach ($user as $index => $item)
                        <tr>
                            <td> {{ ($user->currentPage()-1) * $user->perPage() + ($index + 1) }} </td>
                            <td> {{ $item['name'] }} </td>
                            <td> {{ $item['email'] }} </td>
                            <td> {{ $item['role'] }} </td>
                            <td>
                                <a href="{{ route('users.edit', $item['id']) }}" class="btn btn-secondary">Edit</a>
                                <a class="btn btn-danger" onclick="showModal( '{{ $item-> id }}', '{{ $item->name }}' )">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-delete-user" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="warning-delete" id="exampleModalLabel">Warning delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <span id="name-user"></span> data
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
        let action = '{{ route('users.delete', ':id') }}';
        action = action.replace(':id', id);
        $('#form-delete-user').attr('action', action);
        $('#exampleModal').modal('show');
        $('#name-user'). text(name);
    }
</script>
@endpush