@extends('layouts.app')
@section('content')
<style>
        :root {
            --primary: #852f75;
            /* soft green */
            --border: #cfe8dc;
            /* mild border */
            --bg: #f3f7f5;
            /* page background */
            --input-bg: #fcfdfc;
        }

        body {
            margin: 0;
            background: var(--bg);
            font-family: "Inter", "Noto Sans Tamil", sans-serif;
        }

        /* Wrapper */
        .form-wrapper {
            max-width: 1100px;
            margin: 30px auto;
            padding: 15px;
        }

        /* Card */
        .form-card {
            background: #f9fcfa;
            /* mild form color */
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
            border: 1.5px solid var(--border);
        }

        /* Section */
        .section {
            margin-bottom: 35px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 18px;
            padding-left: 10px;
            border-left: 4px solid var(--primary);
        }

        /* Grid */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .form-group.full {
            grid-column: span 2;
        }

        /* Labels */
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #841010;
        }

        /* Inputs */
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 12px;
            font-size: 14px;
            border-radius: 8px;
            border: 1.5px solid var(--border);
            background: var(--input-bg);
            transition: all .2s ease;
        }

        /* Focus */
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #156038;
            box-shadow: 0 0 0 3px rgba(104, 211, 145, 0.25);
        }

        /* File Upload */
        .form-group input[type="file"] {
            background: #f4fbf7;
            border-style: dashed;
            cursor: pointer;
        }

        /* Submit */
        .submit-wrap {
            text-align: center;
            margin-top: 30px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #ee0716, #ea0404);
            color: #fff;
            border: none;
            padding: 12px 42px;
            font-size: 15px;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 600;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #ee0716, #ea0404);
        }

        /* Mobile */
        @media (max-width: 768px) {

            .grid-2,
            .grid-3 {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: span 1;
            }
        }
    </style>
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
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary">Settings</button>
                    </div>
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

                    <div class="col-12 col-xl-12">
                        <div class="card rounded-4 border-top border-4 border-primary border-gradient-0">
                            <h5 class="card-title mt-2">{{ $servicename }}</h5>
                            <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span>
                            </h6>
                            <div class="card-body p-4">
                                <div class="row">
                                    <form class="row g-4" action="{{ url('submitaadhaar') }}" enctype="multipart/form-data"
                                        method="post" id="myForm">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" name="service_amount" value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">


                                            @if ($serviceid == 56)
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" class="form-label">Aadhaar Number</label>
                                                        <input required type="text"
                                                            class="form-control border border-dark text-dark"
                                                            name="aadhaar_no" placeholder="Aadhaar Number" maxlength="12" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="mobile" class="form-label">Mobile
                                                            Number (Aadhaar
                                                            link)</label>
                                                        <input required type="text" maxlength="10"
                                                            class="form-control border border-dark text-dark number"
                                                            name="mobile" placeholder="Mobile Number" />

                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="name" style="color:#c718b3" class="form-label">Name as per Adhaar/ஆதாரில் இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                        <input required type="text"
                                                            class="form-control border border-dark text-dark" name="name"
                                                            placeholder="Applicant Name" maxlength="30" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="door_no" style="color:#c718b3" class="form-label">Door
                                                            Number</label>
                                                        <input required type="text"
                                                            class="form-control border border-dark text-dark" name="door_no"
                                                            placeholder="Door Number" maxlength="30" />
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="address_english" style="color:#c718b3" class="form-label">Address
                                                            In
                                                            English</label>
                                                        <textarea required rows="2" type="text" maxlength="200" class="form-control border border-dark text-dark"
                                                            name="address_english" placeholder="Address In English"></textarea>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="address_tamil" style="color:#c718b3" class="form-label">முகவரி
                                                            தமிழில்</label>
                                                        <textarea required rows="2" type="text" maxlength="200" class="form-control border border-dark text-dark"
                                                            name="address_tamil" placeholder="முகவரி தமிழில்"></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="dist_id" style="color:#c718b3"
                                                            class="form-label">District</label>
                                                        <select name="dist_id" id="dist_id"
                                                            class="form-control border border-dark text-dark">
                                                            <option value="">Select District</option>
                                                            @foreach ($districts as $d)
                                                                <option value="{{ $d->id }}">
                                                                    {{ $d->district_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="taluk_id" style="color:#c718b3"
                                                            class="form-label">Taluk</label>
                                                        <select name="taluk_id" id="taluk"
                                                            class="form-control border border-dark text-dark">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="postal_area_english" style="color:#c718b3"
                                                            class="form-label">Postal
                                                            Area</label>
                                                        <input required type="text" maxlength="100"
                                                            class="form-control border border-dark text-dark"
                                                            name="postal_area_english" placeholder="Postal Area" />
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="pin_code" style="color:#c718b3" class="form-label">Pin
                                                            code</label>
                                                        <input required type="text"
                                                            class="form-control border border-dark text-dark"
                                                            name="pin_code" placeholder="Pin Code" maxlength="30" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="id_proof" style="color:#c718b3" class="form-label">ஏதேனும்
                                                            அடையாள
                                                            ஆதாரம்</label>
                                                        <select required class="form-control border border-dark text-dark"
                                                            id="id_proof" name="id_proof">
                                                            <option value="">Select Proof</option>
                                                            <option value="Bank Passbook">Bank Passbook(With Photo)
                                                            </option>
                                                            <option value="Smartcard Online Print">Smartcard Online Print
                                                            </option>
                                                            <option value="Voter Id">Voter Id (Latest)</option>
                                                        </select>

                                                    </div>
                                                    <div class="mb-3 col-md-6">

                                                        <div class="" id="passbookhide" style="display: none;">
                                                            <label style="color:#c718b3" class="form-label">Bank Passbook</label>
                                                            <input type="file" class="form-control"
                                                                accept="image/jpeg, image/png" name="bank_pass_book">
                                                        </div>
                                                        <div class="" id="smartcardhide" style="display: none;">
                                                            <label style="color:#c718b3" class="form-label">Smartcard Online
                                                                Print</label>
                                                            <input class="form-control" type="file"
                                                                accept="image/jpeg, image/png"
                                                                name="smartcard_onlineprint">
                                                        </div>

                                                        <div class="" id="voteridhide" style="display: none;">
                                                            <label style="color:#c718b3" class="form-label">Voter Id
                                                                (Latest)</label>
                                                            <input class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="voterid">
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif ($serviceid == 58)
                                                <div class="form-wrapper">
                                                    <div class="form-card" style="color: #19c2a9">
                                                        <div class="section">
                                                            <div class="grid-2">

                                                                <div class="form-group">
                                                                    <label>Aadhaar Number</label>
                                                                    <input type="text" name="aadhaar_no"
                                                                        maxlength="12" placeholder="Aadhaar Number"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Mobile Number(Aadhaar link)</label>
                                                                    <input class="form-control number" type="text"
                                                                        name="mobile" maxlength="10"
                                                                        placeholder="Mobile Number" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Name as per Adhaar/ஆதாரில் இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                                    <input type="text" name="name" maxlength="100"
                                                                        placeholder="Applicant Name" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Door Number</label>
                                                                    <input class="form-control" type="text"
                                                                        name="door_no" maxlength="20"
                                                                        placeholder="Door Number" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="section">
                                                            <div class="grid-2">

                                                                <div class="form-group">
                                                                    <label>District</label>
                                                                    <select name="dist_id" id="dist_id"
                                                                        class="form-control">
                                                                        <option value="">Select District</option>
                                                                        @foreach ($districts as $d)
                                                                            <option value="{{ $d->id }}">
                                                                                {{ $d->district_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Taluk</label>
                                                                    <select name="taluk_id" id="taluk"
                                                                        class="form-control">
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Address in English</label>
                                                                    <textarea rows="2" name="address_english" required></textarea>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>முகவரி தமிழில்</label>
                                                                    <textarea rows="2" name="address_tamil" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="section">
                                                            <div class="grid-2">
                                                                <div class="form-group">
                                                                    <label>Postal Area</label>
                                                                    <input type="text" name="postal_area_english"
                                                                        maxlength="100" placeholder="Postal Area"
                                                                        required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Pin code</label>
                                                                    <input class="form-control" type="text"
                                                                        name="pin_code" maxlength="20"
                                                                        placeholder="Pin coder" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>School ID Card</label>
                                                                    <input type="file" accept="image/jpeg, image/png"
                                                                        name="schl_id_card" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>ஏதேனும் அடையாள ஆதாரம்</label>
                                                                    <select required id="id_proof" name="id_proof">
                                                                        <option value="">Select Proof</option>
                                                                        <option value="Bank Passbook">Bank Passbook(With
                                                                            Photo)</option>
                                                                        <option value="Smartcard Online Print">Smartcard
                                                                            Online Print
                                                                        </option>
                                                                        <option value="Voter Id">Voter Id (Latest)</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="section">
                                                            <div class="grid-2">
                                                                <div class="form-group" id="passbookhide"
                                                                    style="display: none;">
                                                                    <label>Bank Passbook</label>
                                                                    <input type="file" accept="image/jpeg, image/png"
                                                                        name="bank_pass_book">
                                                                </div>

                                                                <div class="form-group" id="smartcardhide"
                                                                    style="display: none;">
                                                                    <label>Smartcard Online Print</label>
                                                                    <input type="file" accept="image/jpeg, image/png"
                                                                        name="smartcard_onlineprint">
                                                                </div>

                                                                <div class="form-group" id="voteridhide"
                                                                    style="display: none;">
                                                                    <label>Voter Id (Latest)</label>
                                                                    <input type="file" accept="image/jpeg, image/png"
                                                                        name="voterid">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @elseif ($serviceid == 158)
                                                        <div class="form-wrapper">
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef">Aadhaar Number</label>
                                                                    <input required type="text" class="form-control"
                                                                        name="aadhaar_no" placeholder="Aadhaar Number"
                                                                        maxlength="12" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="mobile" class="form-label number">Mobile
                                                                        Number
                                                                        (Aadhaar
                                                                        link)</label>
                                                                    <input required type="text" maxlength="10"
                                                                        class="form-control number" name="mobile"
                                                                        placeholder="Mobile Number" />

                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="name" class="form-label">Name as per Adhaar/ஆதாரில் இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                                    <input required type="text" class="form-control"
                                                                        name="name" placeholder="Applicant Name"
                                                                        maxlength="30" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="door_no" class="form-label">Door
                                                                        Number</label>
                                                                    <input required type="text" class="form-control"
                                                                        name="door_no" placeholder="Door Number"
                                                                        maxlength="30" />
                                                                </div>
                                                            </div>

                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="address_english"
                                                                        class="form-label">Address In
                                                                        English</label>
                                                                    <textarea required rows="2" type="text" maxlength="200" class="form-control" name="address_english"
                                                                        placeholder="Address In English"></textarea>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="address_tamil" class="form-label">முகவரி
                                                                        தமிழில்</label>
                                                                    <textarea required rows="2" type="text" maxlength="200" class="form-control" name="address_tamil"
                                                                        placeholder="முகவரி தமிழில்"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="dist_id"
                                                                        class="form-label">District</label>
                                                                    <select name="dist_id" id="dist_id"
                                                                        class="form-control">
                                                                        <option value="">Select District</option>
                                                                        @foreach ($districts as $d)
                                                                            <option value="{{ $d->id }}">
                                                                                {{ $d->district_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="taluk_id" class="form-label">Taluk</label>
                                                                    <select name="taluk_id" id="taluk"
                                                                        class="form-control">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="postal_area_english"
                                                                        class="form-label">Postal
                                                                        Area</label>
                                                                    <input required type="text" maxlength="100"
                                                                        class="form-control" name="postal_area_english"
                                                                        placeholder="Postal Area" />
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="pin_code" class="form-label">Pin
                                                                        code</label>
                                                                    <input required type="text" class="form-control"
                                                                        name="pin_code" placeholder="Pin Code"
                                                                        maxlength="30" />
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="relation_name_english"
                                                                        class="form-label">Relation Name in
                                                                        English</label>
                                                                    <input required type="text" class="form-control"
                                                                        name="relation_name_english"
                                                                        placeholder="Relation Name in Tamil"
                                                                        maxlength="30" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="relation_name_tamil"
                                                                        class="form-label">உறவினர் பெயர்
                                                                        தமிழில்</label>
                                                                    <input required type="text" class="form-control"
                                                                        name="relation_name_tamil"
                                                                        placeholder="உறவினர் பெயர் தமிழில்"
                                                                        maxlength="100" />
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="relationship1"
                                                                        class="form-label">Relationship</label>
                                                                    <select required class="form-control"
                                                                        name="relationship1">
                                                                        <option value="">Select</option>
                                                                        <option value="Father">Father</option>
                                                                        <option value="Mother">Mother</option>
                                                                        <option value="Spouse">Spouse</option>
                                                                        <option value="Legal Gaurdian">Legal Gaurdian
                                                                        </option>
                                                                        <option value="Siblings">Siblings</option>
                                                                        <option value="Child or Ward">Child/Ward</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="id_proof" class="form-label">ஏதேனும்
                                                                        அடையாள
                                                                        ஆதாரம்</label>
                                                                    <select required class="form-control" id="id_proof"
                                                                        name="id_proof">
                                                                        <option value="">Select Proof</option>
                                                                        <option value="Bank Passbook">Bank Passbook(With
                                                                            Photo)</option>
                                                                        <option value="Smartcard Online Print">Smartcard
                                                                            Online Print
                                                                        </option>
                                                                        <option value="Voter Id">Voter Id(Latest)</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="mb-3 col-md-6">

                                                                <div class="" id="passbookhide"
                                                                    style="display: none;">
                                                                    <label style="color:#13ceef">Bank Passbook</label>
                                                                    <input type="file" class="form-control"
                                                                        accept="image/jpeg, image/png"
                                                                        name="bank_pass_book">
                                                                </div>
                                                                <div class="" id="smartcardhide"
                                                                    style="display: none;">
                                                                    <label style="color:#13ceef">Smartcard Online Print</label>
                                                                    <input class="form-control" type="file"
                                                                        accept="image/jpeg, image/png"
                                                                        name="smartcard_onlineprint">
                                                                </div>

                                                                <div class="" id="voteridhide"
                                                                    style="display: none;">
                                                                    <label style="color:#13ceef">Voter Id (Latest)</label>
                                                                    <input class="form-control" type="file"
                                                                        accept="image/jpeg, image/png" name="voterid">
                                                                </div>
                                                            </div>
                                                        </div>
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

                    $('#id_proof').change(function() {
                        if ($('#id_proof').val() == 'Bank Passbook') {
                            $('#passbookhide').show("slow");
                            $('#smartcardhide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#voterid').prop("required", false);
                            $('#smartcard_onlineprint').prop("required", false);
                            $('#bank_pass_book').prop("required", true);

                        } else if ($('#id_proof').val() == 'Smartcard Online Print') {
                            $('#smartcardhide').show("slow");
                            $('#voteridhide').hide("slow");
                            $('#passbookhide').hide("slow");
                            $('#voterid').prop("required", false);
                            $('#bank_pass_book').prop("required", false);
                            $('#smartcard_onlineprint').prop("required", true);

                        } else if ($('#id_proof').val() == 'Voter Id') {
                            $('#voteridhide').show("slow");
                            $('#smartcardhide').hide("slow");
                            $('#passbookhide').hide("slow");
                            $('#bank_pass_book').prop("required", false);
                            $('#smartcard_onlineprint').prop("required", false);
                            $('#voterid').prop("required", true);

                        } else {
                            $('#passbookhide').hide("slow");
                            $('#smartcardhide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#bank_pass_book').prop("required", false);
                            $('#smartcard_onlineprint').prop("required", false);
                            $('#voterid').prop("required", false);

                        }
                    });
                </script>
            @endpush
