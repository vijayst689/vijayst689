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
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ url('addcustomer') }}"class="btn btn-info"><i
                                class="bi bi-chat me-2"></i>Add Customers</a>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Customers</h5>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    {{-- <th>Email</th>
                                    <th>Password</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($viewcustomers as $key => $cus)
                                    <tr>
                                        <td>C{{ $cus->id }}</td>
                                        <td>
                                            <a class="d-flex align-items-center gap-3" href="{{ url('profile') }}">
                                                <div class="customer-pic">
                                                    <img src="/upload/users/profile_photo/{{ $cus->profile }}"
                                                        class="rounded-circle" width="30" height="30" alt="">
                                                </div>
                                                <p class="mb-0 customer-name fw-bold">{{ $cus->name }}</p>
                                            </a>
                                        </td>
                                        <td>{{ $cus->phone }}</td>
                                        {{-- <td>{{ $cus->email }}</td>
                                        <td>{{ $cus->cpassword }}</td> --}}
                                        <td style="white-space: nowrap">

                                            <a href="{{ url('/editcustomer', $cus->id) }}" style="font-size: small"
                                                class="btn-sm btn btn-primary">Edit</a>

                                            <a href="{{ url('/services/1', $cus->id) }}" style="font-size: small"
                                                class="btn-sm btn btn-warning">TNEGA</a>

                                            <a href="{{ url('/documents', $cus->id) }}" style="font-size: small"
                                                class="btn-sm btn btn-success">Document</a>
                                        </td>
                                    </tr>
                                     @endforeach
                            </tbody>

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
