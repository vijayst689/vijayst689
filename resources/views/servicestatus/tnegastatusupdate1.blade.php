@extends('layouts.app')
@section('content')
     <div class="page-wrapper">
        <div class="page-content">
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
                            <form class="row g-4" action="{{ url('submit_statusupdate_tnegaservices1') }}"
                                enctype="multipart/form-data" method="post" id="myForm">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="applied_serviceid" value="{{ $services->id }}">
                                    <input type="hidden" name="user_id" value="{{ $services->user_id }}">
                                    <input type="hidden" name="retailer_id" value="{{ $services->retailer_id }}">
                                    <input type="hidden" name="distributor_id" value="{{ $services->distributor_id }}">
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

                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <h5 class="card-title">{{ $servicename }}</h5>
                                            <div class="mb-3 row">
                                                <label for="example-text-input-lg" class="col-sm-3 form-label">Do You Have
                                                    Can Number</label>
                                                <div class="col-sm-6">
                                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        name="can_details" id="can_details" class="form-control">
                                                        <option value="">Select Can Details</option>
                                                        <option @if ($services->can_details == 'Yes') selected @endif
                                                            value="Yes">Yes</option>
                                                        <option @if ($services->can_details == 'No') selected @endif
                                                            value="No">No</option>
                                                        <option @if ($services->can_details == 'Find') selected @endif
                                                            value="Find">Find Can</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row" id="cannumberhide" style="display: none;">
                                                <label for="example-text-input-lg" class="col-sm-3 form-label">Can
                                                    Number</label>
                                                <div class="col-sm-6">
                                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                        class="form-control" id="cannumber" type="text" name="can_number"
                                                        value="{{ $services->can_number }}" maxlength="15">
                                                </div>
                                            </div>
                                            <div class="mb-3">

                                                <div class="row" id="dobhide" style="display: none;">
                                                    <h4 class="text-center">Can Details</h4>
                                                    <div class="mb-3 col-md-4">
                                                        <label style="color:#23e156" for="personalized"
                                                            class="form-label">திரு/திருமதி/செல்வி</label>
                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            class="form-control" name="personalized">
                                                            <option value="">Select</option>
                                                            <option @if ($services->personalized == 'திரு') selected @endif
                                                                value="திரு">திரு.
                                                            </option>
                                                            <option @if ($services->personalized == 'திருமதி') selected @endif
                                                                value="திருமதி">திருமதி.
                                                            </option>
                                                            <option @if ($services->personalized == 'செல்வன்') selected @endif
                                                                value="செல்வன்">
                                                                செல்வன்.</option>
                                                            <option @if ($services->personalized == 'செல்வி') selected @endif
                                                                value="செல்வி">
                                                                செல்வி.</option>
                                                        </select>
                                                        <label style="color:#23e156" for="relationship_1"
                                                            class="form-label">உறவுமுறை</label>
                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            class="form-control" name="relationship_1">
                                                            <option value="">Select</option>
                                                            <option @if ($services->relationship_1 == 'தந்தை') selected @endif
                                                                value="தந்தை">தந்தை.
                                                            </option>
                                                            <option @if ($services->relationship_1 == 'கணவர்') selected @endif
                                                                value="கணவர்">கணவர்.
                                                            </option>
                                                            <option @if ($services->relationship_1 == 'உறவினர்') selected @endif
                                                                value="உறவினர்">உறவினர்.
                                                            </option>
                                                        </select>
                                                        <label style="color:#23e156" for="mother_name_tamil"
                                                            class="form-label">தாயின் பெயர் தமிழில்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->mother_name_tamil }}"
                                                            class="form-control" name="mother_name_tamil" maxlength="100"
                                                            placeholder="தாயின் பெயர் தமிழில்" />

                                                        <label style="color:#23e156" for="community"
                                                            class="form-label">Community</label>
                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            class="form-control" name="community">
                                                            <option value="">Select Community</option>
                                                            <option @if ($services->community == 'BC') selected @endif
                                                                value="BC">BC.
                                                            </option>
                                                            <option @if ($services->community == 'OC') selected @endif
                                                                value="OC">OC.
                                                            </option>
                                                            <option @if ($services->community == 'OBC') selected @endif
                                                                value="OBC">OBC.
                                                            </option>
                                                            <option @if ($services->community == 'MBC') selected @endif
                                                                value="MBC">MBC.
                                                            </option>
                                                            <option @if ($services->community == 'SC') selected @endif
                                                                value="SC">SC.
                                                            </option>
                                                            <option @if ($services->community == 'ST') selected @endif
                                                                value="ST">ST.
                                                            </option>
                                                            <option @if ($services->community == 'BC(Muslim)') selected @endif
                                                                value="BC(Muslim)">BC (Muslim).
                                                            </option>
                                                        </select>
                                                        <label style="color:#23e156" for="door_no"
                                                            class="form-label">Door No</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->door_no }}"
                                                            class="form-control" name="door_no" maxlength="20"
                                                            placeholder="Door No" />
                                                        <label style="color:#23e156" for="pin_code"
                                                            class="form-label">Pin Code</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->pin_code }}"
                                                            class="form-control" name="pin_code" maxlength="10"
                                                            placeholder="Pin Code" />
                                                    </div>
                                                    <div class="mb-3 col-md-4">

                                                        <label style="color:#e411dd" for="personalized_name_tamil"
                                                            class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text"
                                                            value="{{ $services->personalized_name_tamil }}"
                                                            class="form-control" name="personalized_name_tamil"
                                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                                        <label style="color:#e411dd" for="relationship_name_tamil_1"
                                                            class="form-label">பெயர் தமிழில்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text"
                                                            value="{{ $services->relationship_name_tamil_1 }}"
                                                            class="form-control" name="relationship_name_tamil_1"
                                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                                        <label style="color:#e411dd" for="mother_name_english"
                                                            class="form-label">Mother Name (ENGLISH)</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->mother_name_english }}"
                                                            class="form-control" name="mother_name_english"
                                                            maxlength="50" placeholder="Mother Name (ENGLISH)" />  
                                                        <label style="color:#e411dd" for="education"
                                                            class="form-label">Education</label>
                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            class="form-control" name="education">
                                                            <option value="">Select Education</option>
                                                            <option @if ($services->education == 'Students') selected @endif
                                                                value="Students">Students
                                                            </option>
                                                            <option @if ($services->education == 'No Education') selected @endif
                                                                value="No Education">No Education
                                                            </option>
                                                            <option @if ($services->education == 'Private Employee') selected @endif
                                                                value="Private Employee">Private Employee
                                                            </option>
                                                            <option @if ($services->education == 'Govt.Employee') selected @endif
                                                                value="Govt.Employee">Govt.Employee
                                                            </option>
                                                            <option @if ($services->education == 'Daily Wages') selected @endif
                                                                value="Daily Wages">Daily Wages
                                                            </option>
                                                            <option @if ($services->education == 'Others') selected @endif
                                                                value="Others">Others
                                                            </option>
                                                        </select>
                                                        <label style="color:#e411dd" for="street_name_tamil"
                                                            class="form-label">தெரு பெயர்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->street_name_tamil }}"
                                                            class="form-control" name="street_name_tamil" maxlength="50"
                                                            placeholder="தெரு பெயர்" />
                                                        <label style="color:#e411dd" for="postal_area_tamil"
                                                            class="form-label">அஞ்சல் பெயர்</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->postal_area_tamil }}"
                                                            class="form-control" name="postal_area_tamil" maxlength="50"
                                                            placeholder="அஞ்சல் பெயர்" />
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label style="color:#23e156" for="personalized_name_english"
                                                            class="form-label">Applicant Name</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text"
                                                            value="{{ $services->personalized_name_english }}"
                                                            class="form-control" name="personalized_name_english"
                                                            maxlength="50" placeholder="Name In English" />
                                                        <label style="color:#23e156" for="relationship_name_english_1"
                                                            class="form-label">Name In English</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text"
                                                            value="{{ $services->relationship_name_english_1 }}"
                                                            class="form-control" name="relationship_name_english_1"
                                                            maxlength="50" placeholder="Name In English" />
                                                        <label style="color:#23e156" for="maritial_status"
                                                            class="form-label">Maritial Status</label>
                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            class="form-control" name="maritial_status">
                                                            <option value="">Select Maritial Status</option>
                                                            <option @if ($services->maritial_status == 'Un Married') selected @endif
                                                                value="Un Married">Un Married
                                                            </option>
                                                            <option @if ($services->maritial_status == 'Married') selected @endif
                                                                value="Married">Married
                                                            </option>
                                                            <option @if ($services->maritial_status == 'Widower') selected @endif
                                                                value="Widower">Widower
                                                            </option>
                                                            <option @if ($services->maritial_status == 'Widow') selected @endif
                                                                value="Widow">Widow
                                                            </option>
                                                            <option @if ($services->maritial_status == 'Divorced') selected @endif
                                                                value="Divorced">Divorced
                                                            </option>
                                                        </select>
                                                        <label style="color:#23e156" for="religion"
                                                            class="form-label">Religion</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->religion }}"
                                                            class="form-control" name="religion" maxlength="20"
                                                            placeholder="Religion" />
                                                        <label style="color:#23e156" for="street_name"
                                                            class="form-label">Street Name</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->street_name }}"
                                                            class="form-control" name="street_name" maxlength="30"
                                                            placeholder="Street Name" />
                                                        <label style="color:#23e156" for="postal_area_english"
                                                            class="form-label">Postal Area</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                            type="text" value="{{ $services->postal_area_english }}"
                                                            class="form-control" name="postal_area_english"
                                                            maxlength="50" placeholder="Postal Area" />

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
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
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
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/profile_photo/{{ $customers->profile }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                        <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                        @if ($customers->aadhaar_file == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                        @else
                                            <br><a target="_blank"
                                                href="/upload/users/aadhaar_file/{{ $customers->aadhaar_file }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif

                                        <label for="smart_card" class="form-label">Smart Card</label>
                                        @if ($customers->smartcard == '')
                                            <br><a href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
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
                                                value="{{ $services->income_yearly }}" id="incomeyearly"
                                                placeholder="Income Yearly" />

                                            <label for="income_monthly " class="form-label">Income (Monthly)</label>
                                            <input type="tel" class="form-control" name="income_monthly"
                                                value="{{ $services->income_monthly }}" id="incomemonthly"
                                                placeholder="Income Monthly" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label>Job Type</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                class="form-control" id="job_type" name="job_type"
                                                style="width: 100%;">
                                                <option value="">Select Job Type</option>
                                                <option @if ($services->job_type == 'Govt') selected @endif value="Govt">
                                                    Govt Employee</option>
                                                <option @if ($services->job_type == 'Private') selected @endif
                                                    value="Private">Private Employee</option>
                                                <option @if ($services->job_type == 'Agriculture') selected @endif
                                                    value="Agriculture">Agriculture</option>
                                                <option @if ($services->job_type == 'Others') selected @endif value="Others">
                                                    Others</option>
                                            </select>

                                            <div class="" id="incomecertgovthide" class="form-control"
                                                style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->salary_slip != '')
                                                        <label>Salary Slip</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/salary_slip/{{ $services->salary_slip }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Salary Slip</label>
                                                    <input @if ($services->salary_slip == '' && $services->job_type == 'Govt') required @endif
                                                        class="form-control" type="file" id="salary_slip"
                                                        accept="image/jpeg, image/png" name="salary_slip">
                                                    @if ($services->salary_slip != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/salary_slip/{{ $services->salary_slip }}">Download</a><br>
                                                    @endif
                                                @endif

                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->pancard != '')
                                                        <label>Pancard</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/pancard/{{ $services->pancard }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Pancard</label>
                                                    <input @if ($services->pancard == '' && $services->job_type == 'Govt') required @endif
                                                        class="form-control" type="file" id="pancard"
                                                        accept="image/jpeg, image/png" name="pancard">
                                                    @if ($services->pancard != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/pancard/{{ $services->pancard }}">Download</a><br>
                                                    @endif
                                                @endif

                                            </div>
                                        </div>
                                    @elseif($serviceid == 3)
                                    <div class="mb-3 col-md-6">
                                            <label class="form-label">Father's Community</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                name="father_community" id="father_community" class="form-control">
                                                <option value="">Select Father's Community</option>
                                                <option @if ($services->father_community == 'BC') selected @endif value="BC">BC</option>
                                                <option @if ($services->father_community == 'BC Muslim') selected @endif value="BC Muslim">BC Muslim</option>
                                                <option @if ($services->father_community == 'OC') selected @endif
                                                value="OC">OC</option>
                                                <option @if ($services->father_community == 'MBC') selected @endif value="MBC">
                                                MBC</option>
                                                    <option @if ($services->father_community == 'DNC/DNT') selected @endif value="DNC/DNT">DNC/DNT</option>
                                                <option @if ($services->father_community == 'SC') selected @endif value="SC">SC</option>
                                                <option @if ($services->father_community == 'ST') selected @endif
                                                value="ST">ST</option>
                                                <option @if ($services->father_community == 'SC Arunthathiyar') selected @endif value="SC Arunthathiyar">
                                                SC Arunthathiyar</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                        <label for="father_caste" class="form-label">Father's Caste</label>
                                              <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                               type="text" value="{{ $services->father_caste }}" class="form-control" name="father_caste" maxlength="100"
                                                placeholder="Father's Caste" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Mother's Community</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                name="mother_community" id="mother_community" class="form-control">
                                                <option value="">Select Mother's Community</option>
                                                <option @if ($services->mother_community == 'BC') selected @endif value="BC">BC</option>
                                                <option @if ($services->mother_community == 'BC Muslim') selected @endif value="BC Muslim">BC Muslim</option>
                                                <option @if ($services->mother_community == 'OC') selected @endif
                                                value="OC">OC</option>
                                                <option @if ($services->mother_community == 'MBC') selected @endif value="MBC">
                                                MBC</option>
                                                    <option @if ($services->mother_community == 'DNC/DNT') selected @endif value="DNC/DNT">DNC/DNT</option>
                                                <option @if ($services->mother_community == 'SC') selected @endif value="SC">SC</option>
                                                <option @if ($services->mother_community == 'ST') selected @endif
                                                value="ST">ST</option>
                                                <option @if ($services->mother_community == 'SC Arunthathiyar') selected @endif value="SC Arunthathiyar">
                                                SC Arunthathiyar</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                        <label for="mother_caste" class="form-label">Mother's Caste</label>
                                              <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                               type="text" value="{{ $services->mother_caste }}" class="form-control" name="mother_caste" maxlength="100"
                                                placeholder="Mother's Caste" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Relationship</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                name="relationship" id="relation" class="form-control">
                                                <option value="">Select Relationship</option>
                                                <option @if ($services->relationship == 'Father') selected @endif value="Father">Father</option>
                                                <option @if ($services->relationship == 'Mother') selected @endif value="Mother">Mother</option>
                                                <option @if ($services->relationship == 'Brother') selected @endif
                                                value="Brother">Brother</option>
                                                <option @if ($services->relationship == 'Sister') selected @endif value="Sister">
                                                    Sister</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6" id="tc" style="display :none;">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->tc_community_certificate != '')
                                                    <label>TC / Community Certificate</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/tc_community_certificate/{{ $services->tc_community_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>TC / Community Certificate</label>
                                                <input @if ($services->tc_community_certificate == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="tc_community_certificate">
                                                @if ($services->tc_community_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/tc_community_certificate/{{ $services->tc_community_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6" id="affidavithide" style="display :none;">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->affidavit != '')
                                                    <label>Affidavit</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/affidavit/{{ $services->affidavit }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Affidavit</label>
                                                <input @if ($services->affidavit == '') @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="affidavit">
                                                @if ($services->affidavit != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/affidavit/{{ $services->affidavit }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6" id="self" style="display :none;">

                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->self_community_certificate != '')
                                                    <label>Self Community Certificate (If Available)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/self_community_certificate/{{ $services->self_community_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Self Community Certificate (If Available)</label>
                                                <input @if ($services->self_community_certificate == '') @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="self_community_certificate">
                                                @if ($services->self_community_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/self_community_certificate/{{ $services->self_community_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif($serviceid == 4)
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->income_certificate != '')
                                                    <label>Income Certificate</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/income_certificate/{{ $services->income_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Income Certificate</label>
                                                <input @if ($services->income_certificate == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="income_certificate">
                                                @if ($services->income_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/income_certificate/{{ $services->income_certificate }}">Download</a><br>
                                                @endif
                                            @endif

                                        </div>

                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->community_certificate != '')
                                                    <label>Community Certificate</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/community_certificate/{{ $services->community_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Community Certificate</label>
                                                <input @if ($services->community_certificate == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="community_certificate">
                                                @if ($services->community_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/community_certificate/{{ $services->community_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif($serviceid == 11)
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->birth_certificate != '')
                                                    <label>Birth Certificate</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/birth_certificate/{{ $services->birth_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Birth Certificate</label>
                                                <input @if ($services->birth_certificate == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="birth_certificate">
                                                @if ($services->birth_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/birth_certificate/{{ $services->birth_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                </div>
                            @elseif($serviceid == 14)
                                <div class="mb-3 col-md-6">
                                    <label for="smartcard_no" class="form-label number">Smart Card Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif type="text"
                                        maxlength="10" class="form-control" name="smartcard_no"
                                        value="{{ $services->smartcard_no }}" placeholder="Smart Card Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->smartcard_online != '')
                                            <label>Smart Card (Online Print)</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/smartcard_online/{{ $services->smartcard_online }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Smart Card (Online Print)</label>
                                        <input @if ($services->smartcard_online == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="smartcard_online">
                                        @if ($services->smartcard_online != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/smartcard_online/{{ $services->smartcard_online }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                            @elseif($serviceid == 20)
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">வயது சான்று</label>
                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required id="age_proof"
                                        name="age_proof" class="form-control">
                                        <option value="">Select Age Proof</option>
                                        <option @if ($services->age_proof == 'Birth Certificate') selected @endif
                                            value="Birth Certificate">Birth Certificate</option>
                                        <option @if ($services->age_proof == 'Voter Id') selected @endif value="Voter Id">Voter
                                            Id</option>
                                        <option @if ($services->age_proof == 'Licence') selected @endif value="Licence">
                                            Licence</option>
                                        <option @if ($services->age_proof == 'Marksheet') selected @endif value="Marksheet">
                                            Marksheet</option>
                                        <option @if ($services->age_proof == 'Tc/Community Certificate') selected @endif
                                            value="Tc/Community Certificate">Tc</option>

                                    </select>
                                    <div class="" id="birth_certificatehide" style="display: none;">
                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->birth_certificate != '')
                                                <label>Birth Certificate</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/birth_certificate/{{ $services->birth_certificate }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Birth Certificate</label>
                                            <input @if ($services->birth_certificate == '' && $services->age_proof == 'Birth Certificate') required @endif
                                                class="form-control" type="file" accept="image/jpeg, image/png"
                                                name="birth_certificate" id="birth_certificate">
                                            @if ($services->birth_certificate != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/birth_certificate/{{ $services->birth_certificate }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="" id="voteridhide" style="display: none;">
                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->voterid != '')
                                                <label>Voter Id</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Voter Id</label>
                                            <input @if ($services->voterid == '' && $services->age_proof == 'Voter Id') required @endif
                                                class="form-control" type="file" accept="image/jpeg, image/png"
                                                name="voterid" id="voterid">
                                            @if ($services->voterid != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="" id="driving_licensehide" style="display: none;">
                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->driving_license != '')
                                                <label>Licence</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/driving_license/{{ $services->driving_license }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Licence</label>
                                            <input @if ($services->driving_license == '' && $services->age_proof == 'Licence') required @endif
                                                class="form-control" type="file" accept="image/jpeg, image/png"
                                                name="driving_license" id="driving_license">
                                            @if ($services->driving_license != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/driving_license/{{ $services->driving_license }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="" id="marksheethide" style="display: none;">
                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->marksheet != '')
                                                <label>Marksheet</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/marksheet/{{ $services->marksheet }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Marksheet</label>
                                            <input @if ($services->marksheet == '' && $services->age_proof == 'Marksheet') required @endif
                                                class="form-control" type="file" accept="image/jpeg, image/png"
                                                name="marksheet" id="marksheet">
                                            @if ($services->marksheet != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/marksheet/{{ $services->marksheet }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="" id="tc_community_certificatehide" style="display: none;">
                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->tc_community_certificate != '')
                                                <label>Tc</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/tc_community_certificate/{{ $services->tc_community_certificate }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Tc</label>
                                            <input @if ($services->tc_community_certificate == '' && $services->age_proof == 'Tc/Community Certificate') required @endif
                                                class="form-control" type="file" accept="image/jpeg, image/png"
                                                name="tc_community_certificate" id="tc_community_certificate">
                                            @if ($services->tc_community_certificate != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/tc_community_certificate/{{ $services->tc_community_certificate }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        @if ($services->mrg_invitation != '')
                                            <label>திருமண பத்திரிக்கை</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/mrg_invitation/{{ $services->mrg_invitation }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>திருமண பத்திரிக்கை</label>
                                        <input @if ($services->mrg_invitation == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="mrg_invitation">
                                        @if ($services->mrg_invitation != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/mrg_invitation/{{ $services->mrg_invitation }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                                @endif
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                <div class="mb-3 col-md-6">
                                    <label for="service_name" class="form-label">Service Status</label>
                                    <select class="form-control" name="status" id="service_status">
                                        <option value="">Select</option>
                                        <option @if ($services->status == 'Pending') selected @endif
                                            value="Pending">Pending</option>
                                        <option @if ($services->status == 'Resubmit') selected @endif
                                            value="Resubmit">Resubmit</option>
                                        <option @if ($services->status == 'Processing') selected @endif
                                            value="Processing">Processing</option>
                                            @if ($services->status != 'Approved')
                                        <option @if ($services->status == 'Rejected') selected @endif value="Rejected">
                                        Rejected</option>
                                        @endif
                                            <option @if ($services->status == 'Approved') selected @endif
                                                value="Approved">Approved</option>
                                        </select>
                                </div>
                                <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <input value="{{ $services->remarks }}" class="form-control" type="text"
                                        name="remarks" maxlength="100" id="remarks" placeholder="Remarks" />
                                </div>
                                <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                    <label for="select" class="form-label">Select</label>
                                    <select class="form-control" name="selects" id="select">
                                        <option>select</option>
                                        <option @if ($services->selects == 'Text') selected @endif
                                            value = "Text">Text</option>
                                        <option @if ($services->selects == 'File') selected @endif
                                            value = "File">File</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6" id="acknowledgementhide" style="display :none;">
                                    <label for="acknowledgement" class="form-label">Acknowledgement</label>
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
                                            value = "Text">Text</option>
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
                                            <label for="service_name" class="form-label">Service Status</label>
                                            <input disabled value="{{ $services->status }}" class="form-control"
                                                type="text" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <textarea rows="2" class="form-control" type="text" disabled placeholder="Remarks">{{ $services->remarks }}</textarea>
                                        </div>

                                    </div>
                                @endif
                                <div class="mt-2 text-center">
                                    @if ($services->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                        <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                    @elseif($services->status == 'Approved')
                                        <button type="button" disabled class="btn btn-primary me-2">Completed</button>
                                    @else
                                        <button id="save" type="submit" class="btn btn-primary me-2">Submit</button>
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
    var dist_id = "{{ $customers->dist_id }}";
    var taluk_id = "{{ $customers->taluk_id }}";
    $(function() {
        gettaluk(dist_id);
        getpanchayath(taluk_id);

        var status = "{{ $services->status }}";
        var acknowledgement = "{{ $services->acknowledgement }}";
        var certificate = "{{ $services->certificate }}";
        var selects = "{{ $services->selects }}";
        var candetails = "{{ $services->can_details }}";
        var ageproof = "{{ $services->age_proof }}";
        var job_type = "{{ $services->job_type }}";
        var lects = "{{ $services->lects }}";
        var relationship = "{{ $services->relationship }}";

        if (job_type == "Govt") {
            $('#incomecertgovthide').show("slow");
        }

        if (ageproof == "Tc/Community Certificate") {
            $('#tc_community_certificatehide').show("slow");
        } else if (ageproof == "Marksheet") {
            $('#marksheethide').show("slow");
        } else if (ageproof == "Voter Id") {
            $('#voteridhide').show("slow");
        } else if (ageproof == "Birth Certificate") {
            $('#birth_certificatehide').show("slow");
        } else if (ageproof == "Licence") {
            $('#driving_licensehide').show("slow");
        }

        if (relationship == "Father") {
            $('#tc').show("slow");
            $('#self').show("slow");
            $('#affidavithide').hide("slow");
        } else if (relationship == "Mother") {
            $('#tc').show("slow");
            $('#self').show("slow");
            $('#affidavithide').show("slow");
        } else if (relationship == "Brother") {
            $('#tc').show("slow");
            $('#self').show("slow");
            $('#affidavithide').show("slow");
        } else if (relationship == "Sister") {
            $('#tc').show("slow");
            $('#self').show("slow");
            $('#affidavithide').show("slow");
        }

        if (candetails == "Yes") {
            $('#cannumberhide').show("slow");
            $('#cannumber').prop("required", true);
        } else if (candetails == "No") {
            $('#dobhide').show("slow");
        }

        if (status == "Resubmit") {
            $('#remarkshide').show("slow");
            $('#remarks').prop("required", true);
        } else if (status == "Processing") {
        if(selects == "Text"){
            $('#applicationnohide').show("slow");
        }
        if(selects == "File"){
            $('#acknowledgementhide').show("slow");
            if (acknowledgement == "") {
                $('#acknowledgement').prop("required", true);
            }
        }
            $('#selecthide').show("slow");


        } else if (status == "Approved") {
        if(lects == "Text"){
            $('#applicationhide').show("slow");
        }
        if(lects == "File"){
            $('#certhide').show("slow");
            if (certificate == "") {
                $('#certificate').prop("required", true);
            }
        }
            $('#selectshide').show("slow")
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
    $('#can_details').change(function() {
        if ($('#can_details').val() == 'Yes') {
            $('#cannumberhide').show("slow");
            $('#cannumber').prop("required", true);
            $('#dobhide').hide("slow");
        } else if ($('#can_details').val() == 'No') {} else if ($('#can_details').val() == 'Find') {
            window.location.href = "{{ url('applyservice') }}/" + 121;
        } else {
            $('#cannumberhide').hide("slow");
            $('#cannumber').prop("required", false);
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

        $('#select').change(function(){
            if($('#select').val() == 'Text') {
                $('#applicationnohide').show("slow");
                $('#application_no').prop("required", true); 
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
            }else if($('#select').val() == 'File'){
                $('#acknowledgementhide').show("slow");
                $('#acknowledgement').prop("required", false);
                $('#applicationnohide').hide("slow"); 
                $('#application_no').prop("required", false);
            }else{
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
            }  
        });

        $('#selects').change(function(){
            if($('#selects').val() == 'Text') {
                $('#applicationhide').show("slow");
                $('#application').prop("required", true); 
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
            }else if($('#selects').val() == 'File'){
                $('#certhide').show("slow");
                $('#certificate').prop("required", false);
                $('#applicationhide').hide("slow"); 
                $('#application').prop("required", false);
            }else{
                $('#applicationhide').hide("slow");
                $('#application').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
            }  
        });


        $('#relation').change(function() {
            //alert("oh");
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

    function addnewrow() {
        $("#pricetable tbody").append(
             "<tr><td> <select required name='family_relationship[]' class='form-control'><option value=''>Select</option><option value='Father'>தகப்பன்</option><option value='Mother'>தாய்</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Younger Brother'>அண்ணன்</option><option value='Elder Brother'>தம்பி</option><option value='Younger Sister'>அக்கா</option><option value='Elder Sister'>தங்கை</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'></td><td><input class='form-control' required type='text' name='relation_name_tamil[]'maxlength='80'></td><td width='10%'><input class='form-control number' required type='text' name='relation_age[]'maxlength='2'></td><td><select required name='occupation[]' class='form-control'><option value=''>Select</option><option value='Student'>Student</option><option value='Home Maker'>Home maker</option><option value='Govt Employee'>Govt employee</option><option value='Private Employee'>Private Employee</option><option value='Daily Wages'>Daily Wages</option><option value='Agriculture'>Agriculture</option><option value='Others'>Others</option></select></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
        );
    }

        document.getElementById("myForm").addEventListener("submit", function() {
        const btn = document.getElementById("save");
        btn.disabled = true;               
        btn.innerText = "Submitting...";  
        });
    </script>
@endpush

