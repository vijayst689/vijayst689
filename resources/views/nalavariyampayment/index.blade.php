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
                @if (Auth::user()->user_type_id == 4 || Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 3)
                    <div class="ms-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#FormModal">Request Amount</button>
                        </div>
                    </div>
                @elseif (Auth::user()->user_type_id == 2)
                    <div class="ms-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addMoneyModal">Add
                                Money</button>
                        </div>
                    </div>
                @endif
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
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Sl No</th>
                                    <th>Date Time</th>
                                    <th>From ID</th>
                                    <th>To ID</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Available Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($raviewamount as $key => $am)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $am->paydate }}&nbsp;{{ $am->time }}</td>
                                        <td>{{ $am->from_id }}</td>
                                        <td>{{ $am->to_id }}</td>
                                        <td>{{ $am->service_status }}</td>
                                        <td>{{ $am->ad_info }}</td>
                                        @if ($am->service_status == 'Out Payment')
                                            <td class="text-danger">- {{ $am->amount }}</td>
                                            <td></td>
                                        @else
                                            <td></td>
                                            <td class="text-success">+ {{ $am->amount }}</td>
                                        @endif
                                        <td>{{ $am->newbalance }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td></td>
                                <td>{{ Auth::user()->nalavariyamwallet }}</td>
                            </tr>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="FormModal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                        <h5 class="modal-title">Request Amount</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                        <form method="post" class="row g-3" action="{{ url('/saverequest') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <label for="input1" class="form-label">Request Amount</label>
                                <input type="text" name="amount" maxlength="5" class="form-control number"
                                    placeholder="Amount">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Paid Image (Screen)</label>
                                <input type="file" name="req_image" class="form-control">
                            </div>

                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <div class="modal fade" id="addMoneyModal" tabindex="-1" aria-labelledby="addMoneyModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addMoneyModalLabel">Add Money to Wallet</h5>
                                <button type="button" class="btn-close " data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            {{-- Form with file upload --}}
                            <form action="{{ url('/nalavariyam/wallet/add') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Enter Amount</label>
                                        <input type="number" name="amount" id="amount" class="form-control"
                                            placeholder="Enter amount" required min="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="proof" class="form-label">Upload Payment Proof</label>
                                        <input type="file" name="proof" id="proof" class="form-control"
                                            accept="image/*,application/pdf" required>
                                        <small class="text-muted">Accepted: JPG, PNG, PDF</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add Money</button>
                                </div>
                            </form>
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
