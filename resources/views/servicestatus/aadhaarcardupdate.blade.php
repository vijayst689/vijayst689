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
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                                <div class="card-body p-4">
                                    <h5 class="card-title">{{ $servicename }}</h5>
                                    <form action="{{ url('/aadhaarcardupdate') }}" id="myForm" method="POST"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <input type="hidden" name="applied_serviceid" value="{{ $services->id }}">
                                            <input type="hidden" name="user_id" value="{{ $services->user_id }}">
                                            <input type="hidden" name="retailer_id" value="{{ $services->retailer_id }}">
                                            <input type="hidden" name="distributor_id"
                                                value="{{ $services->distributor_id }}">
                                            <input type="hidden" name="serviceid" value="{{ $services->service_id }}">
                                            @php
                                                $apply_user_id = 0;
                                                if ($services->distributor_id == 0 && $services->retailer_id == 0) {
                                                    $apply_user_id = $services->user_id;
                                                } elseif ($services->retailer_id == 0) {
                                                    $apply_user_id = $services->distributor_id;
                                                } elseif ($services->distributor_id == 0) {
                                                    $apply_user_id = $services->retailer_id;
                                                }
                                            @endphp

                                            @if ($serviceid == 56)
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" class="form-label">Aadhaar
                                                            Number</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->aadhaar_no }}"
                                                            class="form-control border border-dark text-dark"
                                                            name="aadhaar_no" maxlength="12" placeholder="Aadhaar Number" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="mobile"
                                                            class="form-label">Mobile Number
                                                            (Aadhaar
                                                            link)</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->mobile }}"
                                                            class="form-control border border-dark text-dark" name="mobile"
                                                            maxlength="30" placeholder="Mobile Number" />
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="name"
                                                            class="form-label">Name as per Adhaar/ஆதாரில் இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->name }}"
                                                            class="form-control border border-dark text-dark" name="name"
                                                            maxlength="30" placeholder="Applicant Name" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="door_no" class="form-label">Door
                                                            Number</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->door_no }}"
                                                            class="form-control border border-dark text-dark" name="door_no"
                                                            maxlength="30" placeholder="Door Number" />
                                                    </div>
                                                </div>
                                                <div class="row mb=3">
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="address_english"
                                                            class="form-label">Address
                                                            In
                                                            English</label>
                                                        <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                            value="{{ $services->address_english }}" class="form-control border border-dark text-dark"
                                                            name="address_english" maxlength="200" placeholder="Address In English">{{ $services->address_english }}</textarea>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="address_tamil"
                                                            class="form-label">முகவரி
                                                            தமிழில்</label>
                                                        <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                            value="{{ $services->address_tamil }}" class="form-control border border-dark text-dark" name="address_tamil"
                                                            maxlength="200" placeholder="முகவரி தமிழில்">{{ $services->address_tamil }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb=3">
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="dist_id"
                                                            class="form-label">District</label>
                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            name="dist_id" id="dist_id"
                                                            class="form-control border border-dark text-dark">
                                                            <option value="">Select District</option>
                                                            @foreach ($districts as $d)
                                                                <option @if ($d->id == $services->dist_id) selected @endif
                                                                    value="{{ $d->id }}">{{ $d->district_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="taluk_id"
                                                            class="form-label">Taluk</label>
                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            name="taluk_id" id="taluk"
                                                            class="form-control border border-dark text-dark">
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb=3">
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="postal_area_english"
                                                            class="form-label">Postal
                                                            Area</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->postal_area_english }}"
                                                            class="form-control border border-dark text-dark"
                                                            name="postal_area_english" maxlength="100"
                                                            placeholder="Postal Area" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3" for="pin_code"
                                                            class="form-label">Pin
                                                            code</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->pin_code }}"
                                                            class="form-control border border-dark text-dark"
                                                            name="pin_code" maxlength="30"
                                                            placeholder="Enter pin code" />
                                                    </div>
                                                </div>
                                                <div class="row mb=3">
                                                    <div class="col-md-6">
                                                        <label style="color:#c718b3">ஏதேனும் அடையாள ஆதாரம்</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                            class="form-control" id="id_proof" name="id_proof"
                                                            style="width: 100%;">
                                                            <option value="">Select Proof
                                                            </option>
                                                            <option @if ($services->id_proof == 'Bank Passbook') selected @endif
                                                                value="Bank Passbook">Bank Passbook(With Photo)
                                                            </option>
                                                            <option @if ($services->id_proof == 'Smartcard Online Print') selected @endif
                                                                value="Smartcard Online Print">Smartcard Online Print
                                                            </option>
                                                            <option @if ($services->id_proof == 'Voter Id') selected @endif
                                                                value="Voter Id">Voter Id (Latest)</option>

                                                        </select>
                                                    </div>

                                                    <div class="mb-3 col-md-6">

                                                        <div class="" id="passbookhide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->bank_pass_book != '')
                                                                    <label style="color:#c718b3" class="form-label">Bank
                                                                        Passbook(With Photo)</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label style="color:#c718b3" class="form-label">Bank
                                                                    Passbook(With
                                                                    Photo)</label>
                                                                <input @if ($services->bank_pass_book == '' && $services->id_proof == 'Bank Passbook')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="bank_pass_book"
                                                                    id="bank_pass_book">
                                                                @if ($services->bank_pass_book != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="" id="smartcardhide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->smartcard_onlineprint != '')
                                                                    <label style="color:#c718b3"
                                                                        class="form-label">Smartcard Online
                                                                        Print</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label style="color:#c718b3" class="form-label">Smartcard
                                                                    Online
                                                                    Print</label>
                                                                <input @if ($services->smartcard_onlineprint == '' && $services->id_proof == 'Smartcard Online Print')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png"
                                                                    name="smartcard_onlineprint"
                                                                    id="smartcard_onlineprint">
                                                                @if ($services->smartcard_onlineprint != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="" id="voteridhide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->voterid != '')
                                                                    <label style="color:#c718b3" class="form-label">Voter
                                                                        Id(Latest)</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label style="color:#c718b3" class="form-label">Voter Id
                                                                    (Latest)</label>
                                                                <input @if ($services->voterid == '' && $services->id_proof == 'Voter Id')  @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="voterid"
                                                                    id="voter_id">
                                                                @if ($services->voterid != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif ($serviceid == 58)
                                                <div class="form-wrapper">
                                                    <div class="form-card" style="color: #19c2a9">
                                                        <div class="section">
                                                            <div class="grid-2">
                                                                <div class="form-group">

                                                                    <label class="form-label">Aadhaar Number</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->aadhaar_no }}"
                                                                        class="form-control" name="aadhaar_no"
                                                                        maxlength="12" placeholder="Aadhaar Number" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="mobile" class="form-label">Mobile
                                                                        Number
                                                                        (Aadhaar
                                                                        link)</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->mobile }}"
                                                                        class="form-control" name="mobile"
                                                                        maxlength="30" placeholder="Mobile Number" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="name" class="form-label">Name as per Adhaar/ஆதாரில் இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->name }}"
                                                                        class="form-control" name="name"
                                                                        maxlength="30" placeholder="Applicant Name" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="door_no" class="form-label">Door
                                                                        Number</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->door_no }}"
                                                                        class="form-control" name="door_no"
                                                                        maxlength="30" placeholder="Door Number" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="section">
                                                            <div class="grid-2">
                                                                <div class="form-group">
                                                                    <label for="dist_id"
                                                                        class="form-label">District</label>
                                                                    <select
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        name="dist_id" id="dist_id"
                                                                        class="form-control">
                                                                        <option value="">Select District</option>
                                                                        @foreach ($districts as $d)
                                                                            <option
                                                                                @if ($d->id == $services->dist_id) selected @endif
                                                                                value="{{ $d->id }}">
                                                                                {{ $d->district_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="taluk_id" class="form-label">Taluk</label>
                                                                    <select
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        name="taluk_id" id="taluk"
                                                                        class="form-control">
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="address_english"
                                                                        class="form-label">Address In
                                                                        English</label>
                                                                    <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                                        value="{{ $services->address_english }}" class="form-control" name="address_english" maxlength="200"
                                                                        placeholder="Address In English">{{ $services->address_english }}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="address_tamil" class="form-label">முகவரி
                                                                        தமிழில்</label>
                                                                    <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                                        value="{{ $services->address_tamil }}" class="form-control" name="address_tamil" maxlength="200"
                                                                        placeholder="முகவரி தமிழில்">{{ $services->address_tamil }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="section">
                                                            <div class="grid-2">
                                                                <div class="form-group">
                                                                    <label for="postal_area_english"
                                                                        class="form-label">Postal
                                                                        Area</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->postal_area_english }}"
                                                                        class="form-control" name="postal_area_english"
                                                                        maxlength="100" placeholder="Postal Area" />
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="pin_code" class="form-label">Pin
                                                                        code</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->pin_code }}"
                                                                        class="form-control" name="pin_code"
                                                                        maxlength="30" placeholder="Enter pin code" />
                                                                </div>
                                                                <div class="form-group">
                                                                    @if (Auth::user()->id != $apply_user_id)
                                                                        @if ($services->schl_id_card != '')
                                                                            <label>School Id Card</label>
                                                                            <br><a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/schl_id_card/{{ $services->schl_id_card }}"
                                                                                class="btn btn-primary me-2">View</a><br>
                                                                        @endif
                                                                    @else
                                                                        <label>School Id Card</label>
                                                                        <input
                                                                            @if ($services->schl_id_card == '') required @endif
                                                                            class="form-control" type="file"
                                                                            accept="image/jpeg, image/png"
                                                                            name="schl_id_card">
                                                                        @if ($services->schl_id_card != '')
                                                                            <a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/schl_id_card/{{ $services->schl_id_card }}">Download</a><br>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>ஏதேனும் அடையாள ஆதாரம்</label>
                                                                    <select
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        required class="form-control" id="id_proof"
                                                                        name="id_proof" style="width: 100%;">
                                                                        <option value="">Select Handicapped Proof
                                                                        </option>
                                                                        <option
                                                                            @if ($services->id_proof == 'Bank Passbook') selected @endif
                                                                            value="Bank Passbook">Bank Passbook(With Photo)
                                                                        </option>
                                                                        <option
                                                                            @if ($services->id_proof == 'Smartcard Online Print') selected @endif
                                                                            value="Smartcard Online Print">Smartcard
                                                                            Online Print
                                                                        </option>
                                                                        <option
                                                                            @if ($services->id_proof == 'Voter Id') selected @endif
                                                                            value="Voter Id">Voter Id (Latest)</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="section">
                                                            <div class="grid-2">
                                                                <div class="form-group" id="passbookhide"
                                                                    style="display: none;">
                                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                        @if ($services->bank_pass_book != '')
                                                                            <label>Bank Passbook(With Photo)</label>
                                                                            <br><a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}"
                                                                                class="btn btn-primary me-2">View</a><br>
                                                                        @endif
                                                                    @else
                                                                        <label>Bank Passbook(With Photo)</label>
                                                                        <input @if ($services->bank_pass_book == '' && $services->id_proof == 'Bank Passbook')  @endif
                                                                            class="form-control" type="file"
                                                                            accept="image/jpeg, image/png"
                                                                            name="bank_pass_book" id="bank_pass_book">
                                                                        @if ($services->bank_pass_book != '')
                                                                            <a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}">Download</a><br>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="form-group" id="smartcardhide"
                                                                    style="display: none;">
                                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                        @if ($services->smartcard_onlineprint != '')
                                                                            <label>Smartcard Online Print</label>
                                                                            <br><a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}"
                                                                                class="btn btn-primary me-2">View</a><br>
                                                                        @endif
                                                                    @else
                                                                        <label>Smartcard Online Print</label>
                                                                        <input @if ($services->smartcard_onlineprint == '' && $services->id_proof == 'Smartcard Online Print')  @endif
                                                                            class="form-control" type="file"
                                                                            accept="image/jpeg, image/png"
                                                                            name="smartcard_onlineprint"
                                                                            id="smartcard_onlineprint">
                                                                        @if ($services->smartcard_onlineprint != '')
                                                                            <a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}">Download</a><br>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="form-group" id="voteridhide"
                                                                    style="display: none;">
                                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                        @if ($services->voterid != '')
                                                                            <label>Voter Id (Latest)</label>
                                                                            <br><a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}"
                                                                                class="btn btn-primary me-2">View</a><br>
                                                                        @endif
                                                                    @else
                                                                        <label>Voter Id (Latest)</label>
                                                                        <input @if ($services->voterid == '' && $services->id_proof == 'Voter Id')  @endif
                                                                            class="form-control" type="file"
                                                                            accept="image/jpeg, image/png" name="voterid"
                                                                            id="voter_id">
                                                                        @if ($services->voterid != '')
                                                                            <a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}">Download</a><br>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif ($serviceid == 158)
                                                        <div class="form-wrapper">
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef"
                                                                        class="form-label">Aadhaar Number</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->aadhaar_no }}"
                                                                        class="form-control" name="aadhaar_no"
                                                                        maxlength="12" placeholder="Aadhaar Number" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="mobile"
                                                                        class="form-label">Mobile
                                                                        Number (Aadhaar
                                                                        link)</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->mobile }}"
                                                                        class="form-control" name="mobile"
                                                                        maxlength="30" placeholder="Mobile Number" />
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="name"
                                                                        class="form-label">Name as per Adhaar/ஆதாரில் இருக்கும் படி பெயரை குறிப்பிடவும்</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->name }}"
                                                                        class="form-control" name="name"
                                                                        maxlength="30" placeholder="Applicant Name" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="door_no"
                                                                        class="form-label">Door
                                                                        Number</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->door_no }}"
                                                                        class="form-control" name="door_no"
                                                                        maxlength="30" placeholder="Door Number" />
                                                                </div>
                                                            </div>
                                                            <div class="row mb=3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="address_english"
                                                                        class="form-label">Address In
                                                                        English</label>
                                                                    <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                                        value="{{ $services->address_english }}" class="form-control" name="address_english" maxlength="200"
                                                                        placeholder="Address In English">{{ $services->address_english }}</textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="address_tamil"
                                                                        class="form-label">முகவரி
                                                                        தமிழில்</label>
                                                                    <textarea @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                                        value="{{ $services->address_tamil }}" class="form-control" name="address_tamil" maxlength="200"
                                                                        placeholder="முகவரி தமிழில்">{{ $services->address_tamil }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row mb=3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="dist_id"
                                                                        class="form-label">District</label>
                                                                    <select
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        name="dist_id" id="dist_id"
                                                                        class="form-control">
                                                                        <option value="">Select District</option>
                                                                        @foreach ($districts as $d)
                                                                            <option
                                                                                @if ($d->id == $services->dist_id) selected @endif
                                                                                value="{{ $d->id }}">
                                                                                {{ $d->district_name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="taluk_id"
                                                                        class="form-label">Taluk</label>
                                                                    <select
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        name="taluk_id" id="taluk"
                                                                        class="form-control">
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb=3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="postal_area_english"
                                                                        class="form-label">Postal
                                                                        Area</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->postal_area_english }}"
                                                                        class="form-control" name="postal_area_english"
                                                                        maxlength="100" placeholder="Postal Area" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="pin_code"
                                                                        class="form-label">Pin
                                                                        code</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->pin_code }}"
                                                                        class="form-control" name="pin_code"
                                                                        maxlength="30" placeholder="Enter pin code" />
                                                                </div>
                                                            </div>
                                                            <div class="row mb=3">
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="relation_name_english"
                                                                        class="form-label">Relation Name in
                                                                        English</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->relation_name_english }}"
                                                                        class="form-control" name="relation_name_english"
                                                                        maxlength="100"
                                                                        placeholder="Relation Name in English" />
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef" for="relation_name_tamil"
                                                                        class="form-label">உறவினர் பெயர்
                                                                        தமிழில்</label>
                                                                    <input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required type="text"
                                                                        value="{{ $services->relation_name_tamil }}"
                                                                        class="form-control" name="relation_name_tamil"
                                                                        maxlength="100"
                                                                        placeholder="உறவினர் பெயர் தமிழில்" />
                                                                </div>

                                                            </div>
                                                            <div class="row mb=3">
                                                                <div class="col-md-6">

                                                                    <label style="color:#13ceef" for="relationship1"
                                                                        class="form-label">Relationship</label>
                                                                    <select
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        class="form-control" name="relationship1"
                                                                        id="relationship1">
                                                                        <option value="">Select</option>
                                                                        <option
                                                                            @if ($services->relationship1 == 'Father') selected @endif
                                                                            value="Father">
                                                                            Father</option>
                                                                        <option
                                                                            @if ($services->relationship1 == 'Mother') selected @endif
                                                                            value="Mother">
                                                                            Mother</option>
                                                                        <option
                                                                            @if ($services->relationship1 == 'Spouse') selected @endif
                                                                            value="Spouse">
                                                                            Spouse</option>
                                                                        <option
                                                                            @if ($services->relationship1 == 'Legal Gaurdian') selected @endif
                                                                            value="Legal Gaurdian">Legal Gaurdian</option>
                                                                        <option
                                                                            @if ($services->relationship1 == 'Siblings') selected @endif
                                                                            value="Siblings">
                                                                            Siblings</option>
                                                                        <option
                                                                            @if ($services->relationship1 == 'Child or Ward') selected @endif
                                                                            value="Child or Ward">Child/Ward</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label style="color:#13ceef"
                                                                        class="form-label">ஏதேனும் அடையாள ஆதாரம்</label>
                                                                    <select
                                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                        required class="form-control" id="id_proof"
                                                                        name="id_proof" style="width: 100%;">
                                                                        <option value="">Select Proof
                                                                        </option>
                                                                        <option
                                                                            @if ($services->id_proof == 'Bank Passbook') selected @endif
                                                                            value="Bank Passbook">Bank Passbook(With Photo)
                                                                        </option>
                                                                        <option
                                                                            @if ($services->id_proof == 'Smartcard Online Print') selected @endif
                                                                            value="Smartcard Online Print">Smartcard
                                                                            Online Print
                                                                        </option>
                                                                        <option
                                                                            @if ($services->id_proof == 'Voter Id') selected @endif
                                                                            value="Voter Id">
                                                                            Voter Id (Latest)</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 col-md-6">

                                                                <div class="" id="passbookhide"
                                                                    style="display: none;">
                                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                        @if ($services->bank_pass_book != '')
                                                                            <label style="color:#13ceef">Bank Passbook(With
                                                                                Photo)</label>
                                                                            <br><a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}"
                                                                                class="btn btn-primary me-2">View</a><br>
                                                                        @endif
                                                                    @else
                                                                        <label style="color:#13ceef">Bank Passbook(With
                                                                            Photo)</label>
                                                                        <input @if ($services->bank_pass_book == '' && $services->id_proof == 'Bank Passbook')  @endif
                                                                            class="form-control" type="file"
                                                                            accept="image/jpeg, image/png"
                                                                            name="bank_pass_book" id="bank_pass_book">
                                                                        @if ($services->bank_pass_book != '')
                                                                            <a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}">Download</a><br>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="" id="smartcardhide"
                                                                    style="display: none;">
                                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                        @if ($services->smartcard_onlineprint != '')
                                                                            <label style="color:#13ceef">Smartcard Online
                                                                                Print</label>
                                                                            <br><a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}"
                                                                                class="btn btn-primary me-2">View</a><br>
                                                                        @endif
                                                                    @else
                                                                        <label style="color:#13ceef">Smartcard Online
                                                                            Print</label>
                                                                        <input @if ($services->smartcard_onlineprint == '' && $services->id_proof == 'Smartcard Online Print')  @endif
                                                                            class="form-control" type="file"
                                                                            accept="image/jpeg, image/png"
                                                                            name="smartcard_onlineprint"
                                                                            id="smartcard_onlineprint">
                                                                        @if ($services->smartcard_onlineprint != '')
                                                                            <a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/smartcard_onlineprint/{{ $services->smartcard_onlineprint }}">Download</a><br>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                <div class="" id="voteridhide"
                                                                    style="display: none;">
                                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                        @if ($services->voterid != '')
                                                                            <label style="color:#13ceef">Voter Id
                                                                                (Latest)</label>
                                                                            <br><a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}"
                                                                                class="btn btn-primary me-2">View</a><br>
                                                                        @endif
                                                                    @else
                                                                        <label style="color:#13ceef">Voter Id
                                                                            (Latest)</label>
                                                                        <input @if ($services->voterid == '' && $services->id_proof == 'Voter Id')  @endif
                                                                            class="form-control" type="file"
                                                                            accept="image/jpeg, image/png" name="voterid"
                                                                            id="voter_id">
                                                                        @if ($services->voterid != '')
                                                                            <a target="_blank"
                                                                                href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}">Download</a><br>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            @endif
