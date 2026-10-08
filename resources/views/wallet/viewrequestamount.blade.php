@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Request Amount</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                        <button type="button"
                            class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                                href="javascript:;">Action</a>
                            <a class="dropdown-item" href="javascript:;">Another action</a>
                            <a class="dropdown-item" href="javascript:;">Something else here</a>
                            <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated
                                link</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-auto">
                    <div class="position-relative">
                        <input class="form-control px-5" type="search" placeholder="Search Customers">
                        <span
                            class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <button type="button" class="btn btn-grd-primary px-4" data-bs-toggle="modal"
                            data-bs-target="#FormModal">Request Amount</button>
                    </div>
                </div>
                {{-- <div class="col-auto">
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <a href="{{ url('addcustomer') }}" class="btn btn-primary px-4"><i
                                class="bi bi-plus-lg me-2"></i>Add Customers</a>
                    </div>
                </div> --}}
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
                                        <th>DateTime</th>
                                        <th>UserId</th>
                                        <th>Title</th>
                                        <th>Details</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($viewcustomers as $key => $cus)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $cus->name }}</td>
                                            <td>{{ $cus->phone }}</td>
                                            <td>{{ $cus->email }}</td>
                                            <td>{{ $cus->cpassword }}</td>
                                            <td><img src="/upload/profile_photo/{{ $cus->profile }}" class="rounded-circle"
                                                    width="40" height="40" alt=""></td>
                                            <td style="white-space: nowrap">

                                                <a onclick="edit_customer('{{ $cus->id }}','{{ $cus->name }}','{{ $cus->phone }}','{{ $cus->aadhaar_no }}','{{ $cus->gender }}','{{ $cus->email }}','{{ $cus->date_of_birth }}','{{ $cus->address }}','{{ $cus->status }}')"
                                                    class="btn btn-grd btn-grd-voilet px-1">Edit</a>

                                                <a onclick="return confirm('Do you want to confirm delete customer?')"
                                                    href="{{ url('/dropcustomer', $cus->id) }}"
                                                    class="btn btn-danger px-1">Drop</a>

                                                <a href="{{ url('/service', $cus->id) }}"
                                                    class="btn btn-warning px-1">Service</a>
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach --}}
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="FormModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                    <h5 class="modal-title">Request Amount</h5>
                                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                        <i class="material-icons-outlined">close</i>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <div class="form-body">
                                        <form class="row g-3" action="{{ url('/saverequest') }}" method="post" enctype="multipart/form-data">
                                            <center>
                                                    <img style="width:200px"
                                                        src="{{ URL::to('/') }}/upload/profile_photo/" />
                                                         <input type="hidden" class="form-control" name="to_id"
                                                            value="{">
                                            </center>
                                            <div class="col-md-12">
                                                <label for="input11" class="form-label">Request Amount</label>
                                                <input type="text" class="form-control" id="input11" placeholder="Request Amount">
                                            </div>
                                            <div class="col-md-12">
                                                <label for="input11" class="form-label">Paid Image(ScreenShot)</label>
                                                <input type="file" class="form-control" id="input11" placeholder="Request Amount">
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-md-flex d-grid align-items-center gap-3">
                                                    <button type="button" class="btn btn-grd-danger px-4">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>

    </script>
@endpush
