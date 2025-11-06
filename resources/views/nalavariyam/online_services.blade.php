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
            </div>
            @endif
            <h5 class="card-title">Customer Online</h5>
            <div class="col-auto mb-2">

                @if (Auth::user()->user_type_id == 1)
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addservice">Add</button>
                </div>
                @endif
            </div>
            <ul class="nav nav-tabs mb-3 border-0 shadow-sm bg-white rounded-3 p-2" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold text-primary" id="custom-tabs-four-home-tab"
                        data-bs-toggle="tab" data-bs-target="#custom-tabs-four-home" type="button"
                        role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">
                        <i class="bi bi-card-checklist me-1"></i> Online
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold text-primary" id="custom-tabs-four-profile-tab"
                        data-bs-toggle="tab" data-bs-target="#custom-tabs-four-profile" type="button"
                        role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">
                        <i class="bi bi-bag-check me-1"></i> Offline
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="custom-tabs-four-tabContent">

                <!-- ✅ TAB 1: Services -->
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                    aria-labelledby="custom-tabs-four-home-tab">

                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle text-center">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>S No</th>
                                            <th>Service</th>
                                            <th>Amount</th>
                                            <th>Download</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($services as $key => $service)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td class="fw-semibold text-start">{{ $service->service_name }}</td>
                                            <td>₹ {{ $service->pay_amount }}</td>
                                            <td>
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/fromimg/{{ $service->from_image }}"
                                                    class="btn btn-success btn-sm rounded-pill px-3">
                                                    <i class="bi bi-download"></i> Download
                                                </a>
                                            </td>
                                            <td>
                                                @if($service->action == "Pay Now" && ($service->pay_amount <= $balance ))
                                                    <a onclick="show_paynow('{{ $service->id }}','{{ $service->pay_amount }}','{{ $customers->id }}','{{ $customers->customer_user_type_id }}','{{ $customers->district }}','{{ $customers->taluk }}')" class="btn btn-sm btn-info rounded-pill px-3">{{ $service->pay_amount == "0" ? "Free" : $service->action }}</a>
                                                    @elseif($service->action == "Pay Now" && ($service->pay_amount > $balance ))
                                                    <a class="btn btn-sm btn-info rounded-pill px-3">Low Balance</a>
                                                    @elseif($service->action == "Upload Form" || $service->action == "Resubmit Form")
                                                    <a onclick="show_image_upload('{{ $service->id }}','{{ $customers->id }}','{{ $customers->customer_user_type_id }}')" class="btn btn-sm btn-info rounded-pill px-3">{{ $service->action }}</a>
                                                    @elseif($service->action == "Pending")
                                                    <a class="btn btn-sm btn-info rounded-pill px-3">{{ $service->action }}</a>
                                                    @elseif($service->action == "Waiting")
                                                    <a class="btn btn-sm btn-info rounded-pill px-3">{{ $service->action }}</a>
                                                    @elseif($service->action == "Completed" && $service->id == 1)
                                                    <a href="{{ URL::to('/') }}/upload/output/{{ $service->output_image }}" class="btn btn-sm btn-info rounded-pill px-3" download>Download</a>
                                                    @else
                                                    @if($service->pay_amount <= $balance )

                                                        <a onclick="show_paynow('{{ $service->id }}','{{ $service->pay_amount }}','{{ $customers->id }}','{{ $customers->customer_user_type_id }}','{{ $customers->district }}','{{ $customers->taluk }}')" class="btn btn-sm btn-info rounded-pill px-3">{{ $service->pay_amount == "0" ? "Free" : "Next Form" }}</a>
                                                        @else
                                                        <a class="btn btn-sm btn-info rounded-pill px-3">Low Balance</a>
                                                        @endif
                                                        @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-four-profile-tab">

                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <h5 class="card-title mb-4 text-primary fw-bold d-flex align-items-center justify-content-between">
                                <span>
                                    <i class="bi bi-box-seam me-2"></i> Bulk Orders
                                </span>
                                <span class="d-flex align-items-center gap-2" style="font-size: 0.9rem;">
                                    Delivery Address:
                                    <strong id="deliveryAddressText">{{ Auth::user()->address ?? '' }}</strong>

                                    <input type="text" id="deliveryAddressInput" class="form-control form-control-sm d-none"
                                        value="{{ Auth::user()->address ?? '' }}" style="width: 500px;">

                                    <button id="editAddressBtn" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i> Update
                                    </button>
                                    <button id="saveAddressBtn" class="btn btn-sm btn-success d-none">
                                        <i class="bi bi-check-lg"></i> Save
                                    </button>
                                    <button id="cancelAddressBtn" class="btn btn-sm btn-secondary d-none">
                                        <i class="bi bi-x-lg"></i> Cancel
                                    </button>
                                </span>
                            </h5>
                            <form onsubmit="return validateqty()" method="post" action="{{ url('savebulkbuy') }}" id="form1">
                                {{ csrf_field() }}
                                <input type="hidden" name="delivery_amount" id="deliveryamount">


                                <div class="table-responsive">
                                    <table id="example2" class="table table-bordered table-hover text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>S No</th>
                                                <th>Service</th>
                                                <th class="text-end">Amount</th>
                                                <th class="text-end">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody class="align-middle">
                                            @foreach($bulkservice as $key => $bulkservicelist)
                                            <tr>
                                                <td class="text-center fw-semibold">{{ $key + 1 }}<input type="hidden" class="adminamt" value="{{ $bulkservicelist->admin_amount }}"></td>
                                                <td class="text-start fw-semibold text-primary">
                                                    <i class="bi bi-gear-wide-connected me-1"></i> {{ $bulkservicelist->service_name }}
                                                </td>

                                                <td class="text-end">
                                                    <div class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light">
                                                        <span class="fw-bold me-1 text-success">₹</span>
                                                        <input type="text" readonly class="form-control border-0 bg-transparent text-end fw-semibold text-dark serviceamt" value="{{ $bulkservicelist->pay_amount }}" style="width:70px;">
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    @if($bulkservicelist->used == 1)
                                                    <input
                                                        type="text"
                                                        maxlength="3"
                                                        placeholder="Qty"
                                                        name="services_{{ $bulkservicelist->id }}_{{ $bulkservicelist->pay_amount }}"
                                                        class="form-control text-center  serviceqty number"
                                                        style="max-width: 90px;">
                                                    @else
                                                    <button
                                                        type="button"
                                                        class="btn btn-success btn-sm rounded-pill px-3"
                                                        onclick="show_upload('{{ $bulkservicelist->id }}')">
                                                        <i class="bi bi-upload me-1"></i> Upload
                                                    </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach

                                            <!-- Summary Row -->
                                            <tr class="table-light">
                                                <td colspan="2" class="text-end fw-bold text-secondary">
                                                    <i class="bi bi-wallet2 me-1 text-success"></i> Wallet Amount:
                                                </td>
                                                <td colspan="2" class="text-end fw-bold text-success">
                                                    ₹ <span id="wallet">{{ $balance }}</span>
                                                </td>
                                            </tr>

                                            <tr class="table-light">
                                                <td colspan="2" class="text-end fw-bold text-secondary">
                                                    <i class="bi bi-cash-coin me-1 text-danger"></i> Total Amount:
                                                </td>
                                                <td colspan="2" class="text-end fw-bold text-danger">
                                                    ₹ <span id="totamount">0</span>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>

                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4" id="submitbtn">
                                        <i class="bi bi-send-fill"></i> Submit
                                    </button>
                                </div>
                            </form>
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

            <div class="modal fade" id="image_modal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="imageModalLabel">Upload Image</h5>
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
                                            <div class="mb-3 row align-items-center">
                                                <label class="col-sm-4 col-form-label fw-semibold">
                                                    <span class="text-danger">*</span> Image<br>
                                                    <small class="text-muted">(800 x 1100)</small>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="file" accept="image/png,image/jpeg,image/jpg" name="photo" id="photo" class="form-control" required>
                                                </div>
                                            </div>
                                            @if(Auth::user()->user_type_id == 2)
                                            <small class="text-success">As you are an Admin user, please provide the Application No for record purposes.</small>
                                            <div class="mb-3 row align-items-center">
                                                <label class="col-sm-4 col-form-label fw-semibold">Application No</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="application_no" id="application_no" maxlength="50" class="form-control" placeholder="Enter application number">
                                                </div>
                                            </div>
                                            @endif

                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="upload_offline_form" tabindex="-1" aria-labelledby="uploadOfflineFormLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ url('/upload_offline_form') }}" method="post" enctype="multipart/form-data" class="modal-content shadow-lg border-0 rounded-3">
                        {{ csrf_field() }}
                        <input type="hidden" name="form_service_id" id="form_service_id" value="0">
                        <input type="hidden" name="customer_id" value="{{ $customers->id }}">

                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="uploadOfflineFormLabel">Upload Application Form</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <!-- Customer Selection -->


                            <!-- File Upload -->
                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold">
                                    <span class="text-danger">*</span> Application Form
                                </label>
                                <div class="col-sm-8">
                                    <input type="file" name="photo" id="photo" accept="image/png,image/jpeg,image/jpg" class="form-control" required>
                                    <small class="text-muted">Allowed formats: JPG, PNG</small>
                                </div>
                            </div>

                            <div class="mb-3 row align-items-center">
                                <label class="col-sm-4 col-form-label fw-semibold">
                                    Application Number
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" name="application_no" id="application_no" maxlength="50" class="form-control" placeholder="Application number">
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
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

                function validateqty() {
                    let sumQty = 0;
                    let total = 0;
                    let totalAdminAmt = 0;

                    // Assume user_type_id is passed from Blade
                    let userType = parseInt("{{ Auth::user()->user_type_id }}") || 1;
                    let rawallet = parseFloat("{{ $rabalance->nalavariyamwallet ?? 0 }}") || 0;
                    let address = $("#deliveryAddressText").text() || "";
                    if (address.trim() === "") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'Please enter your address to continue the service.'
                        });

                        return false;
                    }
                    let wallet = parseFloat($("#wallet").text()) || 0;

                    $(".serviceqty").each(function() {
                        const qty = parseInt($(this).val()) || 0;
                        const amt = parseFloat($(this).closest("tr").find(".serviceamt").val()) || 0;
                        const adminAmt = parseFloat($(this).closest("tr").find(".adminamt").val()) || 0;

                        total += amt * qty;
                        totalAdminAmt += adminAmt * qty;
                        sumQty += qty;
                    });

                    if (total <= 0) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'Please enter quantity for at least one service.'
                        });
                        return false;
                    }

                    let deliveryCharge = 0;
                    if (sumQty > 0 && sumQty < 5) {
                        deliveryCharge = 50;


                        alert('Since quantity is less than 5, a delivery charge of ₹50 is added.');

                    }

                    const grandTotal = total + deliveryCharge;
                    $("#totamount").text(total);
                    $("#deliveryamount").val(deliveryCharge);

                    if (userType === 2) {
                        // Admin: Only check admin wallet
                        if (totalAdminAmt > rawallet) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Insufficient NAlavariyam Wallet Balance',
                                text: 'Admin wallet balance is insufficient. Please contact higher authority.'
                            });
                            return false;
                        }
                    } else {
                        // Non-admin users: Check both admin wallet AND user wallet

                        // 1. Check admin wallet for backend admin deduction
                        if (totalAdminAmt > rawallet) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Service Not Available',
                                text: 'Admin has insufficient wallet balance. Please try again later or contact Admin.'
                            });
                            return false;
                        }

                        // 2. Check user wallet for user payment
                        if (grandTotal > wallet) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Insufficient Wallet Balance',
                                text: 'No funds in your wallet. Please update your wallet to continue the service.',
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK',
                                backdrop: true
                            });
                            return false;
                        }
                    }

                    $('#submitbtn').prop('disabled', true).val("Please Wait...");
                    return true;
                }


                // Live update total amount when quantity changes
                $(document).on("input", ".serviceqty", function() {
                    let total = 0;
                    $(".serviceqty").each(function() {
                        const qty = parseInt($(this).val()) || 0;
                        const amt = parseFloat($(this).closest("tr").find(".serviceamt").val()) || 0;
                        total += amt * qty;
                    });
                    $("#totamount").text(total);
                });

                function show_upload(id) {
                    $("#upload_offline_form").modal("show");
                    $("#form_service_id").val(id);
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const editBtn = document.getElementById('editAddressBtn');
                    const saveBtn = document.getElementById('saveAddressBtn');
                    const cancelBtn = document.getElementById('cancelAddressBtn');
                    const addressText = document.getElementById('deliveryAddressText');
                    const addressInput = document.getElementById('deliveryAddressInput');

                    editBtn.addEventListener('click', () => {
                        addressText.classList.add('d-none');
                        addressInput.classList.remove('d-none');
                        editBtn.classList.add('d-none');
                        saveBtn.classList.remove('d-none');
                        cancelBtn.classList.remove('d-none');
                    });

                    cancelBtn.addEventListener('click', () => {
                        addressInput.value = addressText.textContent === '-' ? '' : addressText.textContent;
                        addressText.classList.remove('d-none');
                        addressInput.classList.add('d-none');
                        editBtn.classList.remove('d-none');
                        saveBtn.classList.add('d-none');
                        cancelBtn.classList.add('d-none');
                    });

                    saveBtn.addEventListener('click', () => {
                        const newAddress = addressInput.value.trim();

                        fetch("{{ url('updateaddress') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    address: newAddress
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    addressText.textContent = newAddress || '-';
                                    addressText.classList.remove('d-none');
                                    addressInput.classList.add('d-none');
                                    editBtn.classList.remove('d-none');
                                    saveBtn.classList.add('d-none');
                                    cancelBtn.classList.add('d-none');
                                } else {
                                    alert('Failed to update address');
                                }
                            })
                            .catch(() => alert('Error updating address'));
                    });
                });
            </script>
            @endpush