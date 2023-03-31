@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="card rounded-0 p-5">
            <div class="card-title text-center">
                <h3>Token Edit</h3>
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
                <form action="{{ route('admin.tokens.update', $token->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="token" class="form-label">Token</label>
                        <input type="text" class="form-control" id="token" name="token"
                            value="{{ $token->token }}">
                    </div>

                    <div class="mb-3">
                        <label for="chance" class="form-label">Chance</label>
                        <input type="number" class="form-control" id="chance" name="chance"
                            value="{{ $token->chance }}">
                    </div>

                    <div class="mb-3">
                        <label for="drawbox-id" class="form-label">Box</label>
                        <select name="drawbox_id" id="drawbox-id" class="form-select">
                            @foreach ($boxs as $box)
                                <option value="{{ $box->id }}" {{ $token->drawbox_id == $box->id ? 'selected' : '' }}>
                                    {{ $box->box }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-outline-primary rounded-0 w-100 mb-3">Submit</button>
                    <a href="{{ route('admin.tokens.index') }}" class="btn btn-outline-danger rounded-0 w-100 mb-3">
                        Cancel
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
