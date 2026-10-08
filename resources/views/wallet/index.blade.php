@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
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
                    <h5 class="card-title">Wallet Details</h5>
                    <div class="col-auto mb-2">
                        @if (Auth::user()->user_type_id == 4 || Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 3)
                            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                <button type="button" class="btn-sm btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#requestamount">Request Amount</button>
                            </div>
                        @elseif (Auth::user()->user_type_id == 2)
                            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#addmoney">Add Payment</button>
                            </div>
                        @endif
                    </div>
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
                        <table id="datatable" class="table table-bordered">
                            <thead>
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
                                @foreach ($viewamount as $key => $am)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $am->paydate }}&nbsp;{{ $am->time }}</td>
                                        <td>{{ $am->from_id }}</td>
                                        <td>{{ $am->to_id }}</td>
                                        <td>{{ $am->ad_info }}</td>
                                        <td>{{ $am->service_status }}</td>
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
                                <td></td>
                                <td>Total</td>
                                <td>{{ Auth::user()->wallet }}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="addmoney" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Payment</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="post" class="row g-3" action="{{ url('/adminaddwallet') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input required name="wallet" maxlength="6" type="text" class="form-control"
                                    placeholder="Amount">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="requestamount" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Wallet Request</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="form-body">
                            <form method="post" class="row g-3" action="{{ url('/saverequest') }}"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img src="/upload/qrimage/{{ $qrlabel->qrimage }}" class="img-fluid" alt="...">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Amount</label>
                                            <input required name="amount" type="text" maxlength="6" class="form-control number"
                                                placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Paid Image (Screen)</label>
                                            <input required type="file" name="req_image" class="form-control" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-3">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="Submit" class="btn btn-primary">Submit</button>
                                </div>
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
