@extends('layouts.main')

@section('content')
    <div class="page-content">
        <div class="card rounded-0 p-5">
            <div class="card-title text-center">
                <h3>Box {{ $drawbox->box }}</h3>
            </div>

            <div class="card-body">
                <h3 class="mb-3">Drawbox {{ $drawbox->box }}</h3>

                <div class="row">
                    @forelse ($drawbox->boxItems as $item)
                        <div class="col-lg-4 shadow-sm">
                            <div class="card rounded-0">
                                <img src="{{ asset($item->image) }}" class="card-img-top rounded-0" alt="box-item">
                                <div class="card-body">
                                    <h5 class="card-title text-capitalize">{{ $item->item }}</h5>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-lg-12">
                            <h3 class="text-center">
                                Item not found! <a href="{{ route('admin.items.add') }}">add Item</a>
                            </h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
