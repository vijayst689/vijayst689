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
                                <div class="card-body p-4">
                                    <h5 class="card-title">{{ $servicename }}</h5>
                                    <form action="{{ url('/caneditupdate') }}" id="myForm" method="POST"
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

                                            @if ($serviceid == 60)
                                                <div class="mb-3 col-md-4">
                                                    <label style="color:#23e156" for="personalized"
                                                        class="form-label">திரு/திருமதி/செல்வி</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        class="form-control" name="personalized">
                                                        <option value="">Select</option>
                                                        <option @if ($services->personalized == 'திரு') selected @endif
                                                            value="திரு">
                                                            திரு.
                                                        </option>
                                                        <option @if ($services->personalized == 'திருமதி') selected @endif
                                                            value="திருமதி">
                                                            திருமதி.
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
                                                            value="தந்தை">
                                                            தந்தை.
                                                        </option>
                                                        <option @if ($services->relationship_1 == 'கணவர்') selected @endif
                                                            value="கணவர்">
                                                            கணவர்.
                                                        </option>
                                                        <option @if ($services->relationship_1 == 'உறவினர்') selected @endif
                                                            value="உறவினர்">
                                                            உறவினர்.
                                                        </option>
                                                    </select>
                                                    <label style="color:#23e156" for="mother_name_tamil"
                                                        class="form-label">தாயின்
                                                        பெயர் தமிழில்</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->mother_name_tamil }}"
                                                        class="form-control" name="mother_name_tamil" maxlength="100"
                                                        placeholder="தாயின் பெயர் தமிழில்" />

                                                    <label style="color:#23e156" for="dob"
                                                        class="form-label">DOB</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="date" value="{{ $services->dob }}" class="form-control"
                                                        name="dob" maxlength="10" placeholder="DOB" />
                                                    <label style="color:#23e156" for="religion"
                                                        class="form-label">Religion</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->religion }}"
                                                        class="form-control" name="religion" maxlength="20"
                                                        placeholder="Religion" />
                                                    <label style="color:#23e156" for="community"
                                                        class="form-label">Community</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        class="form-control" name="community">
                                                        <option value="">Select Community</option>
                                                        <option @if ($services->community == 'BC') selected @endif
                                                            value="BC">
                                                            BC.
                                                        </option>
                                                        <option @if ($services->community == 'OC') selected @endif
                                                            value="OC">
                                                            OC.
                                                        </option>
                                                        <option @if ($services->community == 'OBC') selected @endif
                                                            value="OBC">
                                                            OBC.
                                                        </option>
                                                        <option @if ($services->community == 'MBC') selected @endif
                                                            value="MBC">
                                                            MBC.
                                                        </option>
                                                        <option @if ($services->community == 'SC') selected @endif
                                                            value="SC">
                                                            SC.
                                                        </option>
                                                        <option @if ($services->community == 'ST') selected @endif
                                                            value="ST">
                                                            ST.
                                                        </option>
                                                        <option @if ($services->community == 'BC(Muslim)') selected @endif
                                                            value="BC(Muslim)">BC (Muslim).
                                                        </option>
                                                    </select>

                                                    <label style="color:#23e156" for="door_no" class="form-label">Door
                                                        No</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->door_no }}"
                                                        class="form-control" name="door_no" maxlength="20"
                                                        placeholder="Door No" />
                                                    <label style="color:#23e156" for="pin_code" class="form-label">Pin
                                                        Code</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->pin_code }}"
                                                        class="form-control number" name="pin_code" maxlength="6"
                                                        placeholder="Pin Code" />
                                                    <label style="color:#23e156" for="dist_id"
                                                        class="form-label">District</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        name="dist_id" id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option @if ($d->id == $services->dist_id) selected @endif
                                                                value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="mb-3 col-md-4">

                                                    <label style="color:#e411dd" for="personalized_name_tamil"
                                                        class="form-label">விண்ணப்பதாரர் பெயர் தமிழில்</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->personalized_name_tamil }}"
                                                        class="form-control" name="personalized_name_tamil"
                                                        maxlength="100" placeholder="பெயர் தமிழில்" />
                                                    <label style="color:#e411dd" for="relationship_name_tamil_1"
                                                        class="form-label">பெயர் தமிழில்</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->relationship_name_tamil_1 }}"
                                                        class="form-control" name="relationship_name_tamil_1"
                                                        maxlength="100" placeholder="பெயர் தமிழில்" />
                                                    <label style="color:#e411dd" for="mother_name_english"
                                                        class="form-label">Mother Name (ENGLISH)</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->mother_name_english }}"
                                                        class="form-control" name="mother_name_english" maxlength="100"
                                                        placeholder="Mother Name (ENGLISH)" />

                                                    <label style="color:#e411dd" for="mobile" class="form-label">Mobile
                                                        Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->mobile }}"
                                                        class="form-control number" name="mobile" maxlength="10"
                                                        placeholder="Mobile Number" />

                                                    <label style="color:#e411dd" for="aadhaar_number"
                                                        class="form-label">Aadhaar
                                                        Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->aadhaar_number }}"
                                                        class="form-control number" name="aadhaar_number" maxlength="12"
                                                        placeholder="Aadhaar Number" />
                                                    <label style="color:#e411dd" for="smartcard_number"
                                                        class="form-label">Smart
                                                        Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->smartcard_number }}"
                                                        class="form-control" name="smartcard_number" maxlength="15"
                                                        placeholder="Smart Number" />
                                                    <label style="color:#e411dd"for="street_name_tamil"
                                                        class="form-label">தெரு
                                                        பெயர்</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->street_name_tamil }}"
                                                        class="form-control" name="street_name_tamil" maxlength="50"
                                                        placeholder="தெரு பெயர்" />
                                                    <label style="color:#e411dd" for="postal_area_tamil"
                                                        class="form-label">அஞ்சல் பெயர்</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->postal_area_tamil }}"
                                                        class="form-control" name="postal_area_tamil" maxlength="50"
                                                        placeholder="அஞ்சல் பெயர்" />
                                                    <label style="color:#e411dd" for="taluk_id"
                                                        class="form-label">Taluk</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        name="taluk_id" id="taluk" class="form-control">
                                                    </select>

                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label style="color:#23e156" for="personalized_name_english"
                                                        class="form-label">Applicant Name</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->personalized_name_english }}"
                                                        class="form-control" name="personalized_name_english"
                                                        maxlength="50" placeholder="Name In English" />
                                                    <label style="color:#23e156" for="relationship_name_english"
                                                        class="form-label">Name In English</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
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
                                                        <option @if ($services->maritial_status == 'Divorced') selected @endif
                                                            value="Divorced">Divorced
                                                        </option>
                                                        <option @if ($services->maritial_status == 'Divorced') selected @endif
                                                            value="Divorced">Divorced
                                                        </option>
                                                        <option @if ($services->maritial_status == 'Divorced') selected @endif
                                                            value="Divorced">Divorced
                                                        </option>
                                                        <option @if ($services->maritial_status == 'Divorced') selected @endif
                                                            value="Divorced">Divorced
                                                        </option>
                                                        <option @if ($services->maritial_status == 'Divorced') selected @endif
                                                            value="Divorced">Divorced
                                                        </option>
                                                    </select>
                                                    <label style="color:#23e156" for="education"
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
                                                            value="Others">
                                                            Others
                                                        </option>

                                                    </select>

                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar_card != '')
                                                            <label style="color:#23e156">Aadhaar Card(Front & Back)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label style="color:#23e156">Aadhaar Card(Front & Back)</label>
                                                        <input @if ($services->aadhaar_card == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar_card">
                                                        @if ($services->aadhaar_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->smart_card != '')
                                                            <label style="color:#23e156">Smart Card</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label style="color:#23e156">Smart Card</label>
                                                        <input @if ($services->smart_card == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="smart_card">
                                                        @if ($services->smart_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                    <label style="color:#23e156" for="street_name"
                                                        class="form-label">Street
                                                        Name</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->street_name }}"
                                                        class="form-control" name="street_name" maxlength="50"
                                                        placeholder="Street Name" />

                                                    <label style="color:#23e156" for="postal_area_english"
                                                        class="form-label">Postal Area</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->postal_area_english }}"
                                                        class="form-control" name="postal_area_english" maxlength="50"
                                                        placeholder="Postal Area" />
                                                    <label style="color:#23e156" for="vao_area" class="form-label">கிராம
                                                        நிர்வாக
                                                        பகுதி</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->vao_area }}"
                                                        class="form-control" name="vao_area" maxlength="50"
                                                        placeholder="கிராம நிர்வாக பகுதி" />

                                                </div>
                                            @elseif ($serviceid == 62)
                                                <div class="mb-3 col-md-6">
                                                    <label for="dist_id" class="form-label">District</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        name="dist_id" id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option @if ($d->id == $services->dist_id) selected @endif
                                                                value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <label class="form-label">Name</label>
                                                    <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        id="select_name" name="select_name" class="form-control">
                                                        <option value="">Select Name</option>
                                                        <option @if ($services->select_name == 'Name In Tamil') selected @endif
                                                            value="Name In Tamil">பெயர் தமிழில்</option>
                                                        <option @if ($services->select_name == 'Name In English') selected @endif
                                                            value="Name In English">Name In English</option>
                                                        <option @if ($services->select_name == 'Tamil And English Name') selected @endif
                                                            value="Tamil And English Name">Tamil & English Name</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6">

                                                    {{-- @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar_card != '')
                                                            <label>Aadhaar Card (Front)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Aadhaar Card (Front)</label>
                                                        <input @if ($services->aadhaar_card == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar_card">
                                                        @if ($services->aadhaar_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                        @endif
                                                    @endif --}}
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="name_tamilhide" style="display: none;">
                                                    <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->name_tamil }}"
                                                        class="form-control" name="name_tamil" maxlength="100"
                                                        placeholder="பெயர் தமிழில்" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="name_englishhide" style="display: none;">
                                                    <label for="name_english" class="form-label">Name In English</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->name_english }}"
                                                        class="form-control" name="name_english" maxlength="100"
                                                        placeholder="Name In English" />
                                                </div>
                                            @elseif ($serviceid == 63)
                                                <div class="mb-3 col-md-6">
                                                    <label for="dist_id" class="form-label">District</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        name="dist_id" id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option @if ($d->id == $services->dist_id) selected @endif
                                                                value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <label for="original_dob" class="form-label">DOB [05041997]</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->original_dob }}"
                                                        class="form-control" name="original_dob" maxlength="8"
                                                        placeholder="ddmmyyyy" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />
                                                    {{-- @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar_card != '')
                                                            <label>Aadhaar Card (Front)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Aadhaar Card (Front)</label>
                                                        <input @if ($services->aadhaar_card == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar_card">
                                                        @if ($services->aadhaar_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                        @endif
                                                    @endif --}}


                                                </div>
                                            @elseif ($serviceid == 64)
                                                <div class="mb-3 col-md-6">
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />
                                                    <label for="new_mobile_no" class="form-label">New mobile
                                                        Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->new_mobile_no }}"
                                                        class="form-control" name="new_mobile_no" maxlength="10"
                                                        placeholder="New mobile Number" />
                                                </div>
                                            @elseif ($serviceid == 66)
                                                <div class="mb-3 col-md-6">
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="aadhaar_number" class="form-label">Aadhaar Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->aadhaar_number }}"
                                                        class="form-control number" name="aadhaar_number" maxlength="12"
                                                        placeholder="Aadhaar Number" />
                                                </div>
                                                <div class="mb-3 col-md-6">

                                        @if (Auth::user()->id != $apply_user_id)
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
                                            @elseif ($serviceid == 121)
                                                <div class="mb-3 col-md-6">
                                                    <label for="aadhaar_number" class="form-label">Aadhaar Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->aadhaar_number }}"
                                                        class="form-control number" name="aadhaar_number" maxlength="12"
                                                        placeholder="Aadhaar Number" />
                                                </div>
                                                {{-- <div class="mb-3 col-md-6">
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                            value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                            maxlength="10" placeholder="Mobile Number" />
                                    </div> --}}
                                            @endif


                                            @if (Auth::user()->id != $apply_user_id)
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


                                                <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                                    <label for="application_no" class="form-label">Application No</label>
                                                    <input value="{{ $services->application_no }}" class="form-control"
                                                        type="text" maxlength="20" name="application_no"
                                                        id="application_no" />
                                                </div>

                                                <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                                    <label for="application" class="form-label">Application</label>
                                                    <input value="{{ $services->application }}" class="form-control"
                                                        type="text" maxlength="150" name="application"
                                                        id="application" />
                                                </div>
                                                 <div class="mb-3 col-md-6" id="cusnamehide" style="display :none;">
                                            <label for="cusname" class="form-label">Name</label>
                                            <input class="form-control" type="text" maxlength="100" placeholder="CusName" name="cusname"
                                                id="cusname" />
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
                                                <button id="save" type="submit" class="btn btn-primary me-2">Submit</button>
                                            @endif
                                        </div>
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
                $(function() {
                    var status = "{{ $services->status }}";
                    var dist_id = "{{ $services->dist_id }}";
                    var taluk_id = "{{ $services->taluk_id }}";
                    var select_name = "{{ $services->select_name }}";

                    gettaluk(dist_id);
                    getpanchayath(taluk_id);

                    if (status == "Resubmit") {
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", true);
                    } else if (status == "Processing") {
                        $('#applicationnohide').show("slow");
                        $('#application_no').prop("required", true);
                    } else if (status == "Approved") {
                        $('#applicationhide').show("slow");
                        $('#cusnamehide').show("slow");
                        $('#application').prop("required", true);
                        $('#cusname').prop("required", true);

                    }

                    if (select_name == "Name In Tamil") {
                        $('#name_tamilhide').show("slow");
                    } else if (select_name == "Name In English") {
                        $('#name_englishhide').show("slow");
                    } else if (select_name == "Tamil And English Name") {
                        $('#name_tamilhide').show("slow");
                        $('#name_englishhide').show("slow");
                    }

                });

                $('#service_status').change(function() {
                    if ($('#service_status').val() == 'Resubmit') {
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#applicationhide').hide("slow");
                        $('#cusnamehide').hide("slow");
                        $('#application').prop("required", false);
                        $('#cusname').prop("required", false);
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", true);
                    } else if ($('#service_status').val() == 'Processing') {
                        // $('#acknowledgementhide').show("slow");
                        // $('#acknowledgement').prop("required", true);
                        $('#remarkshide').hide("slow");
                        $('#remarks').prop("required", false);
                        $('#applicationhide').hide("slow");
                        $('#cusnamehide').hide("slow");
                        $('#application').prop("required", false);
                        $('#cusname').prop("required", false);
                        $('#applicationnohide').show("slow");
                        $('#application_no').prop("required", true);
                    } else if ($('#service_status').val() == 'Approved') {
                        $('#remarkshide').hide("slow");
                        $('#remarks').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#applicationhide').show("slow");
                        $('#cusnamehide').show("slow");
                        $('#application').prop("required", true);
                        $('#cusname').prop("required", true);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                    } else {
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#applicationhide').hide("slow");
                        $('#cusnamehide').hide("slow");
                        $('#application').prop("required", false);
                        $('#cusname').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
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

                $('#select_name').change(function() {

                    if ($('#select_name').val() == 'Name In Tamil') {
                        $('#name_tamilhide').show("slow");
                        $('#name_englishhide').hide("slow");
                        $('#birth_certificate').prop("required", false);
                        $('#name_tamil').prop("required", true);

                    } else if ($('#select_name').val() == 'Name In English') {
                        $('#name_englishhide').show("slow");
                        $('#name_tamilhide').hide("slow");
                        $('#name_tamil').prop("required", false);
                        $('#name_english').prop("required", true);

                    } else if ($('#select_name').val() == 'Tamil And English Name') {
                        $('#name_englishhide').show("slow");
                        $('#name_tamilhide').show("slow");
                        $('#name_tamil').prop("required", true);
                        $('#name_english').prop("required", true);

                    } else {
                        $('#name_tamilhide').hide("slow");
                        $('#name_englishhide').hide("slow");
                        $('#name_tamil').prop("required", false);
                        $('#name_english').prop("required", false);

                    }
                });
            
        document.getElementById("myForm").addEventListener("submit", function() {
        const btn = document.getElementById("save");
        btn.disabled = true;               
        btn.innerText = "Submitting...";  
        });
    </script>
        @endpush
