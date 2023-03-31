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

            <div class="card-body">
                <a href="" class="btn btn-sm btn-outline-primary rounded-0">Add New Box</a>
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
                                    <a href="" class="btn btn-sm btn-outline-primary rounded-0 mb-3">Detail</a>
                                    <a href="" class="btn btn-sm btn-outline-success rounded-0 mb-3">Edit</a>
                                    <a href="" class="btn btn-sm btn-outline-danger rounded-0 mb-3">Delete</a>
                                    <a href="" class="btn btn-sm btn-outline-dark rounded-0 mb-3">Show Items</a>
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
