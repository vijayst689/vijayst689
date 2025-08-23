@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">pkrmsolutions.com</div>
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
                                    <form class="row g-4" action="{{ url('submit_statusupdate_tnegaservices5') }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
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
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <h5 class="card-title">{{ $servicename }}</h5>
                                                    <div class="mb-3 row">
                                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Do
                                                            You Have Can Number</label>
                                                        <div class="col-sm-6">
                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                required name="can_details" id="can_details"
                                                                class="form-control">
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
                                                                class="form-control" id="cannumber" type="text"
                                                                name="can_number" value="{{ $services->can_number }}"
                                                                maxlength="15">
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
                                                                    <option
                                                                        @if ($services->personalized == 'திரு') selected @endif
                                                                        value="திரு">திரு.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->personalized == 'திருமதி') selected @endif
                                                                        value="திருமதி">திருமதி.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->personalized == 'செல்வன்') selected @endif
                                                                        value="செல்வன்">
                                                                        செல்வன்.</option>
                                                                    <option
                                                                        @if ($services->personalized == 'செல்வி') selected @endif
                                                                        value="செல்வி">
                                                                        செல்வி.</option>
                                                                </select>
                                                                <label style="color:#23e156" for="relationship_1"
                                                                    class="form-label">உறவுமுறை</label>
                                                                <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    class="form-control" name="relationship_1">
                                                                    <option value="">Select</option>
                                                                    <option
                                                                        @if ($services->relationship_1 == 'தந்தை') selected @endif
                                                                        value="தந்தை">தந்தை.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->relationship_1 == 'கணவர்') selected @endif
                                                                        value="கணவர்">கணவர்.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->relationship_1 == 'உறவினர்') selected @endif
                                                                        value="உறவினர்">உறவினர்.
                                                                    </option>
                                                                </select>
                                                                <label style="color:#23e156" for="mother_name_tamil"
                                                                    class="form-label">தாயின் பெயர் தமிழில்</label>
                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text"
                                                                    value="{{ $services->mother_name_tamil }}"
                                                                    class="form-control" name="mother_name_tamil"
                                                                    maxlength="100" placeholder="தாயின் பெயர் தமிழில்" />

                                                                <label style="color:#23e156" for="community"
                                                                    class="form-label">Community</label>
                                                                <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    class="form-control" name="community">
                                                                    <option value="">Select Community</option>
                                                                    <option
                                                                        @if ($services->community == 'BC') selected @endif
                                                                        value="BC">BC.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->community == 'OC') selected @endif
                                                                        value="OC">OC.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->community == 'OBC') selected @endif
                                                                        value="OBC">OBC.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->community == 'MBC') selected @endif
                                                                        value="MBC">MBC.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->community == 'SC') selected @endif
                                                                        value="SC">SC.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->community == 'ST') selected @endif
                                                                        value="ST">ST.
                                                                    </option>
                                                                    <option
                                                                        @if ($services->community == 'BC(Muslim)') selected @endif
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
                                                                <label style="color:#e411dd"
                                                                    for="relationship_name_tamil_1"
                                                                    class="form-label">பெயர் தமிழில்</label>
                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text"
                                                                    value="{{ $services->relationship_name_tamil_1 }}"
                                                                    class="form-control" name="relationship_name_tamil_1"
                                                                    maxlength="50" placeholder="பெயர் தமிழில்" />
                                                                <label style="color:#e411dd" for="mother_name_english"
                                                                    class="form-label">Mother Name (ENGLISH)</label>
                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text"
                                                                    value="{{ $services->mother_name_english }}"
                                                                    class="form-control" name="mother_name_english"
                                                                    maxlength="50" placeholder="Mother Name (ENGLISH)" />
                                                                <label style="color:#e411dd" for="education"
                                                                    class="form-label">Education</label>
                                                                <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    class="form-control" name="education">
                                                                    <option value="">Select Education</option>
                                                                    <option
                                                                        @if ($services->education == 'Students') selected @endif
                                                                        value="Students">Students
                                                                    </option>
                                                                    <option
                                                                        @if ($services->education == 'No Education') selected @endif
                                                                        value="No Education">No Education
                                                                    </option>
                                                                    <option
                                                                        @if ($services->education == 'Private Employee') selected @endif
                                                                        value="Private Employee">Private Employee
                                                                    </option>
                                                                    <option
                                                                        @if ($services->education == 'Govt.Employee') selected @endif
                                                                        value="Govt.Employee">Govt.Employee
                                                                    </option>
                                                                    <option
                                                                        @if ($services->education == 'Daily Wages') selected @endif
                                                                        value="Daily Wages">Daily Wages
                                                                    </option>
                                                                    <option
                                                                        @if ($services->education == 'Others') selected @endif
                                                                        value="Others">Others
                                                                    </option>
                                                                </select>
                                                                <label style="color:#e411dd" for="street_name_tamil"
                                                                    class="form-label">தெரு பெயர்</label>
                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text"
                                                                    value="{{ $services->street_name_tamil }}"
                                                                    class="form-control" name="street_name_tamil"
                                                                    maxlength="50" placeholder="தெரு பெயர்" />
                                                                <label style="color:#e411dd" for="postal_area_tamil"
                                                                    class="form-label">அஞ்சல் பெயர்</label>
                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text"
                                                                    value="{{ $services->postal_area_tamil }}"
                                                                    class="form-control" name="postal_area_tamil"
                                                                    maxlength="50" placeholder="அஞ்சல் பெயர்" />
                                                            </div>
                                                            <div class="mb-3 col-md-4">
                                                                <label style="color:#23e156"
                                                                    for="personalized_name_english"
                                                                    class="form-label">Applicant Name</label>
                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text"
                                                                    value="{{ $services->personalized_name_english }}"
                                                                    class="form-control" name="personalized_name_english"
                                                                    maxlength="50" placeholder="Name In English" />
                                                                <label style="color:#23e156"
                                                                    for="relationship_name_english_1"
                                                                    class="form-label">Name In English</label>
                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text"
                                                                    value="{{ $services->relationship_name_english_1 }}"
                                                                    class="form-control"
                                                                    name="relationship_name_english_1" maxlength="50"
                                                                    placeholder="Name In English" />
                                                                <label style="color:#23e156" for="maritial_status"
                                                                    class="form-label">Maritial Status</label>
                                                                <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    class="form-control" name="maritial_status">
                                                                    <option value="">Select Maritial Status</option>
                                                                    <option
                                                                        @if ($services->maritial_status == 'Un Married') selected @endif
                                                                        value="Un Married">Un Married
                                                                    </option>
                                                                    <option
                                                                        @if ($services->maritial_status == 'Married') selected @endif
                                                                        value="Married">Married
                                                                    </option>
                                                                    <option
                                                                        @if ($services->maritial_status == 'Widower') selected @endif
                                                                        value="Widower">Widower
                                                                    </option>
                                                                    <option
                                                                        @if ($services->maritial_status == 'Widow') selected @endif
                                                                        value="Widow">Widow
                                                                    </option>
                                                                    <option
                                                                        @if ($services->maritial_status == 'Divorced') selected @endif
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
                                                                    class="form-control" name="street_name"
                                                                    maxlength="30" placeholder="Street Name" />
                                                                <label style="color:#23e156" for="postal_area_english"
                                                                    class="form-label">Postal Area</label>
                                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                                    type="text"
                                                                    value="{{ $services->postal_area_english }}"
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
                                            @if ($serviceid == 170)
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->family_photo != '')
                                                            <label>குடும்ப போட்டோ</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/family_photo/{{ $services->family_photo }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>குடும்ப போட்டோ</label>
                                                        <input @if ($services->family_photo == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="family_photo">
                                                        @if ($services->family_photo != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/family_photo/{{ $services->family_photo }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->id_proof != '')
                                                            <label>முகவரி சான்று</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/id_proof/{{ $services->id_proof }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>முகவரி சான்று</label>
                                                        <input @if ($services->id_proof == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="id_proof">
                                                        @if ($services->id_proof != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/id_proof/{{ $services->id_proof }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->birth_certificate_children != '')
                                                            <label>குழந்தைகளுக்கான பிறப்பு சான்று</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/birth_certificate_children/{{ $services->birth_certificate_children }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>குழந்தைகளுக்கான பிறப்பு சான்று</label>
                                                        <input @if ($services->birth_certificate_children == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="birth_certificate_children">
                                                        @if ($services->birth_certificate_children != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/birth_certificate_children/{{ $services->birth_certificate_children }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->family_plannnig_certificate != '')
                                                            <label>குடும்பக் கட்டுப்பாடு சான்று</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/family_plannnig_certificate/{{ $services->family_plannnig_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>குடும்பக் கட்டுப்பாடு சான்று</label>
                                                        <input @if ($services->family_plannnig_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="family_plannnig_certificate">
                                                        @if ($services->family_plannnig_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/family_plannnig_certificate/{{ $services->family_plannnig_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->self_declaration_certificate != '')
                                                            <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                        <input @if ($services->self_declaration_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="self_declaration_certificate">
                                                        @if ($services->self_declaration_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->anyothers_certificate != '')
                                                            <label>மற்றவைகள் இருந்தால் அதன் நகல்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/anyothers_certificate/{{ $services->anyothers_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>மற்றவைகள் இருந்தால் அதன் நகல்</label>
                                                        <input @if ($services->anyothers_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="anyothers_certificate">
                                                        @if ($services->anyothers_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/anyothers_certificate/{{ $services->anyothers_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif

                                                </div>
                                            @elseif($serviceid == 171)
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->udid_card != '')
                                                            <label>UDID (தேசிய அடையாள அட்டை)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/udid_card/{{ $services->udid_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>UDID (தேசிய அடையாள அட்டை)</label>
                                                        <input @if ($services->udid_card == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="udid_card">
                                                        @if ($services->udid_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/udid_card/{{ $services->udid_card }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->bank_pass_book != '')
                                                            <label>வங்கி பாஸ்புக்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>வங்கி பாஸ்புக்</label>
                                                        <input @if ($services->bank_pass_book == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="bank_pass_book">
                                                        @if ($services->bank_pass_book != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>ஏதேனும் ஐடி ஆதாரம்</label>
                                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        class="form-control" id="handicapped_proof"
                                                        name="handicapped_proof" style="width: 100%;">
                                                        <option value="">Select Handicapped Proof</option>
                                                        <option @if ($services->handicapped_proof == 'Passport') selected @endif
                                                            value="Passport">Passport</option>
                                                        <option @if ($services->handicapped_proof == 'Pan Card') selected @endif
                                                            value="PAN Card">PAN Card</option>
                                                        <option @if ($services->handicapped_proof == 'Voter Id') selected @endif
                                                            value="Voter Id">Voter Id</option>
                                                        <option @if ($services->handicapped_proof == 'Driving License') selected @endif
                                                            value="Driving License">Driving License</option>
                                                    </select>
                                                    <div class="mb-3 col-md-6">
                                                        <div class="" id="passporthide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->passport != '')
                                                                    <label>பாஸ்போர்ட்</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/passport/{{ $services->passport }}"class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label>பாஸ்போர்ட்</label>
                                                                <input @if ($services->passport == '' && $services->any_proof == 'Passport') required @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="passport"
                                                                    id="pass_port">
                                                                @if ($services->passport != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/passport/{{ $services->passport }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="" id="pancardhide" style="display: none;">
                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                            @if ($services->pancard != '')
                                                                <label>PAN கார்டு</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/pancard/{{ $services->pancard }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>PAN கார்டு</label>
                                                            <input @if ($services->pancard == '' && $services->any_proof == 'Pan Card') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="pancard"
                                                                id="pan_card">
                                                            @if ($services->pancard != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/pancard/{{ $services->pancard }}">Download</a><br>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <div class="" id="voteridhide" style="display: none;">
                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                            @if ($services->voterid != '')
                                                                <label>வாக்காளர் ஐடி</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>வாக்காளர் ஐடி</label>
                                                            <input @if ($services->voterid == '' && $services->any_proof == 'Voter Id') required @endif
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
                                                <div class="mb-3 col-md-6">
                                                    <div class="" id="driving_licensehide" style="display: none;">
                                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                            @if ($services->driving_license != '')
                                                                <label>ஓட்டுநர் உரிமம்</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/driving_license/{{ $services->driving_license }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>ஓட்டுநர் உரிமம்</label>
                                                            <input @if ($services->driving_license == '' && $services->any_proof == 'Driving License') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="driving_license"
                                                                id="drivinglicense">
                                                            @if ($services->driving_license != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/driving_license/{{ $services->driving_license }}">Download</a><br>
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            @elseif($serviceid == 172)
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->age_proof != '')
                                                            <label>வயது சான்று</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/age_proof/{{ $services->age_proof }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>வயது சான்று</label>
                                                        <input @if ($services->age_proof == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="age_proof">
                                                        @if ($services->age_proof != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/age_proof/{{ $services->age_proof }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->vao_certificate != '')
                                                            <label>வீ.ஏ.ஓ சான்று</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/vao_certificate/{{ $services->vao_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>வீ.ஏ.ஓ சான்று</label>
                                                        <input @if ($services->vao_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="vao_certificate">
                                                        @if ($services->vao_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/vao_certificate/{{ $services->vao_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->self_declaration_certificate != '')
                                                            <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                        <input @if ($services->self_declaration_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="self_declaration_certificate">
                                                        @if ($services->self_declaration_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->anyothers_certificate != '')
                                                            <label>மற்றவைகள் இருந்தால் அதன் நகல்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/anyothers_certificate/{{ $services->anyothers_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>மற்றவைகள் இருந்தால் அதன் நகல்</label>
                                                        <input @if ($services->anyothers_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="anyothers_certificate">
                                                        @if ($services->anyothers_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/anyothers_certificate/{{ $services->anyothers_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif

                                                </div>
                                            @elseif($serviceid == 176)
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->residential_certificate != '')
                                                            <label>குடியிருப்பு சான்று</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/residential_certificate/{{ $services->residential_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>குடியிருப்பு சான்று</label>
                                                        <input @if ($services->residential_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="residential_certificate">
                                                        @if ($services->residential_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/residential_certificate/{{ $services->residential_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->solvency_certificate != '')
                                                            <label>கடனுதவி சான்றிதழ்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/solvency_certificate/{{ $services->solvency_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>கடனுதவி சான்றிதழ்</label>
                                                        <input @if ($services->solvency_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="solvency_certificate">
                                                        @if ($services->solvency_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/solvency_certificate/{{ $services->solvency_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->shop_address_proof != '')
                                                            <label>கடை முகவரி ஆதாரம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/shop_address_proof/{{ $services->shop_address_proof }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>கடை முகவரி ஆதாரம்</label>
                                                        <input @if ($services->shop_address_proof == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="shop_address_proof">
                                                        @if ($services->shop_address_proof != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/shop_address_proof/{{ $services->shop_address_proof }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->chitta != '')
                                                            <label>சொத்து ஆவணச் சான்று அல்லது பட்டா அல்லது சிட்டா</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/chitta/{{ $services->chitta }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சொத்து ஆவணச் சான்று அல்லது பட்டா அல்லது சிட்டா</label>
                                                        <input @if ($services->chitta == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="chitta">
                                                        @if ($services->chitta != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/chitta/{{ $services->chitta }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->previous_licence != '')
                                                            <label>முந்தைய உரிமம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/previous_licence/{{ $services->previous_licence }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>முந்தைய உரிமம்</label>
                                                        <input @if ($services->previous_licence == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="previous_licence">
                                                        @if ($services->previous_licence != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/previous_licence/{{ $services->previous_licence }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->challan != '')
                                                            <label>செலுத்துச் சீட்டு</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/challan/{{ $services->challan }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>செலுத்துச் சீட்டு</label>
                                                        <input @if ($services->challan == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="challan">
                                                        @if ($services->challan != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/challan/{{ $services->challan }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->form_A != '')
                                                            <label>படிவம் ஏ</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/form_A/{{ $services->form_A }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>படிவம் ஏ</label>
                                                        <input @if ($services->form_A == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="form_A">
                                                        @if ($services->form_A != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/form_A/{{ $services->form_A }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->building_licence_document != '')
                                                            <label>கட்டிட உரிம ஆவணம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/building_licence_document/{{ $services->building_licence_document }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>கட்டிட உரிம ஆவணம்</label>
                                                        <input @if ($services->building_licence_document == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="building_licence_document">
                                                        @if ($services->building_licence_document != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/building_licence_document/{{ $services->building_licence_document }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->building_blue_print != '')
                                                            <label>பில்டிங் ப்ளூ பிரிண்ட்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/building_blue_print/{{ $services->building_blue_print }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>பில்டிங் ப்ளூ பிரிண்ட்</label>
                                                        <input @if ($services->building_blue_print == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="building_blue_print">
                                                        @if ($services->building_blue_print != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/building_blue_print/{{ $services->building_blue_print }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->pancard != '')
                                                            <label>PAN கார்டு</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/pancard/{{ $services->pancard }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>PAN கார்டு</label>
                                                        <input @if ($services->pancard == '' && $services->any_proof == 'Pan Card') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="pancard" id="pan_card">
                                                        @if ($services->pancard != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/pancard/{{ $services->pancard }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->self_declaration_certificate != '')
                                                            <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                        <input @if ($services->self_declaration_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="self_declaration_certificate">
                                                        @if ($services->self_declaration_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->lease_agreement != '')
                                                            <label>குத்தகை ஒப்பந்தம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/lease_agreement/{{ $services->lease_agreement }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>குத்தகை ஒப்பந்தம்</label>
                                                        <input @if ($services->lease_agreement == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="lease_agreement">
                                                        @if ($services->lease_agreement != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/lease_agreement/{{ $services->lease_agreement }}">Download</a><br>
                                                        @endif
                                                    @endif

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->it_return_document != '')
                                                            <label>IT திரும்ப ஆவணம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/it_return_document/{{ $services->it_return_document }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>IT திரும்ப ஆவணம்</label>
                                                        <input @if ($services->it_return_document == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="it_return_document">
                                                        @if ($services->it_return_document != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/it_return_document/{{ $services->it_return_document }}">Download</a><br>
                                                        @endif
                                                    @endif

                                                </div>
                                            @elseif($serviceid == 177)
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->registered_deed != '')
                                                            <label>பதிவு செய்த பத்திரம் (உன்மை நகல்)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/registered_deed/{{ $services->registered_deed }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>பதிவு செய்த பத்திரம் (உன்மை நகல்)</label>
                                                        <input @if ($services->registered_deed == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="registered_deed">
                                                        @if ($services->registered_deed != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/registered_deed/{{ $services->registered_deed }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->chitta_and_villangam != '')
                                                            <label>சிட்டா மற்றும் வில்லங்கம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/chitta_and_villangam/{{ $services->chitta_and_villangam }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சிட்டா மற்றும் வில்லங்கம்</label>
                                                        <input @if ($services->chitta_and_villangam == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="chitta_and_villangam">
                                                        @if ($services->chitta_and_villangam != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/chitta_and_villangam/{{ $services->chitta_and_villangam }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->property_details != '')
                                                            <label>சொத்து விவரம் (பட்டா & சிட்டா)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/property_details/{{ $services->property_details }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சொத்து விவரம் (பட்டா & சிட்டா)</label>
                                                        <input @if ($services->property_details == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="property_details">
                                                        @if ($services->property_details != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/property_details/{{ $services->property_details }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->self_declaration_certificate != '')
                                                            <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                        <input @if ($services->self_declaration_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="self_declaration_certificate">
                                                        @if ($services->self_declaration_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                            @elseif($serviceid == 178)
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->residential_certificate != '')
                                                            <label>குடியிருப்பு சான்று</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/residential_certificate/{{ $services->residential_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>குடியிருப்பு சான்று</label>
                                                        <input @if ($services->residential_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="residential_certificate">
                                                        @if ($services->residential_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/residential_certificate/{{ $services->residential_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->self_declaration_certificate != '')
                                                            <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சுய வாக்குமூலம் சான்றிதழ்</label>
                                                        <input @if ($services->self_declaration_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="self_declaration_certificate">
                                                        @if ($services->self_declaration_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->damage_certificate != '')
                                                            <label>சேத சான்றிதழ் (ஜெராக்ஸ் நகல்)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/damage_certificate/{{ $services->damage_certificate }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சேத சான்றிதழ் (ஜெராக்ஸ் நகல்)</label>
                                                        <input @if ($services->damage_certificate == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="damage_certificate">
                                                        @if ($services->damage_certificate != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/damage_certificate/{{ $services->damage_certificate }}">Download</a><br>
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
                                                            <option @if ($services->status == 'Rejected') selected @endif
                                                                value="Rejected">
                                                                Rejected</option>
                                                        @endif
                                                        <option @if ($services->status == 'Approved') selected @endif
                                                            value="Approved">Approved</option>
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
                                                            value = "Text">Text</option>
                                                        <option @if ($services->selects == 'File') selected @endif
                                                            value = "File">File</option>
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
                                            <div class="mt-2 text-center">
                                                @if ($services->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                                    <button type="submit" disabled
                                                        class="btn btn-primary me-2">Resubmit</button>
                                                @elseif($services->status == 'Approved')
                                                    <button type="button" disabled
                                                        class="btn btn-primary me-2">Completed</button>
                                                @else
                                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
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
                        var lects = "{{ $services->lects }}";


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


                    var customerid = "{{ $customers->id }}";
                    $('#can_details').change(function() {
                        if ($('#can_details').val() == 'Yes') {
                            $('#cannumberhide').show("slow");
                            $('#cannumber').prop("required", true);
                        } else if ($('#can_details').val() == 'No') {
                            window.location.href = "{{ url('applyservice') }}/" + 60 + "/" + customerid;
                        } else if ($('#can_details').val() == 'Find') {
                            window.location.href = "{{ url('applyservice') }}/" + 121 + "/" + customerid;
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



                    $('#handicapped_proof').change(function() {
                        if ($('#handicapped_proof').val() == 'Passport') {
                            $('#passporthide').show("slow");
                            $('#pancardhide').hide("slow");
                            $('#voteridhide').hide("slow");
                            $('#driving_licensehide').hide("slow");
                            $('#pancard').prop("required", false);
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
                            $('#pass_port').prop("required", false);
                            $('#pancard').prop("required", false);
                            $('#voterid').prop("required", false);
                            $('#driving_license').prop("required", false);

                        }
                    });
                </script>
            @endpush
