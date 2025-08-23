@extends('layouts.app')
@section('content')
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
                                <h5 class="card-title mt-2">{{ $servicename }}</h5>
                                <h1 class="card-title">Service Payment : <span class="text-danger"
                                        id="canpayment">{{ $payment }}</span></h1>
                                <h5><span class="text-danger" id="cantext"></span></h5>
                                <div class="card-body p-4">
                                    <form class="row g-4" action="{{ url('submitapply_tnegaservices6') }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                            <input type="hidden" name="amount" value="{{ $amount }}">
                                            <input type="hidden" id="seramt" name="service_amount"
                                                value="{{ $payment }}">
                                            <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Do
                                                            You Have Can Number</label>
                                                        <div class="col-sm-6">
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
                                                                <select id="personalized" name="personalized"
                                                                    class="form-control">
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
                                                                <input type="text" maxlength="100"
                                                                    class="form-control" name="mother_name_tamil"
                                                                    placeholder="தாயின் பெயர் தமிழில்" />

                                                                <label style="color:#23e156" for="community"
                                                                    class="form-label">Community</label>
                                                                <select name="community" id="community"
                                                                    class="form-control">
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
                                                                <input type="text" maxlength="6"
                                                                    class="form-control number" name="pin_code"
                                                                    placeholder="Pin Code" />
                                                            </div>
                                                            <div class="mb-3 col-md-4">

                                                                <label style="color:#e411dd" for="personalized_name_tamil"
                                                                    class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                                                <input type="text" maxlength="100"
                                                                    class="form-control" name="personalized_name_tamil"
                                                                    placeholder="பெயர் தமிழில்" />
                                                                <label style="color:#e411dd"
                                                                    for="relationship_name_tamil_1"
                                                                    class="form-label">பெயர் தமிழில்</label>
                                                                <input type="text" maxlength="100"
                                                                    class="form-control" name="relationship_name_tamil_1"
                                                                    placeholder="பெயர் தமிழில்" />
                                                                <label style="color:#e411dd" for="mother_name_english"
                                                                    class="form-label">Mother Name (ENGLISH)</label>
                                                                <input type="text" maxlength="100"
                                                                    class="form-control" name="mother_name_english"
                                                                    placeholder="Mother Name (ENGLISH)" />
                                                                <label style="color:#e411dd" for="education"
                                                                    class="form-label">Education</label>
                                                                <select name="education" id="education"
                                                                    class="form-control">
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

                                                                <label style="color:#23e156"
                                                                    for="personalized_name_english"
                                                                    class="form-label">Applicant Name</label>
                                                                <input type="text" maxlength="100"
                                                                    class="form-control" name="personalized_name_english"
                                                                    placeholder="Name In English" />
                                                                <label style="color:#23e156"
                                                                    for="relationship_name_english_1"
                                                                    class="form-label">Name In English</label>
                                                                <input type="text" maxlength="100"
                                                                    class="form-control"
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
                                                                    name="postal_area_english"
                                                                    placeholder="Postal Area" />
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
                                                <input value="{{ $customers->aadhaar_no }}" readonly required
                                                    type="text" maxlength="12" class="form-control" name="aadhaar_no"
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
                                            @if ($serviceid == 15)
                                                <div class="mb-3 col-md-6">
                                                    <label for="course_complete" class="form-label">Course
                                                        Completed</label>
                                                    <select id="course_complete" name="course_complete"
                                                        class="form-control">
                                                        <option value="">Select Course Completed</option>
                                                        <option value="SSLC">SSLC</option>
                                                        <option value="Higher Secondary">Higher Secondary</option>
                                                        <option value="Diploma">Diploma</option>
                                                        <option value="Graduate">Graduate</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Year Of Passing</label>
                                                    <input class="form-control" required type="text"
                                                        name="year_of_passing" maxlength="20"
                                                        placeholder="Year Of Passing">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="current_course" class="form-label">Current Course</label>
                                                    <select id="current_course" name="current_course"
                                                        class="form-control">
                                                        <option value="">Select Current Course</option>
                                                        <option value="SSLC">SSLC</option>
                                                        <option value="Higher Secondary">Higher Secondary</option>
                                                        <option value="Diploma">Diploma</option>
                                                        <option value="Graduate">Graduate</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Current Academy Year</label>
                                                    <input class="form-control" required type="text"
                                                        name="current_academy_yr" maxlength="20"
                                                        placeholder="Current Academy Year">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>நிறுவனத்தின் பெயர் தமிழில்</label>
                                                    <input class="form-control" required type="text"
                                                        name="institute_name_tamil" maxlength="100"
                                                        placeholder="Institute Name In Tamil">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Institute Name In English</label>
                                                    <input class="form-control" required type="text"
                                                        name="institute_name_english" maxlength="100"
                                                        placeholder="Institute Name In English">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>நிறுவனத்தின் முகவரி தமிழில்</label>
                                                    <input class="form-control In Tamil" required type="text"
                                                        name="institute_address_tamil" maxlength="100"
                                                        placeholder="Institute Address In Tamil">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Institute Address In English</label>
                                                    <input class="form-control" required type="text"
                                                        name="institute_address_english" maxlength="100"
                                                        placeholder="Institute Address In English">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="living_status_1" class="form-label">தந்தை</label>
                                                    <select id="living_status_1" name="living_status_1"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Alive">Alive</option>
                                                        <option value="Dead">Dead</option>
                                                    </select>

                                                    <div class="mb-3 col-md-6" id="fathersignaturehide"
                                                        style="display:none;">
                                                        <label class="form-label">signature</label>
                                                        <input id="signature1" class="form-control" type="file"
                                                            name="signature1" />
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="living_status_2" class="form-label">தாய்</label>
                                                    <select id="living_status_2" name="living_status_2"
                                                        class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="Alive">Alive</option>
                                                        <option value="Dead">Dead</option>
                                                    </select>

                                                    <div class="mb-3 col-md-6" id="mothersignaturehide"
                                                        style="display:none;">
                                                        <label class="form-label">signature</label>
                                                        <input id="signature2" class="form-control" type="file"
                                                            name="signature2" />
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <h4 class="text-center">Important Details</h3>
                                                <table id="pricetable" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>உறவுமுறை</th>
                                                            <th>பெயர் தமிழில்</th>
                                                            <th>Name In English</th>
                                                            <th>Age</th>
                                                            <th>Living Status</th>
                                                            <th>Education</th>
                                                            <th>Document</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td> தந்தை<input class="form-control" required type="hidden"
                                                                    name="relation[]" value="தந்தை"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_tamil[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_english[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="age[]" maxlength="2"></td>
                                                            <td> <select required name="living_status[]"
                                                                    class="form-control alive_or_dead">
                                                                    <option value="">Select</option>
                                                                    <option value="Alive">Alive</option>
                                                                    <option value="Dead">Dead</option>

                                                                </select></td>
                                                            <td> <select id="educationtype" required
                                                                    name="education_type[]"
                                                                    class="form-control education_document">
                                                                    <option value="">Select Education Type</option>
                                                                    <option value="Non Literate">Non Literate</option>
                                                                    <option value="Drop Out">Drop Out</option>
                                                                    <option value="Upto 5 Standard">Upto 5 Standard
                                                                    </option>
                                                                    <option value="Less than 10th Standard">Less than 10th
                                                                        Standard</option>
                                                                    <option value="Less than 12th Standard">Less than 12th
                                                                        Standard</option>
                                                                    <option value="10th Or 12th Standard">10th Or 12th
                                                                        Standard</option>
                                                                    <option value="Diploma">Diploma</option>
                                                                    <option value="Degree Completed">Degree Completed
                                                                    </option>
                                                                    <option value="Post Graduate">Post Graduate</option>
                                                                    <option value="Pursing Degree">Pursing Degree</option>
                                                                </select></td>
                                                            <td>
                                                                <P class="educationdoc"></P><input style="display:none;"
                                                                    class="form-control edu_file" type="file"
                                                                    name="doc[]" accept="image/jpeg, image/png">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> தந்தையின் தந்தை <input class="form-control" required
                                                                    type="hidden" name="relation[]"
                                                                    value="தந்தையின் தந்தை"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_tamil[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_english[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="age[]" maxlength="2"></td>
                                                            <td> <select required name="living_status[]"
                                                                    class="form-control alive_or_dead">
                                                                    <option value="">Select</option>
                                                                    <option value="Alive">Alive</option>
                                                                    <option value="Dead">Dead</option>

                                                                </select></td>
                                                            <td> <select required name="education_type[]"
                                                                    class="form-control education_document">
                                                                    <option value="">Select Education Type</option>
                                                                    <option value="Non Literate">Non Literate</option>
                                                                    <option value="Drop Out">Drop Out</option>
                                                                    <option value="Upto 5 Standard">Upto 5 Standard
                                                                    </option>
                                                                    <option value="Less than 10th Standard">Less than 10th
                                                                        Standard</option>
                                                                    <option value="Less than 12th Standard">Less than 12th
                                                                        Standard</option>
                                                                    <option value="10th Or 12th Standard">10th Or 12th
                                                                        Standard</option>
                                                                    <option value="Diploma">Diploma</option>
                                                                    <option value="Degree Completed">Degree Completed
                                                                    </option>
                                                                    <option value="Post Graduate">Post Graduate</option>
                                                                    <option value="Pursing Degree">Pursing Degree</option>
                                                                </select></td>
                                                            <td>
                                                                <P class="educationdoc"></P><input style="display:none;"
                                                                    class="form-control edu_file" type="file"
                                                                    name="doc[]" accept="image/jpeg, image/png">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> தந்தையின் தாய் <input class="form-control" required
                                                                    type="hidden" name="relation[]"
                                                                    value="தந்தையின் தாய்"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_tamil[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_english[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="age[]" maxlength="2"></td>
                                                            <td> <select required name="living_status[]"
                                                                    class="form-control alive_or_dead">
                                                                    <option value="">Select</option>
                                                                    <option value="Alive">Alive</option>
                                                                    <option value="Dead">Dead</option>

                                                                </select></td>
                                                            <td> <select required name="education_type[]"
                                                                    class="form-control education_document">
                                                                    <option value="">Select Education Type</option>
                                                                    <option value="Non Literate">Non Literate</option>
                                                                    <option value="Drop Out">Drop Out</option>
                                                                    <option value="Upto 5 Standard">Upto 5 Standard
                                                                    </option>
                                                                    <option value="Less than 10th Standard">Less than 10th
                                                                        Standard</option>
                                                                    <option value="Less than 12th Standard">Less than 12th
                                                                        Standard</option>
                                                                    <option value="10th Or 12th Standard">10th Or 12th
                                                                        Standard</option>
                                                                    <option value="Diploma">Diploma</option>
                                                                    <option value="Degree Completed">Degree Completed
                                                                    </option>
                                                                    <option value="Post Graduate">Post Graduate</option>
                                                                    <option value="Pursing Degree">Pursing Degree</option>
                                                                </select></td>
                                                            <td>
                                                                <P class="educationdoc"></P><input style="display:none;"
                                                                    class="form-control edu_file" type="file"
                                                                    name="doc[]" accept="image/jpeg, image/png">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td> தாய் <input class="form-control" required type="hidden"
                                                                    name="relation[]" value="தாய்"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_tamil[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_english[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="age[]" maxlength="2"></td>
                                                            <td> <select required name="living_status[]"
                                                                    class="form-control alive_or_dead">
                                                                    <option value="">Select</option>
                                                                    <option value="Alive">Alive</option>
                                                                    <option value="Dead">Dead</option>

                                                                </select></td>
                                                            <td> <select required name="education_type[]"
                                                                    class="form-control education_document">
                                                                    <option value="">Select Education Type</option>
                                                                    <option value="Non Literate">Non Literate</option>
                                                                    <option value="Drop Out">Drop Out</option>
                                                                    <option value="Upto 5 Standard">Upto 5 Standard
                                                                    </option>
                                                                    <option value="Less than 10th Standard">Less than 10th
                                                                        Standard</option>
                                                                    <option value="Less than 12th Standard">Less than 12th
                                                                        Standard</option>
                                                                    <option value="10th Or 12th Standard">10th Or 12th
                                                                        Standard</option>
                                                                    <option value="Diploma">Diploma</option>
                                                                    <option value="Degree Completed">Degree Completed
                                                                    </option>
                                                                    <option value="Post Graduate">Post Graduate</option>
                                                                    <option value="Pursing Degree">Pursing Degree</option>
                                                                </select></td>
                                                            <td>
                                                                <P class="educationdoc"></P><input style="display:none;"
                                                                    class="form-control edu_file" type="file"
                                                                    name="doc[]" accept="image/jpeg, image/png">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td> தாயின் தந்தை <input class="form-control" required
                                                                    type="hidden" name="relation[]"
                                                                    value="தாயின் தந்தை"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_tamil[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_english[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="age[]" maxlength="2"></td>
                                                            <td> <select required name="living_status[]"
                                                                    class="form-control alive_or_dead">
                                                                    <option value="">Select</option>
                                                                    <option value="Alive">Alive</option>
                                                                    <option value="Dead">Dead</option>

                                                                </select></td>
                                                            <td> <select required name="education_type[]"
                                                                    class="form-control education_document">
                                                                    <option value="">Select Education Type</option>
                                                                    <option value="Non Literate">Non Literate</option>
                                                                    <option value="Drop Out">Drop Out</option>
                                                                    <option value="Upto 5 Standard">Upto 5 Standard
                                                                    </option>
                                                                    <option value="Less than 10th Standard">Less than 10th
                                                                        Standard</option>
                                                                    <option value="Less than 12th Standard">Less than 12th
                                                                        Standard</option>
                                                                    <option value="10th Or 12th Standard">10th Or 12th
                                                                        Standard</option>
                                                                    <option value="Diploma">Diploma</option>
                                                                    <option value="Degree Completed">Degree Completed
                                                                    </option>
                                                                    <option value="Post Graduate">Post Graduate</option>
                                                                    <option value="Pursing Degree">Pursing Degree</option>
                                                                </select></td>
                                                            <td>
                                                                <P class="educationdoc"></P><input style="display:none;"
                                                                    class="form-control edu_file" type="file"
                                                                    name="doc[]" accept="image/jpeg, image/png">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td> தாயின் தாய்<input class="form-control" required
                                                                    type="hidden" name="relation[]" value="தாயின் தாய்">
                                                            </td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_tamil[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="name_english[]" maxlength="100"></td>
                                                            <td> <input class="form-control" required type="text"
                                                                    name="age[]" maxlength="2"></td>
                                                            <td> <select required name="living_status[]"
                                                                    class="form-control alive_or_dead">
                                                                    <option value="">Select</option>
                                                                    <option value="Alive">Alive</option>
                                                                    <option value="Dead">Dead</option>

                                                                </select></td>
                                                            <td> <select required name="education_type[]"
                                                                    class="form-control education_document">
                                                                    <option value="">Select Education Type</option>
                                                                    <option value="Non Literate">Non Literate</option>
                                                                    <option value="Drop Out">Drop Out</option>
                                                                    <option value="Upto 5 Standard">Upto 5 Standard
                                                                    </option>
                                                                    <option value="Less than 10th Standard">Less than 10th
                                                                        Standard</option>
                                                                    <option value="Less than 12th Standard">Less than 12th
                                                                        Standard</option>
                                                                    <option value="10th Or 12th Standard">10th Or 12th
                                                                        Standard</option>
                                                                    <option value="Diploma">Diploma</option>
                                                                    <option value="Degree Completed">Degree Completed
                                                                    </option>
                                                                    <option value="Post Graduate">Post Graduate</option>
                                                                    <option value="Pursing Degree">Pursing Degree</option>
                                                                </select></td>
                                                            <td>
                                                                <P class="educationdoc"></P><input style="display:none;"
                                                                    class="form-control edu_file" type="file"
                                                                    name="doc[]" accept="image/jpeg, image/png">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                        </div>
                                        <div class="row">
                                            <h3 class="text-center">Family Details</h3>
                                            <table id="familytable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>உறவுமுறை</th>
                                                        <th>பெயர் தமிழில்</th>
                                                        <th>Name In English</th>
                                                        <th>Age</th>
                                                        <th>Living Status</th>
                                                        <th>Education</th>
                                                        <th>Document</th>
                                                        <th><a class="btn btn-sm btn-success" onclick="addnewrow()"><i
                                                                    class='material-symbols-outlined'>add</i></a></th>
                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td> <select required name="relationship_add[]"
                                                                class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="Self">Self</option>
                                                                <option value="Elder Brother">Elder Brother</option>
                                                                <option value="Younger Brother">Younger Brother</option>
                                                                <option value="Younger Sister">Younger Sister</option>
                                                                <option value="Elder Sister">Elder Sister</option>
                                                            </select></td>
                                                        <td><input class="form-control" required type="text"
                                                                name="name_tamil_add[]" maxlength="100"></td>
                                                        <td><input class="form-control" required type="text"
                                                                name="name_english_add[]" maxlength="100"></td>
                                                        <td><input class="form-control" required type="text"
                                                                name="age_add[]" maxlength="2"></td>
                                                        <td><select required name="living_status_add[]"
                                                                class="form-control alive_or_dead">
                                                                <option value="">Select</option>
                                                                <option value="Alive">Alive</option>
                                                                <option value="Dead">Dead</option>

                                                            </select></td>
                                                        <td> <select required name="education_type_add[]"
                                                                class="form-control education_document_add">
                                                                <option value="">Select Education Type</option>
                                                                <option value="Non Literate">Non Literate</option>
                                                                <option value="Drop Out">Drop Out</option>
                                                                <option value="Upto 5 Standard">Upto 5 Standard</option>
                                                                <option value="Less than 10th Standard">Less than 10th
                                                                    Standard</option>
                                                                <option value="Less than 12th Standard">Less than 12th
                                                                    Standard</option>
                                                                <option value="10th Or 12th Standard">10th Or 12th Standard
                                                                </option>
                                                                <option value="Diploma">Diploma</option>
                                                                <option value="Degree Completed">Degree Completed</option>
                                                                <option value="Post Graduate">Post Graduate</option>
                                                                <option value="Pursing Degree">Pursing Degree</option>
                                                            </select></td>
                                                        <td>
                                                            <P class="docadd"></P><input style="display:none;"
                                                                class="form-control edu_file_add" type="file"
                                                                name="doc1[]" accept="image/jpeg, image/png">
                                                        </td>
                                                        <td><a onClick='removerow()'
                                                                class='btn btn-sm btn-danger btnDelete'><i
                                                                    class='material-symbols-outlined'>Remove</i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
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


                $('#living_status_1').change(function() {
                    if ($('#living_status_1').val() == 'Alive') {
                        $('#fathersignaturehide').show("slow");
                        $('#signature1').prop("required", true);
                    } else {
                        $('#fathersignaturehide').hide("slow");
                        $('#signature1').prop("required", false);
                    }
                });

                $('#living_status_2').change(function() {
                    if ($('#living_status_2').val() == 'Alive') {
                        $('#mothersignaturehide').show("slow");
                        $('#signature2').prop("required", true);
                    } else {
                        $('#mothersignaturehide').hide("slow");
                        $('#signature2').prop("required", false);
                    }
                });

                $("#pricetable").on('change', '.education_document', function() {
                    if ($(this).val() == "Non Literate" || $(this).val() == "") {
                        $(this).closest('tr').find('.educationdoc').text("");
                        $(this).closest('tr').find('.edu_file').attr("required", false).css({
                            'display': 'none',
                        });
                    } else {
                        $(this).closest('tr').find('.educationdoc').text("TC or Marksheet").css({
                            'font-size': '90%',
                        });
                        $(this).closest('tr').find('.edu_file').attr("required", true).css({
                            'display': 'block',
                        });
                    }
                });

                $("#familytable").on('change', '.education_document_add', function() {
                    if ($(this).val() == "Non Literate" || $(this).val() == "") {
                        $(this).closest('tr').find('.docadd').text("");
                        $(this).closest('tr').find('.edu_file_add').attr("required", false).css({
                            'display': 'none',
                        });
                    } else {
                        $(this).closest('tr').find('.docadd').text("TC or Marksheet or Bonafide").css({
                            'font-size': '90%',
                        });
                        $(this).closest('tr').find('.edu_file_add').attr("required", true).css({
                            'display': 'block',
                        });
                    }
                });

                $("#familytable").on('click', '.btnDelete', function() {
                    $(this).closest('tr').remove();
                });


                function addnewrow() {
                    $("#familytable tbody").append(
                        "<tr><td><select required name='relationship_add[]' class='form-control'><option value=''>Select</option><option value='Self'>Self</option><option value='Elder Brother'>Elder Brother</option><option value='Younger Brother'>Younger Brother</option><option value='Younger Sister'>Elder Sister</option><option value='Elder Sister'>Elder Sister</option></select></td><td><input class='form-control' required type='text' name='name_tamil_add[]' maxlength='100'></td><td><input class='form-control' required type='text' name='name_english_add[]' maxlength='100'></td><td><input class='form-control' required type='text' name='age_add[]' maxlength='2'></td><td><select required name='living_status_add[]' class='form-control alive_or_dead'><option value=''>Select</option><option value='Alive'>Alive</option><option value='Dead'>Dead</option></select></td><td> <select required name='education_type_add[]' class='form-control education_document_add'><option value=''>Select Education Type</option><option value='Non Literate'>Non Literate</option><option value='Drop Out'>Drop Out</option><option value='Upto 5 Standard'>Upto 5 Standard</option><option value='Less than 10th Standard'>Less than 10th Standard</option><option value='Less than 12th Standard'>Less than 12th Standard</option><option value='10th Or 12th Standard'>10th Or 12th Standard</option><option value='Diploma'>Diploma</option><option value='Degree Completed'>Degree Completed</option><option value='Post Graduate'>Post Graduate</option><option value='Pursing Degree'>Pursing Degree</option></select></td> <td><P class='docadd'></P><input style='display:none' class='form-control edu_file_add'type='file' name='doc1[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><iclass='material-symbols-outlined'>Remove</i></a></td></tr>"
                    );
                }



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


                $('#handicapped_proof').change(function() {
                    if ($('#handicapped_proof').val() == 'Passport') {
                        $('#passporthide').show("slow");
                        $('#pancardhide').hide("slow");
                        $('#voteridhide').hide("slow");
                        $('#driving_licensehide').hide("slow");
                        $('#pandcard').prop("required", false);
                        $('#voterid').prop("required", false);
                        $('#driving_license').prop("required", false);
                        $('#passport').prop("required", true);

                    } else if ($('#handicapped_proof').val() == 'Pan Card') {
                        $('#pancardhide').show("slow");
                        $('#passporthide').hide("slow");
                        $('#voteridhide').hide("slow");
                        $('#driving_licensehide').hide("slow");
                        $('#passport').prop("required", false);
                        $('#voterid').prop("required", false);
                        $('#driving_license').prop("required", false);
                        $('#pancard').prop("required", true);

                    } else if ($('#handicapped_proof').val() == 'Voter Id') {
                        $('#voteridhide').show("slow");
                        $('#passporthide').hide("slow");
                        $('#pancardhide').hide("slow");
                        $('#driving_licensehide').hide("slow");
                        $('#passport').prop("required", false);
                        $('#driving_license').prop("required", false);
                        $('#pancard').prop("required", false);
                        $('#voterid').prop("required", true);

                    } else if ($('#handicapped_proof').val() == 'Driving License') {
                        $('#driving_licensehide').show("slow");
                        $('#passporthide').hide("slow");
                        $('#pancardhide').hide("slow");
                        $('#voteridhide').hide("slow");
                        $('#passport').prop("required", false);
                        $('#voterid').prop("required", false);
                        $('#pancard').prop("required", false);
                        $('#driving_license').prop("required", true);
                    } else {
                        $('#driving_licensehide').hide("slow");
                        $('#passporthide').hide("slow");
                        $('#pancardhide').hide("slow");
                        $('#voteridhide').hide("slow");
                        $('#passport').prop("required", false);
                        $('#pancard').prop("required", false);
                        $('#voterid').prop("required", false);
                        $('#driving_license').prop("required", false);

                    }
                });

                $('#m_certificate').change(function() {
                    if ($('#m_certificate').val() == 'Marriage Invitation') {
                        $('#mrg_invitationhide').show("slow");
                        $('#mrg_registration_certificatehide').hide("slow");
                        $('#mrg_documentshide').hide("slow");
                        $('#mrg_registration_certificate').prop("required", false);
                        $('#mrg_documents').prop("required", false);
                        $('#mrg_invitation').prop("required", true);

                    } else if ($('#m_certificate').val() == 'Marriage Registration Certificate') {
                        $('#mrg_registration_certificatehide').show("slow");
                        $('#mrg_invitationhide').hide("slow");
                        $('#mrg_documentshide').hide("slow");
                        $('#mrg_invitation').prop("required", false);
                        $('#mrg_documents').prop("required", false);
                        $('#mrg_registration_certificate').prop("required", true);

                    } else if ($('#m_certificate').val() == 'Marriage Documents') {
                        $('#mrg_documentshide').show("slow");
                        $('#mrg_registration_certificatehide').hide("slow");
                        $('#mrg_invitationhide').hide("slow");
                        $('#mrg_invitation').prop("required", false);
                        $('#mrg_registration_certificate').prop("required", false);
                        $('#mrg_documents').prop("required", true);

                    } else {
                        $('#mrg_invitationhide').hide("slow");
                        $('#mrg_registration_certificatehide').hide("slow");
                        $('#mrg_documentshide').hide("slow");
                        $('#mrg_invitation').prop("required", false);
                        $('#mrg_registration_certificate').prop("required", false);
                        $('#mrg_documents').prop("required", false);

                    }
                });

                $('#handicapped_proof').change(function() {
                    if ($('#handicapped_proof').val() == 'Passport') {
                        $('#passporthide').show("slow");
                        $('#pancardhide').hide("slow");
                        $('#voteridhide').hide("slow");
                        $('#driving_licensehide').hide("slow");
                        $('#pandcard').removeClass("required");
                        $('#voterid').removeClass("required");
                        $('#driving_license').removeClass("required");
                        $('#passport').addClass("required");

                    } else if ($('#handicapped_proof').val() == 'Pan Card') {
                        $('#pancardhide').show("slow");
                        $('#passporthide').hide("slow");
                        $('#voteridhide').hide("slow");
                        $('#driving_licensehide').hide("slow");
                        $('#passport').removeClass("required");
                        $('#voterid').removeClass("required");
                        $('#driving_license').removeClass("required");
                        $('#pancard').addClass("required");

                    } else if ($('#handicapped_proof').val() == 'Voter Id') {
                        $('#voteridhide').show("slow");
                        $('#passporthide').hide("slow");
                        $('#pancardhide').hide("slow");
                        $('#driving_licensehide').hide("slow");
                        $('#passport').removeClass("required");
                        $('#driving_license').removeClass("required");
                        $('#pancard').removeClass("required");
                        $('#voterid').addClass("required");

                    } else if ($('#handicapped_proof').val() == 'Driving License') {
                        $('#driving_licensehide').show("slow");
                        $('#passporthide').hide("slow");
                        $('#pancardhide').hide("slow");
                        $('#voteridhide').hide("slow");
                        $('#passport').removeClass("required");
                        $('#voterid').removeClass("required");
                        $('#pancard').removeClass("required");
                        $('#driving_license').addClass("required");
                    } else {
                        $('#driving_licensehide').hide("slow");
                        $('#passporthide').hide("slow");
                        $('#pancardhide').hide("slow");
                        $('#voteridhide').hide("slow");
                        $('#passport').removeClass("required");
                        $('#pancard').removeClass("required");
                        $('#voterid').removeClass("required");
                        $('#driving_license').removeClass("required");

                    }
                });
            </script>
        @endpush
