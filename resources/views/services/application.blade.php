@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
                <div class="card-body">
                    <h5 class="card-title">Application</h5>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead class="table-light">
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
                                        @if ($services->retailer_id == 0)
                                            <td>{{ $services->distributor_id }}</td>
                                        @else
                                            <td>{{ $services->retailer_id }}</td>
                                        @endif
                                        <td style="white-space: nowrap">
                                            @if (Auth::user()->user_type_id == 2)
                                                <a href="{{ url('/viewapplication', $services->id) }}"
                                                    style="font-size: small" class="btn btn-grd btn-grd-branding px-1">View
                                                    Application</a>
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
@endsection
@push('page_scripts')
    <script></script>
@endpush
