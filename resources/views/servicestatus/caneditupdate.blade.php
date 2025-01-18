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
                            <form action="{{ url('/caneditupdate') }}" id="formAccountSettings"
                                method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <input type="hidden" name="applied_serviceid" value="{{ $services->id }}">
                                    <input type="hidden" name="user_id" value="{{ $services->user_id }}">
                                    <input type="hidden" name="retailer_id" value="{{ $services->retailer_id }}">
                                    <input type="hidden" name="distributor_id" value="{{ $services->distributor_id }}">
                                    <input type="hidden" name="serviceid" value="{{ $services->service_id }}">
                                    @php
                                        $apply_user_id = 0;
                                        if ($services->retailer_id == 0) {
                                            $apply_user_id = $services->distributor_id;
                                        } elseif ($services->distributor_id == 0) {
                                            $apply_user_id = $services->retailer_id;
                                        }
                                    @endphp

                                   @if ($serviceid == 60)
                                    <div class="mb-3 col-md-4">
                                        <label for="personalized" class="form-label">திரு/திருமதி/செல்வி</label>
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

                                        <label for="relationship" class="form-label">உறவுமுறை</label>
                                        <select @if (Auth::user()->id != $apply_user_id ) disabled @endif class="form-control"
                                            name="relationship_1">
                                            <option value="">Select</option>
                                            <option @if ($services->relationship_1 == 'தந்தை') selected @endif value="தந்தை">தந்தை.
                                            </option>                                       
                                        </select>
                                        <label for="relationship" class="form-label">உறவுமுறை</label>
                                        <select @if (Auth::user()->id != $apply_user_id ) disabled @endif class="form-control"
                                            name="relationship_2">
                                            <option value="">Select</option>
                                            <option @if ($services->relationship_2 == 'தாய்') selected @endif value="தாய்">தாய்.
                                            </option>
                                            
                                        </select>
                                        <label for="relationship" class="form-label">உறவுமுறை</label>
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
                                        <label for="dob" class="form-label">DOB</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="date"
                                            value="{{ $services->dob }}" class="form-control" name="dob"
                                            maxlength="10" placeholder="DOB" />
                                        <label for="religion" class="form-label">Religion</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->religion }}" class="form-control" name="religion"
                                            maxlength="20" placeholder="Religion" />
                                        <label for="education" class="form-label">Education</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->education }}" class="form-control" name="education"
                                            maxlength="50" placeholder="Education" />
                                        <label for="work" class="form-label">Work</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->work }}" class="form-control" name="work"
                                            maxlength="50" placeholder="Work" />
                                        <label for="door_no" class="form-label">Door No</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->door_no }}" class="form-control" name="door_no"
                                            maxlength="20" placeholder="Door No" />
                                        <label for="pin_code" class="form-label">Pin Code</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->pin_code }}" class="form-control" name="pin_code"
                                                maxlength="10" placeholder="Pin Code" />
                                            <label for="dist_id" class="form-label">District</label>
                                            <select @if (Auth::user()->id != $apply_user_id ) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $services->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                           


                                    </div>
                                    <div class="mb-3 col-md-4">

                                       
                                    <label for="personalized_name_tamil" class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->personalized_name_tamil }}" class="form-control" name="personalized_name_tamil"
                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                        <label for="relationship_name_tamil_1" class="form-label">பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->relationship_name_tamil_1 }}" class="form-control" name="relationship_name_tamil_1"
                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                            <label for="relationship_name_tamil_2" class="form-label">பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->relationship_name_tamil_2 }}" class="form-control" name="relationship_name_tamil_2"
                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                            <label for="relationship_name_tamil_3" class="form-label">பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->relationship_name_tamil_3 }}" class="form-control" name="relationship_name_tamil_3"
                                            maxlength="50" placeholder="பெயர் தமிழில்" />
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                            value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                            maxlength="10" placeholder="Mobile Number" />
                                        <label for="community" class="form-label">Community</label>
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
                                        <label for="aadhaar_number" class="form-label">Aadhaar Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->aadhaar_number }}" class="form-control number" name="aadhaar_number"
                                                maxlength="12" placeholder="Aadhaar Number" />
                                        <label for="smartcard_number" class="form-label">Smart Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->smartcard_number }}" class="form-control" name="smartcard_number"
                                                maxlength="12" placeholder="Smart Number" />
                                        <label for="street_name_tamil" class="form-label">தெரு பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->street_name_tamil }}" class="form-control" name="street_name_tamil"
                                                maxlength="50" placeholder="தெரு பெயர்" />
                                        <label for="street_name_tamil" class="form-label">அஞ்சல் பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->street_name_tamil }}" class="form-control" name="street_name_tamil"
                                                maxlength="50" placeholder="அஞ்சல் பெயர்" />
                                        <label for="taluk_id" class="form-label">Taluk</label>
                                            <select @if (Auth::user()->id != $apply_user_id ) disabled @endif name="taluk_id"
                                                id="taluk" class="form-control">
                                            </select>
                                       

                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label for="personalized_name_english" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->personalized_name_english }}" class="form-control" name="personalized_name_english"
                                                maxlength="50" placeholder="Name In English" />
                                                <label for="relationship_name_english" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->relationship_name_english_1 }}" class="form-control" name="relationship_name_english_1"
                                                maxlength="50" placeholder="Name In English" />
                                                <label for="relationship_name_english" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->relationship_name_english_2 }}" class="form-control" name="relationship_name_english_2"
                                                maxlength="50" placeholder="Name In English" />
                                                <label for="relationship_name_english" class="form-label">Name In English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->relationship_name_english_3 }}" class="form-control" name="relationship_name_english_3"
                                                maxlength="50" placeholder="Name In English" />
                                            <label for="maritial_status" class="form-label">Maritial Status</label>
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
                                            <label for="caste" class="form-label">Caste</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->caste }}" class="form-control" name="caste"
                                                maxlength="20" placeholder="caste" />

                                            @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card(Front & Back)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card(Front & Back)</label>
                                                <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                                    type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id )
                                            @if ($services->smart_card != '')
                                                <label>Smart Card</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Smart Card</label>
                                            <input @if ($services->smart_card == '') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="smart_card">
                                            @if ($services->smart_card != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                            @endif
                                        @endif
                                        <label for="street_name" class="form-label">Street Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->street_name }}" class="form-control" name="street_name"
                                                maxlength="30" placeholder="Street Name" />
                                        <label for="village_administrative_area" class="form-label">Postal Area</label>
                                        <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                        value="{{ $services->village_administrative_area }}" class="form-control" name="village_administrative_area"
                                        maxlength="20" placeholder="Postal Area" />

                                         <label for="vao_area" class="form-label">கிராம நிர்வாக பகுதி</label>
                                            <input @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->vao_area }}" class="form-control" name="panchayavao_areath_id"
                                                maxlength="50" placeholder="கிராம நிர்வாக பகுதி" />
                                                </select>
                                        
                                    </div>
                                    @elseif ($serviceid == 62)
                                    <div class="mb-3 col-md-6">
                                        <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->name_tamil }}" class="form-control" name="name_tamil"
                                            maxlength="30" placeholder="பெயர் தமிழில்" />
                                        <label for="name_english" class="form-label">Name In English</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->name_english }}" class="form-control" name="name_english"
                                            maxlength="30" placeholder="Name In English" />
                                    </div>
                                    <div class="mb-3 col-md-6">

                                        <label for="can_number" class="form-label">Can Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->can_number }}" class="form-control" name="can_number"
                                            maxlength="15" placeholder="Can Number" />

                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->aadhaar_card != '')
                                                <label>Aadhaar Card (Front & Back)</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Aadhaar Card (Front & Back)</label>
                                            <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                        @endif

                                    </div>
                                    @elseif ($serviceid == 63)
                                    <div class="mb-3 col-md-6">
                                        <label for="can_number" class="form-label">Can Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->can_number }}" class="form-control" name="can_number"
                                            maxlength="15" placeholder="Can Number" />
                                        <label for="original_dob" class="form-label">Original DOB</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->original_dob }}" class="form-control" name="original_dob"
                                            maxlength="10" placeholder="Original DOB" />
                                    </div>
                                    <div class="mb-3 col-md-6">

                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->aadhaar_card != '')
                                                <label>Aadhaar Card (Front & Back)</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Aadhaar Card (Front & Back)</label>
                                            <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                        @endif

                                    </div>
                                    @elseif ($serviceid == 64)
                                    <div class="mb-3 col-md-6">
                                        <label for="can_number" class="form-label">Can Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->can_number }}" class="form-control" name="can_number"
                                            maxlength="15" placeholder="Can Number" />
                                        <label for="new_mobile_no" class="form-label">New mobile Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->new_mobile_no }}" class="form-control" name="new_mobile_no"
                                            maxlength="10" placeholder="New mobile Number" />
                                    </div>
                                    <div class="mb-3 col-md-6">

                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->aadhaar_card != '')
                                                <label>Aadhaar Card (Front & Back)</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Aadhaar Card (Front & Back)</label>
                                            <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                        @endif

                                    </div>
                                    @elseif ($serviceid == 65)
                                    <div class="mb-3 col-md-6">
                                        <label for="can_number" class="form-label">Can Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->can_number }}" class="form-control" name="can_number"
                                            maxlength="15" placeholder="Can Number" />
                                        <label for="certificate_name" class="form-label">Certificate Name</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->certificate_name }}" class="form-control" name="certificate_name"
                                            maxlength="50" placeholder="Certificate Name" />
                                    </div>
                                    <div class="mb-3 col-md-6">

                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->aadhaar_card != '')
                                                <label>Aadhaar Card (Front & Back)</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Aadhaar Card (Front & Back)</label>
                                            <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                        @endif

                                    </div>
                                    @elseif ($serviceid == 66)
                                    <div class="mb-3 col-md-6">
                                        <label for="can_number" class="form-label">Can Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->can_number }}" class="form-control" name="can_number"
                                            maxlength="15" placeholder="Can Number" />
                                    </div>
                                    <div class="mb-3 col-md-6">

                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->aadhaar_card != '')
                                                <label>Aadhaar Card (Front & Back)</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Aadhaar Card (Front & Back)</label>
                                            <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>
                                    @elseif ($serviceid == 67)
                                    <div class="mb-3 col-md-6">
                                        <label for="can_number" class="form-label">Can Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->can_number }}" class="form-control" name="can_number"
                                            maxlength="15" placeholder="Can Number" />

                                        @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                            @if ($services->aadhaar_card != '')
                                                <label>Aadhaar Card (Front & Back)</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Aadhaar Card (Front & Back)</label>
                                            <input @if ($services->aadhaar_card == '') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="aadhaar_card">
                                            @if ($services->aadhaar_card != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="address_tamil" class="form-label">முகவரி தமிழில்</label>
                                            <textarea @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                value="{{ $services->address_tamil }}" class="form-control" name="address_tamil" maxlength="200"
                                                placeholder="முகவரி தமிழில்">{{ $services->address_tamil }}</textarea>
                                            <label for="address_english" class="form-label">Address In English</label>
                                            <textarea @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                value="{{ $services->address_english }}" class="form-control" name="address_english" maxlength="200"
                                                placeholder="Address In English">{{ $services->address_english }}</textarea>
                                    </div>
                                    @elseif ($serviceid == 121)
                                    <div class="mb-3 col-md-6">
                                        <label for="aadhaar_number" class="form-label">Aadhaar Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->aadhaar_number }}" class="form-control number" name="aadhaar_number"
                                            maxlength="12" placeholder="Aadhaar Number" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                            maxlength="10" placeholder="Mobile Number" />
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
                                </div>

                                <div class="mt-2 text-center">
                                    @if ($services->status == 'Resubmit' && ($services->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id))
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
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var dist_id = "{{ $services->dist_id }}";
            var taluk_id = "{{ $services->taluk_id }}";
            gettaluk(dist_id);
            getpanchayath(taluk_id);

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
    </script>
@endpush


