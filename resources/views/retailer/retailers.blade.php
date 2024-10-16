@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Retailers Details</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-auto">
                    <div class="position-relative">
                        <input class="form-control px-5" type="search" placeholder="Search">
                        <span
                            class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                    </div>
                </div>
                <div class="col-auto flex-grow-1 overflow-auto">
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <a href="{{ url('addretailer') }}" class="btn btn-primary px-4"><i
                                class="bi bi-plus-lg me-2"></i>Add Retailer</a>
                    </div>
                </div>
            </div><!--end row-->

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
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Password</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewretailers as $key => $cus)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $cus->name }}</td>
                                            <td>{{ $cus->phone }}</td>
                                            <td>{{ $cus->email }}</td>
                                            <td><img src="/upload/profile_photo/{{ $cus->profile }}"
                                                class="rounded-circle" width="40" height="40"
                                                alt=""></td>
                                            <td>{{ $cus->cpassword }}</td>
                                            <td>
                                                <a onclick="return confirm('Do you want to confirm delete retailer?')"
                                                href="{{ url('/dropretailer', $cus->id) }}" type="button"
                                                style="font-size: small"
                                                class="btn btn-inverse-danger px-1">Drop</a>
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
