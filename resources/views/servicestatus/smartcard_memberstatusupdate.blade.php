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
                             <form action="{{ url('/smartcard_member_update') }}" id="formAccountSettings" method="POST"
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
                                    @if ($serviceid == 219)
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
                                                    type="file" accept="image/jpeg, image/png" name="family_head_photo">
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
                                                    <input @if ($services->aadhaar_card == '')  @endif class="form-control"
                                                        type="file" accept="image/jpeg, image/png" name="aadhaar_card">
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
                                                    <input @if ($services->aadhaar_card4 == '')  @endif class="form-control"
                                                        type="file" accept="image/jpeg, image/png"
                                                        name="aadhaar_card4">
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
                                                    <input @if ($services->aadhaar_card5 == '')  @endif class="form-control"
                                                        type="file" accept="image/jpeg, image/png"
                                                        name="aadhaar_card5">
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
                                                <option @if ($services->documents == 'Patta') selected @endif value="Patta">
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
                                                    <input @if ($services->electricity_bill_receipt == '' && $services->documents == 'EB Bill')  @endif class="form-control"
                                                        type="file" accept="image/jpeg, image/png"
                                                        name="electricity_bill_receipt" id="electricity_bill_receipt">
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
                                                    <input @if ($services->patta == '' && $services->documents == 'patta')  @endif class="form-control"
                                                        type="file" accept="image/jpeg, image/png" name="patta"
                                                        id="patta">
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
                                                    <input @if ($services->rental_agreement == '' && $services->documents == 'Rental Agreement')  @endif class="form-control"
                                                        type="file" accept="image/jpeg, image/png"
                                                        name="rental_agreement" id="rental_agreement">
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
                                                    <input @if ($services->gas_cylinder_receipt == '' && $services->documents == 'Gas Bill')  @endif class="form-control"
                                                        type="file" accept="image/jpeg, image/png"
                                                        name="gas_cylinder_receipt" id="gas_cylinder_receipt">
                                                    @if ($services->gas_cylinder_receipt != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/gas_cylinder_receipt/{{ $services->gas_cylinder_receipt }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @elseif ($serviceid == 235)
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
                                            <label class="form-label">Member</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif id="member"
                                                name="member" class="form-control">
                                                <option value="">Select Member</option>
                                                <option @if ($services->member == 'Add 1 Member') selected @endif
                                                    value="Add 1 Member">
                                                    Add 1 Member</option>
                                                <option @if ($services->member == 'Add 2 Member') selected @endif
                                                    value="Add 2 Member">
                                                    Add 2 Member</option>
                                                <option @if ($services->member == 'Add 3 Member') selected @endif
                                                    value="Add 3 Member">
                                                    Add 3 Member</option>
                                                <option @if ($services->member == 'Add 4 Member') selected @endif
                                                    value="Add 4 Member">
                                                    Add 4 Member</option>
                                                <option @if ($services->member == 'Add 5 Member') selected @endif
                                                    value="Add 5 Member">
                                                    Add 5 Member</option>

                                            </select>
                                            <div class="mb-3 col-md-6" id="aadhaarhide" style="display: none;">

                                                @if (Auth::user()->id != $apply_user_id)
                                                    @if ($services->aadhaar != '')
                                                        <label>Aadhaar Card</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar/{{ $services->aadhaar }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>Aadhaar Card</label>
                                                    <input @if ($services->aadhaar == '')  @endif class="form-control"
                                                        type="file" accept="image/jpeg, image/png" name="aadhaar">
                                                    @if ($services->aadhaar != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar/{{ $services->aadhaar }}">Download</a><br>
                                                    @endif
                                                @endif
                                                <div class="mb-3 col-md-6" id="aadhaar2hide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar2 != '')
                                                            <label>2nd Member Aadhaar Card</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar2/{{ $services->aadhaar2 }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>2nd Member Aadhaar Card</label>
                                                        <input @if ($services->aadhaar2 == '')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar2">
                                                        @if ($services->aadhaar2 != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar2/{{ $services->aadhaar2 }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6" id="aadhaar3hide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar3 != '')
                                                            <label>3rd Member Aadhaar Card</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar3/{{ $services->aadhaar3 }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>3rd Member Aadhaar Card</label>
                                                        <input @if ($services->aadhaar3 == '')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar3">
                                                        @if ($services->aadhaar3 != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar3/{{ $services->aadhaar3 }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6" id="aadhaar4hide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar4 != '')
                                                            <label>4th Member Aadhaar Card</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar4/{{ $services->aadhaar4 }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>4th Member Aadhaar Card</label>
                                                        <input @if ($services->aadhaar4 == '')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar4">
                                                        @if ($services->aadhaar4 != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar4/{{ $services->aadhaar4 }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="mb-3 col-md-6" id="aadhaar5hide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id)
                                                        @if ($services->aadhaar5 != '')
                                                            <label>5th Member Aadhaar Card</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar5/{{ $services->aadhaar5 }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>5th Member Aadhaar Card</label>
                                                        <input @if ($services->aadhaar5 == '')  @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar5">
                                                        @if ($services->aadhaar5 != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar5/{{ $services->aadhaar5 }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select @if (Auth::user()->id != $apply_user_id) disabled @endif name="taluk_id"
                                                id="taluk" class="form-control">
                                            </select>
                                            @if (Auth::user()->id != $apply_user_id)
                                                @if ($services->smart_card != '')
                                                    <label>Smart Card</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Smart Card</label>
                                                <input @if ($services->smart_card == '')  @endif class="form-control"
                                                    type="file" accept="image/jpeg, image/png" name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
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
                                            <option @if ($services->status == 'Rejected') selected @endif value="Rejected">
                                            Rejected</option>
                                            @endif
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
                                            <option @if ($services->selects == 'Text') selected @endif
                                                value = "Text">Text</option>
                                            <option @if ($services->selects == 'File') selected @endif
                                                value = "File">File</option>
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
            var certificate = "{{ $services->certificate }}";
            var selects = "{{ $services->selects }}";
            var lects = "{{ $services->lects }}";
            var dist_id = "{{ $services->dist_id }}";
            var taluk_id = "{{ $services->taluk_id }}";
            var add_member = "{{ $services->add_member }}";
            var member = "{{ $services->member }}";
            var documents = "{{ $services->documents }}";

            gettaluk(dist_id);

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

            if (member == "Add 1 Member") {
                $('#aadhaarhide').show("slow");
            } else if (member == "Add 2 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
            } else if (member == "Add 3 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
            } else if (member == "Add 4 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
            } else if (member == "Add 5 Member") {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
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

        $('#member').change(function() {
            if ($('#member').val() == 'Add 1 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').hide("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar2').prop("required", false);
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar').prop("required", true);

            } else if ($('#member').val() == 'Add 2 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);

            } else if ($('#member').val() == 'Add 3 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);

            } else if ($('#member').val() == 'Add 4 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar5').prop("required", false);
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);

            } else if ($('#member').val() == 'Add 5 Member') {
                $('#aadhaarhide').show("slow");
                $('#aadhaar2hide').show("slow");
                $('#aadhaar3hide').show("slow");
                $('#aadhaar4hide').show("slow");
                $('#aadhaar5hide').show("slow");
                $('#aadhaar').prop("required", true);
                $('#aadhaar2').prop("required", true);
                $('#aadhaar3').prop("required", true);
                $('#aadhaar4').prop("required", true);
                $('#aadhaar5').prop("required", true);

            } else {
                $('#aadhaarhide').hide("slow");
                $('#aadhaar2hide').hide("slow");
                $('#aadhaar3hide').hide("slow");
                $('#aadhaar4hide').hide("slow");
                $('#aadhaar5hide').hide("slow");
                $('#aadhaar').prop("required", false);
                $('#aadhaar2').prop("required", false);
                $('#aadhaar3').prop("required", false);
                $('#aadhaar4').prop("required", false);
                $('#aadhaar5').prop("required", false);

            }
        });
    </script>
@endpush