</div>
                                            @if (Auth::user()->id != $apply_user_id)
                                                <div class="mb-3 col-md-6">
                                                    <label for="service_name" class="form-label">Service Status</label>
                                                    <select class="form-control" name="status" id="service_status">
                                                        <option value="">Select</option>
                                                        <option @if ($services->status == 'Pending') selected @endif
                                                            value="Pending">
                                                            Pending</option>
                                                        <option @if ($services->status == 'Resubmit') selected @endif
                                                            value="Resubmit">
                                                            Resubmit</option>
                                                        <option @if ($services->status == 'Processing') selected @endif
                                                            value="Processing">Processing</option>
                                                        @if ($services->status != 'Approved')
                                                            <option @if ($services->status == 'Rejected') selected @endif
                                                                value="Rejected">
                                                                Rejected</option>
                                                        @endif
                                                        <option @if ($services->status == 'Approved') selected @endif
                                                            value="Approved">
                                                            Approved</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                                    <label for="remarks" class="form-label">Remarks</label>
                                                    <input value="{{ $services->remarks }}" class="form-control"
                                                        type="text" name="remarks" maxlength="100" id="remarks"
                                                        placeholder="Remarks" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                                    <label for="select" class="form-label">Select</label>
                                                    <select class="form-control" name="selects" id="select">
                                                        <option>select</option>
                                                        <option @if ($services->selects == 'Text') selected @endif
                                                            value = "Text">
                                                            Text</option>
                                                        <option @if ($services->selects == 'File') selected @endif
                                                            value = "File">
                                                            File</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6" id="acknowledgementhide"
                                                    style="display :none;">
                                                    <label for="acknowledgement"
                                                        class="form-label">Acknowledgement</label>
                                                    <input class="form-control" type="file" name="acknowledgement"
                                                        id="acknowledgement" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                                    <label for="application_no" class="form-label">Application No</label>
                                                    <input value="{{ $services->application_no }}" class="form-control"
                                                        type="text" maxlength="20" name="application_no"
                                                        id="application_no" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                                    <label for="selects" class="form-label">Select</label>
                                                    <select class="form-control" name="lects" id="selects">
                                                        <option>select</option>
                                                        <option @if ($services->lects == 'Text') selected @endif
                                                            value = "Text">
                                                            Text</option>
                                                        <option @if ($services->lects == 'File') selected @endif
                                                            value = "File">File</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                                    <label for="application" class="form-label">Application</label>
                                                    <input value="{{ $services->application }}" class="form-control"
                                                        type="text" maxlength="150" name="application"
                                                        id="application" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                                    <label for="certificate" class="form-label">Certificate</label>
                                                    <input class="form-control" type="file" name="certificate"
                                                        id="certificate" />
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="service_name" class="form-label">Service
                                                            Status</label>
                                                        <input disabled value="{{ $services->status }}"
                                                            class="form-control" type="text" />
                                                    </div>
                                                    <div class="mb-3 col-md-6">
                                                        <label for="remarks" class="form-label">Remarks</label>
                                                        <textarea rows="2" class="form-control" type="text" disabled placeholder="Remarks">{{ $services->remarks }}</textarea>
                                                    </div>

                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-2 text-center">
                                            @if ($services->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                                <button type="submit" disabled
                                                    class="btn btn-primary me-2">Resubmit</button>
                                            @elseif($services->status == 'Approved')
                                                <button type="button" disabled
                                                    class="btn btn-primary me-2">Completed</button>
                                            @else
                                                <button id="save" type="submit"
                                                    class="btn btn-primary me-2">Submit</button>
                                            @endif
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
                    $(function() {
                        var status = "{{ $services->status }}";
                        var acknowledgement = "{{ $services->acknowledgement }}";
                        var certificate = "{{ $services->certificate }}";
                        var selects = "{{ $services->selects }}";
                        var lects = "{{ $services->lects }}";
                        var certificate = "{{ $services->certificate }}";
                        var selects = "{{ $services->selects }}";
                        var lects = "{{ $services->lects }}";
                        var dist_id = "{{ $services->dist_id }}";
                        var taluk_id = "{{ $services->taluk_id }}";
                        var id_proof = "{{ $services->id_proof }}";

                        gettaluk(dist_id);
                        getpanchayath(taluk_id);

                        if (status == "Resubmit") {
                            $('#remarkshide').show("slow");
                            $('#remarks').prop("required", true);

                        } else if (status == "Processing") {
                            if (selects == "Text") {
                                $('#applicationnohide').show("slow");
                            }
                            if (selects == "File") {
                                $('#acknowledgementhide').show("slow");
                                if (acknowledgement == "") {
                                    $('#acknowledgement').prop("required", true);
                                }
                            }
                            $('#selecthide').show("slow");


                        } else if (status == "Approved") {
                            if (lects == "Text") {
                                $('#applicationhide').show("slow");
                            }
                            if (lects == "File") {
                                $('#certhide').show("slow");
                                if (certificate == "") {
                                    $('#certificate').prop("required", true);
                                }
                            }
                            $('#selectshide').show("slow")
                        }
                    });

                    if (id_proof == "Bank Passbook") {
                        $('#passbookhide').show("slow");
                        $('#bank_pass_book').prop("required", true);
                    } else if (id_proof == "Smartcard Online Print") {
                        $('#smartcardhide').show("slow");
                        $('#smartcard_onlineprint').prop("required", true);
                    } else if (id_proof == "Voter Id") {
                        $('#voteridhide').show("slow");
                        $('#voterid').prop("required", true);
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
                                $("#taluk").val("{{ $services->taluk_id }}");

                            }
                        });
                    }


                    $('#enrollment_type').change(function() {
                        if ($('#enrollment_type').val() == 'Enrollment Slip') {
                            $('#ensliphide').show("slow");
                            $('#ennumberhide').hide("slow");
                            $('#enslip').prop("required", true);
                            $('#ennumber').prop("required", false);
                        } else if ($('#enrollment_type').val() == 'Enrollment Number') {
                            $('#ennumberhide').show("slow");
                            $('#ensliphide').hide("slow");
                            $('#enslip').prop("required", false);
                            $('#ennumber').prop("required", true);
                        }
                    });


                    $('#service_status').change(function() {
                        if ($('#service_status').val() == 'Resubmit') {
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                            $('#remarkshide').show("slow");
                            $('#remarks').prop("required", true);
                            $('#select').prop("required", false);
                            $('#selecthide').hide("slow");
                            $('#selects').prop("required", false);
                            $('#selectshide').hide("slow");
                        } else if ($('#service_status').val() == 'Processing') {
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#remarkshide').hide("slow");
                            $('#remarks').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#select').prop("required", true);
                            $('#selecthide').show("slow");
                            $('#selects').prop("required", false);
                            $('#selectshide').hide("slow");
                        } else if ($('#service_status').val() == 'Approved') {
                            $('#remarkshide').hide("slow");
                            $('#remarks').prop("required", false);
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#select').prop("required", false);
                            $('#selecthide').hide("slow");
                            $('#selects').prop("required", true);
                            $('#selectshide').show("slow");
                        } else {
                            $('#remarkshide').show("slow");
                            $('#remarks').prop("required", false);
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#select').prop("required", false);
                            $('#selecthide').hide("slow");
                            $('#selects').prop("required", false);
                            $('#selectshide').hide("slow");
                        }
                    });

                    $('#select').change(function() {
                        if ($('#select').val() == 'Text') {
                            $('#applicationnohide').show("slow");
                            $('#application_no').prop("required", true);
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                        } else if ($('#select').val() == 'File') {
                            $('#acknowledgementhide').show("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                        } else {
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                        }
                    });

                    $('#selects').change(function() {
                        if ($('#selects').val() == 'Text') {
                            $('#applicationhide').show("slow");
                            $('#application').prop("required", true);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                        } else if ($('#selects').val() == 'File') {
                            $('#certhide').show("slow");
                            $('#certificate').prop("required", false);
                            $('#applicationhide').hide("slow");
                            $('#application').prop("required", false);
                        } else {
                            $('#applicationhide').hide("slow");
                            $('#application').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                        }
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
                                $("#taluk").val("{{ $services->taluk_id }}");

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
                                $("#panchayath").val("{{ $services->panchayath_id }}");

                            }
                        });
                    }

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

                    document.getElementById("myForm").addEventListener("submit", function() {
                        const btn = document.getElementById("save");
                        btn.disabled = true;
                        btn.innerText = "Submitting...";
                    });
                </script>
            @endpush
