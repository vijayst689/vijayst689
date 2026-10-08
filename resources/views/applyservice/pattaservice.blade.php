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
                            <form class="row g-4" action="{{ url('submitapply_patta') }}" enctype="multipart/form-data"
                                onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    @if ($serviceid == 213 || $serviceid == 214 || $serviceid == 215)
                                        <div class="mb-3 col-md-6">
                                            <label for="can_no" class="form-label">Can Number</label>
                                            <input required type="text" class="form-control" name="can_no"
                                                placeholder="Can Number" maxlength="15" />

                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                            <label for="reg_office" class="form-label">Register Office</label>
                                            <input required type="text" class="form-control" name="reg_office"
                                                placeholder="Register Office" maxlength="50" />
                                            <label for="subdivision_no" class="form-label">Subdivision No</label>
                                            <input required type="text" class="form-control" name="subdivision_no"
                                                placeholder="Subdivision No" maxlength="30" />
                                            <label for="bond_doc" class="form-label">Bond/பத்திரம் Documents</label>
                                            <input required type="file" class="form-control" name="bond_doc"
                                                placeholder="Bond/பத்திரம் Documents" maxlength="20" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="rev_village" class="form-label">Revenue Village</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="rev_village" placeholder="Revenue Village" />
                                            <label for="survey_no" class="form-label">Survey No</label>
                                            <input required type="text" maxlength="30" class="form-control"
                                                name="survey_no" placeholder="Survey No" />
                                            <label for="transacted_area" class="form-label">Transacted Area</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="transacted_area" placeholder="Transacted Area" />
                                            <label for="ec" class="form-label">EC</label>
                                            <input required type="file" class="form-control" name="ec"
                                                placeholder="EC" maxlength="20" />
                                        </div>
                                    @elseif($serviceid == 219)
                                        <div class="mb-3 col-md-6">
                                            <label for="can_no" class="form-label">Can Number</label>
                                            <input required type="text" class="form-control" name="can_no"
                                                placeholder="Can Number" maxlength="15" />

                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                            <label for="reg_office" class="form-label">Register Office</label>
                                            <input required type="text" class="form-control" name="reg_office"
                                                placeholder="Register Office" maxlength="50" />
                                            <label for="subdivision_no" class="form-label">Subdivision No</label>
                                            <input required type="text" class="form-control" name="subdivision_no"
                                                placeholder="Subdivision No" maxlength="30" />
                                            <label for="bond_doc" class="form-label">Bond/பத்திரம் Documents</label>
                                            <input required type="file" class="form-control" name="bond_doc"
                                                placeholder="Bond/பத்திரம் Documents" maxlength="20" />

                                            <label for="legal_heir" class="form-label">Legal Heir Certificate</label>
                                            <input required type="file" class="form-control" name="legal_heir"
                                                maxlength="20" />

                                            <label for="chitta_copy" class="form-label">Chitta Copy </label>
                                            <input required type="file" class="form-control" name="chitta_copy"
                                                maxlength="20" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="rev_village" class="form-label">Revenue Village</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="rev_village" placeholder="Revenue Village" />
                                            <label for="survey_no" class="form-label">Survey No</label>
                                            <input required type="text" maxlength="30" class="form-control"
                                                name="survey_no" placeholder="Survey No" />
                                            <label for="transacted_area" class="form-label">Transacted Area</label>
                                            <input required type="text" maxlength="50" class="form-control"
                                                name="transacted_area" placeholder="Transacted Area" />
                                            <label for="ec" class="form-label">EC</label>
                                            <input required type="file" class="form-control" name="ec"
                                                placeholder="EC" maxlength="20" />

                                            <label for="death_certificate" class="form-label">Death Certificate </label>
                                            <input required type="file" class="form-control" name="death_certificate"
                                                maxlength="20" />
                                        </div>
                                    @elseif($serviceid == 247)
                                        <div class="mb-3 col-md-6">
                                            <label for="can_no" class="form-label">Can No</label>
                                            <input required type="text" class="form-control" name="can_no"
                                                placeholder="Can Number" maxlength="15" />

                                            <label for="document_page" class="form-label">பத்திரம் முதல் 2 பக்கம்</label>
                                            <input required type="file" class="form-control" name="document_page"
                                                placeholder="பத்திரம் முதல் 2 பக்கம்" />

                                            <label for="Palmistry_page" class="form-label">கை ரேகை பக்கம் 2</label>
                                            <input required type="file" class="form-control" name="Palmistry_page"
                                                placeholder="கை ரேகை பக்கம் 2" />

                                            <label for="oldpatta_chitta" class="form-label">பழைய பட்டா, சிட்டா,
                                                இருந்தால்</label>
                                            <input required type="file" class="form-control" name="oldpatta_chitta"
                                                placeholder="பழைய பட்டா, சிட்டா, இருந்தால்" />

                                            <label for="death_certificate" class="form-label">இறப்பு சான்று</label>
                                            <input required type="file" class="form-control" name="death_certificate"
                                                placeholder="இறப்பு சான்று" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="original_document" class="form-label">ஒரிஜினல் பத்திரம்(ஒரிஜினல்
                                                பத்திரம் வங்கியில் இருந்தால்,
                                                வங்கியிலிருந்து கடிதம்)</label>
                                            <input required type="file" class="form-control" name="original_document"
                                                placeholder="ஒரிஜினல் பத்திரம்" />

                                            <label for="tabasil_property" class="form-label">தபசில் அல்லது சொத்து விபரம் 2
                                                பக்கம்</label>
                                            <input required type="file" class="form-control" name="tabasil_property"
                                                placeholder="தபசில் அல்லது சொத்து விபரம் 2 பக்கம்" />

                                            <label for="anecdotal_evidence" class="form-label">வில்லங்க சான்று</label>
                                            <input required type="file" class="form-control" name="anecdotal_evidence"
                                                placeholder="வில்லங்க சான்று" />

                                            <label for="survey_no" class="form-label">சர்வே எண் மாறியிருந்தால், புதிய
                                                சர்வே எண்
                                                வாரிசு மூலமாக மாற்ற இவற்றுடன் இதனையும் இணைக்க வேண்டும்</label>
                                            <input required type="text" class="form-control" name="survey_no"
                                                placeholder="சர்வே எண் மாறியிருந்தால்,புதிய சர்வே எண்" maxlength="30" />

                                            <label for="heir_proof" class="form-label">வாரிசு சான்று</label>
                                            <input required type="file" class="form-control" name="heir_proof"
                                                placeholder="வாரிசு சான்று" />
                                        </div>
                                    @elseif($serviceid == 248)
                                        <div class="mb-3 col-md-6">

                                            <label for="patta_no" class="form-label">பட்டா அல்லது சிட்டா எண்</label>
                                            <input required type="text" class="form-control number" name="patta_no"
                                                placeholder="பட்டா அல்லது சிட்டா எண்" maxlength="50" />

                                            <label for="aadhaar_card" class="form-label">ஆதார் கார்டு</label>
                                            <input required type="file" class="form-control" name="aadhaar_card"
                                                placeholder="ஆதார் கார்டு" maxlength="12" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">கைபேசி எண்(ஆதார் அட்டையில் பதிவு
                                                செய்யப்பட்ட கைபேசி எண்)</label>
                                            <input required type="text" class="form-control" name="mobile"
                                                placeholder="கைபேசி எண்" maxlength="10" />
                                        </div>
                                    @endif
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

        $(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = "{{ $payment }}";
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
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
        $('#dist_id').on('change', function() {
            var dist_id = this.value;
            $("#taluk").html('');
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
                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
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
                }
            });
        });
    </script>
@endpush
