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
            <div class="ms-auto">
                <button type="button" class="btn-sm btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addcustomer">Add</button>
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
                @endif

                {{-- Title --}}
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


                {{-- Form --}}
                <form onsubmit="return validateqty()" method="POST" action="{{ url('savebulkbuy') }}" id="form1">
                    @csrf
                    <input type="hidden" name="delivery_amount" id="deliveryamount">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th width="5%">#</th>
                                    <th class="text-start">Service</th>
                                    <th class="text-end">Amount</th>
                                    <th class="text-end">Quantity / Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bulkservice as $key => $bulkservicelist)
                                <tr>
                                    <td class="fw-semibold">{{ $key + 1 }}<input type="hidden" class="adminamt" value="{{ $bulkservicelist->admin_amount }}"></td>
                                    <td class="text-start fw-semibold text-primary">
                                        <i class="bi bi-gear-wide-connected me-1"></i>
                                        {{ $bulkservicelist->service_name }}
                                    </td>
                                    <td class="text-end">
                                        <div class="d-inline-flex align-items-center border rounded px-2 py-1 bg-light">
                                            <span class="fw-bold me-1 text-success">₹</span>
                                            <input
                                                type="text"
                                                readonly
                                                class="form-control border-0 bg-transparent text-end fw-semibold text-dark serviceamt"
                                                value="{{ $bulkservicelist->pay_amount }}"
                                                style="width:70px;">
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        @if($bulkservicelist->used == 1)
                                        <input
                                            type="text"
                                            maxlength="3"
                                            placeholder="Qty"
                                            name="services_{{ $bulkservicelist->id }}_{{ $bulkservicelist->pay_amount }}"
                                            class="form-control text-center serviceqty number mx-auto"
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
                                <tr class="table-light">
                                    <td colspan="2" class="text-end fw-bold text-secondary">
                                        <i class="bi bi-wallet2 me-1 text-success"></i> Wallet Amount:
                                    </td>
                                    <td colspan="2" class="text-end fw-bold text-success">
                                        ₹ <span id="wallet">{{ Auth::user()->wallet }}</span>
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

                    {{-- Submit Button --}}
                    <div class="text-end mt-3">
                        <button id="submitbtn" type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="bi bi-save2 me-1"></i> Save Bulk Buy
                        </button>
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

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="uploadOfflineFormLabel">Upload Application Form</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <!-- Customer Selection -->
                <div class="mb-3 row align-items-center">
                    <label class="col-sm-4 col-form-label fw-semibold">
                        <span class="text-danger">*</span> Customer
                    </label>
                    <div class="col-sm-6">
                        <select name="customer_id" class="form-select select2" required>
                            <option value="">Select</option>
                            @foreach($nalavariyamcustomer as $cust)
                            <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-1 text-center">
                        <button type="button" class="btn btn-success btn-sm rounded-circle" onclick="show_add_customer()" title="Add New Customer">
                            <i class="fa fa-plus">&nbsp;New</i>
                        </button>
                    </div>
                </div>

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

<!-- Add Customer Modal -->
<div class="modal fade" id="addcustomer" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <!-- Modal Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Add New Member</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Form -->
            <form id="addCustomerForm" action="{{ url('/addnalavariyam_member') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">

                        <!-- District -->
                        <div class="col-md-6">
                            <label for="dist_id" class="form-label">District <span class="text-danger">*</span></label>
                            <select required name="dist_id" id="dist_id" class="form-select" onchange="load_taluk(this.value)">
                                <option value="">Select District</option>
                                @foreach ($district as $d)
                                <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Taluk -->
                        <div class="col-md-6">
                            <label for="taluk" class="form-label">Taluk <span class="text-danger">*</span></label>
                            <select required name="taluk_id" id="taluk" class="form-select">
                                <option value="">Select Taluk</option>
                            </select>
                        </div>

                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" maxlength="50" placeholder="Full Name" required>
                        </div>

                        <!-- Aadhaar Number -->
                        <div class="col-md-6">
                            <label for="aadhaar_no" class="form-label">Aadhaar Number <span class="text-danger">*</span></label>
                            <input type="text" name="aadhaar_no" id="aadhaar_no" class="form-control number" maxlength="12" placeholder="Aadhaar Number" required onkeyup="nalavariyam_duplicateaadhar(0)">
                            <small id="dupaadhar" class="text-danger"></small>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" name="phone" id="phone" class="form-control number" maxlength="10" placeholder="Phone" required onkeyup="nalavariyam_duplicatephone(0)">
                            <small id="dupphone" class="text-danger"></small>
                        </div>

                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('page_scripts')
<script>
    function validateqty() {
        let sumQty = 0;
        let total = 0;
        let totalAdminAmt = 0;

        // Assume user_type_id is passed from Blade
        let userType = parseInt("{{ Auth::user()->user_type_id }}") || 1;
        let rawallet = parseFloat("{{ $rabalance->rawallet ?? 0 }}") || 0;
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

    function show_add_customer() {
        $("#addcustomer").modal("show");
        $("#upload_offline_form").modal("hide");
    }

    $('#dist_id').on('change', function() {
        var dist_id = this.value;
        $("#taluk").html('');
        var url = "{{ url('nalavariyam/variyamget_taluk') }}/" + dist_id;
        $.ajax({
            url: url,
            type: "GET",
            success: function(result) {
                $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                $.each(result, function(key, value) {
                    $("#taluk").append('<option value="' + value
                        .id + '">' + value.taluk_name + '</option>');
                });
                $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
            }
        });
    });


    function nalavariyam_duplicateaadhar(id) {
        var aadhaar_no = $("#aadhaar_no").val().trim();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "post",
            url: '{{ url('
            nalavariyam_checkaadhar ') }}',
            data: {
                id: id,
                aadhaar_no: aadhaar_no,
                _token: _token
            },

            success: function(res) {
                console.log(res);
                if (res.exists) {
                    $("#save").prop('disabled', true);
                    $("#dupaadhar").html("aadhar no alredy exists!");
                } else {
                    $("#dupaadhar").html("");
                }
                if ($("#dupphone").html() == "" && $("#dupaadhar").html() == "") {
                    $("#save").prop('disabled', false);
                } else {
                    $("#save").prop('disabled', true);
                }
            },
            error: function(jqXHR, exception) {
                console.log(exception);
            }
        });
    }

    function nalavariyam_duplicatephone(id) {
        var phone = $("#phone").val().trim();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "post",
            url: '{{ url('
            nalavariyam_checkphone ') }}',
            data: {
                id: id,
                phone: phone,
                _token: _token
            },

            success: function(res) {
                if (res.exists) {
                    $("#save").prop('disabled', true);
                    $("#dupphone").html("mobile no alredy exists!");
                } else {
                    $("#dupphone").html("");
                }
                if ($("#dupphone").html() == "" && $("#dupaadhar").html() == "") {
                    $("#save").prop('disabled', false);
                } else {
                    $("#save").prop('disabled', true);
                }
            },

            error: function(jqXHR, exception) {
                console.log(exception);
            }
        });
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