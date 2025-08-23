@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
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
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <h5 class="card-title">Member Online</h5>
                        <div class="col-auto mb-2">

                            @if (Auth::user()->user_type_id == 1)
                                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                    <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addservice">Add</button>
                                </div>
                            @endif
                        </div>
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                aria-labelledby="custom-tabs-four-home-tab">
                                <div class="table-responsive" style="overflow-x: auto; ">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Services</th>
                                                <th>Amount</th>
                                                <th>Download</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($services as $key => $service)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $service->service_name }}</td>
                                                    <td>₹ {{ $service->pay_amount }}</td>
                                                    <td><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/fromimg/{{ $service->from_image }}"
                                                            class="btn-sm btn btn-success">Download</a></td>
                                                    <td>
                                                        @if ($service->action == 'Pay Now' && $rabalance->rawallet < $service->admin_amount)
                                                            <a class="btn btn-sm btn-info">Low Balance..Contact Admin</a>
                                                        @elseif($service->action == 'Pay Now' && $service->pay_amount <= $balance)
                                                            <a onclick="show_paynow('{{ $service->id }}','{{ $service->pay_amount }}','{{ $customers->id }}','{{ $customers->customer_user_type_id }}','{{ $customers->district }}','{{ $customers->taluk }}','{{ $service->admin_amount }}')"
                                                                class="btn btn-sm btn-info">{{ $service->pay_amount == '0' ? 'Free' : $service->action }}</a>
                                                        @elseif($service->action == 'Pay Now' && $service->pay_amount > $balance)
                                                            <a class="btn btn-sm btn-info">Low Balance</a>
                                                        @elseif($service->action == 'Upload Form' || $service->action == 'Resubmit Form')
                                                            <a onclick="show_image_upload('{{ $service->id }}','{{ $customers->id }}','{{ $customers->customer_user_type_id }}')"
                                                                class="btn btn-sm btn-info">{{ $service->action }}</a>
                                                        @elseif($service->action == 'Pending')
                                                            <a class="btn btn-sm btn-info">{{ $service->action }}</a>
                                                        @elseif($service->action == 'Waiting')
                                                            <a class="btn btn-sm btn-info">{{ $service->action }}</a>
                                                        @elseif($service->action == 'Completed' && $service->id == 1)
                                                            <a href="{{ URL::to('/') }}/upload/output/{{ $service->output_image }}"
                                                                class="btn btn-sm btn-info" download>Download</a>
                                                        @else
                                                            @if ($rabalance->rawallet < $service->admin_amount)
                                                                <a class="btn btn-sm btn-info">Low Balance..Contact
                                                                    Admin</a>
                                                            @elseif($service->pay_amount <= $balance)
                                                                <a onclick="show_paynow('{{ $service->id }}','{{ $service->pay_amount }}','{{ $customers->id }}','{{ $customers->customer_user_type_id }}','{{ $customers->district }}','{{ $customers->taluk }}','{{ $service->admin_amount }}')"
                                                                    class="btn btn-sm btn-info">{{ $service->pay_amount == '0' ? 'Free' : 'Next Form' }}</a>
                                                            @elseif($service->pay_amount > $balance)
                                                                <a class="btn btn-sm btn-info">Low Balance</a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-four-profile-tab">
                                <div class="table-responsive" style="overflow-x: auto; ">
                                    <form onsubmit="return validateqty()" method="post" action="{{ url('savebulkbuy') }}"
                                        id="form1">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="delivery_amount" id="deliveryamount">
                                        <table id="example2" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th> S No</th>
                                                    <th> Service</th>
                                                    <th style="text-align:right">Amount</th>
                                                    <th style="text-align:right">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align:right;font-weight:bold" colspan="2">Wallet
                                                        Amount:
                                                        ₹ <span id="wallet"></span></td>
                                                    <td style="text-align:right;font-weight:bold" colspan="2">Total
                                                        Amount: ₹
                                                        <span id="totamount"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <input type="submit" name="Submit" value="Submit" class="btn btn-primary"
                                                    id="submitbtn">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="paynow_modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Pay Now</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('/nalavariyam_servicepayment') }}" method="post" id="servicepay">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="service_id" name="service_id" value="">
                                    <input type="hidden" id="customer_id" name="customer_id" value="">
                                    <input type="hidden" id="customer_user_type_id" name="customer_user_type_id"
                                        value="">
                                    <input type="hidden" id="dist_id" name="dist_id" value="">
                                    <input type="hidden" id="taluk_id" name="taluk_id" value="">
                                    <input type="hidden" id="admin_amount" name="admin_amount">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Amount</label>
                                                    <div class="col-sm-8">
                                                        <input readonly name="pay_amount" id="pay_amount"
                                                            required="required" maxlength="50"
                                                            class="form-control number" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-bs-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" id="submitbtn" type="submit"
                                                    value="Submit" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="image_modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Upload Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form action="{{ url('/nalavariyam_createapplication') }}" method="post"
                                    enctype="multipart/form-data" id="serviceimage">
                                    <input type="hidden" id="imservice_id" name="imservice_id" value="">
                                    <input type="hidden" id="imcustomer_id" name="imcustomer_id" value="">
                                    <input type="hidden" id="imcustomer_user_type_id" name="imcustomer_user_type_id"
                                        value="">
                                    {{ csrf_field() }}
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label class="col-sm-4 col-form-label"><span
                                                            style="color:red">*</span>Image(800 x 1100)</label>
                                                    <div class="col-sm-8">
                                                        <input accept="image/png,image/jpeg,image/jpg" type="file"
                                                            name="photo" id="photo" required="required"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default"
                                                    data-bs-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" type="submit" value="Submit" />
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    </main>
@endsection
@push('page_scripts')
    <script>
        function show_paynow(service_id, pay_amount, customer_id, customer_user_type_id, dist_id, taluk_id, adminamount) {
            $("#service_id").val(service_id);
            $("#customer_id").val(customer_id);
            $("#customer_user_type_id").val(customer_user_type_id);
            $("#dist_id").val(dist_id);
            $("#taluk_id").val(taluk_id);
            $("#pay_amount").val(pay_amount);
            $("#admin_amount").val(adminamount);
            if (pay_amount == "0") {
                $("#paynow").html("Free");
                $("#submitbtn").val("Proceed");
            } else {
                $("#paynow").html("Pay Now");
                $("#submitbtn").val("Submit");
            }
            $("#paynow_modal").modal("show");
        }

        function show_image_upload(service_id, customer_id, customer_user_type_id) {
            $("#imservice_id").val(service_id);
            $("#imcustomer_id").val(customer_id);
            $("#imcustomer_user_type_id").val(customer_user_type_id);
            $("#image_modal").modal("show");
        }

        $('#servicepay').submit(function() {
            $("input[type='submit']", this)
                .val("Please Wait...")
                .attr('disabled', 'disabled');
            return true;
        });

        $('#serviceimage').submit(function() {
            $("input[type='submit']", this)
                .val("Please Wait...")
                .attr('disabled', 'disabled');
            return true;
        });
    </script>
@endpush
