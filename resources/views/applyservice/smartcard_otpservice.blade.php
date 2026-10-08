@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('success') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <strong> {{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span id="servicePayment" class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitapply_smartcardotp') }}" onsubmit="return checkpayment(event)"
                                enctype="multipart/form-data" method="post" id="myForm">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" id="amount" value="{{ $payment }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    <input type="hidden" name="ramjidebit_amount" id="ramjidebit_amount" value="{{ $admin_payment }}">

                                    <div class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                        <span class="text-danger">
                                            குடும்ப உறுப்பினர் பெயரை மட்டும் நீக்கம் செய்ய முடியும்..
                                            குடும்ப தலைவரை நீக்கம் செய்ய முடியாது
                                        </span><br>
                                        <span class="text-dark">
                                            ஆவணங்களில் அட்டை எண்கள் தெளிவாக தெரியும் படி இருக்க வேண்டும்.
                                        </span>
                                    </div>

                                    <div class="col-md-12 mb-4">
                                        <label class="form-label fw-bold text-dark fs-5">
                                            விண்ணப்ப வகை (Application Type) <span class="text-danger">*</span>
                                        </label>
                                        <div class="d-flex gap-4 p-3 rounded-3 bg-light border" style="border-color: #cbd5e1 !important;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="application_type" id="type_addition" value="சேர்க்கை" required>
                                                <label class="form-check-label fw-bold cursor-pointer" for="type_addition">
                                                    <i class="bi bi-person-plus-fill text-success me-1"></i> பெயர் சேர்க்கை (Name Addition)
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="application_type" id="type_removal" value="பெயர் நீக்கம்" required>
                                                <label class="form-check-label fw-bold cursor-pointer" for="type_removal">
                                                    <i class="bi bi-person-dash-fill text-danger me-1"></i> பெயர் நீக்கம் (Name Removal)
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                            <label for="relationship" class="form-label">உறவுமுறை</label>
                                            <select required id="relationship" name="relationship" class="form-control">
                                                <option value="">Select</option>
                                                <option value="தந்தை">தந்தை</option>
                                                <option value="தாய்">தாய்</option>
                                                <option value="மகன்">மகன்</option>
                                                <option value="மகள்">மகள்</option>
                                                <option value="கணவர்">கணவர்</option>
                                                <option value="மனைவி">மனைவி</option>
                                                <option value="மாமியார்">மாமியார்</option>
                                                <option value="மாமனார்">மாமனார்</option>
                                                <option value="மருமகன்">மருமகன்</option>
                                                <option value="மருமகள்">மருமகள்</option>
                                                <option value="பேரன்">பேரன்</option>
                                                <option value="பேத்தி">பேத்தி</option>
                                                <option value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                            </select>
                                        </div>
                                    {{-- <div class="mb-3 col-md-6">
                                        <label for="smartcard_number" class="form-label">Linked Mobile Number</label>
                                        <input required type="text" maxlength="20" class="form-control"
                                            name="linked_mobile_number" placeholder="Linked Mobile Number" />
                                    </div> --}}

                                    <!-- <div class="mb-3 col-md-6">
                                        <label for="aadhaar_card" class="form-label">Aadhaar Card Front Page</label>
                                        <input required accept="image/jpeg, image/png" type="file" class="form-control"
                                            name="aadhaar_card">
                                        <small class="text-success">
                                            Allowed files: JPG, JPEG, PNG
                                        </small>
                                    </div> -->

                                    <div class="mb-3 col-md-6">
                                        <label for="smart_card" class="form-label">Smart Card Online print</label>
                                        <input required accept=".jpg,.jpeg,.png,.pdf" type="file" class="form-control"
                                            name="smart_card">
                                        <small class="text-success">
                                            Allowed files: JPG, JPEG, PNG, PDF
                                        </small>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="petition_no" class="form-label">No Of Person</label>
                                        <input type="number" min="1" class="form-control" id="name_count_219"
                                            name="name_count" placeholder="No Of Person" required>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div id="nameContainer219"></div>
                                    </div>

                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>

                                    <div class="mt-2 text-center">
                                        <button id="save" type="submit" class="btn btn-primary me-2">Apply</button>
                                    </div>
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
        var userWallet = parseFloat("{{ Auth::user()->wallet }}") || 0;
        var ramjibalance = parseFloat("{{ $mainbalance->rawallet }}") || 0;
        var perAmountUser = parseFloat("{{ $payment }}") || 0;
        var perAmountAdmin = parseFloat("{{ $admin_payment }}") || 0;

        function checkBalances(totalUserCost, totalAdminCost) {
            let errorMsg = "";

            if (totalUserCost > userWallet) {
                errorMsg = "No Fund in Wallet. Please Update Your wallet To Continue the Service";
            } else if (totalAdminCost > ramjibalance) {
                errorMsg = "Low Balance For the Service. Please Contact Admin...";
            }

            if (errorMsg !== "") {
                $('#save').prop("disabled", true);
                $('#nopayment').html(errorMsg).css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
                return false;
            } else {
                $('#save').prop("disabled", false);
                $('#nopayment').html("");
                return true;
            }
        }

        function checkpayment(e) {
            let count = parseInt($('#name_count_219').val()) || 1;
            let totalUserCost = perAmountUser * count;
            let totalAdminCost = perAmountAdmin * count;

            if (!checkBalances(totalUserCost, totalAdminCost)) {
                return false;
            }

            $("#save").attr("disabled", true).text("Submitting...");
            $("#ramjidebit_amount").val(totalAdminCost);
            return true;
        }

        $(function() {
            // Initial check on page load
            checkBalances(perAmountUser, perAmountAdmin);

            $('#name_count_219').on('keyup change', function() {
                let count = parseInt($(this).val());

                if (isNaN(count) || count <= 0) {
                    count = 1;
                }

                let html = '';
                for (let i = 1; i <= count; i++) {
                    html += `
                        <div class="card p-3 mb-3 border bg-light">
                            <h6 class="fw-bold text-primary mb-3">Member Details #${i}</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Name ${i} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="member_name[]"
                                           class="form-control"
                                           placeholder="Enter Name ${i}"
                                           required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Aadhaar Card File ${i} <span class="text-danger">*</span></label>
                                    <input type="file"
                                           name="member_aadhaar_card[]"
                                           class="form-control"
                                           accept=".jpg,.jpeg,.png,.pdf"
                                           required>
                                    <small class="text-muted">Allowed files: JPG, JPEG, PNG, PDF</small>
                                </div>
                            </div>
                        </div>
                    `;
                }

                $('#nameContainer219').html(html);

                let totalUserCost = perAmountUser * count;
                let totalAdminCost = perAmountAdmin * count;

                $('#servicePayment').text(totalUserCost.toFixed(2));
                $('#amount').val(totalUserCost);

                // Re-evaluate wallet checks when dynamic total changes
                checkBalances(totalUserCost, totalAdminCost);
            });
        });
    </script>
@endpush