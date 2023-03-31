@extends('layouts.main')

@push('style')
    <link rel="stylesheet" href="{{ asset('admins/assets/extensions/simple-datatables/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admins/assets/css/pages/simple-datatables.css') }}" />
@endpush

@section('content')
    <div class="page-content">
        <div class="card rounded-0 p-5">
            <div class="card-title text-center">
                <h3>Box List</h3>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <a href="{{ route('admin.box.add') }}" class="btn btn-sm btn-outline-primary rounded-0">Add New Box</a>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Item Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($boxs as $box)
                            <tr>
                                <td>{{ $box->box }}</td>
                                <td>{{ $box->boxItems->count() }}</td>
                                <td>
                                    <a href="{{ route('admin.box.edit', $box->id) }}"
                                        class="btn btn-sm btn-outline-success rounded-0 mb-3">
                                        Edit
                                    </a>
                                    {{-- <form action="{{ route('admin.box.destroy', $box->id) }}" method="post"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-0 mb-3">
                                            Delete
                                        </button>
                                    </form> --}}
                                    <a href="{{ route('admin.box.show', $box->id) }}"
                                        class="btn btn-sm btn-outline-dark rounded-0 mb-3">
                                        Show Items
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('admins/assets/extensions/simple-datatables/umd/simple-datatables.js') }}"></script>
    <script src="{{ asset('admins/assets/js/pages/simple-datatables.js') }}"></script>
@endpush
