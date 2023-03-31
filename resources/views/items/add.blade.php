@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="card rounded-0 p-5">
            <div class="card-title text-center">
                <h3>Item Add</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="drawbox-id" class="form-label">Drawbox</label>
                        <select class="form-select" id="drawbox-id" name="drawbox_id">
                            <option value="">Select drawbox</option>
                            @foreach ($boxs as $box)
                                <option value="{{ $box->id }}">{{ $box->box }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="item" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="item" name="item">
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Item Image</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>

                    <button type="submit" class="btn btn-outline-primary rounded-0 w-100 mb-3">Submit</button>
                    <a href="{{ route('admin.items.index') }}" class="btn btn-outline-danger rounded-0 w-100 mb-3">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
