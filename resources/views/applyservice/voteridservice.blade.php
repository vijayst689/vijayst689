@extends('layouts.app')
@section('content')
    <style>
        /* Default radio border color */
        /* Default border color */
        .form-check-input {
            border-color: #dd1181;
            /* blue border */
        }

        /* Checked state */
        .form-check-input:checked {
            background-color: #dd1181;
            border-color: #dd1181;
        }

        /* Focus shadow */
        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(238, 4, 82, 0.25);
        }
    </style>
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
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submitvoterid') }}" enctype="multipart/form-data" onsubmit="return checkpayment(event)"
                                method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    @if ($serviceid == 113)
                                        <div class="col-md-12">
                                            <div class=row>
                                                <div class="mb-3 col-md-4">
                                                    <label for="dist_id" class="form-label text-info">District</label>
                                                    <select name="dist_id" id="dist_id" class="form-control">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option value="{{ $d->id }}">{{ $d->district_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="taluk_id" class="form-label text-info">Taluk</label>
                                                    <select name="taluk_id" id="taluk" class="form-control">
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-4">
                                                    <label for="constituent_assembly"
                                                        class="form-label text-info">Constituent Assembly</label>
                                                    <input required type="text" class="form-control" maxlength="100"
                                                        name="constituent_assembly" placeholder="Constituent Assembly" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_in_english" class="form-label text-info">Name in
                                                English</label>
                                            <input required type="text" class="form-control" maxlength="100"
                                                name="name_in_english" placeholder="Name in English" />

                                            <label for="select_relationship" class="form-label text-info">தந்தை அல்லது
                                                கணவர்</label>
                                            <select id="select_relationship" name="select_relationship"
                                                class="form-control">
                                                <option value="">Select தந்தை அல்லது கணவர்</option>
                                                <option value="தந்தை பெயர்">தந்தை பெயர்</option>
                                                <option value="கணவர் பெயர்">கணவர் பெயர்</option>
                                            </select>
                                            <label for="photo" class="form-label text-info">Photo</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="photo" />

                                            <label for="door_no" class="form-label text-info">Door No</label>
                                            <input required type="text" maxlength="20" class="form-control"
                                                name="door_no" placeholder="Door No" />

                                            <label for="street_name_english" class="form-label text-info">Street
                                                Name</label>
                                            <input required type="text" maxlength="500" class="form-control"
                                                name="street_name_english" placeholder="Street Name" />

                                            <label for="postal_area_english" class="form-label text-info">Postal
                                                Area</label>
                                            <input required type="text" maxlength="500" class="form-control"
                                                name="postal_area_english" placeholder="Postal Area" />

                                            <label for="voterid_no" class="form-label text-info">குடும்ப உறுப்பினர்
                                                வாக்காளர் அடையாள அட்டை எண்</label>
                                            <input required type="text" class="form-control" maxlength="10"
                                                name="voterid_no" placeholder="அடையாள அட்டை எண்" />

                                            <label for="mobile" class="form-label text-info">வாக்காளர் அட்டை பதிவு
                                                செய்ய வாடிக்கையாளர்களுக்கு
                                                OTP வரும் அதனை கேட்டால் தகவல் தரும்படி வாடிக்கையாளரிடம்
                                                தெரிவிக்கவும்</label>
                                            <input required type="text" class="form-control" maxlength="10"
                                                name="mobile" placeholder="Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_in_tamil" class="form-label text-info">Name in
                                                Tamil</label>
                                            <input required type="text" class="form-control" maxlength="100"
                                                name="name_in_tamil" placeholder="Name in Tamil" />

                                            <div class="" id="father_name_tamilhide" style="display: none;">
                                                <label for="father_name_tamil" class="form-label text-info">தந்தை பெயர்
                                                    தமிழில்</label>
                                                <input type="text" maxlength="100" class="form-control"
                                                    name="father_name_tamil" placeholder="தந்தை பெயர் தமிழில்" />
                                                <label for="father_name_englishhide" class="form-label text-info">Father
                                                    Name In English</label>
                                                <input type="text" maxlength="100" class="form-control"
                                                    name="father_name_english" placeholder="Father Name In English" />
                                            </div>
                                            <div class="" id="husband_name_tamilhide" style="display: none;">
                                                <label for="husband_name_tamil" class="form-label text-info">கணவர் பெயர்
                                                    தமிழில்</label>
                                                <input type="text" maxlength="100" class="form-control"
                                                    name="husband_name_tamil" placeholder="கணவர் பெயர் தமிழில்" />
                                                <label for="husband_name_englishhide" class="form-label text-info">Husband
                                                    Name In English</label>
                                                <input type="text" maxlength="100" class="form-control"
                                                    name="husband_name_english" placeholder="Husband Name In English" />
                                            </div>
                                            <label for="aadhaar_card" class="form-label text-info">Aadhaar Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_card" />

                                            <label for="pin_code" class="form-label text-info">Pin Code</label>
                                            <input required type="text" maxlength="6" class="form-control number"
                                                name="pin_code" placeholder="Pin Code" />

                                            <label for="street_name_tamil" class="form-label text-info">தெரு
                                                பெயர்</label>
                                            <input required type="text" maxlength="500" class="form-control"
                                                name="street_name_tamil" placeholder="தெரு பெயர்" />

                                            <label for="postal_area_tamil" class="form-label text-info">அஞ்சல்
                                                பெயர்</label>
                                            <input required type="text" maxlength="500" class="form-control"
                                                name="postal_area_tamil" placeholder="அஞ்சல் பெயர்" />

                                            <label for="relationship" class="form-label text-info">Relationship/Family
                                                Member</label>
                                            <select required type="text" class="form-control" name="relationship">
                                                <option value="">Select Relationship/Family Member</option>
                                                <option value="Father">Father</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Husband">Husband</option>
                                                <option value="Wife">Wife</option>
                                            </select>
                                            <label for="name_family_member" class="form-label text-info">Name Of The
                                                Family Member</label>
                                            <input required type="text" maxlength="500" class="form-control"
                                                name="name_family_member" placeholder="Name Of The Family Member" />
                                            <label for="aadhaar_no" class="form-label text-info">Aadhaar Number</label>
                                            <input required type="text" maxlength="12" class="form-control"
                                                name="aadhaar_no" placeholder="Aadhaar Number" />
                                        </div>
                                        {{-- <div class="mb-3 col-md-6">
                                            <label for="voter_id" class="form-label text-primary">Relative Voter Id</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control text-danger" name="voter_id" />
                                        </div> --}}
                                    @elseif ($serviceid == 120)
                                        <div class="col-md-12">
                                            <div class=row>
                                                <div class="mb-3 col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio"
                                                            name="within_assembly" id="within_assembly" value="1" />
                                                        <label class="form-check-label text-dark"
                                                            for="within_assembly">Within
                                                            Assembly Constituency</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio"
                                                            name="within_assembly" id="outside_assembly"
                                                            value="2" />
                                                        <label class="form-check-label text-dark"
                                                            for="outside_assembly">Outside
                                                            Assembly Constituency</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row" id="assembly" style="display:none;">
                                                <div class="mb-3 col-md-6">
                                                    <label for="epic_no" class="form-label text-danger-emphasis">Epic
                                                        Number</label>
                                                    <input type="text" class="form-control req" maxlength="15"
                                                        id="epic_no" name="epic_no" placeholder="Epic No" />

                                                    <label for="aadhaar_card"
                                                        class="form-label text-danger-emphasis">Adhaar Card</label>
                                                    <input type="file" class="form-control req" name="aadhaar_card"
                                                        placeholder="Adhaar card" />
                                                    <label for="apartment_no"
                                                        class="form-label text-danger-emphasis">House/Building/Apartment
                                                        No</label>
                                                    <input type="text" class="form-control req" maxlength="15"
                                                        name="apartment_no" id="apartment_no"
                                                        placeholder="House/Building/Apartment No" />
                                                    <label for="street_name"
                                                        class="form-label text-danger-emphasis">Street/Area/Locality/Road</label>
                                                    <input type="text" maxlength="500" class="form-control req"
                                                        name="street_name" id="street_name"
                                                        placeholder="Street/Area/Locality/Road" />
                                                    <label for="post_office" class="form-label text-danger-emphasis">Post
                                                        Office</label>
                                                    <input type="text" maxlength="200" class="form-control req"
                                                        name="post_office" id="post_office" placeholder="Post Office" />
                                                    <label for="dist_id"
                                                        class="form-label text-danger-emphasis">District</label>
                                                    <select name="dist_id" id="dist_id" class="form-control req">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                            <option value="{{ $d->id }}">
                                                                {{ $d->district_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="taluqa_mandal"
                                                        class="form-label text-danger-emphasis">Tehsil/Taluqa/Mandal</label>
                                                    <input type="text" maxlength="200" class="form-control req"
                                                        name="taluqa_mandal" id="taluqa_mandal"
                                                        placeholder="Tehsil/Taluqa/Mandal" />
                                                    <label for="town_village"
                                                        class="form-label text-danger-emphasis">Town/Village</label>
                                                    <input type="text" maxlength="200" class="form-control req"
                                                        name="town_village" id="town_village"
                                                        placeholder="Town/Village" />

                                                    {{-- <label for="apartment_no"
                                                        class="form-label">வீடு/கட்டிடம்/அபார்ட்மெண்ட் எண்</label>
                                                    <input type="text" class="form-control req" maxlength="15"
                                                        name="apartment_no" id="apartment_no"
                                                        placeholder="House/Building/Apartment No" /> --}}
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="aadhaar_no" class="form-label text-danger-emphasis">ஆதார்
                                                        எண் இணைக்கப்பட்ட மொபைல்
                                                        எண்ணிற்கு OTP அதனை வாடிக்கையாளராடம் தெரிவிக்கவும்</label>
                                                    <input type="text" class="form-control req" maxlength="15"
                                                        id="aadhaar_no" name="aadhaar_no" placeholder="Aadhaar Number" />

                                                    <label for="mobile"
                                                        class="form-label text-danger-emphasis">இணைக்கப்படும் மொபைல்
                                                        எண்ணிற்கு OTP வரும் அதனை வாடிக்கையாளராடம் தெரிவிக்கவும்</label>
                                                    <input type="text" maxlength="10" class="form-control req number"
                                                        name="mobile" id="mobile" placeholder="Mobile Number" />
                                                    <label for="street_name_tamil"
                                                        class="form-label text-danger-emphasis">தெரு/பகுதி/வட்டாரப்
                                                        பகுதி/சாலை</label>
                                                    <input type="text" maxlength="500" class="form-control req"
                                                        name="street_name_tamil" id="street_name_tamil"
                                                        placeholder="தெரு/பகுதி/வட்டாரப் பகுதி/சாலை" />
                                                    <label for="post_office_tamil"
                                                        class="form-label text-danger-emphasis">அஞ்சல் பெயர்</label>
                                                    <input type="text" maxlength="200" class="form-control req"
                                                        name="post_office_tamil" id="post_office_tamil"
                                                        placeholder="அஞ்சல் பெயர்" />
                                                    <label for="pin_code" class="form-label text-danger-emphasis">Pin
                                                        Code</label>
                                                    <input type="text" maxlength="6" class="form-control req number"
                                                        name="pin_code" id="pin_code" placeholder="Pin Code" />
                                                    <label for="taluqa_mandal_tamil"
                                                        class="form-label text-danger-emphasis">தாலுகா/தாலுகா/மண்டல்</label>
                                                    <input type="text" maxlength="200" class="form-control req"
                                                        name="taluqa_mandal_tamil" id="taluqa_mandal_tamil"
                                                        placeholder="Tehsil/Taluqa/Mandal" />
                                                    <label for="town_village_tamil"
                                                        class="form-label text-danger-emphasis">நகரம்/கிராமம்</label>
                                                    <input type="text" maxlength="200" class="form-control req"
                                                        name="town_village_tamil" id="town_village_tamil"
                                                        placeholder="Town/Village" />

                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="assembly1" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="epic_no" class="form-label text-danger-emphasis">Epic
                                                Number</label>
                                            <input type="text" class="form-control req1" maxlength="15"
                                                name="epic_no1" placeholder="Epic No" />
                                            <label for="aadhaar_card" class="form-label text-danger-emphasis">Adhaar
                                                Card</label>
                                            <input type="file" class="form-control req1" name="aadhaar_card1"
                                                placeholder="Adhaar card" />
                                            <label for="apartment_no"
                                                class="form-label text-danger-emphasis">House/Building/Apartment
                                                No</label>
                                            <input type="text" class="form-control req1" maxlength="15"
                                                name="apartment_no1" id="apartment_no"
                                                placeholder="House/Building/Apartment No" />
                                            <label for="street_name"
                                                class="form-label text-danger-emphasis">Street/Area/Locality/Road</label>
                                            <input type="text" maxlength="500" class="form-control req1"
                                                name="street_name1" id="street_name"
                                                placeholder="Street/Area/Locality/Road" />
                                            <label for="post_office" class="form-label text-danger-emphasis">Post
                                                Office</label>
                                            <input type="text" maxlength="200" class="form-control req1"
                                                name="post_office1" id="post_office" placeholder="Post Office" />

                                            <label for="dist_id" class="form-label text-danger-emphasis">District</label>
                                            <select name="dist_id1" id="dist_id" class="form-control req1">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">
                                                        {{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="taluqa_mandal"
                                                class="form-label text-danger-emphasis">Tehsil/Taluqa/Mandal</label>
                                            <input type="text" maxlength="200" class="form-control req1"
                                                name="taluqa_mandal1" id="taluqa_mandal"
                                                placeholder="Tehsil/Taluqa/Mandal" />
                                            <label for="town_village"
                                                class="form-label text-danger-emphasis">Town/Village</label>
                                            <input type="text" maxlength="200" class="form-control req1"
                                                name="town_village1" id="town_village" placeholder="Town/Village" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_assembly_constituency"
                                                class="form-label text-danger-emphasis">Name Of Assembly
                                                Constituency</label>
                                            <input type="text" maxlength="200" class="form-control req1"
                                                name="name_assembly_constituency"
                                                placeholder="Name Of Assembly Constituency" />

                                            <label for="aadhaar_no" class="form-label text-danger-emphasis">ஆதார் எண்
                                                இணைக்கப்பட்ட மொபைல்
                                                எண்ணிற்கு OTP அதனை வாடிக்கையாளராடம் தெரிவிக்கவும்.</label>
                                            <input type="text" class="form-control req1" maxlength="15"
                                                id="aadhaar_no" name="aadhaar_no1" placeholder="Aadhaar Number" />

                                            <label for="mobile" class="form-label text-danger-emphasis">இணைக்கப்படும்
                                                மொபைல்
                                                எண்ணிற்கு OTP வரும் அதனை வாடிக்கையாளராடம் தெரிவிக்கவும்.</label>
                                            <input type="text" maxlength="10" class="form-control req1 number"
                                                name="mobile1" id="mobile" placeholder="Mobile Number" />
                                            <label for="street_name_tamil"
                                                class="form-label text-danger-emphasis">தெரு/பகுதி/வட்டாரப்
                                                பகுதி/சாலை</label>
                                            <input type="text" maxlength="500" class="form-control req1"
                                                name="street_name_tamil1" id="street_name_tamil"
                                                placeholder="தெரு/பகுதி/வட்டாரப் பகுதி/சாலை" />
                                            <label for="post_office_tamil" class="form-label text-danger-emphasis">அஞ்சல்
                                                பெயர்</label>
                                            <input type="text" maxlength="200" class="form-control req1"
                                                name="post_office_tamil1" id="post_office_tamil"
                                                placeholder="அஞ்சல் பெயர்" />
                                            <label for="pin_code" class="form-label text-danger-emphasis">Pin Code</label>
                                            <input type="text" maxlength="6" class="form-control req1 number"
                                                name="pin_code1" id="pin_code" placeholder="Pin Code" />
                                            <label for="taluqa_mandal_tamil"
                                                class="form-label text-danger-emphasis">தாலுகா/தாலுகா/மண்டல்</label>
                                            <input type="text" maxlength="200" class="form-control req1"
                                                name="taluqa_mandal_tamil1" id="taluqa_mandal_tamil"
                                                placeholder="தாலுகா/தாலுகா/மண்டல்" />
                                            <label for="town_village_tamil"
                                                class="form-label text-danger-emphasis">நகரம்/கிராமம்</label>
                                            <input type="text" maxlength="200" class="form-control req1"
                                                name="town_village_tamil1" id="town_village_tamil"
                                                placeholder="நகரம்/கிராமம்" />
                                        </div>
                                    </div>
                                </div>
                            @elseif ($serviceid == 164)
                                <div class=row>
                                    <div class="mb-3 col-md-6">
                                        <label for="epic_no" class="form-label">Epic Number</label>
                                        <input type="text" class="form-control" maxlength="15" name="epic_no"
                                            placeholder="Epic No" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="document" class="form-label text-danger">Document</label>
                                        <input type="file" class="form-control" name="document"
                                            placeholder="Document" />
                                    </div>
                                </div>
                                <div class=row>
                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="name_correction" value="1" />
                                            <label class="form-check-label" for="name_correction">Name Correction</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="gender_correction" value="2" />
                                            <label class="form-check-label" for="gender_correction">Gender</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="dob_correction" value="3" />
                                            <label class="form-check-label" for="dob_correction">DOB/Age</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="relation_type_correction" value="4" />
                                            <label class="form-check-label" for="relation_type_correction">Relation
                                                Type</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="relative_name_correction" value="5" />
                                            <label class="form-check-label" for="relative_name_correction">Relative's
                                                Name</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="mobile_correction" value="6" />
                                            <label class="form-check-label" for="mobile_correction">Mobile Number</label>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="correction[]"
                                                id="photo_correction" value="7" />
                                            <label class="form-check-label" for="photo_correction">Photo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="voterid_correction" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="name_tamil" class="form-label">Name In Tamil</label>
                                            <input type="text" class="form-control crt" maxlength="100"
                                                id="name_tamil" name="name_tamil" placeholder="Name In Tamil" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_english" class="form-label">Name In English</label>
                                            <input type="text" class="form-control crt" maxlength="100"
                                                id="name_english" name="name_english" placeholder="Name In English" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="voterid_correction1" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="gender" class="form-label">Gender</label>
                                            <select id="gender" name="gender" class="form-control crt1">
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Third Gender">Third Gender</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="voterid_correction2" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="dob" class="form-label">DOB</label>
                                            <input type="date" maxlength="10" class="form-control crt2"
                                                name="dob" placeholder="DOB" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="age_proof" class="form-label">Age Proof</label>
                                            <input type="file" class="form-control crt2" name="age_proof"
                                                placeholder="File Upload" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="voterid_correction3" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="relation" class="form-label">Relation</label>
                                            <select id="relation" name="relation" class="form-control crt3">
                                                <option value="">Select Relation</option>
                                                <option value="Father">Father</option>
                                                <option value="Mother">Mother</option>
                                                <option value="Husband">Husband</option>
                                                <option value="Wife">Wife</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="voterid_correction4" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="name_in_tamil" class="form-label">Name In Tamil</label>
                                            <input type="text" class="form-control crt4" maxlength="100"
                                                id="name_in_tamil" name="name_in_tamil" placeholder="Name In Tamil" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_in_english" class="form-label">Name In English</label>
                                            <input type="text" class="form-control crt4" maxlength="100"
                                                id="name_in_english" name="name_in_english"
                                                placeholder="Name In English" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="voterid_correction5" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input type="text" class="form-control number crt5" maxlength="10"
                                                id="mobile" name="mobile" placeholder="Mobile Number" />
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="voterid_correction6" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input type="file" class="form-control number crt6" id="photo"
                                                name="photo" placeholder="Photo" />
                                        </div>

                                    </div>
                                </div>
                            @elseif ($serviceid == 182)
                                <div class="col-md-12">
                                    <h4 class="text-center">Application for Marking Person with Disability</h4>
                                    <div class=row>
                                        <div class="mb-8 col-md-3">
                                            <div class="form-check form-check-inline">
                                                <input required class="form-check-input" type="radio" name="disability"
                                                    id="locomotive" value="1" />
                                                <label class="form-check-label" for="locomotive">Locomotive</label>
                                            </div>
                                        </div>
                                        <div class="mb-8 col-md-3">
                                            <div class="form-check form-check-inline">
                                                <input required class="form-check-input" type="radio" name="disability"
                                                    id="visual" value="2" />
                                                <label class="form-check-label" for="visual">Visual</label>
                                            </div>
                                        </div>
                                        <div class="mb-8 col-md-3">
                                            <div class="form-check form-check-inline">
                                                <input required class="form-check-input" type="radio" name="disability"
                                                    id="deaf_dumb" value="3" />
                                                <label class="form-check-label" for="deaf_dumb">Deaf & Dumb</label>
                                            </div>
                                        </div>
                                        <div class="mb-8 col-md-3">
                                            <div class="form-check form-check-inline">
                                                <input required class="form-check-input" type="radio" name="disability"
                                                    id="description" value="4" />
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
                                            <input type="text" class="form-control re" maxlength="6"
                                                id="locomotive_percentage" name="locomotive_percentage"
                                                placeholder="Percentage of Disability" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="locomotive_certificate" class="form-label">Certificate
                                                Upload</label>
                                            <input type="file" class="form-control re" name="certificate_disability"
                                                placeholder="File Upload" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="person_with_disability1" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="visual_percentage" class="form-label">Percentage of
                                                Disability</label>
                                            <input type="text" class="form-control re1" maxlength="6"
                                                name="visual_percentage" placeholder="Percentage of Disability" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="visual_certificate" class="form-label">Certificate
                                                Upload</label>
                                            <input type="file" class="form-control re1" name="visual_certificate"
                                                placeholder="File Upload" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="person_with_disability2" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="dumb_percentage" class="form-label">Percentage of
                                                Disability</label>
                                            <input type="text" class="form-control re2" maxlength="6" name="epic_no"
                                                placeholder="Percentage of Disability" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dumb_certificate" class="form-label">Certificate
                                                Upload</label>
                                            <input type="file" class="form-control re2" name="dumb_certificate"
                                                placeholder="File Upload" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row" id="person_with_disability3" style="display:none;">
                                        <div class="mb-3 col-md-6">
                                            <label for="other_percentage" class="form-label">Percentage of
                                                Disability</label>
                                            <input type="text" class="form-control re3" maxlength="6"
                                                name="other_percentage" placeholder="Percentage of Disability" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="other_certificate" class="form-label">Certificate
                                                Upload</label>
                                            <input type="file" class="form-control re3" name="other_certificate"
                                                placeholder="Certificate Upload" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" class="form-control re3" maxlength="100"
                                                name="description" placeholder="Enter The Description" />
                                        </div>
                                    </div>
                                </div>
                            @elseif ($serviceid == 181)
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input required type="text" class="form-control" maxlength="30"
                                            name="name" placeholder="Name" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mobile" class="form-label">Mobile Number</label>
                                        <input required type="text" class="form-control" maxlength="10"
                                            name="mobile" placeholder="Mobile Number" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="voter_id" class="form-label text-danger">Voter Id</label>
                                        <input required accept="image/jpeg, image/png" type="file"
                                            class="form-control text-danger" name="voter_id" />
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="aadhaar_card" class="form-label text-danger">Aadhar Card
                                            (Front & Back)</label>
                                        <input required accept="image/jpeg, image/png" type="file"
                                            class="form-control text-danger" name="aadhaar_card" />
                                    </div>
                                </div>
                                <br>
                                </br>
                                <div class="row">
                                    <table id="pricetable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>VOTER ID CORRECTION</th>
                                                <th>CORRECTION DATA</th>
                                                <th>CORRECTION DOCUMENTS</th>
                                                <th>DOCUMENTS</th>
                                                <th><a class="btn btn-sm btn-success" onclick="addnewrow()"><i
                                                            class='mdi mdi-plus-circle-outline'></i></a></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <select required name="voterid_correction[]" class="form-control">
                                                        <option value="">Select</option>
                                                        <option value="NAME">NAME</option>
                                                        <option value="GENDER">GENDER</option>
                                                        <option value="DOB/AGE">DOB/AGE</option>
                                                        <option value="RELATION TYPE">RELATION TYPE</option>
                                                        <option value="RELATIVE NAME">RELATIVE NAME</option>
                                                        <option value="ADDRESS">ADDRESS</option>
                                                        <option value="MOBILE NO">MOBILE NO</option>
                                                        <option value="PHOTO">PHOTO</option>
                                                    </select></td>
                                                <td><input required class="form-control" type="text" name="new_data[]"
                                                        maxlength="70"></td>
                                                <td><select required name="correction_documents[]"
                                                        class="form-control correction_docs">
                                                        <option value="">Select</option>
                                                        <option value="Name Correction">Name Correction</option>
                                                        <option value="Gender Correction">Gender Correction
                                                        </option>
                                                        <option value="DOB/AGE Correction">DOB/AGE Correction
                                                        </option>
                                                        <option value="Relation Type Correction">Relation Type
                                                            Correction</option>
                                                        <option value="Relative Name Correction">Relative Name
                                                            Correction</option>
                                                        <option value="Address Correction">Address Correction
                                                        </option>
                                                        <option value="Mobile No Correction">Mobile No Correction
                                                        </option>
                                                        <option value="Photo Correction">Photo Correction</option>
                                                    </select></td>
                                                <td>
                                                    <P class='changename'></P>
                                                    <input required class="form-control" type="file" name="doc[]"
                                                        accept="image/jpeg, image/png">
                                                </td>
                                                <td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i
                                                            class='mdi mdi-trash-can-outline'></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                        @endif

                        <div class="text-center">
                            <p id="nopayment"></p>
                        </div>
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
    </div>
@endsection
@push('page_scripts')
    <script>
        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });

        $(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = "{{ $payment }}";
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
        });
        var ramjibalance = "{{ $mainbalance->rawallet }}";
        //alert(ramjibalance);
        ramjibalance = parseFloat(ramjibalance);

        function checkpayment(e) {
            var amount = {{ $admin_payment }};
            if (amount > ramjibalance) {
                alert("LOW BALANCE");
                $('#save').prop("disabled", true);
                $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
                return false;
            } else {
                $("#nopayment").html("");
                $("#save").attr("disabled", true);
                $("#ramjidebit_amount").val(amount);
                return true;

            }
        }
        $('#dist_id').on('change', function() {
            var dist_id = this.value;
            $("#taluk").html('');
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
                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
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
                }
            });
        });

        $("#pricetable").on('change', '.correction_docs', function() {
            if ($(this).val() == "DOB/AGE Correction") {
                $(this).closest('tr').find('.changename').text("Birth Certificate or Driving License");
            } else if ($(this).val() == "Photo Correction") {
                $(this).closest('tr').find('.changename').text("Applicant Photo");
            } else {
                $(this).closest('tr').find('.changename').text("Aadhaar Card");
            }
        });

        $("#pricetable").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
        });

        function addnewrow() {
            $("#pricetable tbody").append(
                "<tr><td><select required name='voterid_correction[]' class='form-control'><option value=''>Select</option><option value='NAME'>NAME</option><option value='GENDER'>GENDER</option><option value='DOB/AGE'>DOB/AGE</option><option value='RELATION TYPE'>RELATION TYPE</option><option value='RELATIVE NAME'>RELATIVE NAME</option><option value='ADDRESS'>ADDRESS</option><option value='MOBILE NO'>MOBILE NO</option><option value='PHOTO'>PHOTO</option></select></td><td><input required class='form-control' type='text' name='wrong_data[]' maxlength='70'></td><td><input required class='form-control' type='text' name='new_data[]' maxlength='70'></td><td><select required name='correction_documents[]' class='form-control correction_docs'><option value=''>Select</option> <option value='Name Correction'>Name Correction</option><option value='Gender Correction'>Gender Correction</option><option value='DOB/AGE Correction'>DOB/AGE Correction</option><option value='Relation Type Correction'>Relation Type Correction</option> <option value='Relative Name Correction'>Relative Name Correction</option><option value='Address Correction'>Address Correction</option><option value='Mobile No Correction'>Mobile No Correction</option><option value='Photo Correction'>Photo Correction</option></select></td><td><P class='changename'></P><input required class='form-control' type='file' name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-trash-can-outline'></i></a></td></tr>"
            );
        }

        $('input[name="within_assembly"]').change(function() {
            if ($(this).val() === "1") {
                $("#assembly").show().find('.req').attr('required', true);;
                $("#assembly1").hide().find('.req1').removeAttr('required');
            } else if ($(this).val() === "2") {
                $("#assembly").hide().find('.req').removeAttr('required');
                $("#assembly1").show().find('.req1').attr('required', true);;
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
            if ($('#select_relationship').val() == 'தந்தை பெயர்') {
                $('#father_name_tamilhide').show("slow");
                $('#father_name_englishhide').show("slow");
                $('#husband_name_tamilhide').hide("slow");
                $('#husband_name_englishhide').hide("slow");
                $('#husband_name_tamil').prop("required", false);
                $('#husband_name_english').prop("required", false);
                $('#father_name_tamil').prop("required", true);
                $('#father_name_english').prop("required", true);

            } else if ($('#select_relationship').val() == 'கணவர் பெயர்') {
                $('#husband_name_tamilhide').show("slow");
                $('#husband_name_englishhide').show("slow");
                $('#father_name_tamilhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#husband_name_tamil').prop("required", true);
                $('#husband_name_english').prop("required", true);

            } else {
                $('#father_name_tamilhide').hide("slow");
                $('#father_name_englishhide').hide("slow");
                $('#husband_name_tamilhide').hide("slow");
                $('#husband_name_englishhide').hide("slow");
                $('#father_name_tamil').prop("required", false);
                $('#father_name_english').prop("required", false);
                $('#husband_name_tamil').prop("required", false);
                $('#husband_name_english').prop("required", false);

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
