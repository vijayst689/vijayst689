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
                                    <form action="{{ url('/caneditupdate') }}" id="formAccountSettings" method="POST"
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

                                            @if ($serviceid == 208)
                                                <div class="mb-3 col-md-6">
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
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />
                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->mobile }}" class="form-control"
                                                        name="mobile" maxlength="10" placeholder="Mobile Number" />
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

                                                <div class="mb-3 col-md-6">

                                                    @if (Auth::user()->id != $apply_user_id)
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
                                                    @endif
                                                </div>
                                            @elseif ($serviceid == 209)
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
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />
                                                    <label for="dob" class="form-label">Date Of Birth
                                                        [05041997]</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->dob }}" class="form-control"
                                                        name="dob" maxlength="8" placeholder="ddmmyyyy" />

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

                                                <div class="mb-3 col-md-6">

                                                    @if (Auth::user()->id != $apply_user_id)
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
                                                    @endif
                                                </div>
                                            @elseif ($serviceid == 210)
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

                                                    <label for="dob" class="form-label">Date Of Birth
                                                        [05041997]</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->dob }}" class="form-control"
                                                        name="dob" maxlength="8" placeholder="ddmmyyyy" />
                                                    @if (Auth::user()->id != $apply_user_id)
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
                                                    @endif

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />
                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->mobile }}"
                                                        class="form-control" name="mobile" maxlength="10"
                                                        placeholder="Mobile Number" />
                                                </div>
                                            @elseif ($serviceid == 211)
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

                                                    <label for="mobile" class="form-label">Mobile Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->mobile }}"
                                                        class="form-control" name="mobile" maxlength="10"
                                                        placeholder="Mobile Number" />
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
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />
                                                    <label for="dob" class="form-label">Date Of Birth
                                                        [05041997]</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->dob }}" class="form-control"
                                                        name="dob" maxlength="8" placeholder="ddmmyyyy" />
                                                    @if (Auth::user()->id != $apply_user_id)
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
                                                    @endif
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
                                            @elseif ($serviceid == 233)
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
                                                    <label for="father_name" class="form-label">தந்தையின் பெயர்
                                                        தமிழில்</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->father_name }}"
                                                        class="form-control" name="father_name" maxlength="100"
                                                        placeholder="தந்தையின் பெயர் தமிழில்" />

                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar_card != '')
                                                            <label>Aadhaar Card (Front & Back)</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>Aadhaar Card (Front & Back)</label>
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
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />

                                                    <label for="father_name_english" class="form-label">Father's Name
                                                        English</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->father_name_english }}"
                                                        class="form-control" name="father_name_english" maxlength="100"
                                                        placeholder="Father's Name English" />
                                                </div>
                                            @elseif ($serviceid == 234)
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
                                                    <label for="revenue_village" class="form-label">Revenue
                                                        Village</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->revenue_village }}"
                                                        class="form-control" name="revenue_village" maxlength="100"
                                                        placeholder="Revenue Village" />
                                                    <label for="door_no" class="form-label">Door No</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->door_no }}"
                                                        class="form-control" name="door_no" maxlength="30"
                                                        placeholder="Door No" />
                                                    <label for="street_name" class="form-label">Street Name</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->street_name }}"
                                                        class="form-control" name="street_name" maxlength="100"
                                                        placeholder="Street Name" />
                                                    <label for="postal_area_english" class="form-label">Postal
                                                        Name</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->postal_area_english }}"
                                                        class="form-control" name="postal_area_english" maxlength="100"
                                                        placeholder="Postal Name" />

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="taluk_id" class="form-label">Taluk</label>
                                                    <select @if (Auth::user()->id != $apply_user_id) disabled @endif
                                                        name="taluk_id" id="taluk" class="form-control">
                                                    </select>
                                                    <label for="can_number" class="form-label">Can Number</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->can_number }}"
                                                        class="form-control" name="can_number" maxlength="30"
                                                        placeholder="Can Number" />

                                                    <label for="pin_code" class="form-label">Pin Code</label>
                                                    <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                        type="text" value="{{ $services->pin_code }}"
                                                        class="form-control" name="pin_code" maxlength="10"
                                                        placeholder="Pin Code" />
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
                                                </div>
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
                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
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
                        $('#application').prop("required", true);
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

                $('#service_status').change(function() {
                    if ($('#service_status').val() == 'Resubmit') {
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                        $('#applicationhide').hide("slow");
                        $('#application').prop("required", false);
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", true);
                    } else if ($('#service_status').val() == 'Processing') {
                        // $('#acknowledgementhide').show("slow");
                        // $('#acknowledgement').prop("required", true);
                        $('#remarkshide').hide("slow");
                        $('#remarks').prop("required", false);
                        $('#applicationhide').hide("slow");
                        $('#application').prop("required", false);
                        $('#applicationnohide').show("slow");
                        $('#application_no').prop("required", true);

                    } else if ($('#service_status').val() == 'Approved') {
                        $('#remarkshide').hide("slow");
                        $('#remarks').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#applicationhide').show("slow");
                        $('#application').prop("required", true);
                        $('#applicationnohide').hide("slow");
                        $('#application_no').prop("required", false);
                    } else {
                        $('#remarkshide').show("slow");
                        $('#remarks').prop("required", false);
                        $('#acknowledgementhide').hide("slow");
                        $('#acknowledgement').prop("required", false);
                        $('#applicationhide').hide("slow");
                        $('#application').prop("required", false);
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
            </script>
        @endpush
