@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-lg flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light"></span>{{ $servicename }}</h4>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> {{ session('success') }} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> {{ session('error') }} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ url('/smartcard_nametransfer_update') }}" id="myForm" method="POST"
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
                                    @if ($serviceid == 222)
                                        {{-- Application Type Radio Group --}}
                                        <div class="col-md-12 mb-4">
                                            <label class="form-label fw-bold text-dark fs-5">
                                                விண்ணப்ப வகை (Application Type) <span class="text-danger">*</span>
                                            </label>
                                            <div class="d-flex gap-4 p-3 rounded-3 bg-light border"
                                                style="border-color: #cbd5e1 !important;">
                                                <div class="form-check form-check-inline">
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        class="form-check-input" type="radio" name="application_type"
                                                        id="type_addition" value="சேர்க்கை"
                                                        {{ isset($services) && $services->application_type == 'சேர்க்கை' ? 'checked' : '' }}
                                                        required>
                                                    <label class="form-check-label fw-bold cursor-pointer"
                                                        for="type_addition">
                                                        <i class="bi bi-person-plus-fill text-success me-1"></i> பெயர்
                                                        சேர்க்கை (Name Addition)
                                                    </label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        class="form-check-input" type="radio" name="application_type"
                                                        id="type_removal" value="பெயர் நீக்கம்"
                                                        {{ isset($services) && $services->application_type == 'பெயர் நீக்கம்' ? 'checked' : '' }}
                                                        required>
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
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->petition_no }}" class="form-control"
                                                name="petition_no" maxlength="20" placeholder="கோரிக்கை மனு எண்" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text"
                                                value="{{ $services->smartcard_number }}" class="form-control"
                                                name="smartcard_number" maxlength="20" placeholder="Ration Card Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->application_print != '')
                                                    <label>Acknowledgement Slip</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Acknowledgement Slip</label>
                                                <input @if ($services->application_print == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="application_print">
                                                @if ($services->application_print != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">No Of Person</label>

                                            <input type="text" class="form-control" value="{{ $services->name_count }}"
                                                readonly>

                                            <input type="hidden" name="name_count" value="{{ $services->name_count }}">
                                        </div>
                                        @php
                                            $members = !empty($services->member_name)
                                                ? explode(',', $services->member_name)
                                                : [];
                                        @endphp

                                        <div class="row">
                                            @foreach ($members as $key => $member)
                                                <div class="col-md-6 mb-3">
                                                    <label>Name {{ $key + 1 }}</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        type="text" class="form-control" name="member_name[]"
                                                        value="{{ trim($member) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    @elseif ($serviceid == 223)
                                        <div class="mb-3 col-md-6">
                                            <label for="relationship" class="form-label">உறவுமுறை</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif class="form-control"
                                                name="relationship">
                                                <option value="">Select</option>
                                                <option @if ($services->relationship == 'தந்தை') selected @endif value="தந்தை">
                                                    தந்தை</option>
                                                <option @if ($services->relationship == 'தாய்') selected @endif value="தாய்">
                                                    தாய்</option>
                                                <option @if ($services->relationship == 'மகன்') selected @endif value="மகன்">
                                                    மகன்</option>
                                                <option @if ($services->relationship == 'மகள்') selected @endif value="மகள்">
                                                    மகள்</option>
                                                <option @if ($services->relationship == 'கணவர்') selected @endif value="கணவர்">
                                                    கணவர்</option>
                                                <option @if ($services->relationship == 'மனைவி') selected @endif value="மனைவி">
                                                    மனைவி</option>
                                                <option @if ($services->relationship == 'மாமியார்') selected @endif
                                                    value="மாமியார்">மாமியார்</option>
                                                <option @if ($services->relationship == 'மாமனார்') selected @endif
                                                    value="மாமனார்">
                                                    மாமனார்</option>
                                                <option @if ($services->relationship == 'மருமகன்') selected @endif
                                                    value="மருமகன்">
                                                    மருமகன்</option>
                                                <option @if ($services->relationship == 'மருமகள்') selected @endif
                                                    value="மருமகள்">
                                                    மருமகள்</option>
                                                <option @if ($services->relationship == 'பேரன்') selected @endif value="பேரன்">
                                                    பேரன்</option>
                                                <option @if ($services->relationship == 'பேத்தி') selected @endif value="பேத்தி">
                                                    பேத்தி</option>
                                                <option @if ($services->relationship == 'மற்ற உறவுகள்') selected @endif
                                                    value="மற்ற உறவுகள்">
                                                    மற்ற உறவுகள்</option>
                                            </select>

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
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label>Smart Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Smart Card</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 228)
                                        <div class="mb-3 col-md-6">
                                            <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_tamil }}" class="form-control"
                                                name="name_tamil" maxlength="100" placeholder="பெயர் தமிழில்" />
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />
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
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_english" class="form-label">English Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_english }}"
                                                class="form-control" name="name_english" maxlength="100"
                                                placeholder="English Name" />
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label>Smart Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Smart Card</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 231)
                                        <div class="mb-3 col-md-6">
                                            <label for="dob" class="form-label">DOB</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="date" value="{{ $services->dob }}" class="form-control"
                                                name="dob" maxlength="10" placeholder="DOB" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
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
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label>Smart Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Smart Card</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 232)
                                        <div class="mb-3 col-md-6">
                                            <label for="relationship" class="form-label">உறவுமுறை</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                class="form-control" name="relationship">
                                                <option value="">Select</option>
                                                <option @if ($services->relationship == 'தந்தை') selected @endif value="தந்தை">
                                                    தந்தை</option>
                                                <option @if ($services->relationship == 'தாய்') selected @endif value="தாய்">
                                                    தாய்</option>
                                                <option @if ($services->relationship == 'மகன்') selected @endif value="மகன்">
                                                    மகன்</option>
                                                <option @if ($services->relationship == 'மகள்') selected @endif value="மகள்">
                                                    மகள்</option>
                                                <option @if ($services->relationship == 'கணவர்') selected @endif value="கணவர்">
                                                    கணவர்</option>
                                                <option @if ($services->relationship == 'மனைவி') selected @endif value="மனைவி">
                                                    மனைவி</option>
                                                <option @if ($services->relationship == 'மாமியார்') selected @endif
                                                    value="மாமியார்">மாமியார்</option>
                                                <option @if ($services->relationship == 'மாமனார்') selected @endif
                                                    value="மாமனார்">மாமனார்</option>
                                                <option @if ($services->relationship == 'மருமகன்') selected @endif
                                                    value="மருமகன்">
                                                    மருமகன்</option>
                                                <option @if ($services->relationship == 'மருமகள்') selected @endif
                                                    value="மருமகள்">
                                                    மருமகள்</option>
                                                <option @if ($services->relationship == 'பேரன்') selected @endif value="பேரன்">
                                                    பேரன்</option>
                                                <option @if ($services->relationship == 'பேத்தி') selected @endif value="பேத்தி">
                                                    பேத்தி</option>
                                                <option @if ($services->relationship == 'மற்ற உறவுகள்') selected @endif
                                                    value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
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
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label>Smart Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Smart Card</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 233)
                                        <div class="mb-3 col-md-6">

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->application_print != '')
                                                    <label>Acknowledgement Slip</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Acknowledgement Slip</label>
                                                <input @if ($services->application_print == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="application_print">
                                                @if ($services->application_print != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}">Download</a><br>
                                                @endif
                                            @endif
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="shop_number" class="form-label">Shop Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->shop_number }}" class="form-control"
                                                name="shop_number" maxlength="10" placeholder="Shop Number" />
                                        </div>
                                    @elseif ($serviceid == 234)
                                        <div class="mb-3 col-md-6">
                                            <!-- <label for="dist_id" class="form-label">District</label>
                                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="dist_id"
                                                                            id="dist_id" class="form-control">
                                                                            <option value="">Select District</option>
                                                                            @foreach ($districts as $d)
    <option @if ($d->id == $services->dist_id) selected @endif
                                                                                    value="{{ $d->id }}">{{ $d->district_name }}</option>
    @endforeach
                                                                        </select> -->
                                            <label for="name_english" class="form-label">English Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_english }}"
                                                class="form-control" name="name_english" maxlength="100"
                                                placeholder="English Name" />
                                            <label for="dob" class="form-label">DOB</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="date" value="{{ $services->dob }}" class="form-control"
                                                name="dob" maxlength="10" placeholder="DOB" />

                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label>Smart Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Smart Card</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <!-- <label for="taluk_id" class="form-label">Taluk</label>
                                                                        <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="taluk_id"
                                                                            id="taluk" class="form-control">
                                                                        </select> -->
                                            <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_tamil }}" class="form-control"
                                                name="name_tamil" maxlength="100" placeholder="பெயர் தமிழில்" />
                                            <label for="relationship" class="form-label">உறவுமுறை</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                class="form-control" name="relationship">
                                                <option value="">Select</option>
                                                <option @if ($services->relationship == 'தந்தை') selected @endif
                                                    value="தந்தை">
                                                    தந்தை</option>
                                                <option @if ($services->relationship == 'தாய்') selected @endif
                                                    value="தாய்">
                                                    தாய்</option>
                                                <option @if ($services->relationship == 'மகன்') selected @endif
                                                    value="மகன்">மகன்</option>
                                                <option @if ($services->relationship == 'மகள்') selected @endif
                                                    value="மகள்">மகள்</option>
                                                <option @if ($services->relationship == 'கணவர்') selected @endif
                                                    value="கணவர்">கணவர்</option>
                                                <option @if ($services->relationship == 'மனைவி') selected @endif
                                                    value="மனைவி">மனைவி</option>
                                                <option @if ($services->relationship == 'மாமியார்') selected @endif
                                                    value="மாமியார்">மாமியார்</option>
                                                <option @if ($services->relationship == 'மாமனார்') selected @endif
                                                    value="மாமனார்">மாமனார்</option>
                                                <option @if ($services->relationship == 'மருமகன்') selected @endif
                                                    value="மருமகன்">
                                                    மருமகன்</option>
                                                <option @if ($services->relationship == 'மருமகள்') selected @endif
                                                    value="மருமகள்">
                                                    மருமகள்</option>
                                                <option @if ($services->relationship == 'பேரன்') selected @endif
                                                    value="பேரன்">பேரன்</option>
                                                <option @if ($services->relationship == 'பேத்தி') selected @endif
                                                    value="பேத்தி">பேத்தி</option>
                                                <option @if ($services->relationship == 'மற்ற உறவுகள்') selected @endif
                                                    value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                            </select>
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
                                        </div>
                                    @elseif ($serviceid == 235)
                                        <div class="mb-3 col-md-6">
                                            <label for="name_tamil" class="form-label">பெயர் தமிழில்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_tamil }}" class="form-control"
                                                name="name_tamil" maxlength="100" placeholder="பெயர் தமிழில்" />
                                            <label for="relationship" class="form-label">உறவுமுறை</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                class="form-control" name="relationship">
                                                <option value="">Select</option>
                                                <option @if ($services->relationship == 'தந்தை') selected @endif
                                                    value="தந்தை">தந்தை</option>
                                                <option @if ($services->relationship == 'தாய்') selected @endif
                                                    value="தாய்">தாய்</option>
                                                <option @if ($services->relationship == 'மகன்') selected @endif
                                                    value="மகன்">மகன்</option>
                                                <option @if ($services->relationship == 'மகள்') selected @endif
                                                    value="மகள்">மகள்</option>
                                                <option @if ($services->relationship == 'கணவர்') selected @endif
                                                    value="கணவர்">கணவர்</option>
                                                <option @if ($services->relationship == 'மனைவி') selected @endif
                                                    value="மனைவி">மனைவி</option>
                                                <option @if ($services->relationship == 'மாமியார்') selected @endif
                                                    value="மாமியார்">மாமியார்</option>
                                                <option @if ($services->relationship == 'மாமனார்') selected @endif
                                                    value="மாமனார்">மாமனார்</option>
                                                <option @if ($services->relationship == 'மருமகன்') selected @endif
                                                    value="மருமகன்">
                                                    மருமகன்</option>
                                                <option @if ($services->relationship == 'மருமகள்') selected @endif
                                                    value="மருமகள்">
                                                    மருமகள்</option>
                                                <option @if ($services->relationship == 'பேரன்') selected @endif
                                                    value="பேரன்">பேரன்</option>
                                                <option @if ($services->relationship == 'பேத்தி') selected @endif
                                                    value="பேத்தி">பேத்தி</option>
                                                <option @if ($services->relationship == 'மற்ற உறவுகள்') selected @endif
                                                    value="மற்ற உறவுகள்">மற்ற உறவுகள்</option>
                                            </select>
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>Aadhaar Card Front Page</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Aadhaar Card Front Page</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            {{-- <label for="smart_mobile" class="form-label">Smart Card Link Cell
                                                Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smart_mobile }}"
                                                class="form-control number" name="smart_mobile" maxlength="10"
                                                placeholder="Smart Card Link Cell Numberr" /> --}}
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="name_english" class="form-label">English Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name_english }}"
                                                class="form-control" name="name_english" maxlength="100"
                                                placeholder="English Name" />
                                            <label for="dob" class="form-label">DOB</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="date" value="{{ $services->dob }}" class="form-control"
                                                name="dob" maxlength="10" placeholder="DOB" />
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label>Smart Card Front Page</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Smart Card Front Page</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            <label for="aadhaar_no" class="form-label">Aadhaar Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->aadhaar_no }}"
                                                class="form-control number" name="aadhaar_no" maxlength="15"
                                                placeholder="Aadhaar Card Numberr" />
                                        </div>
                                    @elseif ($serviceid == 236)
                                         <div class="mb-3 col-md-6">
                                            <label for="shop_number" class="form-label">Shop Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->shop_number }}" class="form-control"
                                                name="shop_number" maxlength="20" placeholder="Shop Number" />
                                        </div>
                                         <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->application_print != '')
                                                    <label>Acknowledgement Slip</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Acknowledgement Slip</label>
                                                <input @if ($services->application_print == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="application_print">
                                                @if ($services->application_print != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div> 
                                    @elseif ($serviceid == 237)
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $services->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->family_head_photo != '')
                                                    <label>Family Head Photo</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/family_head_photo/{{ $services->family_head_photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Family Head Photo</label>
                                                <input @if ($services->family_head_photo == '')  @endif class="form-control"
                                                    type="file" accept="image/jpeg, image/png"
                                                    name="family_head_photo">
                                                @if ($services->family_head_photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/family_head_photo/{{ $services->family_head_photo }}">Download</a><br>
                                                @endif
                                            @endif
                                            <label class="form-label">Member</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif id="add_member"
                                                name="add_member" class="form-control">
                                                <option value="">Select Member</option>
                                                <option @if ($services->add_member == 'Add 1 Member') selected @endif
                                                    value="Add 1 Member">
                                                    Add 1 Member</option>
                                                <option @if ($services->add_member == 'Add 2 Member') selected @endif
                                                    value="Add 2 Member">
                                                    Add 2 Member</option>
                                                <option @if ($services->add_member == 'Add 3 Member') selected @endif
                                                    value="Add 3 Member">
                                                    Add 3 Member</option>
                                                <option @if ($services->add_member == 'Add 4 Member') selected @endif
                                                    value="Add 4 Member">
                                                    Add 4 Member</option>
                                                <option @if ($services->add_member == 'Add 5 Member') selected @endif
                                                    value="Add 5 Member">
                                                    Add 5 Member</option>

                                            </select>
                                            <div class="mb-3 col-md-6" id="aadhaar_cardhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id)
                                                    @if ($services->aadhaar_card != '')
                                                        <label>Aadhaar Card</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Aadhaar Card</label>
                                                    <input @if ($services->aadhaar_card == '')  @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="aadhaar_card">
                                                    @if ($services->aadhaar_card != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                    @endif
                                                @endif

                                                <div class="mb-3 col-md-6" id="aadhaar_card2hide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar_card2 != '')
                                                            <label>2nd Member Aadhaar Card</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card2/{{ $services->aadhaar_card2 }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>2nd Member Aadhaar Card</label>
                                                        <input @if ($services->aadhaar_card2 == '')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar_card2">
                                                        @if ($services->aadhaar_card2 != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card2/{{ $services->aadhaar_card2 }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6" id="aadhaar_card3hide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar_card3 != '')
                                                            <label>3rd Member Aadhaar Card</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card3/{{ $services->aadhaar_card3 }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>3rd Member Aadhaar Card</label>
                                                        <input @if ($services->aadhaar_card3 == '')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar_card3">
                                                        @if ($services->aadhaar_card3 != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card3/{{ $services->aadhaar_card3 }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6" id="aadhaar_card4hide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id)
                                                    @if ($services->aadhaar_card4 != '')
                                                        <label>4th Member Aadhaar Card</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card4/{{ $services->aadhaar_card4 }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>4th Member Aadhaar Card</label>
                                                    <input @if ($services->aadhaar_card4 == '')  @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="aadhaar_card4">
                                                    @if ($services->aadhaar_card4 != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card4/{{ $services->aadhaar_card4 }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="mb-3 col-md-6" id="aadhaar_card5hide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id)
                                                    @if ($services->aadhaar_card5 != '')
                                                        <label>5th Member Aadhaar Card</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card5/{{ $services->aadhaar_card5 }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>5th Member Aadhaar Card</label>
                                                    <input @if ($services->aadhaar_card5 == '')  @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="aadhaar_card5">
                                                    @if ($services->aadhaar_card5 != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card5/{{ $services->aadhaar_card5 }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="taluk_id"
                                                id="taluk" class="form-control">
                                            </select>
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                value="{{ $services->mobile }}" class="form-control number"
                                                name="mobile" maxlength="10" placeholder="Mobile Number" />

                                            <label class="form-label">Addres Proof</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif id="documents"
                                                name="documents" class="form-control">
                                                <option value="">Select Addres Proof</option>
                                                <option @if ($services->documents == 'EB Bill') selected @endif
                                                    value="EB Bill">
                                                    EB Bill</option>
                                                <option @if ($services->documents == 'Patta') selected @endif
                                                    value="Patta">
                                                    Patta</option>
                                                <option @if ($services->documents == 'Rental Agreement') selected @endif
                                                    value="Rental Agreement">Rental Agreement</option>
                                                <option @if ($services->documents == 'Gas Bill') selected @endif
                                                    value="Gas Bill">Gas Bill</option>
                                            </select>

                                            <div class="" id="electricity_bill_receipthide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->electricity_bill_receipt != '')
                                                        <label>EB Bill</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/electricity_bill_receipt/{{ $services->electricity_bill_receipt }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>EB Bill</label>
                                                    <input @if ($services->electricity_bill_receipt == '' && $services->documents == 'EB Bill')  @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="electricity_bill_receipt"
                                                        id="electricity_bill_receipt">
                                                    @if ($services->electricity_bill_receipt != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/electricity_bill_receipt/{{ $services->electricity_bill_receipt }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="pattahide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->patta != '')
                                                        <label>patta</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/patta/{{ $services->patta }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>patta</label>
                                                    <input @if ($services->patta == '' && $services->documents == 'patta')  @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="patta" id="patta">
                                                    @if ($services->patta != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/patta/{{ $services->patta }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="rental_agreementhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->rental_agreement != '')
                                                        <label>Rental Agreement</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/rental_agreement/{{ $services->rental_agreement }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Rental Agreement</label>
                                                    <input @if ($services->rental_agreement == '' && $services->documents == 'Rental Agreement')  @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="rental_agreement"
                                                        id="rental_agreement">
                                                    @if ($services->rental_agreement != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/rental_agreement/{{ $services->rental_agreement }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="gas_cylinder_receipthide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->gas_cylinder_receipt != '')
                                                        <label>Gas Bill</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/gas_cylinder_receipt/{{ $services->gas_cylinder_receipt }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Gas Bill</label>
                                                    <input @if ($services->gas_cylinder_receipt == '' && $services->documents == 'Gas Bill')  @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="gas_cylinder_receipt"
                                                        id="gas_cylinder_receipt">
                                                    @if ($services->gas_cylinder_receipt != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/gas_cylinder_receipt/{{ $services->gas_cylinder_receipt }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 238)
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" style="color: #0f7ac1"
                                                class="form-label">District</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $services->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>

                                            {{-- <label for="name" style="color: #0f7ac1" class="form-label">Name</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->name }}" class="form-control"
                                                name="name" maxlength="100" placeholder="Name" /> --}}

                                            <label for="smartcard_number" style="color: #0f7ac1" class="form-label">Smart
                                                Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Smart Card Number" />

                                            {{-- @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label style="color: #0f7ac1">Smart Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label style="color: #0f7ac1">Smart Card</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif --}}
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" style="color: #0f7ac1" class="form-label">Taluk</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="taluk_id"
                                                id="taluk" class="form-control">
                                            </select>

                                            <label for="mobile" style="color: #0f7ac1" class="form-label">Mobile
                                                Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif type="text"
                                                value="{{ $services->mobile }}" class="form-control number"
                                                name="mobile" maxlength="10" placeholder="Mobile Number" />

                                            {{-- @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label style="color: #0f7ac1">Aadhaar Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label style="color: #0f7ac1">Aadhaar Card</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif --}}
                                        </div>
                                    @elseif ($serviceid == 239)
                                        <div class="row p-3 rounded shadow-sm bg-light">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label fw-bold text-primary">Name</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->name }}"
                                                    class="form-control border-primary" name="name" maxlength="100"
                                                    placeholder="Name" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="mobile" class="form-label fw-bold text-primary">
                                                    Register Cell Number
                                                </label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="tel" maxlength="10" class="form-control border-primary"
                                                    value="{{ $services->mobile }}" name="mobile"
                                                    placeholder="Enter registered mobile number">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="smartcard_number" class="form-label fw-bold text-primary">
                                                    Smartcard Number
                                                </label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" maxlength="15" class="form-control border-primary"
                                                    value="{{ $services->smartcard_number }}" name="smartcard_number"
                                                    placeholder="Enter smartcard number">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                @if (Auth::user()->id != $apply_user_id)
                                                    @if ($services->application_print != '')
                                                        <label class="form-label fw-bold text-primary">Application / Online
                                                            Print</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}"
                                                            class="btn btn-success me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label class="form-label fw-bold text-primary">Application / Online
                                                        Print</label>
                                                    <input @if ($services->application_print == '') required @endif
                                                        class="form-control border-primary" type="file"
                                                        accept=".jpg,.jpeg,.png,.pdf" name="application_print">
                                                    @if ($services->application_print != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 240)
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />
                                        </div>
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
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
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
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label>Smart Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Smart Card</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 241)
                                        <div class="row p-3 rounded shadow-sm bg-light">
                                            <div class="mb-3 col-md-6">
                                                <label for="smartcard_number" class="form-label fw-bold text-primary">
                                                    Smartcard Number
                                                </label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" maxlength="15" class="form-control border-primary"
                                                    value="{{ $services->smartcard_number }}" name="smartcard_number"
                                                    placeholder="Enter smartcard number">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="smart_mobile" class="form-label fw-bold text-primary">
                                                    Register Link Mobile Number
                                                </label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" maxlength="15"
                                                    class="form-control number border-primary"
                                                    value="{{ $services->smart_mobile }}" name="smart_mobile"
                                                    placeholder="Enter Register Link Mobile Number">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="name_tamil" class="form-label fw-bold text-primary"> பெயர்
                                                    தமிழில்</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->name_tamil }}"
                                                    class="form-control border-primary" name="name_tamil" maxlength="100"
                                                    placeholder=" பெயர் தமிழில்" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                @if (Auth::user()->id != $apply_user_id)
                                                    @if ($services->aadhaar_card != '')
                                                        <label class="form-label fw-bold text-primary">Aadhaar
                                                            Card</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                            class="btn btn-success me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label class="form-label fw-bold text-primary">Aadhaar
                                                        Card</label>
                                                    <input @if ($services->aadhaar_card == '') required @endif
                                                        class="form-control border-primary" type="file"
                                                        accept=".jpg,.jpeg,.png" name="aadhaar_card">
                                                    @if ($services->aadhaar_card != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                @if (Auth::user()->id != $apply_user_id)
                                                    @if ($services->photo != '')
                                                        <label class="form-label fw-bold text-primary">Photo</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                            class="btn btn-success me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label class="form-label fw-bold text-primary">Photo</label>
                                                    <input @if ($services->photo == '') required @endif
                                                        class="form-control border-primary" type="file"
                                                        accept=".jpg,.jpeg,.png" name="photo">
                                                    @if ($services->photo != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 242)
                                        <div class="row p-3 rounded shadow-sm bg-light">
                                            <div class="mb-3 col-md-6">
                                                <label for="name_tamil" class="form-label fw-bold text-primary"> பெயர்
                                                    தமிழில்</label>
                                                <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                    type="text" value="{{ $services->name_tamil }}"
                                                    class="form-control border-primary" name="name_tamil" maxlength="100"
                                                    placeholder=" பெயர் தமிழில்" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->application_print != '')
                                                    <label>Acknowledgement Slip</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Acknowledgement Slip</label>
                                                <input @if ($services->application_print == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="application_print">
                                                @if ($services->application_print != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>                                           
                                        </div>
                                    @elseif ($serviceid == 243)
                                        <div class="mb-3 col-md-6">
                                            <label for="petition_no" class="form-label">கோரிக்கை மனு எண்</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->petition_no }}"
                                                class="form-control" name="petition_no" maxlength="20"
                                                placeholder="கோரிக்கை மனு எண்" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="smartcard_number" class="form-label">Ration Card Number</label>
                                            <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                type="text" value="{{ $services->smartcard_number }}"
                                                class="form-control" name="smartcard_number" maxlength="20"
                                                placeholder="Ration Card Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->application_print != '')
                                                    <label>Acknowledgement Slip</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Acknowledgement Slip</label>
                                                <input @if ($services->application_print == '') required @endif
                                                    class="form-control" type="file" accept=".jpg,.jpeg,.png,.pdf"
                                                    name="application_print">
                                                @if ($services->application_print != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/application_print/{{ $services->application_print }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">No Of Name</label>

                                            <input type="text" class="form-control"
                                                value="{{ $services->name_count }}" readonly>

                                            <input type="hidden" name="name_count"
                                                value="{{ $services->name_count }}">
                                        </div>
                                        @php
                                            $members = !empty($services->member_name)
                                                ? explode(',', $services->member_name)
                                                : [];
                                        @endphp

                                        <div class="row">
                                            @foreach ($members as $key => $member)
                                                <div class="col-md-6 mb-3">
                                                    <label>Name {{ $key + 1 }}</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        type="text" class="form-control" name="member_name[]"
                                                        value="{{ trim($member) }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if (Auth::user()->id != $apply_user_id)
                                        <div class="mb-3 col-md-6">
                                            <label for="service_name" class="form-label">Service Status</label>
                                            <select class="form-control" name="status" id="service_status">
                                                <option value="">Select</option>
                                                <option @if ($services->status == 'Pending') selected @endif
                                                    value="Pending">
                                                    Pending</option>
                                                <option @if ($services->status == 'Resubmit') selected @endif
                                                    value="Resubmit">
                                                    Resubmit</option>
                                                <option @if ($services->status == 'Processing') selected @endif
                                                    value="Processing">Processing</option>
                                                @if ($services->status != 'Approved')
                                                    <option @if ($services->status == 'Rejected') selected @endif
                                                        value="Rejected">Rejected</option>
                                                @endif
                                                <option @if ($services->status == 'Approved') selected @endif
                                                    value="Approved">
                                                    Approved</option>
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
                                                <option @if ($services->selects == 'Text') selected @endif
                                                    value = "Text">
                                                    Text</option>
                                                <option @if ($services->selects == 'File') selected @endif
                                                    value = "File">
                                                    File</option>
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
                                        <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                            <label for="selects" class="form-label">Select</label>
                                            <select class="form-control" name="lects" id="selects">
                                                <option>select</option>
                                                <option @if ($services->lects == 'Text') selected @endif
                                                    value = "Text">
                                                    Text</option>
                                                <option @if ($services->lects == 'File') selected @endif
                                                    value = "File">
                                                    File</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                            <label for="application" class="form-label">Application</label>
                                            <input value="{{ $services->application }}" class="form-control"
                                                type="text" maxlength="150" name="application" id="application" />
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
                                    @if ($services->status == 'Resubmit' && $apply_user_id != Auth::user()->id)
                                        <button type="submit" disabled class="btn btn-primary me-2">Resubmit</button>
                                    @elseif($services->status == 'Approved')
                                        <button type="button" disabled class="btn btn-primary me-2">Completed</button>
                                    @else
                                        <button id="save" type="submit"
                                            class="btn btn-primary me-2">Submit</button>
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
        var dist_id = "{{ $services->dist_id }}";
        var taluk_id = "{{ $services->taluk_id }}";
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var certificate = "{{ $services->certificate }}";
            var selects = "{{ $services->selects }}";
            var lects = "{{ $services->lects }}";
            var add_member = "{{ $services->add_member }}";
            var documents = "{{ $services->documents }}";

            gettaluk(dist_id);
            getpanchayath(taluk_id);

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
            if (add_member == "Add 1 Member") {
                $('#aadhaar_cardhide').show("slow");
            } else if (add_member == "Add 2 Member") {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
            } else if (add_member == "Add 3 Member") {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
            } else if (add_member == "Add 4 Member") {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4').show("slow");
            } else if (add_member == "Add 5 Member") {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4').show("slow");
                $('#aadhaar_card5').show("slow");
            }

            if (documents == "EB Bill") {
                $('#electricity_bill_receipthide').show("slow");
            } else if (documents == "Patta") {
                $('#pattahide').show("slow");
            } else if (documents == "Rental Agreement") {
                $('#rental_agreementhide').show("slow");
            } else if (documents == "Gas Bill") {
                $('#gas_cylinder_receipthide').show("slow");
            }
        });

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
                $('#remarkshide').show("slow");
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

        $('#add_member').change(function() {
            if ($('#add_member').val() == 'Add 1 Member') {
                $('#aadhaar_cardhide1').show("slow");
                $('#aadhaar_card2hide').hide("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card2').prop("required", false);
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);

            } else if ($('#add_member').val() == 'Add 2 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);

            } else if ($('#add_member').val() == 'Add 3 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);

            } else if ($('#add_member').val() == 'Add 4 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').show("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card5').prop("required", false);
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);
                $('#aadhaar_card4').prop("required", true);

            } else if ($('#add_member').val() == 'Add 5 Member') {
                $('#aadhaar_cardhide').show("slow");
                $('#aadhaar_card2hide').show("slow");
                $('#aadhaar_card3hide').show("slow");
                $('#aadhaar_card4hide').show("slow");
                $('#aadhaar_card5hide').show("slow");
                $('#aadhaar_card').prop("required", true);
                $('#aadhaar_card2').prop("required", true);
                $('#aadhaar_card3').prop("required", true);
                $('#aadhaar_card4').prop("required", true);
                $('#aadhaar_card5').prop("required", true);

            } else {
                $('#aadhaar_cardhide').hide("slow");
                $('#aadhaar_card2hide').hide("slow");
                $('#aadhaar_card3hide').hide("slow");
                $('#aadhaar_card4hide').hide("slow");
                $('#aadhaar_card5hide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#aadhaar_card2').prop("required", false);
                $('#aadhaar_card3').prop("required", false);
                $('#aadhaar_card4').prop("required", false);
                $('#aadhaar_card5').prop("required", false);

            }
        });

        $('#documents').change(function() {
            if ($('#documents').val() == 'EB Bill') {
                $('#electricity_bill_receipthide').show("slow");
                $('#pattahide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#patta').prop("required", false);
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#electricity_bill_receipt').prop("required", true);

            } else if ($('#documents').val() == 'Patta') {
                $('#pattahide').show("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#patta').prop("required", true);

            } else if ($('#documents').val() == 'Rental Agreement') {
                $('#rental_agreementhide').show("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#pattahide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#patta').prop("required", false);
                $('#rental_agreement').prop("required", true);

            } else if ($('#documents').val() == 'Gas Bill') {
                $('#gas_cylinder_receipthide').show("slow");
                $('#pattahide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#electricity_bill_receipt').prop("required", false);
                $('#patta').prop("required", false);
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", true);

            } else {
                $('#gas_cylinder_receipthide').hide("slow");
                $('#pattahide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#electricity_bill_receipt').prop("required", false);
                $('#patta').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
            }
        });

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush
