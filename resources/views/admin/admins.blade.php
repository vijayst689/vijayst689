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
                    <h5 class="card-title">Admins</h5>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($admin as $key => $ad)
                                    <tr>
                                        <td>A{{ $ad->id }}</td>
                                        <td>
                                            <a class="d-flex align-items-center gap-3">
                                                <div class="customer-pic">
                                                    <img src="/upload/profile_photo/{{ $ad->profile }}"
                                                        class="rounded-circle" width="30" height="30" alt="">
                                                </div>
                                                <p class="mb-0 customer-name fw-bold">{{ $ad->name }}</p>
                                            </a>
                                        </td>
                                        <td>{{ $ad->phone }}</td>
                                        <td>{{ $ad->email }}</td>
                                        <td>{{ $ad->cpassword }}</td>
                                        <td><a href="{{ url('/userpermission', $ad->id) }}" type="button"
                                            style="font-size: small" class="btn-sm btn btn-info">Permission</a></td>
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
