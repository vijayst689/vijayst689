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
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <strong> {{ session('error') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitapply_medicalscheme') }}"
                                onsubmit="return checkpayment(event)" enctype="multipart/form-data" method="post"
                                id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    <div class="row">
                                        @if ($serviceid == 179)
                                            <div class="mb-3 col-md-6">
                                                <label for="" class="form-label text-primary">VAO
                                                    Certificate</label><br>
                                                <a download class="btn btn-sm btn-danger"
                                                    href="{{ URL::to('/') }}/upload/vao_certificate/EnrolmentForm2024.pdf">Download</a><br>

                                                <label for="smartcard_no" class="form-label text-primary">Smartcard
                                                    Number</label>
                                                <input required type="text" class="form-control" name="smartcard_no"
                                                    maxlength="15" placeholder="Smartcard Number" />

                                                <label for="aadhaar_no" class="form-label text-primary">Aadhaar
                                                    Number</label>
                                                <input required type="text" class="form-control" name="aadhaar_no"
                                                    maxlength="12" placeholder="Aadhaar Number" />

                                                <label for="mobile" class="form-label text-primary">Cell Number </label>
                                                <input required type="text" class="form-control number" name="mobile"
                                                    maxlength="10" placeholder="Cell Number " />

                                                <label for="pin_code" class="form-label text-primary">Pin Code</label>
                                                <input required type="text" maxlength="6" class="form-control number"
                                                    name="pin_code" placeholder="Pin Code" />

                                                <label class="form-label text-primary" for="relation">குடும்ப உறுப்பினரின்
                                                    தந்தை அல்லது கணவர் பெயர்</label>
                                                <select required id="relation" name="relation" class="form-control">
                                                    <option value="">Select Name</option>
                                                    <option value="Father Name">தந்தை பெயர்</option>
                                                    <option value="Husband Name">கணவர் பெயர்</option>
                                                </select>

                                                <label for="marital_status" class="form-label text-primary">Marital
                                                    Status</label>
                                                <select name="marital_status" class="form-control" required>
                                                    <option value="">Select Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                    <option value="Divorced">Divorced</option>
                                                    <option value="Widowed">Widowed</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="vao_or_income_certificate" class="form-label text-primary">VAO
                                                    Certificate/Income Certificate(1,20,000)</label>
                                                <input required accept="application/pdf" type="file" class="form-control"
                                                    name="vao_or_income_certificate" />


                                                <label for="smartcard_onlineprint" class="form-label text-primary">Smart
                                                    card</label>
                                                <input required accept="application/pdf" type="file"
                                                    class="form-control" name="smartcard_onlineprint" />

                                                <label for="aadhaar_card" class="form-label text-primary">Adhaar card
                                                    (Front &
                                                    Back)</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="aadhaar_card" />

                                                <label for="photo" class="form-label text-primary">Live Photo(Family
                                                    Memebers)</label>
                                                <input required accept="image/jpeg" type="file" class="form-control"
                                                    name="photo" />

                                                <label for="passportsize_photo" class="form-label text-primary">Passport
                                                    Size
                                                    Photo</label>
                                                <input required accept="image/jpeg" type="file" class="form-control"
                                                    name="passportsize_photo" />

                                                <div class="mb-3 col-md-6" id="father_namehide" style="display: none;">
                                                    <label class="form-label text-primary" for="father_name">தந்தை
                                                        பெயர்</label>
                                                    <input type="text" maxlength="100" class="form-control"
                                                        name="father_name" placeholder="தந்தை பெயர்" />
                                                </div>

                                                <div class="mb-3 col-md-6" id="husband_namehide" style="display: none;">
                                                    <label class="form-label text-primary" for="husband_name">கணவர்
                                                        பெயர்</label>
                                                    <input type="text" maxlength="100" class="form-control"
                                                        name="husband_name" placeholder="கணவர் பெயர்" />
                                                </div>
                                            </div>
                                        @elseif ($serviceid == 180)
                                            <div class="mb-3 col-md-6">
                                                <label for="mobile" class="form-label">Adhaar link cell
                                                    Number</label>
                                                <input required type="text" class="form-control number" name="mobile"
                                                    maxlength="10" placeholder="Adhaar link cell Number" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="aadhaar_card" class="form-label">Adhaar Card (Front &
                                                    Back)</label>
                                                <input required type="file" class="form-control" name="aadhaar_card"
                                                    placeholder="Adhaar card (Front & Back)" />
                                            </div>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>
                                    <div class="text-center">
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <button id="save" type="submit"
                                                    class="btn btn-primary">Apply</button>
                                            </div>
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
        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });

        var dist_id = "{{ $customers->dist_id }}";
        var taluk_id = "{{ $customers->taluk_id }}";
        var wallet = "{{ Auth::user()->wallet }}";
        var amount = "{{ $payment }}";
        $(function() {
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
            gettaluk(dist_id);
            getpanchayath(taluk_id);
        });
        var ramjibalance = "{{ $mainbalance->rawallet }}";
        //alert(ramjibalance);
        ramjibalance = parseFloat(ramjibalance);

        function checkpayment(e) {
            var amount = {{ $admin_payment }};
            if (amount > ramjibalance) {
                alert("LOW BALANCE");
                $('#save').prop("disabled", true);
                $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
                return false;
            } else {
                $("#nopayment").html("");
                $("#save").attr("disabled", true);
                $("#ramjidebit_amount").val(amount);
                return true;

            }
        }

        function gettaluk(dist_id) {
            var url = "{{ url('service/get_taluk') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $("#taluk").val("{{ $customers->taluk_id }}");

                }
            });
        }

        function getpanchayath(taluk_id) {
            var url = "{{ url('service/get_panchayath') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                    $("#panchayath").val("{{ $customers->panchayath_id }}");

                }
            });
        }

        $('#select_relationship').change(function() {
            if ($('#select_relationship').val() == 'Father Name') {
                $('#father_name_tamilhide').show("slow");
                $('#father_name_englishhide').show("slow");
                $('#husband_name_tamilhide').hide("slow");
                $('#husband_name_englishhide').hide("slow");
                $('#husband_name_tamil').prop("required", false);
                $('#husband_name_english').prop("required", false);
                $('#father_name_tamil').prop("required", true);
                $('#father_name_english').prop("required", true);

            } else if ($('#select_relationship').val() == 'Husband Name') {
                $('#husband_name_tamilhide').show("slow");
                $('#husband_name_englishhide').show("slow");
                $('#father_name_tamilhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#husband_name_tamil').prop("required", true);
                $('#husband_name_english').prop("required", true);

            } else {
                $('#father_name_tamilhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#husband_name_tamilhide').hide("slow");
                $('#husband_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#husband_name_tamil').prop("required", false);
                $('#husband_name_english').prop("required", false);

            }
        });

        $('#member').change(function() {
            if ($('#member').val() == 'Add 1 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').hide("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar2').prop("required", false);
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);

            } else if ($('#member').val() == 'Add 2 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);

            } else if ($('#member').val() == 'Add 3 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);

            } else if ($('#member').val() == 'Add 4 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);

            } else if ($('#member').val() == 'Add 5 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar6').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);
                $('#aadhaar5').prop("required", true);

            } else if ($('#member').val() == 'Add 6 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
                $('#aadhaar6hide').show("slow");
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);
                $('#aadhaar5').prop("required", true);
                $('#aadhaar6').prop("required", true);

            } else {
                $('#aadhaarhide').hide("slow");
                $('#aadhaar2hide').hide("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar6hide').hide("slow");
                $('#aadhaar').prop("required", false);
                $('#aadhaar2').prop("required", false);
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar6').prop("required", false);

            }
        });

        $('#relation').change(function() {

            if ($('#relation').val() == 'Father Name') {
                $('#father_namehide').show("slow");
                $('#husband_namehide').hide("slow");
                $('#husband_name').prop("required", false);
                $('#father_name').prop("required", true);

            } else if ($('#relation').val() == 'Husband Name') {
                $('#husband_namehide').show("slow");
                $('#father_namehide').hide("slow");
                $('#father_name').prop("required", false);
                $('#husband_name').prop("required", true);

            } else {
                $('#father_namehide').hide("slow");
                $('#husband_namehide').hide("slow");
                $('#father_name').prop("required", false);
                $('#husband_name').prop("required", false);

            }
        });
    </script>
@endpush
