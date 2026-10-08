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
                            <form class="row g-4" action="{{ url('submitsmartcard_register') }}" onsubmit="return checkpayment(event)"
                                enctype="multipart/form-data" method="post" id="myForm">
                                {{ csrf_field() }}

                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">

                                    @if ($serviceid == 37)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">பெயர்</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />

                                            <label for="dist_id" class="form-label">மாவட்டம்</label>
                                            <select  name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach($districts as $d)
                                                <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">ஆதார் அட்டை (Front & Back)</label>
                                            <input required type="file"  class="form-control"
                                            name="aadhaar_card" placeholder="Adhaar card (Front & Back)" />
                                            <label for="smart_card" class="form-label">ஸ்மார்ட் கார்டு</label>
                                            <input required type="file"  class="form-control"
                                            name="smart_card" placeholder="ஸ்மார்ட் கார்டு" />
                                            <label for="photo" class="form-label">புகைப்படம்</label>
                                            <input required type="file"  class="form-control"
                                            name="photo" placeholder="புகைப்படம்" />
                                           
                                           

                                        </div>
                                    @elseif($serviceid == 43)
                                        <div class="mb-3 col-md-6">

                                            <label for="name" class="form-label">பெயர்</label>
                                            <input value="{{ $customers->name }}" readonly required type="text" class="form-control" name="name"
                                                placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input value="{{ $customers->phone }}" readonly required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">ஆதார் அட்டை (Front & Back)</label>
                                            <input required type="file"  class="form-control"
                                            name="aadhaar_card" placeholder="Adhaar card (Front & Back)" />
                                            <label for="smart_card" class="form-label">ஸ்மார்ட் கார்டு</label>
                                            <input required type="file"  class="form-control"
                                            name="smart_card" placeholder="ஸ்மார்ட் கார்டு" />
                                            <label for="photo" class="form-label">புகைப்படம்</label>
                                            <input required type="file"  class="form-control"
                                            name="photo" placeholder="புகைப்படம்" />
                                        </div>
                                    @elseif($serviceid == 41)
                                        <div class="mb-3 col-md-6">

                                            <label for="name" class="form-label">பெயர்</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            <label for="smart_card" class="form-label">ஸ்மார்ட் கார்டு</label>
                                            <input required type="file"  class="form-control"
                                            name="smart_card" placeholder="ஸ்மார்ட் கார்டு" />

                                        </div>
                                        <h4 class="text-center"> Additional Details </h4>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Choose Proof</label>
                                            <select required id="new_proof" name="new_proof" class="form-control">
                                                <option value="">ஏதேனும் ஒரு ஆவணம்</option>
                                                <option value="ஆதார் அட்டை">ஆதார் அட்டை</option>
                                                <option value="பிறப்பு சான்றிதழ்">பிறப்பு சான்றிதழ்</option>
                                                <option value="வாக்காளர் அட்டை">வாக்காளர் அட்டை</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <div class="" id="adh_hide" style="display: none">
                                            <label for="aadhaar_card" class="form-label">ஆதார் அட்டை</label>
                                            <input id="adhar" required accept="image/jpeg, image/png" type="file" class="form-control"
                                                name="aadhaar_card" />
                                            </div>

                                            <div id="born_hide" style="display: none">
                                            <label for="birth_certificate" class="form-label">பிறப்பு சான்றிதழ்</label>
                                            <input id="born" required accept="image/jpeg, image/png" type="file" class="form-control"
                                                name="birth_certificate" />
                                            </div>

                                            <div id="voterhide" style="display: none">
                                            <label for="voter_id" class="form-label">வாக்காளர் அட்டை</label>
                                            <input id="voter" required accept="image/jpeg, image/png" type="file" class="form-control"
                                                name="voter_id" />
                                            </div>
                                            </div>
                                    @elseif($serviceid == 38)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">பெயர்</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="பெயர்" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="செல் நம்பர்" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">ஆதார் அட்டை (Front & Back)</label>
                                            <input required type="file"  class="form-control"
                                            name="aadhaar_card" placeholder="Adhaar card (Front & Back)" />
                                            <label for="smart_card" class="form-label">ஸ்மார்ட் கார்டு</label>
                                            <input required type="file"  class="form-control"
                                            name="smart_card" placeholder="ஸ்மார்ட் கார்டு" />
                                            <label for="photo" class="form-label">புகைப்படம்</label>
                                            <input required type="file"  class="form-control"
                                            name="photo" placeholder="புகைப்படம்" />
                                        </div>
                                        <h4 class="text-center"> Additional Details </h4>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Choose Proof</label>
                                            <select required id="any_proof" name="any_proof" class="form-control">
                                                <option value="">ஏதேனும் ஒரு ஆவணம்</option>
                                                <option value="இறப்பு சான்றிதழ்">இறப்பு சான்றிதழ்</option>
                                                <option value="திருமண சான்று">திருமண சான்று</option>
                                                <option value="திருமண பத்திரிக்கை">திருமண பத்திரிக்கை</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <div class="" id="death_hide" style="display: none;">
                                                <label for="death_certificate" class="form-label">இறப்பு சான்றிதழ்
                                                </label>
                                                <input requied id="death" accept="image/jpeg, image/png"
                                                    type="file" class="form-control" name="death_certificate" />
                                            </div>
                                            <div class="" id="maraige_hide" style="display: none;">
                                                <label for="mrg_certificate" class="form-label">திருமண சான்று</label>
                                                <input required id="maraige" accept="image/jpeg, image/png"
                                                    type="file" class="form-control" name="mrg_certificate" />
                                            </div>
                                            <div class="" id="invite_hide" style="display: none;">
                                                <label for="mrg_invitation" class="form-label">திருமண பத்திரிக்கை</label>
                                                <input required id="invite" accept="image/jpeg, image/png"
                                                    type="file" class="form-control" name="mrg_invitation" />
                                            </div>
                                        </div>
                                    @elseif($serviceid == 39)
                                        <div class="mb-3 col-md-6">

                                            <label for="name" class="form-label">பெயர்</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="aadhaar_card" class="form-label">ஆதார் அட்டை (Front & Back)</label>
                                            <input required type="file"  class="form-control"
                                            name="aadhaar_card" placeholder="Adhaar card (Front & Back)" />
                                            <label for="smart_card" class="form-label">ஸ்மார்ட் கார்டு</label>
                                            <input required type="file"  class="form-control"
                                            name="smart_card" placeholder="ஸ்மார்ட் கார்டு" />
                                            
                                        </div>
                                    @elseif($serviceid == 42)
                                        <div class="mb-3 col-md-6">

                                            <label for="name" class="form-label">பெயர்</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">

                                            <label for="smart_card" class="form-label">ஸ்மார்ட் கார்டு</label>
                                            <input required type="file"  class="form-control"
                                            name="smart_card" placeholder="ஸ்மார்ட் கார்டு" />

                                            <label class="form-label">ஏதேனும் ஒரு ஆவணம்</label>
                                            <select required id="any_document" name="any_document" class="form-control">
                                                <option value="">ஏதேனும் ஒரு ஆவணம்</option>
                                                <option value="ஆதார் அட்டை">ஆதார் அட்டை</option>
                                                <option value="வாகாளர் அடையாள அட்டை">வாகாளர் அடையாள அட்டை</option>
                                                <option value="பாஸ்போர்ட்">பாஸ்போர்ட்</option>
                                                <option value="மின்சார கட்டணம் ரசீது">மின்சார கட்டணம் ரசீது</option>
                                                <option value="தொலைபேசி கட்டணம்">தொலைபேசி கட்டணம்</option>
                                                <option value="எரிவாயு சிலிண்டர் ரசீது">எரிவாயு சிலிண்டர் ரசீது</option>
                                                <option value="விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி">
                                                    விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி</option>
                                                <option value="வாடகை ஒப்பந்த பத்திரம்">வாடகை ஒப்பந்த பத்திரம்</option>
                                                <option value="குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை">குடிசை மாற்று
                                                    வாரியத்தின் ஒதுக்கீடு ஆணை</option>
                                                <option value="கொத்தடிமை விடுப்பு சான்று">கொத்தடிமை விடுப்பு சான்று
                                                </option>
                                                <option value="வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்">வங்கி கணக்கு
                                                    புத்தகத்தின் முதல் பக்கம்</option>
                                            </select>

                                            <div class="" id="aadhaar_cardhide" style="display: none;">
                                                <label>ஆதார் அட்டை</label>
                                                <input id="aadhaar_card" class="form-control" type="file"
                                                    name="aadhaar_card">
                                            </div>
                                            <div class="" id="voteridhide" style="display: none;">
                                                <label>வாகாளர் அடையாள அட்டை</label>
                                                <input id="voterid" class="form-control" type="file"
                                                    name="voterid">
                                            </div>
                                            <div class="" id="passporthide" style="display: none;">
                                                <label>பாஸ்போர்ட்</label>
                                                <input id="passport" class="form-control" type="file"
                                                    name="passport">
                                            </div>
                                            <div class="" id="electricity_bill_receipthide" style="display: none;">
                                                <label>மின்சார கட்டணம் ரசீது</label>
                                                <input id="electricity_bill_receipt" class="form-control"
                                                    type="file" name="electricity_bill_receipt">
                                            </div>
                                            <div class="" id="telephone_chargeshide" style="display: none;">
                                                <label>தொலைபேசி கட்டணம்</label>
                                                <input id="telephone_charges" class="form-control"
                                                    type="file" name="telephone_charges">
                                            </div>
                                            <div class="" id="gas_cylinder_receipthide" style="display: none;">
                                                <label>எரிவாயு சிலிண்டர் ரசீது</label>
                                                <input id="gas_cylinder_receipt" class="form-control"
                                                    type="file" name="gas_cylinder_receipt">
                                            </div>
                                            <div class="" id="property_tax_applicant_owns_househide"
                                                style="display: none;">
                                                <label>விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி</label>
                                                <input id="property_tax_applicant_owns_house"
                                                    class="form-control" type="file"
                                                    name="property_tax_applicant_owns_house">
                                            </div>
                                            <div class="" id="lease_deedhide" style="display: none;">
                                                <label>வாடகை ஒப்பந்த பத்திரம்</label>
                                                <input id="lease_deed" class="form-control" type="file"
                                                    name="lease_deed">
                                            </div>
                                            <div class="" id="allotment_rder_of_slum_replacement_boardhide"
                                                style="display: none;">
                                                <label>குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை</label>
                                                <input id="allotment_rder_of_slum_replacement_board"
                                                    class="form-control" type="file"
                                                    name="allotment_rder_of_slum_replacement_board">
                                            </div>
                                            <div class="" id="bond_leave_proofhide" style="display: none;">
                                                <label>கொத்தடிமை விடுப்பு சான்று</label>
                                                <input id="bond_leave_proof" class="form-control" type="file"
                                                    name="bond_leave_proof">
                                            </div>
                                            <div class="" id="first_page_of_bank_account_bookhide"
                                                style="display: none;">
                                                <label>வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்</label>
                                                <input id="first_page_of_bank_account_book" class="form-control"
                                                    type="file" name="first_page_of_bank_account_book">
                                            </div>
                                        </div>
                                        <div class="row">
                                        @elseif($serviceid == 36)
                                        <h4 class="text-center"> குடும்ப தலைவர் விபரம்</h4>

                                        <div class="mb-3 col-md-6">

                                            <label for="family_head_name" class="form-label">குடும்ப தலைவர்
                                                பெயர்பெயர் தமிழில்</label>
                                            <input required type="text" class="form-control" name="family_head_name"
                                                maxlength="30" placeholder="பெயர் தமிழில்" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                    name="mobile" placeholder="Mobile Number" />

                                            <label for="dist_id" class="form-label">District</label>
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="family_head_photo" class="form-label">குடும்ப தலைவர்
                                                புகைப்படம்</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="family_head_photo" />

                                            <label for="family_head_aadhaar" class="form-label">குடும்ப தலைவர் ஆதார்</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="family_head_aadhaar" />
                                            
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                        </div>
                                        <h3 class="text-center">குடும்ப உறுப்பினர் விபரம்</h3>
                                        <table id="pricetable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>உறவுமுறை</th>
                                                    <th>Aadhaar Card</th>
                                                    <th><a class="btn btn-sm btn-success" onclick="addnewrow()"><i
                                                                class='bx bx-plus-medical'></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> <select required name="relationship[]" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Mother">தாய்</option>
                                                            <option value="Father">தந்தை</option>
                                                            <option value="Husband">கணவர்</option>
                                                            <option value="Wife">மனைவி</option>
                                                            <option value="Son">மகன்</option>
                                                            <option value="Daughter">மகள்</option>
                                                            <option value="Father In Law">மாமனார்</option>
                                                            <option value="Mother In Law">மாமியார்</option>
                                                            <option value="Son In Law">மருமகன்</option>
                                                            <option value="Daughter In Law">மருமகள்</option>
                                                        </select></td>

                                                    <td>
                                                        <input required class="form-control" type="file"
                                                            name="doc[]" accept="image/jpeg, image/png">
                                                    </td>
                                                    <td><a onClick='removerow()'
                                                            class='btn btn-sm btn-danger btnDelete'><i
                                                                class='bx bx-trash'></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                               
                                    @endif
                                    <div class="text-center"><p id="nopayment"></p></div>
                                    <div class="mt-2 text-center">
                                        <button id="save" type="submit" class="btn btn-primary me-2">Apply</button>
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




        $('#any_document').change(function() {
            if ($('#any_document').val() == 'ஆதார் அட்டை') {
                $('#aadhaar_cardhide').show("slow");
                $('#voteridhide').hide("slow");
                $('#passporthide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#aadhaar_card').prop("required", true);

            } else if ($('#any_document').val() == 'வாகாளர் அடையாள அட்டை') {
                $('#voteridhide').show("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#passporthide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#voterid').prop("required", true);

            } else if ($('#any_document').val() == 'பாஸ்போர்ட்') {
                $('#passporthide').show("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#passport').prop("required", true);

            } else if ($('#any_document').val() == 'மின்சார கட்டணம் ரசீது') {
                $('#electricity_bill_receipthide').show("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#electricity_bill_receipt').prop("required", true);

            } else if ($('#any_document').val() == 'தொலைபேசி கட்டணம்') {
                $('#telephone_chargeshide').show("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required");
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required");
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#telephone_charges').prop("required", true);

            } else if ($('#any_document').val() == 'எரிவாயு சிலிண்டர் ரசீது') {
                $('#gas_cylinder_receipthide').show("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required");
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", true);

            } else if ($('#any_document').val() == 'விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி') {
                $('#property_tax_applicant_owns_househide').show("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required");
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", true);

            } else if ($('#any_document').val() == 'வாடகை ஒப்பந்த பத்திரம்') {
                $('#lease_deedhide').show("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#lease_deed').prop("required", true);

            } else if ($('#any_document').val() == 'குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை') {
                $('#allotment_rder_of_slum_replacement_boardhide').show("slow");
                $('#lease_deedhide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", true);

            } else if ($('#any_document').val() == 'கொத்தடிமை விடுப்பு சான்று') {
                $('#bond_leave_proofhide').show("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $$('#aadhaar_card').prop("required");
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#bond_leave_proof').prop("required", true);

            } else if ($('#any_document').val() == 'வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்') {
                $('#first_page_of_bank_account_bookhide').show("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required");
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", true);

            } else {
                $('#aadhaar_cardhide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#passporthide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);

            }
        });
        $('#residence_proof').change(function() {
            if ($('#residence_proof').val() == 'ஆதார் அட்டை') {
                $('#aadhaar_card').show("slow");
                $('#voterid').hide("slow");
                $('#passport').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#aadhaar_card').prop("required", true);

            } else if ($('#residence_proof').val() == 'வாக்காளர் அடையாள அட்டை') {
                $('#voterid').show("slow");
                $('#aadhaar_card').hide("slow");
                $('#passport').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#voterid').prop("required", true);

            } else if ($('#residence_proof').val() == 'பாஸ்போர்ட்') {
                $('#passport').show("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#passport').prop("required", true);

            } else if ($('#residence_proof').val() == 'மின்சார கட்டணம் ரசீது') {
                $('#electricity_bill_receipt').show("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#electricity_bill_receipt').prop("required", true);

            } else if ($('#residence_proof').val() == 'தொலைபேசி கட்டணம்') {
                $('#telephone_charges').show("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#telephone_charges').prop("required", true);

            } else if ($('#residence_proof').val() == 'எரிவாயு சிலிண்டர் ரசீது') {
                $('#gas_cylinder_receipt').show("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required");
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", true);

            } else if ($('#residence_proof').val() == 'விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி') {
                $('#property_tax_applicant_owns_house').show("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", true);

            } else if ($('#residence_proof').val() == 'வாடகை ஒப்பந்த பத்திரம்') {
                $('#lease_deed').show("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receip').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#lease_deed').prop("required", true);

            } else if ($('#residence_proof').val() == 'குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை') {
                $('#allotment_rder_of_slum_replacement_board').show("slow");
                $('#lease_deed').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", true);

            } else if ($('#residence_proof').val() == 'கொத்தடிமை விடுப்பு சான்று') {
                $('#bond_leave_proof').show("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#lease_deed').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#bond_leave_proof').prop("required", true);

            } else if ($('#residence_proof').val() == 'வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்') {
                $('#first_page_of_bank_account_book').show("slow");
                $('#bond_leave_proof').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#lease_deed').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", true);

            } else {
                $('#aadhaar_card').hide("slow");
                $('#voterid').hide("slow");
                $('#passport').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#driving_license').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
            }
        });

        $('#any_proof').change(function() {
            if ($('#any_proof').val() == 'இறப்பு சான்றிதழ்') {
                $('#death_hide').show("slow");
                $('#death').prop("required", true);
                $('#maraige_hide').hide("slow");
                $('#maraige').prop("required", false);
                $('#invite_hide').hide("slow");
                $('#invite').prop("required", false);
            } else if ($('#any_proof').val() == 'திருமண சான்று') {
                $('#maraige_hide').show("slow");
                $('#maraige').prop("required", true);
                $('#death_hide').hide("slow");
                $('#death').prop("required", false);
                $('#invite_hide').hide("slow");
                $('#invite').prop("required", false);
            } else if ($('#any_proof').val() == 'திருமண பத்திரிக்கை') {
                $('#invite_hide').show("slow");
                $('#invite').prop("required", true);
                $('#death_hide').hide("slow");
                $('#death').prop("required", false);
                $('#maraige_hide').hide("slow");
                $('#maraige').prop("required", false);
            }
        });

        $('#new_proof').change(function() {
            if ($('#new_proof').val() == 'ஆதார் அட்டை') {
                $('#adh_hide').show("slow");
                $('#adhar').prop("required", true);
                $('#born_hide').hide("slow");
                $('#born').prop("required", false);
                $('#voterhide').hide("slow");
                $('#voter').prop("required", false);
            } else if ($('#new_proof').val() == 'பிறப்பு சான்றிதழ்') {
                $('#born_hide').show("slow");
                $('#born').prop("required", true);
                $('#adh_hide').hide("slow");
                $('#adhar').prop("required", false);
                $('#voterhide').hide("slow");
                $('#voter').prop("required", false);
            } else if ($('#new_proof').val() == 'வாக்காளர் அட்டை') {
                $('#voterhide').show("slow");
                $('#voter').prop("required", true);
                $('#adh_hide').hide("slow");
                $('#adhar').prop("required", false);
                $('#born_hide').hide("slow");
                $('#born').prop("required", false);
            }
        });

        $("#pricetable").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
        });

        function addnewrow() {
            $("#pricetable tbody").append(
                "<tr><td> <select required name='relationship[]' class='form-control'><option value=''>Select</option><option value='Mother'>தாய்</option><option value='Father'>தந்தை</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Father In Law'>மாமனார்</option><option value='Mother In Law'>மாமியார்</option><option value='Son In Law'>மருமகன்</option><option value='Daughter In Law'>மருமகள்</option></select></td><td><input class='form-control' required type='file' name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
            );
        }
    </script>
@endpush
