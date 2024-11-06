@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Wallet Details</div>
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
                        <input class="form-control px-5" type="search" placeholder="Search Customers">
                        <span
                            class="material-icons-outlined position-absolute ms-3 translate-middle-y start-0 top-50 fs-5">search</span>
                    </div>
                </div>
                <div class="col-auto flex-grow-1 overflow-auto">
                </div>
                <div class="col-auto">
                    @if( Auth::user()->user_type_id == 4 || Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 3 )
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <button type="button" class="btn btn-grd-primary px-4" data-bs-toggle="modal"
                            data-bs-target="#FormModal">Request Amount</button>
                    </div>
                    @elseif ( Auth::user()->user_type_id == 2 )
                    <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                        <button type="button" class="btn btn-grd-primary px-4" data-bs-toggle="modal"
                            data-bs-target="#addmoney">Add Payment</button>
                    </div>
                    @endif
                </div>
            </div>

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
                                        <th>Date Time</th>
                                        <th>From ID</th>
                                        <th>To ID</th>
                                        <th>Title</th>
                                         <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($viewamount as $key => $am)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $am->paydate }}&nbsp;{{ $am->time }}</td>
                                            <td>{{ $am->from_id }}</td>
                                            <td>{{ $am->to_id }}</td>
                                            <td>{{ $am->ad_info }}</td>
                                             @if ($am->service_status == 'Out Payment')
                                                    <td class="text-danger">- {{ $am->amount }}</td>
                                                    <td></td>
                                                @else
                                                    <td></td>
                                                    <td class="text-success">+ {{ $am->amount }}</td>
                                                @endif
                                            <td>{{ $am->service_status }}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                                <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{ Auth::user()->wallet }}</td>
                                        <td></td>

                                    </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="FormModal" style="display: none;" aria-hidden="true">
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
                        <div class="card-body">
                            <h5 class="card-title mb-4"></h5>
                            <div class="col">
                                <div class="card-body">
                                    <div class="text-center">
                                        <img src="upload/qr/qrimg.jpeg" class="w-50 mb-4 rounded" alt="...">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post" class="row g-3" action="{{ url('/saverequest') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Request Amount</label>
                            <input type="text" name="amount" maxlength="5" class="form-control number" placeholder="Amount">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Paid Image (Screen)</label>
                            <input type="file" name="req_image" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-grd-danger px-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addmoney" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                    <h5 class="modal-title">Add Payment</h5>
                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                        <i class="material-icons-outlined">close</i>
                    </a>
                </div>
                <div class="modal-body">
                    <form method="post" class="row g-3" action="{{ url('/adminaddwallet') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                            <label class="form-label">Add Money</label>
                            <input type="text" maxlength="5" placeholder="Amount" name="wallet" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-grd-danger px-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('page_scripts')
    <script>
        function edit_customer(id, name, phone, aadhaar_no, gender, email, date_of_birth, address, status) {
            $("#editname").val(name);
            $("#editphone").val(phone);
            $("#editadhar").val(aadhaar_no);
            $("#editgender").val(gender);
            $("#editemail").val(email);
            $("#editdob").val(date_of_birth);
            $("#editaddress").val(address);
            $("#editstatus").val(status);
            $("#cusid").val(id);
            $("#editcustomer").modal("show");
        }
    </script>
@endpush
