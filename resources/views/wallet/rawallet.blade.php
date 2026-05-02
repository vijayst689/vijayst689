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
                @if (Auth::user()->user_type_id == 2)
                    <div class="ms-auto">
                        <div class="btn-group">
                            <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#ramjirequest">Add Money</button>
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
                    <form method="GET" action="{{ url()->current() }}">
                        <div class="row g-2 align-items-end mb-3">

                            <div class="col-md-3">
                                <label class="form-label">From Date</label>
                                <input type="date" name="from_date" value="{{ request('from_date') }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">To Date</label>
                                <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Quick Filter</label>
                                <select class="form-select" onchange="applyQuickFilter(this.value)">
                                    <option value="">-- Select --</option>
                                    <option value="today">Today</option>
                                    <option value="7days">Last 7 Days</option>
                                    <option value="month">This Month</option>
                                </select>
                            </div>

                            <div class="col-md-2 d-grid">
                                <button class="btn btn-primary">Filter</button>
                            </div>

                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
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
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total</td>
                                <td></td>
                                <td>{{ Auth::user()->rawallet }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="col-md-6">
            <div class="card-body">
                <div class="modal fade" id="ramjirequest" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">

                            <!-- Header -->
                            <div class="modal-header">
                                <h5 class="modal-title">Add Money to Apiwallet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <!-- Wallet Info -->
                                <div class="d-flex justify-content-between mb-3">
                                    <div>
                                        <small class="text-muted">Wallet Balance</small>
                                        <h4>₹ {{ Auth::user()->rawallet ?? 0 }}</h4>
                                    </div>
                                    <div class="text-end">
                                        <small>Welcome</small><br>
                                        <strong>{{ Auth::user()->name }}</strong>
                                    </div>
                                </div>

                                <div class="alert alert-warning text-center mt-3 py-2">
                                    <strong>⚠️ Having trouble with online payment?</strong><br>
                                    Please use
                                    <a href="#" class="fw-bold text-decoration-underline text-danger switchToManual">
                                        Manual Payment
                                    </a>
                                </div>


                                <!-- Tabs -->
                                <ul class="nav nav-pills mb-3 justify-content-center" role="tablist">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="pill"
                                            data-bs-target="#ramji_onlineTab">
                                            💳 Online Payment
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#ramji_manualTab">
                                            📸 Manual Payment
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content">

                                    <!-- ================= ONLINE PAYMENT ================= -->
                                    <div class="tab-pane fade show active" id="ramji_onlineTab">

                                        <div class="mb-3">
                                            <label class="form-label">Enter Amount (Min ₹50)</label>
                                            <input type="number" id="amountInput"
                                                class="form-control border-warning amountInput" min="50">
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 justify-content-center mb-3">
                                            @foreach ([50, 100, 300, 500, 1000, 2000, 5000] as $amt)
                                                <button type="button" class="btn btn-outline-primary quick-amount"
                                                    data-amount="{{ $amt }}">
                                                    ₹{{ $amt }}
                                                </button>
                                            @endforeach
                                        </div>

                                        <form method="POST" action="{{ route('ramjionline.create') }}"
                                            class="onlinePaymentForm">
                                            @csrf
                                            <input type="hidden" name="mobile" value="{{ Auth::user()->mobile }}">
                                            <input type="hidden" name="amount" id="finalAmount" class="finalAmount">

                                            <button type="submit" class="btn btn-primary w-100 payBtn" id="payBtn"
                                                disabled>
                                                <span class="payBtnText">➕ Pay Online</span>
                                                <span id="payLoader"
                                                    class="spinner-border spinner-border-sm d-none payLoader"></span>
                                            </button>
                                        </form>

                                    </div>

                                    <!-- ================= MANUAL PAYMENT ================= -->
                                    <div class="tab-pane fade" id="ramji_manualTab">

                                        <div class="text-center mb-3">
                                            <img src="/upload/qr/qrimgramji.jpeg" alt="QR Code" class="img-fluid"
                                                style="max-width:300px">
                                        </div>

                                        <form method="POST" action="{{ url('/ramjisaverequest') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Amount</label>
                                                    <input type="number" name="amount"
                                                        class="form-control  border-warning" required>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Payment Screenshot</label>
                                                    <input type="file" name="req_image" class="form-control" required>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-success w-100">
                                                📤 Submit Manual Request
                                            </button>
                                        </form>

                                    </div>

                                </div>
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
                    function applyQuickFilter(type) {
            let from = document.querySelector('[name="from_date"]');
            let to = document.querySelector('[name="to_date"]');

            let today = new Date();
            let yyyy = today.getFullYear();
            let mm = String(today.getMonth() + 1).padStart(2, '0');
            let dd = String(today.getDate()).padStart(2, '0');

            if (type === 'today') {
                from.value = `${yyyy}-${mm}-${dd}`;
                to.value = `${yyyy}-${mm}-${dd}`;
            }

            if (type === '7days') {
                let prev = new Date();
                prev.setDate(today.getDate() - 7);
                from.value = prev.toISOString().slice(0, 10);
                to.value = today.toISOString().slice(0, 10);
            }

            if (type === 'month') {
                from.value = `${yyyy}-${mm}-01`;
                to.value = `${yyyy}-${mm}-${dd}`;
            }
        }
        </script>
    @endpush
