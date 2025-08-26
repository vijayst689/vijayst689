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
                         <form action="{{ url('/voterid_update') }}" id="formAccountSettings" method="POST"
                                enctype="multipart/form-data">
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

                                    @if ($serviceid == 113)
                                        <div class="col-md-12">
                                            <div class=row>
                                                <div class="mb-3 col-md-4">
                                                    <label for="dist_id" class="form-label">District</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="dist_id"
                                                        id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option @if ($d->id == $services->dist_id) selected @endif
                                                                value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="taluk_id" class="form-label">Taluk</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        name="taluk_id" id="taluk" class="form-control">
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="constituent_assembly" class="form-label">Constituent
                                                        Assembly</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->constituent_assembly }}"
                                                        class="form-control" name="constituent_assembly" maxlength="100"
                                                        placeholder="Constituent Assembly" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_in_english" class="form-label">Name in English</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->name_in_english }}" class="form-control"
                                                name="name_in_english" maxlength="100" placeholder="Name in English" />

                                            <label class="form-label">தந்தை அல்லது கணவர்</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                id="select_relationship" name="select_relationship" class="form-control">
                                                <option value="">Select தந்தை அல்லது கணவர்</option>
                                                <option @if ($services->select_relationship == 'தந்தை பெயர்') selected @endif
                                                    value="தந்தை பெயர்">தந்தை பெயர்</option>
                                                <option @if ($services->select_relationship == 'கணவர் பெயர்') selected @endif
                                                    value="கணவர் பெயர்">கணவர் பெயர்</option>
                                            </select>

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->photo != '')
                                                    <label>Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Photo</label>
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif

                                            <label for="door_no" class="form-label">Door No</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->door_no }}" class="form-control"
                                                name="door_no" maxlength="30" placeholder="Door No" />

                                            <label for="street_name_english" class="form-label">Street Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->street_name_english }}"
                                                class="form-control" name="street_name_english" maxlength="100"
                                                placeholder="Street Name" />

                                            <label for="postal_area_english" class="form-label">Postal Area</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->postal_area_english }}"
                                                class="form-control" name="postal_area_english" maxlength="100"
                                                placeholder="Postal Area" />

                                            <label for="voterid_no" class="form-label">குடும்ப உறுப்பினர்
                                                வாக்காளர் அடையாள அட்டை எண்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->voterid_no }}" class="form-control"
                                                name="voterid_no" maxlength="10" placeholder="அடையாள அட்டை எண்" />

                                            <label for="mobile" class="form-label">வாக்காளர் அட்டை பதிவு
                                                செய்ய வாடிக்கையாளர்களுக்கு
                                                OTP வரும் அதனை கேட்டால் தகவல் தரும்படி வாடிக்கையாளரிடம்
                                                தெரிவிக்கவும்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->mobile }}"
                                                class="form-control number" name="mobile" maxlength="10"
                                                placeholder="Mobile Number" />

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_in_tamil" class="form-label">Name in Tamil</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_in_tamil }}"
                                                class="form-control" name="name_in_tamil" maxlength="100"
                                                placeholder="Name in English" />

                                            <div class="mb-3 col-md-6" id="father_name_tamilhide" style="display: none;">
                                                <label for="father_name_tamil" class="form-label">தந்தை பெயர்
                                                    தமிழில்</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                    value="{{ $services->father_name_tamil }}" class="form-control"
                                                    name="father_name_tamil" maxlength="100"
                                                    placeholder="தந்தை பெயர் தமிழில்" />
                                                <label for="father_name_englishhide" class="form-label">Father Name In
                                                    English</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                    value="{{ $services->father_name_english }}" class="form-control"
                                                    name="father_name_english" maxlength="100"
                                                    placeholder="Father Name In English" />
                                            </div>
                                            <div class="mb-3 col-md-6" id="husband_name_tamilhide"
                                                style="display: none;">
                                                <label for="husband_name_tamil" class="form-label">கணவர் பெயர்
                                                    தமிழில்</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                    value="{{ $services->husband_name_tamil }}" class="form-control"
                                                    name="husband_name_tamil" maxlength="100"
                                                    placeholder="கணவர் பெயர் தமிழில்" />
                                                <label for="husband_name_englishhide" class="form-label">Husband Name In
                                                    English</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                    value="{{ $services->husband_name_english }}" class="form-control"
                                                    name="husband_name_english" maxlength="100"
                                                    placeholder="Husband Name In English" />
                                            </div>

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif

                                            <label for="pin_code" class="form-label">Pin Code</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->pin_code }}" class="form-control"
                                                name="pin_code" maxlength="10" placeholder="Pin Code" />

                                            <label for="street_name_tamil" class="form-label">தெரு பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->street_name_tamil }}"
                                                class="form-control" name="street_name_tamil" maxlength="100"
                                                placeholder="தெரு பெயர்" />

                                            <label for="postal_area_tamil" class="form-label">அஞ்சல் பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->postal_area_tamil }}"
                                                class="form-control" name="postal_area_tamil" maxlength="100"
                                                placeholder="அஞ்சல் பெயர்" />

                                            <label for="relationship" class="form-label">Relationship</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                class="form-control" name="relationship">
                                                <option value="">Select</option>
                                                <option @if ($services->relationship == 'Father') selected @endif value="Father">
                                                    Father.
                                                </option>
                                                <option @if ($services->relationship == 'Mother') selected @endif value="Mother">
                                                    Mother.
                                                </option>
                                                <option @if ($services->relationship == 'Husband') selected @endif
                                                    value="Husband">Husband.
                                                </option>
                                                <option @if ($services->relationship == 'Wife') selected @endif value="Wife">
                                                    Wife.
                                                </option>
                                            </select>
                                        </div>
                                        {{-- @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->voter_id != '')
                                                    <label>Relative Voter Id</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/voter_id/{{ $services->voter_id }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Relative Voter Id</label>
                                                <input @if ($services->voter_id == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="voter_id">
                                                @if ($services->voter_id != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/voter_id/{{ $services->voter_id }}">Download</a><br>
                                                @endif
                                            @endif --}}
                                    @elseif ($serviceid == 120)
                                        <div class="col-md-12">
                                            <div class=row>
                                                <div class="mb-3 col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input @if ($services->within_assembly == 1) checked @endif
                                                            class="form-check-input" type="radio"
                                                            name="within_assembly" id="within_assembly" value="1" />
                                                        <label class="form-check-label" for="within_assembly">Within
                                                            Assembly Constituency</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input @if ($services->within_assembly == 2) checked @endif
                                                            class="form-check-input" type="radio"
                                                            name="within_assembly" id="outside_assembly"
                                                            value="2" />
                                                        <label class="form-check-label" for="outside_assembly">Outside
                                                            Assembly Constituency</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row" id="assembly" style="display:none;">
                                                <div class="mb-3 col-md-6">
                                                    <label for="epic_no" class="form-label">Epic No</label>
                                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        type="text" value="{{ $services->epic_no }}"
                                                        class="form-control req" name="epic_no" maxlength="15"
                                                        placeholder="Epic No" />

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

                                                    <label for="street_name"
                                                        class="form-label">Street/Area/Locality/Road</label>
                                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        type="text" value="{{ $services->street_name }}"
                                                        class="form-control" name="street_name" maxlength="200"
                                                        placeholder="Street/Area/Locality/Road" />

                                                    <label for="post_office" class="form-label">Post Office</label>
                                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        type="text" value="{{ $services->post_office }}"
                                                        class="form-control" name="post_office" maxlength="200"
                                                        placeholder="Post Office" />

                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar_card != '')
                                                            <label>Aadhar Card</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Aadhar Card</label>
                                                        <input @if ($services->aadhaar_card == '') required @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar_card">
                                                        @if ($services->aadhaar_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="apartment_no" class="form-label">House/Building/Apartment
                                                        No</label>
                                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        type="text" value="{{ $services->apartment_no }}"
                                                        class="form-control" name="apartment_no" maxlength="20"
                                                        placeholder="House/Building/Apartment No" />

                                                    <label for="taluqa_mandal"
                                                        class="form-label">Tehsil/Taluqa/Mandal</label>
                                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        type="text" value="{{ $services->taluqa_mandal }}"
                                                        class="form-control" name="taluqa_mandal" maxlength="200"
                                                        placeholder="Tehsil/Taluqa/Mandal" />

                                                    <label for="town_village" class="form-label">Town/Village</label>
                                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        type="text" value="{{ $services->town_village }}"
                                                        class="form-control" name="town_village" maxlength="200"
                                                        placeholder="Town/Village" />

                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                        type="text" value="{{ $services->pin_code }}"
                                                        class="form-control" name="pin_code" maxlength="6"
                                                        placeholder="Town/Village" />
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="assembly1" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label">Epic No</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->epic_no }}"
                                                class="form-control req1" name="epic_no" maxlength="15"
                                                placeholder="Epic No" />

                                            <label for="apartment_no" class="form-label">House/Building/Apartment
                                                No</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->apartment_no }}"
                                                class="form-control" name="apartment_no" maxlength="20"
                                                placeholder="House/Building/Apartment No" />

                                            <label for="dist_id" class="form-label">District</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $services->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <label for="post_office" class="form-label">Post Office</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->post_office }}" class="form-control"
                                                name="post_office" maxlength="200" placeholder="Post Office" />

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhar Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhar Card</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_assembly_constituency" class="form-label">Name Of Assembly
                                                Constituency</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->name_assembly_constituency }}"
                                                class="form-control" name="name_assembly_constituency" maxlength="200"
                                                placeholder="Name Of Assembly Constituency" />

                                            <label for="street_name" class="form-label">Street/Area/Locality/Road</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->street_name }}" class="form-control"
                                                name="street_name" maxlength="200"
                                                placeholder="Street/Area/Locality/Road" />

                                            <label for="taluqa_mandal" class="form-label">Tehsil/Taluqa/Mandal</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->taluqa_mandal }}"
                                                class="form-control" name="taluqa_mandal" maxlength="200"
                                                placeholder="Tehsil/Taluqa/Mandal" />

                                            <label for="town_village" class="form-label">Town/Village</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->town_village }}"
                                                class="form-control" name="town_village" maxlength="200"
                                                placeholder="Town/Village" />

                                            <label for="pin_code" class="form-label">Pin Code</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->pin_code }}" class="form-control"
                                                name="pin_code" maxlength="6" placeholder="Town/Village" />

                                        </div>
                                    </div>
                                </div>
                            @elseif ($serviceid == 164)
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="epic_no" class="form-label">Epic No</label>
                                        <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                            value="{{ $services->epic_no }}" class="form-control" name="epic_no"
                                            maxlength="15" placeholder="Epic No" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        @if (Auth::user()->id != $apply_user_id)
                                            @if ($services->document != '')
                                                <label>Document</label>
                                                <br><a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/document/{{ $services->document }}"
                                                    class="btn btn-primary me-2">View</a><br>
                                            @endif
                                        @else
                                            <label>Document</label>
                                            <input @if ($services->document == '') required @endif class="form-control"
                                                type="file" accept="image/jpeg, image/png" name="document">
                                            @if ($services->document != '')
                                                <a target="_blank"
                                                    href="{{ URL::to('/') }}/upload/services/document/{{ $services->document }}">Download</a><br>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="name_correction" value="1"
                                                {{ in_array('1', $selectedCorrections) ? 'checked' : '' }}
                                                @if (Auth::user()->id != $apply_user_id && !in_array('1', $selectedCorrections)) disabled @endif>
                                            <label class="form-check-label" for="name_correction">Name
                                                Correction</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="gender_correction" value="2"
                                                {{ in_array('2', $selectedCorrections) ? 'checked' : '' }}
                                                @if (Auth::user()->id != $apply_user_id && !in_array('2', $selectedCorrections)) disabled @endif>
                                            <label class="form-check-label" for="gender_correction">Gender</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="dob_correction" value="3"
                                                {{ in_array('3', $selectedCorrections) ? 'checked' : '' }}
                                                @if (Auth::user()->id != $apply_user_id && !in_array('3', $selectedCorrections)) disabled @endif>
                                            <label class="form-check-label" for="dob_correction">DOB/Age</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="relation_type_correction" value="4"
                                                {{ in_array('4', $selectedCorrections) ? 'checked' : '' }}
                                                @if (Auth::user()->id != $apply_user_id && !in_array('4', $selectedCorrections)) disabled @endif>
                                            <label class="form-check-label" for="relation_type_correction">Relation
                                                Type</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="relative_name_correction" value="5"
                                                {{ in_array('5', $selectedCorrections) ? 'checked' : '' }}
                                                @if (Auth::user()->id != $apply_user_id && !in_array('5', $selectedCorrections)) disabled @endif>
                                            <label class="form-check-label" for="relative_name_correction">Relative's
                                                Name</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="mobile_correction" value="6"
                                                {{ in_array('6', $selectedCorrections) ? 'checked' : '' }}
                                                @if (Auth::user()->id != $apply_user_id && !in_array('6', $selectedCorrections)) disabled @endif>
                                            <label class="form-check-label" for="mobile_correction">Mobile
                                                Number</label>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="photo_correction" value="7"
                                                {{ in_array('7', $selectedCorrections) ? 'checked' : '' }}
                                                @if (Auth::user()->id != $apply_user_id && !in_array('7', $selectedCorrections)) disabled @endif>
                                            <label class="form-check-label" for="photo_correction">Photo</label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="voterid_correction" style="display:none;">
                                <div class="mb-3 col-md-6">
                                    <label for="name_tamil" class="form-label">Name in Tamil</label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                        value="{{ $services->name_tamil }}" class="form-control crt"
                                        name="name_tamil" maxlength="100" placeholder="Name in Tamil" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="name_english" class="form-label">Name in English</label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                        value="{{ $services->name_english }}" class="form-control crt"
                                        name="name_english" maxlength="100" placeholder="Name in English" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="voterid_correction1" style="display:none;">
                                <div class="mb-3 col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control crt1"
                                        name="gender">
                                        <option value="">Select Gender</option>
                                        <option @if ($services->gender == 'Male') selected @endif value="Male">
                                            Male
                                        </option>
                                        <option @if ($services->gender == 'Female') selected @endif value="Female">
                                            Female
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="voterid_correction2" style="display:none;">
                                <div class="mb-3 col-md-6">
                                    <label for="dob" class="form-label">DOB</label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="date"
                                        maxlength="10" class="form-control crt2" value="{{ $services->dob }}"
                                        name="dob" placeholder="DOB" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id)
                                        @if ($services->age_proof != '')
                                            <label>Age Proof</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/age_proof/{{ $services->age_proof }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Age Proof</label>
                                        <input @if ($services->age_proof == '')  @endif class="form-control crt2"
                                            type="file" accept="image/jpeg, image/png" name="age_proof">
                                        @if ($services->age_proof != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/age_proof/{{ $services->age_proof }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="voterid_correction3" style="display:none;">
                                <div class="mb-3 col-md-6">
                                    <label for="relation" class="form-label">Relation</label>
                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control crt3"
                                        name="relation">
                                        <option value="">Select Relation</option>
                                        <option @if ($services->relation == 'Father') selected @endif value="Father">
                                            Father</option>
                                        <option @if ($services->relation == 'Mother') selected @endif value="Mother">
                                            Mother</option>
                                        <option @if ($services->relation == 'Husband') selected @endif value="Husband">Husband
                                        </option>
                                        <option @if ($services->relation == 'Wife') selected @endif value="Wife">
                                            Wife</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="voterid_correction4" style="display:none;">
                                <div class="mb-3 col-md-6">
                                    <label for="name_in_tamil" class="form-label">Name in Tamil</label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                        value="{{ $services->name_in_tamil }}" class="form-control crt4"
                                        name="name_in_tamil" maxlength="100" placeholder="Name in Tamil" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="name_in_english" class="form-label">Name in English</label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                        value="{{ $services->name_in_english }}" class="form-control crt4"
                                        name="name_in_english" maxlength="100" placeholder="Name in English" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="voterid_correction5" style="display:none;">
                                <div class="mb-3 col-md-6">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                        value="{{ $services->mobile }}" class="form-control number crt5" name="mobile"
                                        maxlength="10" placeholder="Mobile Number" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="voterid_correction6" style="display:none;">
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id)
                                        @if ($services->photo != '')
                                            <label>Photo</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Photo</label>
                                        <input @if ($services->photo == '')  @endif class="form-control crt6"
                                            type="file" accept="image/jpeg, image/png" name="photo">
                                        @if ($services->photo != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif ($serviceid == 182)
                        <div class="col-md-12">
                            <h4 class="text-center">Application for Marking Person with Disability</h4>
                            <div class=row>
                                <div class="mb-8 col-md-3">
                                    <div class="form-check form-check-inline">
                                        <input @if ($services->disability == 1) checked @endif class="form-check-input"
                                            type="radio" name="disability" id="locomotive" value="1" />
                                        <label class="form-check-label" for="locomotive">Locomotive</label>
                                    </div>
                                </div>
                                <div class="mb-8 col-md-3">
                                    <div class="form-check form-check-inline">
                                        <input @if ($services->disability == 2) checked @endif class="form-check-input"
                                            type="radio" name="disability" id="visual" value="2" />
                                        <label class="form-check-label" for="visual">Visual</label>
                                    </div>
                                </div>
                                <div class="mb-8 col-md-3">
                                    <div class="form-check form-check-inline">
                                        <input @if ($services->disability == 3) checked @endif class="form-check-input"
                                            type="radio" name="disability" id="deaf_dumb" value="3" />
                                        <label class="form-check-label" for="deaf_dumb">Deaf & Dumb</label>
                                    </div>
                                </div>
                                <div class="mb-8 col-md-3">
                                    <div class="form-check form-check-inline">
                                        <input @if ($services->disability == 4) checked @endif class="form-check-input"
                                            type="radio" name="disability" id="description" value="4" />
                                        <label class="form-check-label" for="description">If Any Other(Give
                                            Description)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" id="person_with_disability" style="display:none;">
                                <div class="mb-3 col-md-6">
                                    <label for="locomotive_percentage" class="form-label">Percentage of
                                        Disability</label>
                                    <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                        value="{{ $services->locomotive_percentage }}" class="form-control re"
                                        name="locomotive_percentage" maxlength="6"
                                        placeholder="Percentage of Disability" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id)
                                        @if ($services->locomotive_certificate != '')
                                            <label>Certificate Upload</label>
                                            <br><a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/locomotive_certificate/{{ $services->locomotive_certificate }}"
                                                class="btn btn-primary me-2">View</a><br>
                                        @endif
                                    @else
                                        <label>Certificate Upload</label>
                                        <input @if ($services->locomotive_certificate == '') required @endif class="form-control re"
                                            type="file" accept="image/jpeg, image/png" name="locomotive_certificate">
                                        @if ($services->locomotive_certificate != '')
                                            <a target="_blank"
                                                href="{{ URL::to('/') }}/upload/services/locomotive_certificate/{{ $services->locomotive_certificate }}">Download</a><br>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="person_with_disability1" style="display:none;">
                            <div class="mb-3 col-md-6">
                                <label for="visual_percentage" class="form-label">Percentage of Disability</label>
                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                    value="{{ $services->visual_percentage }}" class="form-control re1"
                                    name="visual_percentage" maxlength="6" placeholder="Percentage of Disability" />


                            </div>
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id)
                                    @if ($services->visual_certificate != '')
                                        <label>Certificate Upload</label>
                                        <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/visual_certificate/{{ $services->visual_certificate }}"
                                            class="btn btn-primary me-2">View</a><br>
                                    @endif
                                @else
                                    <label>Certificate Upload</label>
                                    <input @if ($services->visual_certificate == '') required @endif class="form-control re1"
                                        type="file" accept="image/jpeg, image/png" name="visual_certificate">
                                    @if ($services->visual_certificate != '')
                                        <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/visual_certificate/{{ $services->visual_certificate }}">Download</a><br>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="person_with_disability2" style="display:none;">
                            <div class="mb-3 col-md-6">
                                <label for="dumb_percentage" class="form-label">Percentage of Disability</label>
                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                    value="{{ $services->dumb_percentage }}" class="form-control re2"
                                    name="dumb_percentage" maxlength="6" placeholder="Percentage of Disability" />


                            </div>
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id)
                                    @if ($services->dumb_certificate != '')
                                        <label>Certificate Upload</label>
                                        <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/dumb_certificate/{{ $services->dumb_certificate }}"
                                            class="btn btn-primary me-2">View</a><br>
                                    @endif
                                @else
                                    <label>Certificate Upload</label>
                                    <input @if ($services->dumb_certificate == '') required @endif class="form-control re2"
                                        type="file" accept="image/jpeg, image/png" name="dumb_certificate">
                                    @if ($services->dumb_certificate != '')
                                        <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/dumb_certificate/{{ $services->dumb_certificate }}">Download</a><br>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="person_with_disability3" style="display:none;">
                            <div class="mb-3 col-md-6">
                                <label for="other_percentage" class="form-label">Percentage of Disability</label>
                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                    value="{{ $services->other_percentage }}" class="form-control re3"
                                    name="other_percentage" maxlength="6" placeholder="Percentage of Disability" />


                            </div>
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id)
                                    @if ($services->other_certificate != '')
                                        <label>Certificate Upload</label>
                                        <br><a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/other_certificate/{{ $services->other_certificate }}"
                                            class="btn btn-primary me-2">View</a><br>
                                    @endif
                                @else
                                    <label>Certificate Upload</label>
                                    <input @if ($services->other_certificate == '') required @endif class="form-control re3"
                                        type="file" accept="image/jpeg, image/png" name="other_certificate">
                                    @if ($services->other_certificate != '')
                                        <a target="_blank"
                                            href="{{ URL::to('/') }}/upload/services/other_certificate/{{ $services->other_certificate }}">Download</a><br>
                                    @endif
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                    value="{{ $services->description }}" class="form-control re3" name="description"
                                    maxlength="100" placeholder="Description" />
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (Auth::user()->id != $apply_user_id)
                        <div class="mb-3 col-md-6">
                            <label for="service_name" class="form-label">Service Status</label>
                            <select class="form-control" name="status" id="service_status">
                                <option value="">Select</option>
                                <option @if ($services->status == 'Pending') selected @endif value="Pending">
                                    Pending</option>
                                <option @if ($services->status == 'Resubmit') selected @endif value="Resubmit">
                                    Resubmit</option>
                                <option @if ($services->status == 'Processing') selected @endif value="Processing">
                                    Processing</option>
                                @if ($services->status != 'Approved')
                                    <option @if ($services->status == 'Rejected') selected @endif value="Rejected">
                                        Rejected</option>
                                @endif
                                <option @if ($services->status == 'Approved') selected @endif value="Approved">
                                    Approved</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                            <label for="remarks" class="form-label">Remarks</label>
                            <input value="{{ $services->remarks }}" class="form-control" type="text" name="remarks"
                                maxlength="100" id="remarks" placeholder="Remarks" />
                        </div>

                        <div class="mb-3 col-md-6" id="acknowledgementhide" style="display :none;">
                            <label for="acknowledgement" class="form-label">Acknowledgement</label>
                            <input class="form-control" type="file" name="acknowledgement" id="acknowledgement" />
                        </div>
                        <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                            <label for="application_no" class="form-label">Application No</label>
                            <input value="{{ $services->application_no }}" class="form-control" type="text"
                                maxlength="20" name="application_no" id="application_no" />
                        </div>

                        <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                            <label for="application" class="form-label">Application</label>
                            <input value="{{ $services->application }}" class="form-control" type="text"
                                maxlength="150" name="application" id="application" />
                        </div>
                    @else
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="service_name" class="form-label">Service Status</label>
                                <input disabled value="{{ $services->status }}" class="form-control" type="text" />
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
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var dist_id = "{{ $services->dist_id }}";
            var taluk_id = "{{ $services->taluk_id }}";
            var within = "{{ $services->within_assembly }}";
            var dis = "{{ $services->disability }}";
            var correction = "{{ $services->correction }}";
            var select_relationship = "{{ $services->select_relationship }}";

            if (select_relationship == "தந்தை") {
                $('#father_namehide').show("slow");
            } else if (select_relationship == "கணவர்") {
                $('#husband_namehide').show("slow");
            }

            if (within == 1) {
                $("#assembly").show().find('.req').attr('required', true);
                $("#assembly1").hide().find('.req1').removeAttr('required');
            } else {
                $("#assembly").hide().find('.req').removeAttr('required');
                $("#assembly1").show().find('.req1').attr('required', true);
            }

            if (dis == 1) {
                $("#person_with_disability").show().find('.re').attr('required', true);
                $("#person_with_disability1").hide().find('.re1').removeAttr('required');
                $("#person_with_disability2").hide().find('.re2').removeAttr('required');
                $("#person_with_disability3").hide().find('.re3').removeAttr('required');
            } else if (dis == 2) {
                $("#person_with_disability1").show().find('.re1').attr('required', true);
                $("#person_with_disability").hide().find('.re').removeAttr('required');
                $("#person_with_disability2").hide().find('.re2').removeAttr('required');
                $("#person_with_disability3").hide().find('.re3').removeAttr('required');
            } else if (dis == 3) {
                $("#person_with_disability2").show().find('.re2').attr('required', true);
                $("#person_with_disability1").hide().find('.re1').removeAttr('required');
                $("#person_with_disability").hide().find('.re').removeAttr('required');
                $("#person_with_disability3").hide().find('.re3').removeAttr('required');
            } else if (dis == 4) {
                $("#person_with_disability3").show().find('.re3').attr('required', true);
                $("#person_with_disability1").hide().find('.re1').removeAttr('required');
                $("#person_with_disability2").hide().find('.re2').removeAttr('required');
                $("#person_with_disability").hide().find('.re').removeAttr('required');
            }

            // if (correction == 1) {
            //     $("#voterid_correction").show().find('.crt').attr('required', true);
            //     $("#voterid_correction1").hide().find('.crt1').removeAttr('required');
            //     $("#voterid_correction2").hide().find('.crt2').removeAttr('required');
            //     $("#voterid_correction3").hide().find('.crt3').removeAttr('required');
            //     $("#voterid_correction4").hide().find('.crt4').removeAttr('required');
            //     $("#voterid_correction5").hide().find('.crt5').removeAttr('required');
            // } else if (correction == 2) {
            //     $("#voterid_correction1").show().find('.crt1').attr('required', true);
            //     $("#voterid_correction").hide().find('.crt').removeAttr('required');
            //     $("#voterid_correction2").hide().find('.crt2').removeAttr('required');
            //     $("#voterid_correction3").hide().find('.crt3').removeAttr('required');
            //     $("#voterid_correction4").hide().find('.crt4').removeAttr('required');
            //     $("#voterid_correction5").hide().find('.crt5').removeAttr('required');
            // } else if (correction == 3) {
            //     $("#voterid_correction2").show().find('.crt2').attr('required', true);
            //     $("#voterid_correction").hide().find('.crt').removeAttr('required');
            //     $("#voterid_correction1").hide().find('.crt1').removeAttr('required');
            //     $("#voterid_correction3").hide().find('.crt3').removeAttr('required');
            //     $("#voterid_correction4").hide().find('.crt4').removeAttr('required');
            //     $("#voterid_correction5").hide().find('.crt5').removeAttr('required');
            // } else if (correction == 4) {
            //     $("#voterid_correction3").show().find('.crt3').attr('required', true);
            //     $("#voterid_correction").hide().find('.crt').removeAttr('required');
            //     $("#voterid_correction1").hide().find('.crt1').removeAttr('required');
            //     $("#voterid_correction2").hide().find('.crt2').removeAttr('required');
            //     $("#voterid_correction4").hide().find('.crt4').removeAttr('required');
            //     $("#voterid_correction5").hide().find('.crt5').removeAttr('required');
            // } else if (correction == 5) {
            //     $("#voterid_correction4").show().find('.crt4').attr('required', true);
            //     $("#voterid_correction1").hide().find('.crt1').removeAttr('required');
            //     $("#voterid_correction2").hide().find('.crt2').removeAttr('required');
            //     $("#voterid_correction3").hide().find('.crt3').removeAttr('required');
            //     $("#voterid_correction").hide().find('.crt').removeAttr('required');
            //     $("#voterid_correction4").hide().find('.crt5').removeAttr('required');
            // } else if (correction == 6) {
            //     $("#voterid_correction5").show().find('.crt5').attr('required', true);
            //     $("#voterid_correction1").hide().find('.crt1').removeAttr('required');
            //     $("#voterid_correction2").hide().find('.crt2').removeAttr('required');
            //     $("#voterid_correction3").hide().find('.crt3').removeAttr('required');
            //     $("#voterid_correction4").hide().find('.crt4').removeAttr('required');
            //     $("#voterid_correction").hide().find('.crt').removeAttr('required');
            // }
            handleCorrectionSelection();

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
                $('#applicationhide').show("slow");
                $('#application').prop("required", true);
            }
        });

        function handleCorrectionSelection() {
            var selected = $('input[name="correction[]"]:checked').map(function() {
                return $(this).val();
            }).get();

            // Limit to 4 selections
            if (selected.length > 4) {
                alert("You can select only 4 corrections.");
                // Uncheck the last one
                $('input[name="correction[]"]:checked').last().prop("checked", false);
                selected.pop();
            }

            // Hide all sections first
            $('[id^="voterid_correction[]"]').hide().find("input").removeAttr("required");

            // Show only selected ones
            selected.forEach(function(val) {
                let targetId = (val == 1) ? "#voterid_correction" : "#voterid_correction" + (val - 1);
                let targetClass = ".crt" + ((val == 1) ? "" : (val - 1));

                $(targetId).show().find(targetClass).attr("required", true);
            });
        }

        // Run when checkboxes change
        $('input[name="correction"]').on("change", handleCorrectionSelection);




        $('#dist_id').change(function() {
            var dist_id = this.value;
            gettaluk(dist_id);
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
                $('#application').prop("required", false);
                $('#applicationhide').hide("slow");
            } else if ($('#service_status').val() == 'Processing') {
                $('#acknowledgementhide').show("slow");
                $('#acknowledgement').prop("required", true);
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#applicationnohide').show("slow");
                $('#application_no').prop("required", true);
                $('#application').prop("required", false);
                $('#applicationhide').hide("slow");
            } else if ($('#service_status').val() == 'Approved') {
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
                $('#application').prop("required", true);
                $('#applicationhide').show("slow");
            } else {
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", false);
                $('#acknowledgementhide').hide("slow");
                $('#acknowledgement').prop("required", false);
                $('#certhide').hide("slow");
                $('#certificate').prop("required", false);
                $('#applicationnohide').hide("slow");
                $('#application_no').prop("required", false);
                $('#application').prop("required", false);
                $('#applicationhide').hide("slow");
            }
        });

        $('input[name="within_assembly"]').change(function() {
            if ($(this).val() === "1") {
                $("#assembly").show();
                $("#assembly1").hide();
            } else if ($(this).val() === "2") {
                $("#assembly").hide();
                $("#assembly1").show();
            }
        });

        $('input[name="disability"]').change(function() {
            if ($(this).val() === "1") {
                $("#person_with_disability").show().find('.re').attr('required', true);;
                $("#person_with_disability1").hide().find('.re1').removeAttr('required');
                $("#person_with_disability2").hide().find('.re2').removeAttr('required');
                $("#person_with_disability3").hide().find('.re3').removeAttr('required');
            } else if ($(this).val() === "2") {
                $("#person_with_disability1").show().find('.re1').attr('required', true);;
                $("#person_with_disability").hide().find('.re').removeAttr('required');
                $("#person_with_disability2").hide().find('.re2').removeAttr('required');
                $("#person_with_disability3").hide().find('.re3').removeAttr('required');
            } else if ($(this).val() === "3") {
                $("#person_with_disability2").show().find('.re2').attr('required', true);;
                $("#person_with_disability").hide().find('.re').removeAttr('required');
                $("#person_with_disability1").hide().find('.re1').removeAttr('required');
                $("#person_with_disability3").hide().find('.re3').removeAttr('required');
            } else if ($(this).val() === "4") {
                $("#person_with_disability3").show().find('.re3').attr('required', true);;
                $("#person_with_disability").hide().find('.re1').removeAttr('required');
                $("#person_with_disability1").hide().find('.re2').removeAttr('required');
                $("#person_with_disability2").hide().find('.re').removeAttr('required');
            }
        });

        $('#select_relationship').change(function() {
            if ($('#select_relationship').val() == 'தந்தை') {
                $('#father_namehide').show("slow");
                $('#husband_namehide').hide("slow");
                $('#father_name').prop("required", true);

            } else if ($('#select_relationship').val() == 'கணவர்') {
                $('#husband_namehide').show("slow");
                $('#father_namehide').hide("slow");
                $('#father_name').prop("required", false);
                $('#husband_name').prop("required", true);

            } else {
                $('#father_namehide').hide("slow");
                $('#husband_namehide').hide("slow");
                $('#father_name').prop("required", false);
                $('#husband_name').prop("required", false);

            }
        });

        $('input[name="correction[]"]').change(function() {
            // Count checked checkboxes
            var checkedCount = $('input[name="correction[]"]:checked').length;

            if (checkedCount > 4) {
                // prevent selecting more than 4
                this.checked = false;
                alert("You can select only 4 options.");
                return;
            }

            // Hide all boxes and remove required
            $("#voterid_correction, #voterid_correction1, #voterid_correction2, #voterid_correction3, #voterid_correction4, #voterid_correction5, #voterid_correction6")
                .hide()
                .find("input")
                .removeAttr("required");

            // Show only selected ones
            $('input[name="correction[]"]:checked').each(function() {
                let val = $(this).val();

                if (val === "1") {
                    $("#voterid_correction").show().find(".crt").attr("required", true);
                } else if (val === "2") {
                    $("#voterid_correction1").show().find(".crt1").attr("required", true);
                } else if (val === "3") {
                    $("#voterid_correction2").show().find(".crt2").attr("required", true);
                } else if (val === "4") {
                    $("#voterid_correction3").show().find(".crt3").attr("required", true);
                } else if (val === "5") {
                    $("#voterid_correction4").show().find(".crt4").attr("required", true);
                } else if (val === "6") {
                    $("#voterid_correction5").show().find(".crt5").attr("required", true);
                } else if (val === "7") {
                    $("#voterid_correction6").show().find(".crt6").attr("required", true);
                }
            });
        });
    </script>
@endpush
