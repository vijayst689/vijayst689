@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('success') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                <h5 class="card-title mb-4">Bulk Orders</h5>

                        <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-hover align-middle shadow-sm rounded-3">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>S.No</th>
                                <th>District Name</th>
                                <th>Service Name</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Amount (₹)</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pending as $key => $bulkservice)
                            <tr>
                                <td class="text-center fw-semibold">{{ $key + 1 }}</td>
                                <td>{{ $bulkservice->district_name }}</td>
                                <td>{{ $bulkservice->service_name }}</td>
                                <td class="text-center">{{ $bulkservice->quantity }}</td>
                                <td class="text-end">{{ number_format($bulkservice->amount * $bulkservice->quantity, 2) }}</td>
                                <td class="text-center">
                                    @php
                                    $status = strtolower($bulkservice->status);
                                    @endphp
                                    @if ($status === 'paid')
                                    <span class="badge bg-success px-3 py-2">Paid</span>
                                    @elseif ($status === 'delivered')
                                    <span class="badge bg-primary px-3 py-2">Delivered</span>
                                    @else
                                    <span class="badge bg-secondary px-3 py-2 text-capitalize">{{ $bulkservice->status }}</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@push('page_scripts')
    <script>

    </script>
@endpush
