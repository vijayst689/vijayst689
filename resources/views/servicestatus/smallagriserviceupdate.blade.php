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
                            <form class="row g-4" action="{{ url('submit_statusupdate_smallagriservice') }}"
                                enctype="multipart/form-data" method="post">
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
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <h5 class="card-title">{{ $servicename }}</h5>
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
                                                                <option @if ($ser->course_complete == 'Widow') selected @endif
                                                                    value="Widow">Widow
                                                                </option>
                                                                <option @if ($ser->course_complete == 'Divorced') selected @endif
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
                                        @if ($serviceid == 23)
                                            <div class="row">
                                                <h3 class="text-center">சிறு குறு விவசாய சான்று தேவையான மொத்த பரப்பளவு</h3>
                                                <table id="agri" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>பட்டா வகை</th>
                                                            <th>மாவட்டம்</th>
                                                            <th>தாலுகா</th>
                                                            <th>வருவாய் கிராமம்</th>
                                                            <th>பட்டா எண்</th>
                                                            <th>புல எண்</th>
                                                            <th>உட்பிரிவு எண்</th>
                                                            <th>தேவையான பரப்பளவு(Area/Hectares)</th>
                                                            <th><a class="btn btn-sm btn-success"
                                                                    onclick="addnewrows()"><i
                                                                        class='material-symbols-outlined'>add</i></a></th>
                                                        </tr>

                                                    </thead>

                                                    <tbody>
                                                        @foreach ($ser->details as $key => $ser1)
                                                            <tr>
                                                                <td><select
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        required class="form-control" name="proof[]"
                                                                        style="width: 100%;">
                                                                        <option value="">Select</option>
                                                                        <option
                                                                            @if ($ser1->pattatype == 'Joint Strap') selected @endif
                                                                            value="Joint Strap">கூட்டு பட்டா</option>
                                                                        <option
                                                                            @if ($ser1->pattatype == 'Strap') selected @endif
                                                                            value="Strap">தனிபட்டா</option>
                                                                    </select></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->district }}" required
                                                                        class="form-control" type="text"
                                                                        name="district[]" maxlength="50"></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->taluk }}" required
                                                                        class="form-control" type="text"
                                                                        name="taluk[]" maxlength="50"></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->village }}" required
                                                                        class="form-control" type="text"
                                                                        name="village[]" maxlength="50"></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->patta_no }}" required
                                                                        class="form-control" type="text"
                                                                        name="patta_no[]" maxlength="50"></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->field_no }}" required
                                                                        class="form-control" type="text"
                                                                        name="field_no[]" maxlength="50"></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->subdivision_no }}" required
                                                                        class="form-control" type="text"
                                                                        name="subdivision_no[]" maxlength="50"></td>
                                                                <td><input
                                                                        @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                        value="{{ $ser1->area }}" required
                                                                        class="form-control" type="text"
                                                                        name="area1[]" maxlength="50"></td>


                                                                <td></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <h4 class="text-center"> Additional Details </h4>
                                            <div class="mb-3 col-md-6">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id)
                                                    @if ($ser->chitta != '')
                                                        <label>சிட்டா</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/chitta/{{ $ser->chitta }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>சிட்டா</label>
                                                    <input @if ($ser->chitta == '') required @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="chitta">
                                                    @if ($ser->chitta != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/chitta/{{ $ser->chitta }}">Download</a><br>
                                                    @endif
                                                @endif

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id)
                                                    @if ($ser->aggregation != '')
                                                        <label>அடங்கல்</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aggregation/{{ $ser->aggregation }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>அடங்கல்</label>
                                                    <input @if ($ser->aggregation == '') required @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="aggregation">
                                                    @if ($ser->aggregation != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aggregation/{{ $ser->aggregation }}">Download</a><br>
                                                    @endif
                                                @endif

                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label>Select Any</label>
                                                <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id) disabled @endif required
                                                    class="form-control" id="strap_details" name="any_proof"
                                                    style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <option @if ($ser->any_proof == 'Joint Strap') selected @endif
                                                        value="Joint Strap">கூட்டு பட்டா</option>
                                                    <option @if ($ser->any_proof == 'Strap') selected @endif
                                                        value="Strap">தனிபட்டா</option>
                                                </select>
                                            </div>


                                    </div>
                                    <div class="row" id="dochide" style="display:none;">
                                        <h3 class="text-center">Document Details</h3>
                                        <table id="doc" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name of the document</th>
                                                    <th>File</th>

                                                </tr>

                                            </thead>

                                            <tbody>
                                                @foreach ($ser->documents as $key => $ser1)
                                                    <tr>
                                                        <input type="hidden" name="doc_id[{{ $ser1->id }}]"
                                                            value="{{ $ser1->id }}">
                                                        <td> <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id) disabled @endif
                                                                id="docdetails" name="doc_name[{{ $ser1->id }}]"
                                                                class="form-control">
                                                                <option value="">Select</option>
                                                                <option @if ($ser1->doc_name == 'Deed') selected @endif
                                                                    value="Deed">பத்திரம்</option>
                                                                <option @if ($ser1->doc_name == 'NOC') selected @endif
                                                                    value="NOC">NOC</option>
                                                                <option @if ($ser1->doc_name == 'Ec/Villankam') selected @endif
                                                                    value="Ec/Villankam">Ec/Villankam</option>
                                                                <option @if ($ser1->doc_name == 'VAO Certificate') selected @endif
                                                                    value="VAO Certificate">விஏஓ சான்றிதழ்</option>
                                                            </select></td>

                                                        <td>

                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id)
                                                                @if ($ser1->doc != '')
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/doc/{{ $ser1->doc }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <input @if ($ser1->doc == '' && $ser->any_proof == 'Joint Strap') required @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png"
                                                                    name="doc[{{ $ser1->id }}]">
                                                                @if ($ser1->doc != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/doc/{{ $ser1->doc }}">Download</a><br>
                                                                @endif
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $ser->user_id)
                                    <div class="mb-3 col-md-6">
                                        <label for="service_name" class="form-label">Service Status</label>
                                        <select class="form-control" name="status" id="service_status">
                                            <option value="">Select</option>
                                            <option @if ($ser->status == 'Pending') selected @endif value="Pending">
                                                Pending</option>
                                            <option @if ($ser->status == 'Resubmit') selected @endif value="Resubmit">
                                                Resubmit</option>
                                            <option @if ($ser->status == 'Processing') selected @endif value="Processing">
                                                Processing</option>
                                            @if ($ser->status != 'Approved')
                                                <option @if ($ser->status == 'Rejected') selected @endif
                                                    value="Rejected">
                                                    Rejected</option>
                                            @endif
                                            <option @if ($ser->status == 'Approved') selected @endif value="Approved">
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
                                            <option @if ($ser->selects == 'Text') selected @endif value = "Text">Text
                                            </option>
                                            <option @if ($ser->selects == 'File') selected @endif value = "File">File
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6" id="acknowledgementhide" style="display :none;">
                                        <label for="acknowledgement" class="form-label">Acknowledgement</label>
                                        <input class="form-control" type="file" name="acknowledgement"
                                            id="acknowledgement" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                        <label for="application_no" class="form-label">Application No</label>
                                        <input value="{{ $ser->application_no }}" class="form-control" type="text"
                                            maxlength="20" name="application_no" id="application_no" />
                                    </div>
                                    <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                        <label for="selects" class="form-label">Select</label>
                                        <select class="form-control" name="lects" id="selects">
                                            <option>select</option>
                                            <option @if ($ser->lects == 'Text') selected @endif value = "Text">Text
                                            </option>
                                            <option @if ($ser->lects == 'File') selected @endif value = "File">File
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                        <label for="application" class="form-label">Application</label>
                                        <input value="{{ $ser->application }}" class="form-control" type="text"
                                            maxlength="150" name="application" id="application" />
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
                                <div class="mt-2 text-center">
                                    @if ($ser->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                        <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                    @elseif($ser->status == 'Approved')
                                        <button type="button" disabled class="btn btn-primary me-2">Completed</button>
                                    @else
                                        <button type="submit" class="btn btn-primary me-2">Submit</button>
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
                var proof = "{{ $ser->any_proof }}";
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
                if (proof == "Joint Strap") {
                    $('#dochide').show("slow");
                } else {
                    $('#straphide').show("slow");
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
                    $('#dobhide').show("slow");
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

            $('#strap_details').change(function() {
                if ($('#strap_details').val() == 'Joint Strap') {
                    $('#dochide').show("slow");
                    $('#docdetails').prop("required", true);
                    $('#docimg').prop("required", true);
                    $('#straphide').hide("slow");
                    $('#strap1').prop("required", false);

                } else if ($('#strap_details').val() == 'Strap') {
                    $('#straphide').show("slow");
                    $('#strap1').prop("required", true);
                    $('#dochide').hide("slow");
                    $('#docdetails').prop("required", false);
                    $('#docimg').prop("required", false);

                } else {
                    $('#dochide').hide("slow");
                    $('#docdetails').prop("required", false);
                    $('#docimg').prop("required", false);
                    $('#straphide').hide("slow");
                    $('#strap1').prop("required", false);
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

            $("#doc").on('click', '.btnDelete', function() {
                $(this).closest('tr').remove();
            });


            function addnewrow() {
                $("#doc tbody").append(
                    "<tr><td><select required name='doc_name[]' class='form-control'><option value=''>Select</option><option value='பத்திரம்'>பத்திரம்</option><option value='NOC'>NOC</option><option value='Ec/வில்லங்கம்'>Ec/வில்லங்கம்</option><option value='விஏஓ சான்றிதழ்'>விஏஓ சான்றிதழ்</option></select></td><td><input required class='form-control' type='file'  name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
                );
            }

            $("#agri").on('click', '.btnDelete', function() {
                $(this).closest('tr').remove();
            });


            function addnewrows() {
                $("#agri tbody").append(
                    "<tr><td><select required class='form-control' name='proof[]'  style='width: 100%;'><option value=''>Select</option><option value='Joint Strap'>கூட்டு பட்டா</option><option value='Strap'>தனிபட்டா</option></select></td><td><input class='form-control' required type='text' name='district[]' maxlength='80' placeholder='மாவட்டம்'></td><td><input class='form-control' required type='text' name='taluk[]' maxlength='80' placeholder='தாலுகா'></td><td><input class='form-control' required type='text' name='village[]' maxlength='80' placeholder='வருவாய் கிராமம்'></td><td><input class='form-control' required type='text' name='patta_no[]' maxlength='80' placeholder='பட்டா எண்'></td><td><input class='form-control' required type='text' name='field_no[]' maxlength='80' placeholder='புல எண்'></td><td><input class='form-control' required type='text' name='subdivision_no[]' maxlength='80' placeholder='உட்பிரிவு எண்'></td><td><input class='form-control' required type='text' name='area1[]' maxlength='80' placeholder='தேவையான பரப்பளவு(Area/Hectares)'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
                );
            }
        </script>
    @endpush
