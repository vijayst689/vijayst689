@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Application</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">

                </div>
            </div>
           <!--end row-->

            <div class="card mt-4">
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
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table class="table align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Service Name</th>
                                        <th>Amount</th>
                                        <th>Customer Id</th>
                                        <th>User Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewservice as $key => $services)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $services->service_name }}
                                            </td>
                                            <td>{{ $services->amount }}</td>
                                            <td>{{ $services->customer_id }}</td>
                                            @if($services->retailer_id == 0)
                                            <td>{{ $services->distributor_id }}</td>
                                            @else
                                            <td>{{ $services->retailer_id }}</td>
                                            @endif

                                            
                                            <td style="white-space: nowrap">
                                                @if(Auth::user()->user_type_id == 2)
                                                <a href="{{ url('/viewapplication', $services->id) }}" style="font-size: small"
                                                    class="btn btn-grd btn-grd-branding px-1">View Application</a>
                                                    @else
                                                    <button disabled style="font-size: small"
                                                    class="btn btn-grd btn-grd-branding px-1">Application</button>
                                                    @endif
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    
@endpush
