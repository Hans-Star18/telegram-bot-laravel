@extends('layouts.main')

@push('style')
    <link rel="stylesheet" href="{{ asset('admins/assets/extensions/simple-datatables/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admins/assets/css/pages/simple-datatables.css') }}" />
@endpush

@section('content')
    <div class="page-content">
        <div class="card rounded-0 p-5">
            <div class="card-title text-center">
                <h3>Item List</h3>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <a href="{{ route('admin.items.add') }}" class="btn btn-sm btn-outline-primary rounded-0">Add New Item</a>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Box</th>
                            <th>Item</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr>
                                <td class="fw-bold fs-1">{{ $item->drawbox->box }}</td>
                                <td class="text-capitalize">{{ $item->item }}</td>
                                <td>
                                    <img src="{{ asset($item->image) }}" alt="item-image"
                                        class="img-responsive img-thumbnail" style="max-width: 200px;">
                                </td>
                                <td>
                                    <a href="{{ route('admin.items.edit', $item->id) }}"
                                        class="btn btn-sm btn-outline-success rounded-0 mb-3">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-0 mb-3">
                                            Delete
                                        </button>
                                    </form>
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
