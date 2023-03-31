@extends('layouts.main')

@push('style')
    <link rel="stylesheet" href="{{ asset('admins/assets/extensions/simple-datatables/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admins/assets/css/pages/simple-datatables.css') }}" />
@endpush

@section('content')
    <div class="page-content">
        <div class="card rounded-0 p-5">
            <div class="card-title text-center">
                <h3>Report List</h3>
            </div>

            <div class="card-body">
                <a href="{{ route('admin.reports.export') }}" class="btn btn-sm btn-outline-success rounded-0">Recap Excel</a>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Token</th>
                            <th>Prize</th>
                            <th>Date Used</th>
                            <th>Time Used</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td>{{ $report->token->token }}</td>
                                <td>{{ $report->item->item }}</td>
                                <td>{{ $report->created_at->format('d-m-Y') }}</td>
                                <td>{{ $report->created_at->format('H : i') }}</td>
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
