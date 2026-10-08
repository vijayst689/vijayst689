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
                    <h1 class="card-title">
                        Service Payment :
                        <span class="text-danger" id="servicePayment">{{ $payment }}</span>
                    </h1>
                    <div class="row">
                        <form class="row g-4" action="{{ url('submitapply_smart_nametransfer') }}"
                            onsubmit="return checkpayment(event)" enctype="multipart/form-data" method="post"
                            id="myForm">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                <input type="hidden" name="amount" value="{{ $amount }}">
                                <input type="hidden" name="service_amount" value="{{ $payment }}">

                                @if ($serviceid == 222)
                                <div
                                    class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                    <span class="text-danger">
                                        பெயர் நீக்கம் அல்லது சேர்க்க ஆதாரை பதிவேற்றம் செய்தால் போதுமானது.
                                        பெயர் நீக்கம் அல்லது சேர்க்கைக்கான விண்ணப்பம் எண்ணை வைத்து APPROVED செய்து
                                        தரப்படும்.
                                    </span><br>
                                    <span class="text-dark">
                                        குடும்ப உறுப்பினர் எண்ணிக்கை அடிப்படையில் மட்டுமே கட்டணம் வேறுப்படும்
                                    </span>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <label class="form-label fw-bold text-dark fs-5">
                                        விண்ணப்ப வகை (Application Type) <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex gap-4 p-3 rounded-3 bg-light border"
                                        style="border-color: #cbd5e1 !important;">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="application_type"
                                                id="type_addition" value="சேர்க்கை" required>
                                            <label class="form-check-label fw-bold cursor-pointer"
                                                for="type_addition">
                                                <i class="bi bi-person-plus-fill text-success me-1"></i> பெயர்
                                                சேர்க்கை (Name Addition)
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="application_type"
                                                id="type_removal" value="பெயர் நீக்கம்" required>
                                            <label class="form-check-label fw-bold cursor-pointer"
                                                for="type_removal">
                                                <i class="bi bi-person-dash-fill text-danger me-1"></i> பெயர்
                                                நீக்கம் (Name Removal)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">

                                    <label for="petition_no" class="form-label">கோரிக்கை மனு எண்</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="petition_no" placeholder="கோரிக்கை மனு எண்" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />

                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="application_print" class="form-label">Acknowledgement Slip</label>
                                    <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                        class="form-control" name="application_print" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="petition_no" class="form-label">No Of Person</label>
                                    <input type="number" min="1" class="form-control" id="name_count_222"
                                        name="name_count" placeholder="No Of Person" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div id="nameContainer222"></div>
                                </div>
                                @elseif ($serviceid == 223)
                                <div
                                    class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                    <span class="text-danger">
                                        ஒரு குடும்ப அட்டையில் இருக்கும் உறுப்பினரை வேறு குடும்ப அட்டையில் நேரடியாக
                                        இணைக்கலாம். எந்த குடும்ப அட்டையில் இணைக்கப்பட வேண்டுமோ அந்த குடும்ப அட்டை
                                        எண் தெளிவாக தெரியும்படி பதிவேற்றம் செய்ய வேண்டும்.
                                    </span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="relationship" class="form-label">உறவுமுறை</label>
                                    <select required id="relationship" name="relationship" class="form-control">
                                        <option value="">Select</option>
                                        <option value="தந்தை">தந்தை</option>
                                        <option value="தாய்">தாய்</option>
                                        <option value="மகன்">மகன்</option>
                                        <option value="மகள்">மகள்</option>
                                        <option value="கணவர்">கணவர்</option>
                                        <option value="மனைவி">மனைவி</option>
                                        <option value="மாமியார்">மாமியார்</option>
                                        <option value="மாமனார்">மாமனார்</option>
                                        <option value="மருமகன்">மருமகன்</option>
                                        <option value="மருமகள்">மருமகள்</option>
                                        <option value="பேரன்">பேரன்</option>
                                        <option value="பேத்தி">பேத்தி</option>
                                        <option value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                    </select>

                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                    <input required accept="image/jpeg, image/png" type="file"
                                        class="form-control" name="aadhaar_card" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                    <label for="smart_card" class="form-label">Smart Card</label>
                                    <input required type="file" accept=".jpg,.jpeg,.png,.pdf"
                                        class="form-control" name="smart_card" placeholder="Smart Card" />
                                </div>
                                @elseif ($serviceid == 228)
                                <div
                                    class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                    <span class="text-danger">
                                        பெயர்களில் இருக்கும் எழுத்து பிழைகளை மட்டுமே திருத்தம் செய்யப்படும்.
                                    </span><br>
                                    <span class="text-dark">
                                        பெயர் மாற்றம் செய்ய இயலாது.
                                    </span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                    <input required type="text" maxlength="100" class="form-control"
                                        name="name_tamil" placeholder="பெயர் தமிழில்" />
                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                    <input required accept="image/jpeg, image/png" type="file"
                                        class="form-control" name="aadhaar_card" />
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="name_english" class="form-label">Name English</label>
                                    <input required type="text" maxlength="100" class="form-control"
                                        name="name_english" placeholder="Name English" />
                                    <label for="smart_card" class="form-label">Smart Card</label>
                                    <input required type="file" accept=".jpg,.jpeg,.png,.pdf"
                                        class="form-control" name="smart_card" placeholder="Smart Card" />
                                </div>
                                @elseif ($serviceid == 231)
                                <div
                                    class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                    <span class="text-danger">
                                        பிறந்த தேதிகளில் இருக்கும் தேதிகளை மட்டுமே திருத்தம் செய்யப்படும்.
                                    </span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="dob" class="form-label">DOB</label>
                                    <input required type="date" maxlength="10" class="form-control"
                                        name="dob" placeholder="DOB" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                    <input required accept="image/jpeg, image/png" type="file"
                                        class="form-control" name="aadhaar_card" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smart_card" class="form-label">Smart Card</label>
                                    <input required type="file" accept=".jpg,.jpeg,.png,.pdf"
                                        class="form-control" name="smart_card" placeholder="Smart Card" />
                                </div>
                                @elseif ($serviceid == 232)
                                <div
                                    class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                    <span class="text-danger">
                                        உறுப்பினரின் உறவுமுறைகள் மட்டுமே திருத்தம் செய்யப்படும்.
                                    </span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="relationship" class="form-label">உறவுமுறை</label>
                                    <select required id="relationship" name="relationship" class="form-control">
                                        <option value="">Select</option>
                                        <option value="தந்தை">தந்தை</option>
                                        <option value="தாய்">தாய்</option>
                                        <option value="மகன்">மகன்</option>
                                        <option value="மகள்">மகள்</option>
                                        <option value="கணவர்">கணவர்</option>
                                        <option value="மனைவி">மனைவி</option>
                                        <option value="மாமியார்">மாமியார்</option>
                                        <option value="மாமனார்">மாமனார்</option>
                                        <option value="மருமகன்">மருமகன்</option>
                                        <option value="மருமகள்">மருமகள்</option>
                                        <option value="பேரன்">பேரன்</option>
                                        <option value="பேத்தி">பேத்தி</option>
                                        <option value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                    <input required accept="image/jpeg, image/png" type="file"
                                        class="form-control" name="aadhaar_card" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smart_card" class="form-label">Smart Card</label>
                                    <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                        class="form-control" name="smart_card" />
                                </div>
                                @elseif ($serviceid == 233)
                                <div
                                    class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                    <span class="text-danger">
                                        குடும்ப அட்டையில் முகவரி திருத்தம் செய்த விண்ணப்பம் ஒப்புகை சீட்டை
                                        பதிவேற்றம் செய்ய வேண்டும்.
                                        விண்ணப்பிக்கும் போது ஆவணமாக ஏதேனும் ஒரு அடையாள சான்றை பதிவேற்றம் செய்யவும்.
                                        அந்த ஆவணத்தில்
                                        முகவரி சரியாக இருக்க வேண்டியதில்லை.
                                    </span><br>
                                    <span class="text-dark">
                                        எந்த கடைக்கு மாற்ற வேண்டுமே அந்த கடையின் எண் வழங்க வேண்டும்
                                    </span><br>

                                </div>
                                <div class="mb-3 col-md-6">
                                    {{-- <label for="address_tamil_1" class="form-label">முகவரி தமிழில்</label>
                                            <textarea class="form-control" name="address_tamil_1" id="address_tamil_1" placeholder="முகவரி தமிழில்"
                                                maxlength="500" rows="3" required></textarea> --}}
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                    <label for="application_print" class="form-label">Acknowledgement Slip</label>
                                    <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                        class="form-control" name="application_print" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    {{-- <label for="address_english_1" class="form-label">Address in English</label>
                                            <textarea class="form-control" name="address_english_1" id="address_english_1" placeholder="Full Address"
                                                maxlength="500" rows="3" required></textarea> --}}

                                    <label for="shop_number" class="form-label">Shop Number</label>
                                    <input required type="text" maxlength="10" class="form-control"
                                        name="shop_number" placeholder="Shop Number" />
                                </div>
                                @elseif ($serviceid == 234)
                                <div
                                    class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                    <span class="text-danger">
                                        பெயர்,பிறந்த தேதி மற்றும் உறவுமுறை ஆகியவற்றில் இருக்கும் பிழைகளை
                                        திருத்தங்கள் மட்டுமே செய்யப்படும்.
                                    </span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <!-- <label for="dist_id" class="form-label">District</label>
                                                                                        <select required name="dist_id" id="dist_id" class="form-control">
                                                                                            <option value="">Select District</option>
                                                                                            @foreach ($districts as $d)
    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
    @endforeach
                                                                                        </select> -->
                                    <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                    <input required type="text" maxlength="100" class="form-control"
                                        name="name_tamil" placeholder="பெயர் தமிழில்" />
                                    <label for="relationship" class="form-label">உறவுமுறை</label>
                                    <select required id="relationship" name="relationship" class="form-control">
                                        <option value="">Select</option>
                                        <option value="தந்தை">தந்தை</option>
                                        <option value="தாய்">தாய்</option>
                                        <option value="மகன்">மகன்</option>
                                        <option value="மகள்">மகள்</option>
                                        <option value="கணவர்">கணவர்</option>
                                        <option value="மனைவி">மனைவி</option>
                                        <option value="மாமியார்">மாமியார்</option>
                                        <option value="மாமனார்">மாமனார்</option>
                                        <option value="மருமகன்">மருமகன்</option>
                                        <option value="மருமகள்">மருமகள்</option>
                                        <option value="பேரன்">பேரன்</option>
                                        <option value="பேத்தி">பேத்தி</option>
                                        <option value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                    </select>
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                    <label for="smart_card" class="form-label">Smart Card</label>
                                    <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                        class="form-control" name="smart_card" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <!-- <label for="taluk_id" class="form-label">Taluk</label>
                                                                                        <select required name="taluk_id" id="taluk" class="form-control">
                                                                                        </select> -->
                                    <label for="name_english" class="form-label">Name English</label>
                                    <input required type="text" maxlength="100" class="form-control"
                                        name="name_english" placeholder="Name English" />
                                    <label for="dob" class="form-label">DOB</label>
                                    <input required type="date" maxlength="10" class="form-control"
                                        name="dob" placeholder="DOB" />
                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                    <input required accept="image/jpeg, image/png" type="file"
                                        class="form-control" name="aadhaar_card" />
                                </div>
                                @elseif ($serviceid == 235)
                                <div class="mb-3 col-md-6">
                                    <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                    <input required type="text" maxlength="100" class="form-control"
                                        name="name_tamil" placeholder="பெயர் தமிழில்" />
                                    <label for="relationship" class="form-label">உறவுமுறை</label>
                                    <select required id="relationship" name="relationship" class="form-control">
                                        <option value="">Select</option>
                                        <option value="தந்தை">தந்தை</option>
                                        <option value="தாய்">தாய்</option>
                                        <option value="மகன்">மகன்</option>
                                        <option value="மகள்">மகள்</option>
                                        <option value="கணவர்">கணவர்</option>
                                        <option value="மனைவி">மனைவி</option>
                                        <option value="மாமியார்">மாமியார்</option>
                                        <option value="மாமனார்">மாமனார்</option>
                                        <option value="மருமகன்">மருமகன்</option>
                                        <option value="மருமகள்">மருமகள்</option>
                                        <option value="பேரன்">பேரன்</option>
                                        <option value="பேத்தி">பேத்தி</option>
                                        <option value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                    </select>
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                    <label for="aadhaar_card" class="form-label">Aadhaar Card Front Page</label>
                                    <input required accept="image/jpeg, image/png" type="file"
                                        class="form-control" name="aadhaar_card" />
                                    {{-- <label for="smart_mobile" class="form-label">Smart Card Link Cell
                                                Number</label>
                                            <input required type="text" maxlength="10" class="form-control number"
                                                name="smart_mobile" placeholder="Smart Card Link Cell Number" /> --}}
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="name_english" class="form-label">Name English</label>
                                    <input required type="text" maxlength="100" class="form-control"
                                        name="name_english" placeholder="Name English" />
                                    <label for="dob" class="form-label">DOB</label>
                                    <input required type="date" maxlength="10" class="form-control"
                                        name="dob" placeholder="DOB" />
                                    <label for="smart_card" class="form-label">Smart Card Front Page</label>
                                    <input required type="file" accept=".jpg,.jpeg,.png,.pdf"
                                        class="form-control" name="smart_card" placeholder="Smart Card" />
                                    <label for="aadhaar_no" class="form-label">Aadhaar Card Number</label>
                                    <input required type="text" maxlength="15" class="form-control number"
                                        name="aadhaar_no" placeholder="Aadhaar Card Number" />
                                </div>
                                @elseif ($serviceid == 236)
 <div
                                            class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                            <span class="text-danger">
                                                முகவரி மாற்றம் விண்ணப்பம் செய்து Accknowledgement Slip இணைக்க வேண்டும்.
