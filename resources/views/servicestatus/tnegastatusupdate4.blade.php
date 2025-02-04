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
                            <form class="row g-4" action="{{ url('submit_statusupdate_tnegaservices4') }}"
                                enctype="multipart/form-data" method="post">
                                @csrf
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
                                            <input value="{{ $customers->name }}" readonly required type="text"
                                                class="form-control" name="name" placeholder="Name" />


                                            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                            <input value="{{ $customers->aadhaar_no }}" readonly required type="text"
                                                maxlength="12" class="form-control" name="aadhaar_no"
                                                placeholder="Aadhaar Number" />

                                            <label for="mobile" class="form-label number">Mobile Number</label>
                                            <input value="{{ $customers->phone }}" readonly required type="text"
                                                maxlength="10" class="form-control" name="mobile"
                                                placeholder="Mobile Number" />

                                            <label for="dist_id" class="form-label">District</label>
                                            <select disabled name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $customers->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>

                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select disabled name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="panchayath_id" class="form-label">VAO</label>
                                            <select disabled name="panchayath_id" id="panchayath" class="form-control">
                                            </select>

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
                                            <label for="signature" class="form-label">Signature</label>
                                            @if ($customers->signature == '')
                                                <br><a href="#" class="btn btn-primary me-2">No File
                                                    Uploaded</a><br>
                                            @else
                                                <br><a target="_blank"
                                                    href="/upload/users/signature/{{ $customers->signature }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            <label for="photo" class="form-label">Photo</label>
                                            @if ($customers->profile == '')
                                                <br><a href="#" class="btn btn-primary me-2">No File
                                                    Uploaded</a><br>
                                            @else
                                                <br><a target="_blank"
                                                    href="/upload/users/photo/{{ $customers->profile }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif

                                        </div>
                                    </div>
                                    <div class="row">
                                        <h4 class="text-center"> Additional Details </h4>

                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->aadhaar_card != '')
                                            <label>ஆதார் கார்டு</label>
                                            <br><a target="_blank" href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                            class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>ஆதார் கார்டு</label>
                                            <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                            <a target="_blank" href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                            @endif
                
                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->smart_card != '')
                                            <label>ஸ்மார்ட் கார்டு</label>
                                            <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                            class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>ஸ்மார்ட் கார்டு</label>
                                            <input @if ($services->smart_card == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="smart_card">
                                            @if ($services->smart_card != '')
                                            <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                            @endif
                                            @endif
                
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->photo != '')
                                            <label>போட்டோ</label>
                                            <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                            class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>போட்டோ</label>
                                            <input @if ($services->photo == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="photo">
                                            @if ($services->photo != '')
                                            <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                            @endif
                                            @endif
                                            </div>
                                            <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->signature != '')
                                            <label>கையெழுத்து</label>
                                            <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/signature/{{ $services->signature }}"
                                            class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>கையெழுத்து</label>
                                            <input @if ($services->signature == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="signature">
                                            @if ($services->signature != '')
                                            <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/signature/{{ $services->signature }}">Download</a><br>
                                            @endif
                                            @endif
                
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->tailoring_certificate != '')
                                            <label>தையல் சான்றிதழ்</label>
                                            <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/tailoring_certificate/{{ $services->tailoring_certificate }}"
                                            class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>தையல் சான்றிதழ்</label>
                                            <input @if ($services->tailoring_certificate == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="tailoring_certificate">
                                            @if ($services->tailoring_certificate != '')
                                            <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/tailoring_certificate/{{ $services->tailoring_certificate }}">Download</a><br>
                                            @endif
                                            @endif
                                             
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->income_certificate != '')
                                            <label>வருமான சான்றிதழ்(72000)க்குள்</label>
                                            <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/income_certificate/{{ $services->income_certificate }}"
                                            class="btn btn-primary me-2">View</a><br>
                                            @endif
                                            @else
                                            <label>வருமான சான்றிதழ்(72000)க்குள்</label>
                                            <input @if ($services->income_certificate == '') required @endif class="form-control"
                                            type="file" accept="image/jpeg, image/png" name="income_certificate">
                                            @if ($services->income_certificate != '')
                                            <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/income_certificate/{{ $services->income_certificate }}">Download</a><br>
                                            @endif
                                            @endif
                                          
                                        </div>
                 
                
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
                                                <input value="{{ $services->remarks }}" class="form-control"
                                                    type="text" name="remarks" maxlength="100" id="remarks"
                                                    placeholder="Remarks" />
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
                                        <div class="mt-2 text-center">
                                @if ($services->status == 'Resubmit' && ($apply_user_id != Auth::user()->id))
                                    <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                @elseif($services->status == 'Approved')
                                    <button type="button" disabled class="btn btn-primary me-2">Completed</button>
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
        var selects = "{{ $services->selects }}";
        var candetails = "{{ $services->can_details }}";
       

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
                } else if ($('#service_status').val() == 'Approved') {
                    $('#remarkshide').hide("slow");
                    $('#remarks').prop("required", false);
                    $('#acknowledgementhide').hide("slow");
                    $('#acknowledgement').prop("required", false);
                    $('#certhide').show("slow");
                    $('#certificate').prop("required", true);
                    $('#applicationnohide').hide("slow");
                    $('#application_no').prop("required", false);
                    $('#select').prop("required", false);
                    $('#selecthide').hide("slow");
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


    </script>
@endpush
