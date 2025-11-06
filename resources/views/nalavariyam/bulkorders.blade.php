@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolution.com</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--end breadcrumb-->
            <hr />
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
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th class="text-center" width="60">S.No</th>
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

@endsection
@push('page_scripts')
    <script>
       
    </script>
@endpush