TNPDS யில் விண்ணப்பம் செய்ய ஆவணமாக ஆதாரை பதிவேற்றம் செய்யவும் ஆதாரில் முகவரி தவறாக இருந்தாலும் பிரச்சினை இல்லை. ஏதேனும் ஒரு ஆவணம் சமர்பிக்க வேண்டும்.
                                            </span>
                                        </div>
                                <div class="mb-3 col-md-6">
                                    <label for="shop_number" class="form-label">Shop Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="shop_number" placeholder="Shop Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="application_print" class="form-label">Acknowledgement Slip</label>
                                    <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                        class="form-control" name="application_print" />
                                    <small class="text-success">
                                        Allowed files: JPG, JPEG, PNG, PDF
                                    </small>
                                </div>
                                @elseif ($serviceid == 237)
                                <div class="mb-3 col-md-6">
                                    <label for="dist_id" class="form-label">District</label>
                                    <select required name="dist_id" id="dist_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach ($districts as $d)
                                        <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                        @endforeach
                                    </select>
                                    <label>Family Head Photo</label>
                                    <input id="family_head_photo" class="form-control" required type="file"
                                        name="family_head_photo">
                                    <label class="form-label">Member</label>
                                    <select required id="add_member" name="add_member" class="form-control">
                                        <option value="">Select Member</option>
                                        <option value="Add 1 Member">Add 1 Member</option>
                                        <option value="Add 2 Member">Add 2 Member</option>
                                        <option value="Add 3 Member">Add 3 Member</option>
                                        <option value="Add 4 Member">Add 4 Member</option>
                                        <option value="Add 5 Member">Add 5 Member</option>
                                    </select>
                                    <div class="mb-3 row" id="aadhaar_cardhide" style="display: none;">
                                        <label>Aadhaar Card</label>
                                        <input required id="aadhaar_card" class="form-control" type="file"
                                            name="aadhaar_card">
                                    </div>

                                    <div class="mb-3 row" id="aadhaar_card2hide" style="display: none;">
                                        <label>2nd Member Aadhaar Card</label>
                                        <input required id="aadhaar_card2" class="form-control" type="file"
                                            name="aadhaar_card2">
                                    </div>

                                    <div class="mb-3 row" id="aadhaar_card3hide" style="display: none;">
                                        <label>3rd Member Aadhaar Card</label>
                                        <input required id="aadhaar_card3" class="form-control" type="file"
                                            name="aadhaar_card3">
                                    </div>

                                    <div class="mb-3 row" id="aadhaar_card4hide" style="display: none;">
                                        <label>4th Member Aadhaar Card</label>
                                        <input required id="aadhaar_card4" class="form-control" type="file"
                                            name="aadhaar_card4">
                                    </div>

                                    <div class="mb-3 row" id="aadhaar_card5hide" style="display: none;">
                                        <label>5th Member Aadhaar Card</label>
                                        <input required id="aadhaar_card5" class="form-control" type="file"
                                            name="aadhaar_card5">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="taluk_id" class="form-label">Taluk</label>
                                    <select required name="taluk_id" id="taluk" class="form-control">
                                    </select>
                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                    <input required type="text" class="form-control" name="mobile"
                                        placeholder="Mobile Number" maxlength="10" />
                                    <label class="form-label">Addres Proof</label>
                                    <select required id="documents" name="documents" class="form-control">
                                        <option value="">Select Addres Proof</option>
                                        <option value="EB Bill">EB Bill</option>
                                        <option value="Patta">Patta</option>
                                        <option value="Rental Agreement">Rental Agreement</option>
                                        <option value="Gas Bill">Gas Bill</option>
                                    </select>
                                    <div class="" id="electricity_bill_receipthide" style="display: none;">
                                        <label class="form-label text-danger">EB Bill</label>
                                        <input required id="electricity_bill_receipt"
                                            class="form-control text-danger" type="file"
                                            name="electricity_bill_receipt">
                                    </div>
                                    <div class="" id="pattahide" style="display: none;">
                                        <label class="form-label text-danger">Patta</label>
                                        <input required id="patta" class="form-control text-danger"
                                            type="file" name="patta">
                                    </div>
                                    <div class="" id="rental_agreementhide" style="display: none;">
                                        <label class="form-label text-danger">Rental Agreement</label>
                                        <input required id="rental_agreement" class="form-control text-danger"
                                            type="file" name="rental_agreement">
                                    </div>
                                    <div class="" id="gas_cylinder_receipthide" style="display: none;">
                                        <label class="form-label text-danger">Gas Bill</label>
                                        <input required id="gas_cylinder_receipt" class="form-control text-danger"
                                            type="file" name="gas_cylinder_receipt">
                                    </div>
                                </div>
                                @elseif ($serviceid == 238)
                                <div class="card shadow-sm border-0 mt-4">
                                    <div class="card-header bg-info bg-gradient text-white">
                                        <h5 class="mb-0">Cell Number Link</h5>
                                    </div>

                                    <div class="card-body">
                                        <div class="row g-4">

                                            <!-- Left Column -->
                                            <div class="col-md-6">

                                                <!-- District -->
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label fw-semibold bg-body text-dark">District</label>
                                                    <select required name="dist_id" id="dist_id"
                                                        class="form-select">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $d)
                                                        <option value="{{ $d->id }}">
                                                            {{ $d->district_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Name -->
                                                {{-- <div class="mb-3">
                                                            <label
                                                                class="form-label fw-semibold bg-body text-dark">Name</label>
                                                            <input required type="text" maxlength="100"
                                                                class="form-control" name="name"
                                                                placeholder="Enter Full Name" />
                                                        </div> --}}

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold bg-body text-dark">Smart
                                                        Card Number</label>
                                                    <input required type="text" maxlength="20"
                                                        class="form-control" name="smartcard_number"
                                                        placeholder="Enter Smart Card Number" />
                                                </div>

                                                <!-- Smart Card -->
                                                {{-- <div class="mb-3">
                                                            <label class="form-label fw-semibold bg-body text-dark">Smart
                                                                Card</label>
                                                            <input required accept="image/jpeg, image/png" type="file"
                                                                class="form-control" name="smart_card" />
                                                            <small class="text-success">Upload JPG/PNG only</small>
                                                        </div> --}}

                                            </div>

                                            <!-- Right Column -->
                                            <div class="col-md-6">

                                                <!-- Taluk -->
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label fw-semibold bg-body text-dark">Taluk</label>
                                                    <select required name="taluk_id" id="taluk"
                                                        class="form-select">
                                                        <option value="">Select Taluk</option>
                                                    </select>
                                                </div>

                                                <!-- Mobile -->
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold bg-body text-dark">Mobile
                                                        Number</label>
                                                    <input required type="text" class="form-control"
                                                        name="mobile" maxlength="10" pattern="[0-9]{10}"
                                                        placeholder="Enter 10-digit Mobile Number" />
                                                </div>

                                                <!-- Aadhaar -->
                                                {{-- <div class="mb-3">
                                                            <label class="form-label fw-semibold bg-body text-dark">Aadhaar
                                                                Card</label>
                                                            <input required accept="image/jpeg, image/png" type="file"
                                                                class="form-control" name="aadhaar_card" />
                                                            <small class="text-success">Upload JPG/PNG only</small>
                                                        </div> --}}

                                            </div>

                                        </div>

                                        <!-- Important Note -->
                                        <div class="alert alert-warning mt-4">
                                            <strong>Important:</strong>
                                            <p class="mb-0 mt-2 text-danger">
                                                புதிய செல் நம்பருக்கு ஒரு 6 இலக்கு OTP வரும்.
                                                வாடிக்கையாளரை தொடர்பு கொண்டு எமது குழு உறுப்பினர்கள் கேட்டு
                                                பெறுவார்கள்
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @elseif ($serviceid == 239)
                                <div class="row p-3 rounded shadow-sm bg-light">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label fw-bold text-primary">
                                            Name
                                        </label>
                                        <input required type="text" maxlength="100"
                                            class="form-control border-primary" name="name"
                                            placeholder="Enter your name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="mobile" class="form-label fw-bold text-primary">
                                            Register Cell Number
                                        </label>
                                        <input required type="tel" maxlength="10"
                                            class="form-control border-primary" name="mobile"
                                            placeholder="Enter registered mobile number">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="smartcard_number" class="form-label fw-bold text-primary">
                                            Smartcard Number
                                        </label>
                                        <input required type="text" maxlength="15"
                                            class="form-control border-primary" name="smartcard_number"
                                            placeholder="Enter smartcard number">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="application_print" class="form-label fw-bold text-primary">
                                            Application / Online Print
                                        </label>
                                        <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                            class="form-control border-primary" name="application_print">
                                        <small class="text-success">
                                            Allowed files: JPG, JPEG, PNG, PDF
                                        </small>
                                    </div>
                                    <div class="col-12">
                                        <div class="alert alert-danger text-center py-2">
                                            பதிவு செய்யப்பட்ட செல் எண்ணிற்கு OTP வரும். அந்த OTP ஐ வழங்க வேண்டும்.
                                        </div>
                                    </div>
                                </div>
                                @elseif ($serviceid == 240)
                                <div
                                    class="alert alert-warning text-center fw-bold fs-4 border border-danger shadow-sm">
                                    <span class="text-danger">
                                        குடும்ப தலைவரின் புகைப்படம் தெளிவாக அல்லது வேறு நபர்களின் புகைப்படம்
                                        இருப்பின் மாற்றி தரப்படும்.
                                    </span>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input required accept="image/jpeg, image/png" type="file"
                                        class="form-control" name="photo" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                    <input required accept="image/jpeg, image/png" type="file"
                                        class="form-control" name="aadhaar_card" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smart_card" class="form-label">Smart Card</label>
                                    <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                        class="form-control" name="smart_card" />
                                </div>
                                @elseif ($serviceid == 241)
                                <div class="row p-3 rounded shadow-sm bg-light">
                                    <div class="mb-3 col-md-6">
                                        <label for="smartcard_number" class="form-label fw-bold text-primary">
                                            Smartcard Number
                                        </label>
                                        <input required type="text" maxlength="15"
                                            class="form-control border-primary" name="smartcard_number"
                                            placeholder="Enter smartcard number">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="smart_mobile" class="form-label fw-bold text-primary">
                                            Register Link Mobile Number
                                        </label>
                                        <input required type="text" maxlength="10"
                                            class="form-control number border-primary" name="smart_mobile"
                                            placeholder="Enter Register Link Mobile Number">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name_tamil" class="form-label fw-bold text-primary">
                                            பெயர் தமிழில்
                                        </label>
                                        <input required type="text" maxlength="100"
                                            class="form-control border-primary" name="name_tamil"
                                            placeholder="பெயர் தமிழில்">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="aadhaar_card" class="form-label fw-bold text-primary">
                                            Aadhaar Card
                                        </label>
                                        <input required accept=".jpg,.jpeg,.png" type="file"
                                            class="form-control border-primary" name="aadhaar_card">
                                        <small class="text-success">
                                            Allowed files: JPG, JPEG, PNG
                                        </small>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="photo" class="form-label fw-bold text-primary">
                                            Photo
                                        </label>
                                        <input required accept=".jpg,.jpeg,.png" type="file"
                                            class="form-control border-primary" name="photo">
                                        <small class="text-success">
                                            Allowed files: JPG, JPEG, PNG
                                        </small>
                                    </div>

                                </div>
                                @elseif ($serviceid == 242)
                                <div class="row p-3 rounded shadow-sm bg-light">
                                    <div class="mb-3 col-md-6">
                                        <label for="name_tamil" class="form-label fw-bold text-primary">
                                            பெயர் தமிழில்
                                        </label>
                                        <input required type="text" maxlength="100"
                                            class="form-control border-primary" name="name_tamil"
                                            placeholder="பெயர் தமிழில்">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="application_print" class="form-label">Acknowledgement Slip</label>
                                        <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                            class="form-control" name="application_print" />
                                        <small class="text-success">
                                            Allowed files: JPG, JPEG, PNG, PDF
                                        </small>
                                    </div>
                                </div>
                                @elseif ($serviceid == 243)
                                <div class="mb-3 col-md-6">
                                    <label for="petition_no" class="form-label">கோரிக்கை மனு எண்</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="petition_no" placeholder="கோரிக்கை மனு எண்" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                    <input required type="text" maxlength="20" class="form-control"
                                        name="smartcard_number" placeholder="Ration Card Number" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="application_print" class="form-label">Acknowledgement Slip</label>
                                    <input required accept=".jpg,.jpeg,.png,.pdf" type="file"
                                        class="form-control" name="application_print" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="petition_no" class="form-label">No Of Name</label>
                                    <input type="number" min="1" class="form-control"
                                        id="name_count_258" name="name_count" placeholder="No Of Name" required>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div id="nameContainer258"></div>
                                </div>
                                @endif

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
    $(document).ready(function() {
        // -------------------------------------------------------------
        // 1. Initial Variables Setup & Core Validation
        // -------------------------------------------------------------
        const walletBalance = parseFloat("{{ Auth::user()->wallet }}") || 0;
        const basePayment = parseFloat("{{ $payment }}") || 0;

        // Helper function to re-evaluate user wallet status
        function validateUserWallet(totalAmount) {
            if (totalAmount > walletBalance) {
                $('#save').prop("disabled", true);
                $('#nopayment')
                    .html(`Insufficient Funds! Total required: ₹${totalAmount.toFixed(2)}, Available: ₹${walletBalance.toFixed(2)}. Please update your wallet.`)
                    .css({
                        'color': 'red',
                        'font-size': '130%',
                        'font-weight': 'bold',
                        'margin-top': '8px'
                    });
                return false;
            } else {
                $('#save').prop("disabled", false);
                $('#nopayment').html("");
                return true;
            }
        }

        // Run initial wallet check on page load
        validateUserWallet(basePayment);

        // -------------------------------------------------------------
        // 2. Dynamic Service Payment Calculation (Services 222 & 258)
        // -------------------------------------------------------------
        @if(in_array($serviceid, [222, 258]))
        const serviceId = "{{ $serviceid }}";
        const targetInput = `#name_count_${serviceId}`;
        const targetContainer = `#nameContainer${serviceId}`;

        $(targetInput).on('keyup change input', function() {
            let count = parseInt($(this).val(), 10);
            count = (!isNaN(count) && count > 0) ? count : 0;

            // Build dynamic member inputs
            let html = '<div class="row">';
            for (let i = 1; i <= count; i++) {
                html += `
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name ${i}</label>
                        <input type="text"
                               name="member_name[]"
                               class="form-control"
                               placeholder="Enter Name ${i}"
                               required>
                    </div>`;
            }
            html += '</div>';

            $(targetContainer).html(html);

            // Calculate overall dynamic payment based on count
            const totalPayment = basePayment * count;

            // Update UI elements and hidden amount field
            $('#servicePayment').text(totalPayment.toFixed(2));
            $('#amount').val(totalPayment);

            // Re-validate wallet balance against calculated total
            validateUserWallet(totalPayment);
        });
        @endif

        // -------------------------------------------------------------
        // 3. Dynamic Aadhaar Card Input Toggles (Add 1-5 Members)
        // -------------------------------------------------------------
        $('#add_member').on('change', function() {
            const val = $(this).val();
            const match = val ? val.match(/\d+/) : null;
            const count = match ? parseInt(match[0], 10) : 0;

            for (let i = 1; i <= 5; i++) {
                const wrapper = $(`#aadhaar_card${i === 1 ? '' : i}hide`);
                const input = $(`#aadhaar_card${i === 1 ? '' : i}`);

                if (i <= count) {
                    wrapper.show("slow");
                    input.prop("required", true);
                } else {
                    wrapper.hide("slow");
                    input.prop("required", false);
                }
            }
        });

        // -------------------------------------------------------------
        // 4. Dynamic Document Attachment Toggles
        // -------------------------------------------------------------
        $('#documents').on('change', function() {
            const docMap = {
                'EB Bill': {
                    wrapper: '#electricity_bill_receipthide',
                    input: '#electricity_bill_receipt'
                },
                'Patta': {
                    wrapper: '#pattahide',
                    input: '#patta'
                },
                'Rental Agreement': {
                    wrapper: '#rental_agreementhide',
                    input: '#rental_agreement'
                },
                'Gas Bill': {
                    wrapper: '#gas_cylinder_receipthide',
                    input: '#gas_cylinder_receipt'
                }
            };

            const selectedDoc = $(this).val();

            // Reset and hide all document fields
            $.each(docMap, function(_, item) {
                $(item.wrapper).hide("slow");
                $(item.input).prop("required", false);
            });

            // Show selected document input field
            if (docMap[selectedDoc]) {
                $(docMap[selectedDoc].wrapper).show("slow");
                $(docMap[selectedDoc].input).prop("required", true);
            }
        });

        // -------------------------------------------------------------
        // 5. AJAX Cascading Dropdowns (District -> Taluk -> Panchayath)
        // -------------------------------------------------------------
        $('#dist_id').on('change', function() {
            const dist_id = this.value;
            $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
            $('#panchayath').html('<option value="">-- Select Panchayath --</option>');

            if (!dist_id) return;

            $.ajax({
                url: "{{ url('service/get_taluk') }}/" + dist_id,
                type: "GET",
                success: function(result) {
                    $.each(result, function(key, value) {
                        $("#taluk").append(`<option value="${value.id}">${value.taluk_name}</option>`);
                    });
                }
            });
        });

        $('#taluk').on('change', function() {
            const taluk_id = this.value;
            $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');

            if (!taluk_id) return;

            $.ajax({
                url: "{{ url('service/get_panchayath') }}/" + taluk_id,
                type: "GET",
                success: function(result) {
                    $.each(result, function(key, value) {
                        $("#panchayath").append(`<option value="${value.id}">${value.panchayath_name}</option>`);
                    });
                }
            });
        });

        // -------------------------------------------------------------
        // 6. Form Submit Listener
        // -------------------------------------------------------------
        document.getElementById("myForm")?.addEventListener("submit", function() {
            const btn = document.getElementById("save");
            if (btn) {
                btn.disabled = true;
                btn.innerText = "Submitting...";
            }
        });
    });

    // -----------------------------------------------------------------
    // 7. Global Admin Payment Check Function
    // -----------------------------------------------------------------
    function checkpayment(e) {
        const ramjiBalance = parseFloat("{{ $mainbalance->rawallet }}") || 0;
        const adminPayment = parseFloat("{{ $admin_payment }}") || 0;

        if (adminPayment > ramjiBalance) {
            alert("LOW BALANCE");
            $('#save').prop("disabled", true);
            $('#nopayment')
                .html("Low Balance For the Service. Please Contact Admin...")
                .css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
            return false;
        } else {
            $("#nopayment").html("");
            $("#ramjidebit_amount").val(adminPayment);
            return true;
        }
    }
</script>
@endpush