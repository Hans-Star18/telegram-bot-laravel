@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="card rounded-0 p-5">
            <div class="card-title text-center">
                <h3>Box Add</h3>
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
                <form action="{{ route('admin.box.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="box" class="form-label">Drawbox Name</label>
                        <input type="text" class="form-control" id="box" name="box">
                    </div>

                    <button type="submit" class="btn btn-outline-primary rounded-0 w-100 mb-3">Submit</button>
                    <a href="{{ route('admin.box.index') }}" class="btn btn-outline-danger rounded-0 w-100 mb-3">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
