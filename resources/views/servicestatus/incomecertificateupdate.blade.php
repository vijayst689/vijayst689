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
                    <div class="row">
                            <form class="row g-4" action="{{ url('submit_statusupdate_incomecertificate') }}"
                                enctype="multipart/form-data" method="post" id="myForm">
                                @csrf
                                @foreach ($services as $key => $ser)
                                    <div class="row">
                                        <input type="hidden" name="applied_serviceid" value="{{ $ser->id }}">
                                        <input type="hidden" name="user_id" value="{{ $ser->user_id }}">
                                        <input type="hidden" name="retailer_id" value="{{ $ser->retailer_id }}">
                                        <input type="hidden" name="distributor_id" value="{{ $ser->distributor_id }}">
                                        <input type="hidden" name="serviceid" value="{{ $ser->service_id }}">
                                        @php
                                            $apply_user_id = 0;
                                            if ($ser->distributor_id == 0 && $ser->retailer_id == 0) {
                                                $apply_user_id = $ser->user_id;
                                            } elseif ($ser->retailer_id == 0) {
                                                $apply_user_id = $ser->distributor_id;
                                            } elseif ($ser->distributor_id == 0) {
                                                $apply_user_id = $ser->retailer_id;
                                            }
                                        @endphp
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3 row">
                                                    <label for="example-text-input-lg" class="col-sm-3 form-label">Do You
                                                        Have Can Number</label>
                                                    <div class="col-sm-6">
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id) disabled @endif required
                                                            name="can_details" id="can_details" class="form-control">
                                                            <option value="">Select Can Details</option>
                                                            <option @if ($ser->can_details == 'Yes') selected @endif
                                                                value="Yes">Yes</option>
                                                            <option @if ($ser->can_details == 'No') selected @endif
                                                                value="No">No</option>
                                                            <option @if ($ser->can_details == 'Find') selected @endif
                                                                value="Find">Find Can</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row" id="cannumberhide" style="display: none;">
                                                    <label for="example-text-input-lg" class="col-sm-3 form-label">Can
                                                        Number</label>
                                                    <div class="col-sm-6">
                                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id) disabled @endif
                                                            class="form-control" id="cannumber" type="text"
                                                            name="can_number" value="{{ $ser->can_number }}" maxlength="15">
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
                                                                <option @if ($ser->personalized == 'திரு') selected @endif
                                                                    value="திரு">திரு.
                                                                </option>
                                                                <option @if ($ser->personalized == 'திருமதி') selected @endif
                                                                    value="திருமதி">திருமதி.
                                                                </option>
                                                                <option @if ($ser->personalized == 'செல்வன்') selected @endif
                                                                    value="செல்வன்">
                                                                    செல்வன்.</option>
                                                                <option @if ($ser->personalized == 'செல்வி') selected @endif
                                                                    value="செல்வி">
                                                                    செல்வி.</option>
                                                            </select>
                                                            <label style="color:#23e156" for="relationship_1"
                                                                class="form-label">உறவுமுறை</label>
                                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                class="form-control" name="relationship_1">
                                                                <option value="">Select</option>
                                                                <option @if ($ser->relationship_1 == 'தந்தை') selected @endif
                                                                    value="தந்தை">தந்தை.
                                                                </option>
                                                                <option @if ($ser->relationship_1 == 'கணவர்') selected @endif
                                                                    value="கணவர்">கணவர்.
                                                                </option>
                                                                <option @if ($ser->relationship_1 == 'உறவினர்') selected @endif
                                                                    value="உறவினர்">உறவினர்.
                                                                </option>
                                                            </select>
                                                            <label style="color:#23e156" for="mother_name_tamil"
                                                                class="form-label">தாயின் பெயர் தமிழில்</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->mother_name_tamil }}"
                                                                class="form-control" name="mother_name_tamil"
                                                                maxlength="100" placeholder="தாயின் பெயர் தமிழில்" />

                                                            <label style="color:#23e156" for="community"
                                                                class="form-label">Community</label>
                                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                class="form-control" name="community">
                                                                <option value="">Select Community</option>
                                                                <option @if ($ser->community == 'BC') selected @endif
                                                                    value="BC">BC.
                                                                </option>
                                                                <option @if ($ser->community == 'OC') selected @endif
                                                                    value="OC">OC.
                                                                </option>
                                                                <option @if ($ser->community == 'OBC') selected @endif
                                                                    value="OBC">OBC.
                                                                </option>
                                                                <option @if ($ser->community == 'MBC') selected @endif
                                                                    value="MBC">MBC.
                                                                </option>
                                                                <option @if ($ser->community == 'SC') selected @endif
                                                                    value="SC">SC.
                                                                </option>
                                                                <option @if ($ser->community == 'ST') selected @endif
                                                                    value="ST">ST.
                                                                </option>
                                                                <option @if ($ser->community == 'BC(Muslim)') selected @endif
                                                                    value="BC(Muslim)">BC (Muslim).
                                                                </option>
                                                            </select>
                                                            <label style="color:#23e156" for="door_no"
                                                                class="form-label">Door No</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->door_no }}"
                                                                class="form-control" name="door_no" maxlength="20"
                                                                placeholder="Door No" />
                                                            <label style="color:#23e156" for="pin_code"
                                                                class="form-label">Pin Code</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->pin_code }}"
                                                                class="form-control" name="pin_code" maxlength="10"
                                                                placeholder="Pin Code" />
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label style="color:#e411dd" for="personalized_name_tamil"
                                                                class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text"
                                                                value="{{ $ser->personalized_name_tamil }}"
                                                                class="form-control" name="personalized_name_tamil"
                                                                maxlength="50" placeholder="பெயர் தமிழில்" />
                                                            <label style="color:#e411dd" for="relationship_name_tamil_1"
                                                                class="form-label">பெயர் தமிழில்</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text"
                                                                value="{{ $ser->relationship_name_tamil_1 }}"
                                                                class="form-control" name="relationship_name_tamil_1"
                                                                maxlength="50" placeholder="பெயர் தமிழில்" />
                                                            <label style="color:#e411dd" for="mother_name_english"
                                                                class="form-label">Mother Name (ENGLISH)</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->mother_name_english }}"
                                                                class="form-control" name="mother_name_english"
                                                                maxlength="50" placeholder="Mother Name (ENGLISH)" />
                                                            <label style="color:#e411dd" for="education"
                                                                class="form-label">Education</label>
                                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                class="form-control" name="education">
                                                                <option value="">Select Education</option>
                                                                <option @if ($ser->education == 'Students') selected @endif
                                                                    value="Students">Students
                                                                </option>
                                                                <option @if ($ser->education == 'No Education') selected @endif
                                                                    value="No Education">No Education
                                                                </option>
                                                                <option @if ($ser->education == 'Private Employee') selected @endif
                                                                    value="Private Employee">Private Employee
                                                                </option>
                                                                <option @if ($ser->education == 'Govt.Employee') selected @endif
                                                                    value="Govt.Employee">Govt.Employee
                                                                </option>
                                                                <option @if ($ser->education == 'Daily Wages') selected @endif
                                                                    value="Daily Wages">Daily Wages
                                                                </option>
                                                                <option @if ($ser->education == 'Others') selected @endif
                                                                    value="Others">Others
                                                                </option>
                                                            </select>
                                                            <label style="color:#e411dd" for="street_name_tamil"
                                                                class="form-label">தெரு பெயர்</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->street_name_tamil }}"
                                                                class="form-control" name="street_name_tamil"
                                                                maxlength="50" placeholder="தெரு பெயர்" />
                                                            <label style="color:#e411dd" for="postal_area_tamil"
                                                                class="form-label">அஞ்சல் பெயர்</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->postal_area_tamil }}"
                                                                class="form-control" name="postal_area_tamil"
                                                                maxlength="50" placeholder="அஞ்சல் பெயர்" />
                                                        </div>
                                                        <div class="mb-3 col-md-4">
                                                            <label style="color:#23e156" for="personalized_name_english"
                                                                class="form-label">Applicant Name</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text"
                                                                value="{{ $ser->personalized_name_english }}"
                                                                class="form-control" name="personalized_name_english"
                                                                maxlength="50" placeholder="Name In English" />
                                                            <label style="color:#23e156" for="relationship_name_english_1"
                                                                class="form-label">Name In English</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text"
                                                                value="{{ $ser->relationship_name_english_1 }}"
                                                                class="form-control" name="relationship_name_english_1"
                                                                maxlength="50" placeholder="Name In English" />
                                                            <label style="color:#23e156" for="maritial_status"
                                                                class="form-label">Maritial Status</label>
                                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                class="form-control" name="maritial_status">
                                                                <option value="">Select Maritial Status</option>
                                                                <option @if ($ser->maritial_status == 'Un Married') selected @endif
                                                                    value="Un Married">Un Married
                                                                </option>
                                                                <option @if ($ser->maritial_status == 'Married') selected @endif
                                                                    value="Married">Married
                                                                </option>
                                                                <option @if ($ser->maritial_status == 'Widower') selected @endif
                                                                    value="Widower">Widower
                                                                </option>
                                                                <option @if ($ser->maritial_status == 'Widow') selected @endif
                                                                    value="Widow">Widow
                                                                </option>
                                                                <option @if ($ser->maritial_status == 'Divorced') selected @endif
                                                                    value="Divorced">Divorced
                                                                </option>
                                                            </select>
                                                            <label style="color:#23e156" for="religion"
                                                                class="form-label">Religion</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->religion }}"
                                                                class="form-control" name="religion" maxlength="20"
                                                                placeholder="Religion" />
                                                            <label style="color:#23e156" for="street_name"
                                                                class="form-label">Street Name</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->street_name }}"
                                                                class="form-control" name="street_name" maxlength="30"
                                                                placeholder="Street Name" />
                                                            <label style="color:#23e156" for="postal_area_english"
                                                                class="form-label">Postal Area</label>
                                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                type="text" value="{{ $ser->postal_area_english }}"
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
                                                    value="{{ $ser->income_yearly }}" id="incomeyearly"
                                                    placeholder="Income Yearly" />

                                                <label for="income_monthly " class="form-label">Income (Monthly)</label>
                                                <input type="tel" class="form-control" name="income_monthly"
                                                    value="{{ $ser->income_monthly }}" id="incomemonthly"
                                                    placeholder="Income Monthly" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label>Job Type</label>
                                                <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id) disabled @endif
                                                    class="form-control" id="job_type" name="job_type"
                                                    style="width: 100%;">
                                                    <option value="">Select Job Type</option>
                                                    <option @if ($ser->job_type == 'Govt') selected @endif
                                                        value="Govt">Govt Employee</option>
                                                    <option @if ($ser->job_type == 'Private') selected @endif
                                                        value="Private">Private Employee</option>
                                                    <option @if ($ser->job_type == 'Agriculture') selected @endif
                                                        value="Agriculture">Agriculture</option>
                                                    <option @if ($ser->job_type == 'Others') selected @endif
                                                        value="Others">Others</option>
                                                </select>

                                                <div class="" id="incomecertgovthide" class="form-control"
                                                    style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id)
                                                        @if ($ser->salary_slip != '')
                                                            <label>Salary Slip</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/salary_slip/{{ $ser->salary_slip }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Salary Slip</label>
                                                        <input @if ($ser->salary_slip == '' && $ser->job_type == 'Govt') @endif
                                                            class="form-control" type="file" id="salary_slip"
                                                            accept="image/jpeg, image/png" name="salary_slip">
                                                        @if ($ser->salary_slip != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/salary_slip/{{ $ser->salary_slip }}">Download</a><br>
                                                        @endif
                                                    @endif

                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id)
                                                        @if ($ser->pancard != '')
                                                            <label>Pancard</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/pancard/{{ $ser->pancard }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Pancard</label>
                                                        <input @if ($ser->pancard == '' && $ser->job_type == 'Govt') @endif
                                                            class="form-control" type="file" id="pancard"
                                                            accept="image/jpeg, image/png" name="pancard">
                                                        @if ($ser->pancard != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/pancard/{{ $ser->pancard }}">Download</a><br>
                                                        @endif
                                                    @endif

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id)
                                                        @if ($ser->pancard != '')
                                                            <label>Pan Card(Optional)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/pancard/{{ $ser->pancard }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Pan Card(Optional)</label>
                                                        <input @if ($ser->pancard == '') @endif class="form-control"
                                                            type="file" accept="image/jpeg, image/png" name="pancard">
                                                        @if ($ser->pancard != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/pancard/{{ $ser->pancard }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <h3 class="text-center">View Family Details</h3>
                                            <div class="table-responsive">
                                                <table id="pricetable" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Relationship</th>
                                                            <th>Name</th>
                                                            <th>பெயர் தமிழில்</th>
                                                            <th>Age</th>
                                                            <th>Income</th>
                                                            <th>Occupation</th>
                                                            <th>
                                                                @if (Auth::user()->id == $apply_user_id)
                                                                    <a class="btn btn-sm btn-success"
                                                                        onclick="addnewrow()"><i
                                                                            class='material-symbols-outlined'>add</i></a>
                                                                @endif
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($ser->family_details as $key => $ser1)
                                                            <tr>
                                                                <td> <select
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required name="family_relationship[]"
                                                                        class="form-control">
                                                                        <option value="">Select</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Father') selected @endif
                                                                            value="Father">தகப்பன்</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Mother') selected @endif
                                                                            value="Mother">தாய்</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Husband') selected @endif
                                                                            value="Husband">கணவர்</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Wife') selected @endif
                                                                            value="Wife">மனைவி</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Son') selected @endif
                                                                            value="Son">மகன்</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Daughter') selected @endif
                                                                            value="Daughter">மகள்</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Younger Brother') selected @endif
                                                                            value="Younger Brother">அண்ணன்</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Elder Brother') selected @endif
                                                                            value="Elder Brother">தம்பி</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Younger Sister') selected @endif
                                                                            value="Younger Sister">அக்கா</option>
                                                                        <option
                                                                            @if ($ser1->relation == 'Elder Sister') selected @endif
                                                                            value="Elder Sister">தங்கை</option>
                                                                            <option
                                                                            @if ($ser1->relation == 'Relation') selected @endif
                                                                            value="Relation">உறவினர்</option>
                                                                            <option
                                                                            @if ($ser1->relation == 'Self') selected @endif
                                                                            value="Self">தனக்கு</option>
                                                                    </select></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->relation_name }}" required
                                                                        class="form-control" type="text"
                                                                        name="relation_name[]" maxlength="50"></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->relation_name_tamil }}" required
                                                                        class="form-control" type="text"
                                                                        name="relation_name_tamil[]" maxlength="50"></td>
                                                                <td width="10%"><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->relation_age }}" required
                                                                        class="form-control number" type="text"
                                                                        name="relation_age[]" maxlength="2"></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->relation_income }}" required
                                                                        class="form-control" type="text"
                                                                        name="relation_income[]" maxlength="100"></td>
                                                                <td><select
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required name="occupation[]" class="form-control">
                                                                        <option value="">Select</option>
                                                                        <option
                                                                            @if ($ser1->occupation == 'Student') selected @endif
                                                                            value="Student">Student</option>
                                                                        <option
                                                                            @if ($ser1->occupation == 'Home Maker') selected @endif
                                                                            value="Home Maker">Home Maker</option>
                                                                        <option
                                                                            @if ($ser1->occupation == 'Govt Employee') selected @endif
                                                                            value="Govt Employee">Govt Employee</option>
                                                                        <option
                                                                            @if ($ser1->occupation == 'Private Employee') selected @endif
                                                                            value="Private Employee">Private Employee
                                                                        </option>
                                                                        <option
                                                                            @if ($ser1->occupation == 'Daily Wages') selected @endif
                                                                            value="Daily Wages">Daily Wages</option>
                                                                        <option
                                                                            @if ($ser1->occupation == 'Agriculture') selected @endif
                                                                            value="Agriculture">Agriculture</option>
                                                                        <option
                                                                            @if ($ser1->occupation == 'Others') selected @endif
                                                                            value="Others">Others</option>
                                                                    </select></td>
                                                                <td><a onClick='removerow()'
                                                                        @if (Auth::user()->id != $apply_user_id) style="pointer-events: none;" @endif
                                                                        class='btn btn-sm btn-danger btnDelete'><i
                                                                            class='mdi mdi-delete mdi-18px'></i></a></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        @if (Auth::user()->id != $apply_user_id)
                                        <div class="mb-3 col-md-6">
                                            <label for="service_name" class="form-label">Service Status</label>
                                            <select class="form-control" name="status" id="service_status">
                                                <option value="">Select</option>
                                                <option @if ($ser->status == 'Pending') selected @endif
                                                    value="Pending">
                                                    Pending</option>
                                                <option @if ($ser->status == 'Resubmit') selected @endif
                                                    value="Resubmit">
                                                    Resubmit</option>
                                                <option @if ($ser->status == 'Processing') selected @endif
                                                    value="Processing">Processing</option>
                                                @if ($ser->status != 'Approved')
                                                    <option @if ($ser->status == 'Rejected') selected @endif
                                                        value="Rejected">Rejected</option>
                                                @endif
                                                <option @if ($ser->status == 'Approved') selected @endif
                                                    value="Approved">
                                                    Approved</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <input value="{{ $ser->remarks }}" class="form-control" type="text"
                                                name="remarks" maxlength="100" id="remarks" placeholder="Remarks" />
                                        </div>
                                        <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                            <label for="select" class="form-label">Select</label>
                                            <select class="form-control" name="selects" id="select">
                                                <option>select</option>
                                                <option @if ($ser->selects == 'Text') selected @endif value = "Text">
                                                    Text</option>
                                                <option @if ($ser->selects == 'File') selected @endif value = "File">
                                                    File</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6" id="acknowledgementhide" style="display :none;">
                                            <label for="acknowledgement" class="form-label">Acknowledgement</label>
                                            <input class="form-control" type="file" name="acknowledgement"
                                                id="acknowledgement" />
                                        </div>
                                        <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                            <label for="application_no" class="form-label">Application No</label>
                                            <input value="{{ $ser->application_no }}" class="form-control"
                                                type="text" maxlength="20" name="application_no"
                                                id="application_no" />
                                        </div>
                                        <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                            <label for="selects" class="form-label">Select</label>
                                            <select class="form-control" name="lects" id="selects">
                                                <option>select</option>
                                                <option @if ($ser->lects == 'Text') selected @endif value = "Text">
                                                    Text</option>
                                                <option @if ($ser->lects == 'File') selected @endif value = "File">
                                                    File</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                            <label for="application" class="form-label">Application</label>
                                            <input value="{{ $ser->application }}" class="form-control"
                                                type="text" maxlength="150" name="application" id="application" />
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
                                                <input disabled value="{{ $ser->status }}" class="form-control"
                                                    type="text" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="remarks" class="form-label">Remarks</label>
                                                <textarea rows="2" class="form-control" type="text" disabled placeholder="Remarks">{{ $ser->remarks }}</textarea>
                                            </div>

                                        </div>
                                    @endif
                                </div>
                                        <div class="mt-2 text-center">
                                            @if ($ser->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                                <button type="submit" disabled
                                                    class="btn btn-primary me-2">Resubmit</button>
                                            @elseif($ser->status == 'Approved')
                                                <button type="button" disabled
                                                    class="btn btn-primary me-2">Completed</button>
                                            @else
                                                <button id="save" type="submit" class="btn btn-primary me-2">Submit</button>
                                            @endif
                                        </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-backdrop fade"></div>
        </div>
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
@endsection

@push('page_scripts')
<script>
    var dist_id = "{{ $customers->dist_id }}";
    var taluk_id = "{{ $customers->taluk_id }}";
    $(function() {
        gettaluk(dist_id);
        getpanchayath(taluk_id);

        var status = "{{ $ser->status }}";
        var acknowledgement = "{{ $ser->acknowledgement }}";
        var certificate = "{{ $ser->certificate }}";
        var selects = "{{ $ser->selects }}";
        var candetails = "{{ $ser->can_details }}";
        var ageproof = "{{ $ser->age_proof }}";
        var job_type = "{{ $ser->job_type }}";
        var lects = "{{ $ser->lects }}";

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

        if (candetails == "Yes") {
            $('#cannumberhide').show("slow");
            $('#cannumber').prop("required", true);
        } else if (candetails == "No") {
            $('#dobhide').hide("slow");
        }

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
        } else if ($('#can_details').val() == 'No') {
             window.location.href = "{{ url('applyservice') }}/" + 60;

        } else if ($('#can_details').val() == 'Find') {
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
            "<tr><td> <select required name='family_relationship[]' class='form-control'><option value=''>Select</option><option value='Father'>தகப்பன்</option><option value='Mother'>தாய்</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Younger Brother'>அண்ணன்</option><option value='Elder Brother'>தம்பி</option><option value='Younger Sister'>அக்கா</option><option value='Elder Sister'>தங்கை</option><option value='Relation'>உறவினர்</option><option value='Self'>தனக்கு</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'></td><td><input class='form-control' required type='text' name='relation_name_tamil[]'maxlength='80'></td><td width='10%'><input class='form-control number' required type='text' name='relation_age[]'maxlength='2'></td><td><input class='form-control' required type='text' name='relation_income[]'maxlength='100'></td><td><select required name='occupation[]' class='form-control'><option value=''>Select</option><option value='Student'>Student</option><option value='Home Maker'>Home maker</option><option value='Govt Employee'>Govt employee</option><option value='Private Employee'>Private Employee</option><option value='Daily Wages'>Daily Wages</option><option value='Agriculture'>Agriculture</option><option value='Others'>Others</option></select></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
        );
    }

    document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
</script>
@endpush
