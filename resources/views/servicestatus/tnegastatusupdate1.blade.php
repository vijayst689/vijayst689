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
                            <form class="row g-4" action="{{ url('submit_statusupdate_tnegaservices1') }}" enctype="multipart/form-data"
                            method="post">
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
                                        }
                                        elseif ($services->retailer_id == 0) {
                                            $apply_user_id = $services->distributor_id;
                                        } elseif ($services->distributor_id == 0) {
                                            $apply_user_id = $services->retailer_id;
                                        }
                                    @endphp

                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="mb-3 row">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Do You Have Can Number</label>
                                        <div class="col-sm-6">
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif  required name="can_details" id="can_details" class="form-control">
                                                <option value="">Select Can Details</option>
                                                <option @if($services->can_details == "Yes") selected @endif value="Yes">Yes</option>
                                                <option @if($services->can_details == "No") selected @endif value="No">No</option>
                                                <option @if($services->can_details == "Find") selected @endif value="Find">Find Can</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row" id="cannumberhide" style="display: none;">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Can
                                        Number</label>
                                        <div class="col-sm-6">
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif  class="form-control" id="cannumber" type="text"
                                            name="can_number" value="{{ $services->can_number }}" maxlength="15">
                                        </div>
                                    </div>
                                 <div class="mb-3">

                                        <div class="row" id="dobhide" style="display: none;">
                                            <h4 class="text-center">Can Details</h4>
                                <div class="mb-3 col-md-4">
                                        <label style="color:#23e156" for="personalized" class="form-label">திரு/திருமதி/செல்வி</label>
                                        <select @if (Auth::user()->id != $apply_user_id ) disabled @endif class="form-control"
                                            name="personalized">
                                            <option value="">Select</option>
                                            <option @if ($services->personalized == 'திரு') selected @endif value="திரு">திரு.
                                            </option>
                                            <option @if ($services->personalized == 'திருமதி') selected @endif value="திருமதி">திருமதி.
                                            </option>
                                            <option @if ($services->personalized == 'செல்வி') selected @endif value="செல்வி">
                                                செல்வி.</option>
                                        </select>

                                        <label style="color:#23e156" for="relationship_1" class="form-label">உறவுமுறை</label>
                                        <select @if (Auth::user()->id != $apply_user_id ) disabled @endif class="form-control"
                                            name="relationship_1">
                                            <option value="">Select</option>
                                            <option @if ($services->relationship_1 == 'தந்தை') selected @endif value="தந்தை">தந்தை.
                                            </option>
                                        </select>
                                        <label style="color:#23e156" for="relationship_2" class="form-label">உறவுமுறை</label>
                                        <select @if (Auth::user()->id != $apply_user_id ) disabled @endif class="form-control"
                                            name="relationship_2">
                                            <option value="">Select</option>
                                            <option @if ($services->relationship_2 == 'தாய்') selected @endif value="தாய்">தாய்.
                                            </option>
                                        </select>
                                        <label style="color:#23e156" for="relationship_3" class="form-label">உறவுமுறை</label>
                                        <select @if (Auth::user()->id != $apply_user_id ) disabled @endif class="form-control"
                                            name="relationship_3">
                                            <option value="">Select</option>
                                            <option @if ($services->relationship_3 == 'கணவர்') selected @endif value="கணவர்">கணவர்.
                                            </option>
                                            <option @if ($services->relationship_3 == 'மனைவி') selected @endif value="மனைவி">மனைவி.
                                            </option>
                                            <option @if ($services->relationship_3 == 'உறவினர்') selected @endif value="உறவினர்">உறவினர்.
                                            </option>
                                        </select>
                                        <label style="color:#e411dd" for="community" class="form-label">Community</label>
                                            <select @if (Auth::user()->id != $apply_user_id ) disabled @endif class="form-control"
                                                name="community">
                                                <option value="">Select Community</option>
                                                <option @if ($services->community == 'BC') selected @endif value="BC">BC.
                                                </option>
                                                <option @if ($services->community == 'OC') selected @endif value="OC">OC.
                                                </option>
                                                <option @if ($services->community == 'OBC') selected @endif value="OBC">OBC.
                                                </option>
                                                <option @if ($services->community == 'MBC') selected @endif value="MBC">MBC.
                                                </option>
                                                <option @if ($services->community == 'SC') selected @endif value="SC">SC.
                                                </option>
                                                <option @if ($services->community == 'ST') selected @endif value="ST">ST.
                                                </option>
                                                <option @if ($services->community == 'BC(Muslim)') selected @endif value="BC(Muslim)">BC (Muslim).
                                                </option>
                                            </select>
                                            <label style="color:#23e156" for="maritial_status" class="form-label">Maritial Status</label>
                                                <select @if (Auth::user()->id != $apply_user_id ) disabled @endif class="form-control"
                                                    name="maritial_status">
                                                    <option value="">Select Maritial Status</option>
                                                    <option @if ($services->maritial_status == 'Married') selected @endif value="Married">Married
                                                    </option>
                                                    <option @if ($services->maritial_status == 'Single') selected @endif value="Single">Single
                                                    </option>
                                                    <option @if ($services->maritial_status == 'Divorced') selected @endif value="Divorced">Divorced
                                                    </option>
                                                </select>
                                        
                                        
                                        <label style="color:#23e156" for="door_no" class="form-label">Door No</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->door_no }}" class="form-control" name="door_no"
                                            maxlength="20" placeholder="Door No" />
                                            <label style="color:#23e156" for="pin_code" class="form-label">Pin Code</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->pin_code }}" class="form-control" name="pin_code"
                                                maxlength="10" placeholder="Pin Code" />
                                    </div>
                                    <div class="mb-3 col-md-4">

                                        <label style="color:#e411dd" for="personalized_name_tamil" class="form-label">பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->personalized_name_tamil }}" class="form-control" name="personalized_name_tamil"
                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                        <label style="color:#e411dd" for="relationship_name_tamil_1" class="form-label">பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->relationship_name_tamil_1 }}" class="form-control" name="relationship_name_tamil_1"
                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                            <label style="color:#e411dd" for="relationship_name_tamil_2" class="form-label">பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->relationship_name_tamil_2 }}" class="form-control" name="relationship_name_tamil_2"
                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                            <label style="color:#e411dd" for="relationship_name_tamil_3" class="form-label">பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->relationship_name_tamil_3 }}" class="form-control" name="relationship_name_tamil_3"
                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                         <label style="color:#23e156" for="caste" class="form-label">Caste</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->caste }}" class="form-control" name="caste"
                                                maxlength="20" placeholder="caste" />
                                                <label style="color:#23e156" for="education" class="form-label">Education</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->education }}" class="form-control" name="education"
                                            maxlength="50" placeholder="Education" />
                                        
                                        <label style="color:#e411dd" for="street_name_tamil" class="form-label">தெரு பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->street_name_tamil }}" class="form-control" name="street_name_tamil"
                                                maxlength="50" placeholder="தெரு பெயர்" />
                                        <label style="color:#e411dd" for="street_name_tamil" class="form-label">அஞ்சல் பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->street_name_tamil }}" class="form-control" name="street_name_tamil"
                                                maxlength="50" placeholder="அஞ்சல் பெயர்" />
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label style="color:#23e156" for="personalized_name_english" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->personalized_name_english }}" class="form-control" name="personalized_name_english"
                                                maxlength="50" placeholder="Name In English" />
                                                <label style="color:#23e156" for="relationship_name_english_1" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->relationship_name_english_1 }}" class="form-control" name="relationship_name_english_1"
                                                maxlength="50" placeholder="Name In English" />
                                                <label style="color:#23e156" for="relationship_name_english_2" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->relationship_name_english_2 }}" class="form-control" name="relationship_name_english_2"
                                                maxlength="50" placeholder="Name In English" />
                                                <label style="color:#23e156" for="relationship_name_english_3" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->relationship_name_english_3 }}" class="form-control" name="relationship_name_english_3"
                                                maxlength="50" placeholder="Name In English" />
                                            
                                           <label style="color:#23e156" for="religion" class="form-label">Religion</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->religion }}" class="form-control" name="religion"
                                            maxlength="20" placeholder="Religion" />
                                        
                                        <label style="color:#23e156" for="work" class="form-label">Work</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->work }}" class="form-control" name="work"
                                            maxlength="50" placeholder="Work" />
  
                                        <label style="color:#23e156" for="street_name" class="form-label">Street Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->street_name }}" class="form-control" name="street_name"
                                                maxlength="30" placeholder="Street Name" />
                                        
                                        <label style="color:#23e156" for="village_administrative_area" class="form-label">Postal Area</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                        value="{{ $services->village_administrative_area }}" class="form-control" name="village_administrative_area"
                                        maxlength="20" placeholder="Postal Area" />

                                    </div>
                            </div>
                    </div>
                </div>
            </div>
                                <h4 class="text-center"> Basic Details </h4>

                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input value="{{ $customers->name }}" readonly  required type="text" class="form-control"
                                    name="name" placeholder="Name"/>


                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input value="{{ $customers->aadhaar_no }}" readonly required type="text" maxlength="12" class="form-control"
                                    name="aadhaar_no" placeholder="Aadhaar Number"/>

                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                    <input value="{{ $customers->phone }}" readonly required type="text" maxlength="10" class="form-control"
                                    name="mobile" placeholder="Mobile Number"/>

                                    <label for="dist_id" class="form-label">District</label>
                                    <select disabled name="dist_id" id="dist_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach($districts as $d)
                                        <option @if($d->id == $customers->dist_id) selected @endif value="{{ $d->id }}">{{ $d->district_name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="taluk_id" class="form-label">Taluk</label>
                                    <select disabled name="taluk_id" id="taluk"  class="form-control">
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="panchayath_id" class="form-label">VAO</label>
                                    <select disabled name="panchayath_id" id="panchayath"  class="form-control">
                                    </select>

                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                    @if($customers->aadhaar_file == "")
                                    <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                    @else
                                    <br><a target="_blank" href="/upload/users/aadhaar_file/{{ $customers->aadhaar_file }}" class="btn btn-primary me-2">View</a><br>
                                    @endif

                                    <label for="smart_card" class="form-label">Smart Card</label>
                                    @if($customers->smartcard == "")
                                    <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                    @else
                                    <br><a target="_blank" href="/upload/users/smart_card/{{ $customers->smartcard }}" class="btn btn-primary me-2">View</a><br>
                                    @endif
                                    <label for="signature" class="form-label">Signature</label>
                                    @if($customers->signature == "")
                                    <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                    @else
                                    <br><a target="_blank" href="/upload/users/signature/{{ $customers->signature }}" class="btn btn-primary me-2">View</a><br>
                                    @endif
                                    <label for="photo" class="form-label">Photo</label>
                                    @if($customers->profile == "")
                                    <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                    @else
                                    <br><a target="_blank" href="/upload/users/profile_photo/{{ $customers->profile }}" class="btn btn-primary me-2">View</a><br>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <h4 class="text-center"> Additional Details </h4>
                                @if($serviceid == 2)
                                <div class="mb-3 col-md-6">
                                    <label for="income_yearly " class="form-label">Income (Yearly)</label>
                                    <input type="tel"  class="form-control"
                                    name="income_yearly" id="incomeyearly" placeholder="Income Yearly"/>

                                    <label for="income_monthly " class="form-label">Income (Monthly)</label>
                                    <input type="tel"  class="form-control"
                                    name="income_monthly" id="incomemonthly" placeholder="Income Monthly"/>

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="job_type" class="form-label">Job Type</label>
                                    <select required name="job_type" id="job_type" class="form-control">
                                        <option value="">Select Job Type</option>
                                        <option value="Govt">Govt Employee</option>
                                        <option value="Private">Private Employee</option>
                                        <option value="Agriculture">Agriculture</option>
                                        <option value="Others">Others</option>
                                    </select>

                                    <div class="" id="incomecertgovthide" class="form-control" style="display: none;">
                                       <label>Salary Slip</label>
                                       <input id="salary_slip"  class="form-control" type="file"
                                       name="salary_slip">

                                       <label>Pancard</label>
                                       <input id="pancard"  class="form-control" type="file"
                                       name="pancard">
                                   </div>
                               </div>
                               @elseif($serviceid == 3)
                               <div class="mb-3 col-md-6">
                                   <label class="form-label">Relationship</label>
                                   <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required name="relationship" class="form-control">
                                    <option value="">Select Relationship</option>
                                    <option @if($services->relationship == "Father") selected @endif value="Father">Father</option>
                                    <option @if($services->relationship == "Brother") selected @endif value="Brother">Brother</option>
                                    <option @if($services->relationship == "Sister") selected @endif value="Sister">Sister</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">

                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->tc_community_certificate != '')
                                <label>TC / Community Certificate</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/tc_community_certificate/{{ $services->tc_community_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>TC / Community Certificate</label>
                                <input @if ($services->tc_community_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="tc_community_certificate">
                                @if ($services->tc_community_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/tc_community_certificate/{{ $services->tc_community_certificate }}">Download</a><br>
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
                                <input @if ($services->income_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="income_certificate">
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
                               <input @if ($services->community_certificate == '') required @endif class="form-control"
                               type="file" accept="image/jpeg, image/png" name="community_certificate">
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
                            <input @if ($services->birth_certificate == '') required @endif class="form-control"
                            type="file" accept="image/jpeg, image/png" name="birth_certificate">
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
                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif type="text" maxlength="10" class="form-control"
                        name="smartcard_no" value="{{ $services->smartcard_no }}" placeholder="Smart Card Number"/>
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
                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required id="age_proof" name="age_proof" class="form-control">
                            <option value="">Select Age Proof</option>
                            <option @if($services->age_proof == "Birth Certificate") selected @endif value="Birth Certificate">Birth Certificate</option>
                            <option @if($services->age_proof == "Voter Id") selected @endif value="Voter Id">Voter Id</option>
                            <option @if($services->age_proof == "Licence") selected @endif value="Licence">Licence</option>
                            <option @if($services->age_proof == "Marksheet") selected @endif value="Marksheet">Marksheet</option>
                            <option @if($services->age_proof == "Tc/Community Certificate") selected @endif value="Tc/Community Certificate">Tc</option>

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
                        <input @if ($services->birth_certificate == '' && $services->age_proof == 'Birth Certificate') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="birth_certificate" id="birth_certificate">
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
                        <input @if ($services->voterid == '' && $services->age_proof == 'Voter Id') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="voterid" id="voterid">
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
                        <input @if ($services->driving_license == '' && $services->age_proof == 'Licence') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="driving_license" id="driving_license">
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
                        <input @if ($services->marksheet == '' && $services->age_proof == 'Marksheet') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="marksheet" id="marksheet">
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
                        <input @if ($services->tc_community_certificate == '' && $services->age_proof == 'Tc/Community Certificate') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="tc_community_certificate" id="tc_community_certificate">
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
                                                    <option @if ($services->selects == 'Text') selected @endif value = "Text">Text</option>
                                                    <option @if ($services->selects == 'File') selected @endif value = "File">File</option>
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
                                    <div class="text-center"><p id="nopayment"></p></div>
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
 $(function() {
    gettaluk(dist_id);
    getpanchayath(taluk_id);

    var status = "{{ $services->status }}";
    var acknowledgement = "{{ $services->acknowledgement }}";
    var certificate = "{{ $services->certificate }}";
    var candetails = "{{ $services->can_details }}";
    var ageproof = "{{ $services->age_proof }}";
    if(ageproof == "Tc/Community Certificate"){
         $('#tc_community_certificatehide').show("slow");
     }else if(ageproof == "Marksheet"){
        $('#marksheethide').show("slow");
     }else if(ageproof == "Voter Id"){
        $('#voteridhide').show("slow");
     }else if(ageproof == "Birth Certificate"){
         $('#birth_certificatehide').show("slow");
     }else if(ageproof == "Licence"){
        $('#driving_licensehide').show("slow");
     }

     if(candetails == "Yes"){
            $('#cannumberhide').show("slow");
            $('#cannumber').prop("required",true);
        }else if(candetails == "No"){
            $('#dobhide').show("slow");
        }

    if (status == "Resubmit") {
        $('#remarkshide').show("slow");
        $('#remarks').prop("required", true);
    } else if (status == "Processing") {
        $('#applicationnohide').show("slow");
        $('#application_no').prop("required", true);
        $('#acknowledgementhide').show("slow");
        if (acknowledgement == "") {
            $('#acknowledgement').prop("required", true);
        }
    } else if (status == "Approved") {
        $('#certhide').show("slow");
        if (acknowledgement == "") {
            $('#certificate').prop("required", true);
        }
    }
});

 function gettaluk(dist_id) {
    var url = "{{ url('service/get_taluk') }}/" + dist_id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (result) {
            $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
            $.each(result, function (key, value) {
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


$('#incomeyearly').on('input',function() {
    var yearly = parseInt($('#incomeyearly').val());
    $('#incomemonthly').val((yearly / 12 ? yearly / 12 : 0).toFixed(2));
});
var customerid = "{{ $customers->id }}";
$('#can_details').change(function(){
    if($('#can_details').val() == 'Yes') {
        $('#cannumberhide').show("slow");
        $('#cannumber').prop("required",true);
    }else if($('#can_details').val() == 'No'){
        window.location.href = "{{ url('applyservice') }}/"+60+"/"+customerid;
    }else if($('#can_details').val() == 'Find'){
        window.location.href = "{{ url('applyservice') }}/"+121+"/"+customerid;
    } else {
        $('#cannumberhide').hide("slow");
        $('#cannumber').prop("required",false);
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
    } else if ($('#service_status').val() == 'Processing') {
        $('#acknowledgementhide').show("slow");
        $('#acknowledgement').prop("required", true);
        $('#remarkshide').hide("slow");
        $('#remarks').prop("required", false);
        $('#certhide').hide("slow");
        $('#certificate').prop("required", false);
        $('#applicationnohide').show("slow");
        $('#application_no').prop("required", true);
    } else if ($('#service_status').val() == 'Approved') {
        $('#remarkshide').hide("slow");
        $('#remarks').prop("required", false);
        $('#acknowledgementhide').hide("slow");
        $('#acknowledgement').prop("required", false);
        $('#certhide').show("slow");
        $('#certificate').prop("required", true);
        $('#applicationnohide').hide("slow");
        $('#application_no').prop("required", false);
    } else {
        $('#remarkshide').hide("slow");
        $('#remarks').prop("required", false);
        $('#acknowledgementhide').hide("slow");
        $('#acknowledgement').prop("required", false);
        $('#certhide').hide("slow");
        $('#certificate').prop("required", false);
        $('#applicationnohide').hide("slow");
        $('#application_no').prop("required", false);
    }
});

$('#job_type').change(function(){
    if($('#job_type').val() == 'Govt') {
        $('#incomecertgovthide').show("slow");
        $('#salary_slip').prop("required",true);
        $('#pancard').prop("required",true);
    } else {
        $('#incomecertgovthide').hide("slow");
        $('#salary_slip').prop("required",false);
        $('#pancard').prop("required",false);
    }
});

$('#age_proof').change(function(){
    if($('#age_proof').val() == 'Tc/Community Certificate') {
     $('#tc_community_certificatehide').show("slow");
     $('#marksheethide').hide("slow");
     $('#voteridhide').hide("slow");
     $('#birth_certificatehide').hide("slow");
     $('#driving_licensehide').hide("slow");
     $('#marksheet').prop("required",false);
     $('#voterid').prop("required",false);
     $('#birth_certificate').prop("required",false);
     $('#driving_license').prop("required",false);
     $('#tc_community_certificate').prop("required",true);

 } else if($('#age_proof').val() == 'Marksheet') {
    $('#marksheethide').show("slow");
    $('#tc_community_certificatehide').hide("slow");
    $('#voteridhide').hide("slow");
    $('#birth_certificatehide').hide("slow");
    $('#driving_licensehide').hide("slow");
    $('#tc_community_certificate').prop("required",false);
    $('#voterid').prop("required",false);
    $('#birth_certificate').prop("required",false);
    $('#driving_license').prop("required",false);
    $('#marksheet').prop("required",true);

} else if($('#age_proof').val() == 'Voter Id') {
    $('#voteridhide').show("slow");
    $('#marksheethide').hide("slow");
    $('#tc_community_certificatehide').hide("slow");
    $('#birth_certificatehide').hide("slow");
    $('#driving_licensehide').hide("slow");
    $('#tc_community_certificate').prop("required",false);
    $('#marksheet').prop("required",false);
    $('#birth_certificate').prop("required",false);
    $('#driving_license').prop("required",false);
    $('#voterid').prop("required",true);

} else if($('#age_proof').val() == 'Birth Certificate') {
    $('#birth_certificatehide').show("slow");
    $('#marksheethide').hide("slow");
    $('#tc_community_certificatehide').hide("slow");
    $('#voteridhide').hide("slow");
    $('#driving_licensehide').hide("slow");
    $('#tc_community_certificate').prop("required",false);
    $('#marksheet').prop("required",false);
    $('#voterid').prop("required",false);
    $('#driving_license').prop("required",false);
    $('#birth_certificate').prop("required",true);

} else if($('#age_proof').val() == 'Licence') {
    $('#driving_licensehide').show("slow");
    $('#marksheethide').hide("slow");
    $('#tc_community_certificatehide').hide("slow");
    $('#voteridhide').hide("slow");
    $('#birth_certificatehide').hide("slow");
    $('#tc_community_certificate').prop("required",false);
    $('#marksheet').prop("required",false);
    $('#voterid').prop("required",false);
    $('#birth_certificate').prop("required",false);
    $('#driving_license').prop("required",true);

} else{
    $('#voteridhide').hide("slow");
    $('#marksheethide').hide("slow");
    $('#tc_community_certificatehide').hide("slow");
    $('#birth_certificatehide').hide("slow");
    $('#driving_licensehide').hide("slow");
    $('#tc_community_certificate').prop("required",false);
    $('#marksheet').prop("required",false);
    $('#voterid').prop("required",false);
    $('#birth_certificate').prop("required",false);
    $('#driving_license').prop("required",false);

}
});
</script>
@endpush
