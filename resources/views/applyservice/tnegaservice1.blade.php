@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
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
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                        <div class="card-body p-4">
                            <h5 class="card-title">{{ $servicename }}</h5>
                            <h1 class="card-title">Service Payment : <span class="text-danger"
                                    id="canpayment">{{ $payment }}</span></h1>
                            <h5><span class="text-danger" id="cantext"></span></h5>
                            <form class="row g-4" action="{{ url('submitapply_tnegaservices1') }}"
                                enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" id="seramt" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3 row">
                                                <label for="example-text-input-lg" class="col-sm-3 form-label mt-4">Do You
                                                    Have
                                                    Can Number</label>
                                                <div class="col-sm-6 mt-4">
                                                    <select required name="can_details" id="can_details"
                                                        class="form-control">
                                                        <option value="">Select Can Details</option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Find">Find Can</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row" id="cannumberhide" style="display: none;">
                                                <label for="example-text-input-lg" class="col-sm-3 form-label">Can
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="cannumber" type="text"
                                                        name="can_number" value="{{ $customers->can_number }}"
                                                        maxlength="15">
                                                </div>
                                            </div>

                                            <div class="mb-3">

                                                <div class="row" id="dobhide" style="display: none;">
                                                    <h4 class="text-center">Can Details</h4>
                                                    <div class="mb-3 col-md-4">
                                                        <label style="color:#23e156" for="personalized"
                                                            class="form-label">திரு/திருமதி/செல்வி</label>
                                                        <select id="personalized" name="personalized" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="திரு">திரு.</option>
                                                            <option value="திருமதி">திருமதி.</option>
                                                            <option value="செல்வன்">செல்வன்.</option>
                                                            <option value="செல்வி">செல்வி.</option>
                                                        </select>
                                                        <label style="color:#23e156" for="relationship_1"
                                                            class="form-label">உறவுமுறை</label>
                                                        <select id="relationship_1" name="relationship_1"
                                                            class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="தந்தை">தந்தை.</option>
                                                            <option value="கணவர்">கணவர்.</option>
                                                            <option value="உறவினர்">உறவினர்.</option>

                                                        </select>
                                                        <label style="color:#23e156" for="mother_name_tamil"
                                                            class="form-label">தாயின் பெயர் தமிழில்</label>
                                                        <input type="text" maxlength="100" class="form-control"
                                                            name="mother_name_tamil" placeholder="தாயின் பெயர் தமிழில்" />

                                                        <label style="color:#23e156" for="community"
                                                            class="form-label">Community</label>
                                                        <select name="community" id="community" class="form-control">
                                                            <option value="">Select Community</option>
                                                            <option value="BC">BC</option>
                                                            <option value="OC">OC</option>
                                                            <option value="OBC">OBC</option>
                                                            <option value="MBC">MBC</option>
                                                            <option value="SC">SC</option>
                                                            <option value="ST">ST</option>
                                                            <option value="BC(Muslim)">BC (Muslim)</option>
                                                        </select>
                                                        <label style="color:#23e156" for="door_no"
                                                            class="form-label">Door No</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="door_no" placeholder="Door No" />
                                                        <label style="color:#23e156" for="pin_code"
                                                            class="form-label">Pin Code</label>
                                                        <input type="text" maxlength="10" class="form-control"
                                                            name="pin_code" placeholder="Pin Code" />
                                                    </div>
                                                    <div class="mb-3 col-md-4">

                                                        <label style="color:#e411dd" for="personalized_name_tamil"
                                                            class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="personalized_name_tamil" placeholder="பெயர் தமிழில்" />
                                                        <label style="color:#e411dd" for="relationship_name_tamil_1"
                                                            class="form-label">பெயர் தமிழில்</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="relationship_name_tamil_1"
                                                            placeholder="பெயர் தமிழில்" />
                                                        <label style="color:#e411dd" for="mother_name_english"
                                                            class="form-label">Mother Name (ENGLISH)</label>
                                                        <input type="text" maxlength="100" class="form-control"
                                                            name="mother_name_english"
                                                            placeholder="Mother Name (ENGLISH)" />
                                                        <label style="color:#e411dd" for="education"
                                                            class="form-label">Education</label>
                                                        <select name="education" id="education" class="form-control">
                                                            <option value="">Select Education</option>
                                                            <option value="Students ">Students </option>
                                                            <option value="No Education">No Education</option>
                                                            <option value="Private Employee">Private Employee
                                                            </option>
                                                            <option value="Govt.Employee">Govt.Employee
                                                            </option>
                                                            <option value="Daily Wages">Daily Wages
                                                            </option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                        <label style="color:#e411dd" for="street_name_tamil"
                                                            class="form-label">தெரு பெயர்</label>
                                                        <input type="text" maxlength="50" class="form-control"
                                                            name="street_name_tamil" placeholder="தெரு பெயர்" />
                                                        <label style="color:#e411dd" for="postal_area_tamil"
                                                            class="form-label">அஞ்சல் பெயர்</label>
                                                        <input type="text" maxlength="50" class="form-control"
                                                            name="postal_area_tamil" placeholder="அஞ்சல் பெயர்" />

                                                    </div>
                                                    <div class="mb-3 col-md-4">

                                                        <label style="color:#23e156" for="personalized_name_english"
                                                            class="form-label">Applicant Name</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="personalized_name_english"
                                                            placeholder="Name In English" />
                                                        <label style="color:#23e156" for="relationship_name_english_1"
                                                            class="form-label">Name In English</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="relationship_name_english_1"
                                                            placeholder="Name In English" />
                                                        <label style="color:#23e156" for="maritial_status"
                                                            class="form-label">Maritial Status</label>
                                                        <select id="maritial_status" name="maritial_status"
                                                            class="form-control">
                                                            <option value="">Select Maritial Status</option>
                                                            <option value="Un Married">Un Married</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Widower">Widower</option>
                                                            <option value="Widow">Widow</option>
                                                            <option value="Divorced">Divorced</option>
                                                        </select>

                                                        <label style="color:#23e156" for="religion"
                                                            class="form-label">Religion</label>
                                                        <input type="text" maxlength="20" class="form-control"
                                                            name="religion" placeholder="Religion" />

                                                        <label style="color:#23e156" for="street_name"
                                                            class="form-label">Street Name</label>
                                                        <input type="text" maxlength="30" class="form-control"
                                                            name="street_name" placeholder="Street Name" />

                                                        <label style="color:#23e156" for="postal_area_english"
                                                            class="form-label">Postal Area</label>
                                                        <input type="text" maxlength="50" class="form-control"
                                                            name="postal_area_english" placeholder="Postal Area" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="text-center"> Basic Details </h4>

                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input value="{{ $customers->name }}" readonly required type="text"
                                            class="form-control" name="name" placeholder="Name" />

                                        <label for="dist_id" class="form-label">District</label>
                                        <select disabled name="dist_id" id="dist_id" class="form-control">
                                            <option value="">Select District</option>
                                            @foreach ($districts as $d)
                                                <option @if ($d->id == $customers->dist_id) selected @endif
                                                    value="{{ $d->id }}">{{ $d->district_name }}</option>
                                            @endforeach
                                        </select>
                                        <label for="panchayath_id" class="form-label">VAO</label>
                                        <input class="form-control" type="text"
                                            value="{{ $customers->panchayath_name }}" readonly required
                                            name="panchayath_name" maxlength="50" placeholder="VAO">
                                        <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                        <input value="{{ $customers->aadhaar_no }}" readonly required type="text"
                                            maxlength="12" class="form-control" name="aadhaar_no"
                                            placeholder="Aadhaar Number" />
                                        <label for="signature" class="form-label">Signature</label>
                                        @if ($customers->signature == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File
                                                Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/signature/{{ $customers->signature }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif


                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="mobile" class="form-label number">Mobile Number</label>
                                        <input value="{{ $customers->phone }}" readonly required type="text"
                                            maxlength="10" class="form-control" name="mobile"
                                            placeholder="Mobile Number" />

                                        <label for="taluk_id" class="form-label">Taluk</label>
                                        <select disabled name="taluk_id" id="taluk" class="form-control">
                                        </select>

                                        <label for="photo" class="form-label">Photo</label>
                                        @if ($customers->profile == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File
                                                Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/profile_photo/{{ $customers->profile }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                        <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                        @if ($customers->aadhaar_file == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File
                                                Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/aadhaar_file/{{ $customers->aadhaar_file }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif

                                        <label for="smart_card" class="form-label">Smart Card</label>
                                        @if ($customers->smartcard == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File
                                                Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/smart_card/{{ $customers->smartcard }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif



                                    </div>
                                </div>
                                <div class="row">
                                    <h4 class="text-center"> Additional Details </h4>
                                    @if ($serviceid == 2)
                                        <div class="mb-3 col-md-6">
                                            <label for="income_yearly " class="form-label">Income (Yearly)</label>
                                            <input type="tel" class="form-control" name="income_yearly"
                                                id="incomeyearly" placeholder="Income Yearly" />

                                            <label for="income_monthly " class="form-label">Income (Monthly)</label>
                                            <input type="tel" class="form-control" name="income_monthly"
                                                id="incomemonthly" placeholder="Income Monthly" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="job_type" class="form-label">Job Type</label>
                                            <select required name="job_type" id="job_type" class="form-control">
                                                <option value="">Select Job Type</option>
                                                <option value="Govt">Govt Employee</option>
                                                <option value="Private">Private Employee</option>
                                                <option value="Agriculture">Agriculture</option>
                                                <option value="Agriculture">Business</option>
                                                <option value="Rent">Rent</option>
                                                <option value="Others">Others</option>
                                            </select>

                                            <div class="" id="incomecertgovthide" class="form-control"
                                                style="display: none;">
                                                <label>Salary Slip</label>
                                                <input id="salary_slip" class="form-control" type="file"
                                                    name="salary_slip">

                                                <label>Pancard</label>
                                                <input id="pancard" class="form-control" type="file"
                                                    name="pancard">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label>Pan Card(Optional)</label>
                                                <input class="form-control" type="file"
                                                    name="pan_card">
                                            </div>
                                        </div>
                                        <h3 class="text-center">Family Details</h3>
                                        <table id="pricetable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Relationship</th>
                                                    <th>Name</th>
                                                    <th>பெயர் தமிழில்</th>
                                                    <th>Age</th>
                                                    <th>Occupation</th>
                                                    <th><a class="btn btn-sm btn-success" onclick="addnewrow()"><i
                                                        class='material-symbols-outlined'>add</i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> <select required name="family_relationship[]"
                                                            class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Father">தகப்பன்</option>
                                                            <option value="Mother">தாய்</option>
                                                            <option value="Husband">கணவர்</option>
                                                            <option value="Wife">மனைவி</option>
                                                            <option value="Son">மகன்</option>
                                                            <option value="Daughter">மகள்</option>
                                                            <option value="Younger Brother">அண்ணன்</option>
                                                            <option value="Elder Brother">தம்பி</option>
                                                            <option value="Younger Sister">அக்கா</option>
                                                            <option value="Elder Sister">தங்கை</option>
                                                            <option value="Self">தனக்கு</option>
                                                            <option value="Relation">உறவினர்</option>
                                                        </select></td>
                                                    <td><input required class="form-control" type="text"
                                                            name="relation_name[]" maxlength="50"></td>
                                                    <td><input required class="form-control" type="text"
                                                            name="relation_name_tamil[]" maxlength="50"></td>
                                                    <td width="10%"><input required class="form-control number"
                                                            type="text" name="relation_age[]" maxlength="2"></td>
                                                    <td> <select required name="occupation[]" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Student">Student</option>
                                                            <option value="Home Maker">Home maker</option>
                                                            <option value="Govt Employee">Govt employee</option>
                                                            <option value="Private Employee">Private Employee</option>
                                                            <option value="Daily Wages">Daily Wages</option>
                                                            <option value="Agriculture">Agriculture</option>
                                                            <option value="Others">Others</option>
                                                    </select></td>
                                                    <td><a onClick='removerow()'
                                                            class='btn btn-sm btn-danger btnDelete'><i
                                                                class='material-symbols-outlined'>Remove</i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @elseif($serviceid == 3)
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Father's Community</label>
                                        <select required name="father_community" id="father_community" class="form-control">
                                            <option value="">Father's Community</option>
                                            <option value="BC">BC</option>
                                            <option value="BC Muslim">BC Muslim</option>
                                            <option value="OC">OC</option>
                                            <option value="MBC">MBC</option>
                                            <option value="DNC/DNT">DNC/DNT</option>
                                            <option value="SC">SC</option>
                                            <option value="ST">ST</option>
                                            <option value="SC Arunthathiyar">SC Arunthathiyar</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Father's Caste</label>
                                        <input required class="form-control" type="text"
                                            name="father_caste" placeholder="Father's Caste" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Mother's Community</label>
                                        <select required name="mother_community" id="mother_community" class="form-control">
                                            <option value="">Mother's Community</option>
                                            <option value="BC">BC</option>
                                            <option value="BC Muslim">BC Muslim</option>
                                            <option value="OC">OC</option>
                                            <option value="MBC">MBC</option>
                                            <option value="DNC/DNT">DNC/DNT</option>
                                            <option value="SC">SC</option>
                                            <option value="ST">ST</option>
                                            <option value="SC Arunthathiyar">SC Arunthathiyar</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label>Mother's Caste</label>
                                        <input required class="form-control" type="text"
                                            name="mother_caste" placeholder="Mather's Caste" />
                                    </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Relationship</label>
                                            <select required name="relationship" id="relation" class="form-control">
                                                <option value="">Select Relationship</option>
                                                <option value="Father">Father</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Brother">Brother</option>
                                                <option value="Sister">Sister</option>
                                            </select>

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>TC / Community Certificate</label>
                                            <input required class="form-control" type="file"
                                                name="tc_community_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6" id="affidavithide" style="display: none;">
                                            <label>Affidavit</label>
                                            <input id="affidavit" class="form-control" type="file"
                                                name="affidavit">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>Self Community Certificate (If Available)</label>
                                            <input class="form-control" type="file"
                                                name="self_community_certificate">
                                        </div>
                                    @elseif($serviceid == 4)
                                        <div class="mb-3 col-md-6">
                                            <label>Income Certificate</label>
                                            <input id="income_certificate" class="form-control" required type="file"
                                                name="income_certificate">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>Community Certificate</label>
                                            <input id="community_certificate" class="form-control" required
                                                type="file" name="community_certificate">
                                        </div>
                                    @elseif($serviceid == 11)
                                        <div class="mb-3 col-md-6">
                                            <label>Birth Certificate</label>
                                            <input id="birth_certificate" class="form-control" required type="file"
                                                name="birth_certificate">
                                        </div>
                                </div>
                            @elseif($serviceid == 14)
                                <div class="mb-3 col-md-6">
                                    <label for="smartcard_no" class="form-label number">Smart Card Number</label>
                                    <input type="text" maxlength="13" class="form-control" name="smartcard_no"
                                        required placeholder="Smart Card Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>Smart Card (Online Print)</label>
                                    <input id="smartcard_online" class="form-control" type="file"
                                        name="smartcard_online" required>
                                </div>
                            @elseif($serviceid == 20)
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">வயது சான்று</label>
                                    <select required id="age_proof" name="age_proof" class="form-control">
                                        <option value="">Select Age Proof</option>
                                        <option value="Birth Certificate">Birth Certificate</option>
                                        <option value="Voter Id">Voter Id</option>
                                        <option value="Licence">Licence</option>
                                        <option value="Marksheet">Marksheet</option>
                                        <option value="Tc/Community Certificate">Tc</option>

                                    </select>
                                    <div class="" id="birth_certificatehide" style="display: none;">
                                        <label>Birth Certificate</label>
                                        <input id="birth_certificate" class="form-control" type="file"
                                            name="birth_certificate">
                                    </div>
                                    <div class="" id="voteridhide" style="display: none;">
                                        <label>Voter Id</label>
                                        <input id="voterid" class="form-control" type="file" name="voterid">
                                    </div>
                                    <div class="" id="driving_licensehide" style="display: none;">
                                        <label>Licence</label>
                                        <input id="driving_license" class="form-control" type="file"
                                            name="driving_license">
                                    </div>
                                    <div class="" id="marksheethide" style="display: none;">
                                        <label>Marksheet</label>
                                        <input id="marksheet" class="form-control" type="file" name="marksheet">
                                    </div>
                                    <div class="" id="tc_community_certificatehide" style="display: none;">
                                        <label>Tc</label>
                                        <input id="tc_community_certificate" class="form-control" type="file"
                                            name="tc_community_certificate">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label>திருமண பத்திரிக்கை</label>
                                    <input class="form-control required" type="file" name="mrg_invitation">
                                </div>
                                @endif

                                <div class="text-center">
                                    <p id="nopayment"></p>
                                </div>
                                <div class="text-center">
                                    <div class="col-12">
                                        <div class="mb-0">
                                            <button id="save" type="submit" class="btn btn-primary">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>
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

        $('#incomeyearly').on('input', function() {
            var yearly = parseInt($('#incomeyearly').val());
            $('#incomemonthly').val((yearly / 12 ? yearly / 12 : 0).toFixed(2));
        });
        var customerid = "{{ $customers->id }}";
        $('#can_details').change(function() {
            if ($('#can_details').val() == 'Yes') {
                $('#cannumberhide').show("slow");
                $('#cannumber').prop("required", true);
                $('#dobhide').hide("slow");
                $('#canpayment').html(parseFloat(amount));
                $('#seramt').val(amount);
                $('#cantext').html("");
                $('#save').prop("disabled", false);
                $('#nopayment').html("");
            } else if ($('#can_details').val() == 'No') {
                $('#dobhide').show("slow");
                $('#cannumberhide').hide("slow");
                $('#cannumber').prop("required", false);
                $('#canpayment').html(parseFloat(amount) + 15);
                $('#seramt').val(parseFloat(amount) + 15);
                $('#cantext').html("Additional Amount of 15 will be added for can number...");
                var canamt = parseFloat(amount) + 15;
                if (parseFloat(canamt) > parseInt(wallet)) {
                    $('#save').prop("disabled", true);
                    $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service")
                .css({
                        'color': 'red',
                        'font-size': '150%',
                        'font-weight': 'bold'
                    });
                }
            } else if ($('#can_details').val() == 'Find') {
                $('#dobhide').hide("slow");
                $('#cannumberhide').show("slow");
                $('#cannumber').prop("required", false);
                window.location.href = "{{ url('applyservice') }}/" + 121 + "/" + customerid;
            } else {
                $('#dobhide').hide("slow");
                $('#cannumberhide').hide("slow");
                $('#cannumber').prop("required", false);
            }
        });

        $('#relation').change(function() {
            if ($('#relation').val() == 'Father' || $('#relation').val() == '') {
                $('#affidavithide').hide("slow");
                $('#affidavit').prop("required", false);
            } else {
                $('#affidavithide').show("slow");
                $('#affidavit').prop("required", true);
            }
        });

        $('#job_type').change(function() {
            if ($('#job_type').val() == 'Govt') {
                $('#incomecertgovthide').show("slow");
                $('#salary_slip').prop("required", true);
                $('#pancard').prop("required", true);
            } else {
                $('#incomecertgovthide').hide("slow");
                $('#salary_slip').prop("required", false);
                $('#pancard').prop("required", false);
            }
        });

        $('#age_proof').change(function() {
            if ($('#age_proof').val() == 'Tc/Community Certificate') {
                $('#tc_community_certificatehide').show("slow");
                $('#marksheethide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#marksheet').prop("required", false);
                $('#voterid').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#tc_community_certificate').prop("required", true);

            } else if ($('#age_proof').val() == 'Marksheet') {
                $('#marksheethide').show("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#voterid').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#marksheet').prop("required", true);

            } else if ($('#age_proof').val() == 'Voter Id') {
                $('#voteridhide').show("slow");
                $('#marksheethide').hide("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#voterid').prop("required", true);

            } else if ($('#age_proof').val() == 'Birth Certificate') {
                $('#birth_certificatehide').show("slow");
                $('#marksheethide').hide("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#voterid').prop("required", false);
                $('#driving_license').prop("required", false);
                $('#birth_certificate').prop("required", true);

            } else if ($('#age_proof').val() == 'Licence') {
                $('#driving_licensehide').show("slow");
                $('#marksheethide').hide("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#voterid').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", true);

            } else {
                $('#voteridhide').hide("slow");
                $('#marksheethide').hide("slow");
                $('#tc_community_certificatehide').hide("slow");
                $('#birth_certificatehide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#tc_community_certificate').prop("required", false);
                $('#marksheet').prop("required", false);
                $('#voterid').prop("required", false);
                $('#birth_certificate').prop("required", false);
                $('#driving_license').prop("required", false);

            }
        });

        $("#pricetable").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
        });


        function addnewrow() {
            $("#pricetable tbody").append(
                "<tr><td> <select required name='family_relationship[]' class='form-control'><option value=''>Select</option><option value='Father'>தகப்பன்</option><option value='Mother'>தாய்</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Younger Brother'>அண்ணன்</option><option value='Elder Brother'>தம்பி</option><option value='Younger Sister'>அக்கா</option><option value='Elder Sister'>தங்கை</option><option value='Relation'>உறவினர்</option><option value='Self'>தனக்கு</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'></td><td><input class='form-control' required type='text' name='relation_name_tamil[]'maxlength='80'></td><td width='10%'><input class='form-control number' required type='text' name='relation_age[]'maxlength='2'></td><td><select required name='occupation[]' class='form-control'><option value=''>Select</option><option value='Student'>Student</option><option value='Home Maker'>Home maker</option><option value='Govt Employee'>Govt employee</option><option value='Private Employee'>Private Employee</option><option value='Daily Wages'>Daily Wages</option><option value='Agriculture'>Agriculture</option><option value='Others'>Others</option></select></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
            );
        }
    </script>
@endpush
