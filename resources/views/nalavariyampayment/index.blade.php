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
    <div class="modal fade" id="addMoneyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Header -->
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    💰 Add Money to Wallet
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body px-4 pb-4">

                <!-- Wallet Info Card -->
                <div class="bg-light rounded-4 p-3 mb-4 d-flex justify-content-between align-items-center shadow-sm">
                    <div>
                        <small class="text-muted">Current Balance</small>
                        <h3 class="fw-bold text-success mb-0">
                            ₹ {{ Auth::user()->nalavariyamwallet ?? 0 }}
                        </h3>
                    </div>
                    <div class="text-end">
                        <small class="text-muted">Welcome</small><br>
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>
                </div>

                <!-- Trouble Alert -->
                <div class="alert alert-warning border-0 rounded-3 text-center py-2 small">
                    ⚠️ Facing issues with online payment?
                    <a href="#" class="fw-bold text-danger text-decoration-none switchToManual">
                        Switch to Manual Payment
                    </a>
                </div>

                <!-- Tabs -->
                <ul class="nav nav-pills nav-justified mb-4 bg-light rounded-pill p-1">
                    <li class="nav-item">
                        <button class="nav-link active rounded-pill fw-semibold"
                            data-bs-toggle="pill"
                            data-bs-target="#onlineTab">
                            💳 Online Payment
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link rounded-pill fw-semibold"
                            data-bs-toggle="pill"
                            data-bs-target="#manualTab">
                            📸 Manual Payment
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    <!-- ================= ONLINE PAYMENT ================= -->
                    <div class="tab-pane fade show active" id="onlineTab">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Enter Amount</label>
                            <input type="number"
                                class="form-control form-control-lg rounded-3 border-warning amountInput"
                                placeholder="Enter amount"
                                min="1">
                        </div>

                        <!-- Quick Amount Buttons -->
                        <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                            @foreach([50,100,300,500,1000,2000,5000] as $amt)
                            <button type="button"
                                class="btn btn-outline-primary rounded-pill px-4 quick-amount"
                                data-amount="{{ $amt }}">
                                ₹{{ $amt }}
                            </button>
                            @endforeach
                        </div>

                        <form method="POST"
                            action="{{ route('nalavariyamonline.create') }}"
                            class="onlinePaymentForm">
                            @csrf
                            <input type="hidden" name="mobile" value="{{ Auth::user()->mobile }}">
                            <input type="hidden" name="amount" class="finalAmount">

                            <button type="submit"
                                class="btn btn-primary btn-lg w-100 rounded-3 payBtn"
                                disabled>
                                <span class="payBtnText">➕ Pay Securely</span>
                                <span class="spinner-border spinner-border-sm d-none payLoader"></span>
                            </button>
                        </form>

                    </div>

                    <!-- ================= MANUAL PAYMENT ================= -->
                    <div class="tab-pane fade" id="manualTab">
<div class="text-center mb-3">
                                    <img src="/upload/qr/qrimgramji.jpeg" alt="QR Code"
                                        class="img-fluid"
                                        style="max-width:300px">
                                </div>

                        <form method="POST"
                            action="{{ url('/nalavariyam/wallet/add') }}"
                            enctype="multipart/form-data"
                            class="mt-3">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Amount</label>
                                    <input type="number"
                                        name="amount"
                                        class="form-control rounded-3 border-warning"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Upload Proof</label>
                                    <input type="file"
                                        name="proof"
                                        class="form-control rounded-3"
                                        accept="image/*,application/pdf"
                                        required>
                                </div>
                            </div>

                            <button type="submit"
                                class="btn btn-success btn-lg w-100 rounded-3">
                                📤 Submit Manual Request
                            </button>
                        </form>

                    </div>

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
