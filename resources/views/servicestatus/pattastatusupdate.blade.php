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
                            <form action="{{ url('/patta_update') }}" id="myForm" method="POST"
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
                                    @if ($serviceid == 213 || $serviceid == 214 || $serviceid == 215)
                                        <div class="mb-3 col-md-6">
                                            <label for="can_no" class="form-label">Can Number</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->can_no }}" class="form-control" name="can_no"
                                                maxlength="15" placeholder="Can Number" />

                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select  @if (Auth::user()->id != $apply_user_id ) disabled @endif name="taluk_id"
                                                id="taluk" class="form-control">
                                            </select>
                                            <label for="reg_office" class="form-label">Register Office</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->reg_office }}" class="form-control" name="reg_office"
                                                maxlength="50" placeholder="Register Office" />
                                            <label for="subdivision_no" class="form-label">Subdivision No</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->subdivision_no }}" class="form-control"
                                                name="subdivision_no" maxlength="30" placeholder="Subdivision No" />

                                             @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->bond_doc != '')
                                                    <label>Bond/பத்திரம் Documents</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/bond_doc/{{ $services->bond_doc }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Bond/பத்திரம் Documents</label>
                                                <input @if ($services->bond_doc == '') required @endif
                                                    class="form-control" type="file" name="bond_doc">
                                                @if ($services->bond_doc != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/bond_doc/{{ $services->bond_doc }}">Download</a><br>
                                                @endif
                                            @endif

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select  @if (Auth::user()->id != $apply_user_id ) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $services->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="rev_village" class="form-label">Revenue Village</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" maxlength="50" class="form-control"
                                                value="{{ $services->rev_village }}" name="rev_village"
                                                placeholder="Revenue Village" />
                                            <label for="survey_no" class="form-label">Survey No</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" maxlength="30" class="form-control"
                                                value="{{ $services->survey_no }}" name="survey_no"
                                                placeholder="Survey No" />
                                            <label for="transacted_area" class="form-label">Transacted Area</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" maxlength="50" class="form-control"
                                                value="{{ $services->transacted_area }}" name="transacted_area"
                                                placeholder="Transacted Area" />
                                             @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->ec != '')
                                                    <label>EC</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/ec/{{ $services->ec }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>EC</label>
                                                <input @if ($services->ec == '') required @endif
                                                    class="form-control" type="file" name="ec">
                                                @if ($services->ec != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/ec/{{ $services->ec }}">Download</a><br>
                                                @endif
                                            @endif

                                        </div>
                                        @elseif ($serviceid == 219 )
                                        <div class="mb-3 col-md-6">
                                            <label for="can_no" class="form-label">Can Number</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" value="{{ $services->can_no }}" class="form-control"
                                                name="can_no" maxlength="15" placeholder="Can Number" />

                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select  @if (Auth::user()->id != $apply_user_id ) disabled @endif name="taluk_id"
                                                id="taluk" class="form-control">
                                            </select>
                                            <label for="reg_office" class="form-label">Register Office</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" value="{{ $services->reg_office }}" class="form-control"
                                                name="reg_office" maxlength="50" placeholder="Register Office" />
                                            <label for="subdivision_no" class="form-label">Subdivision No</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" value="{{ $services->subdivision_no }}"
                                                class="form-control" name="subdivision_no" maxlength="30"
                                                placeholder="Subdivision No" />
                                            @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->bond_doc != '')
                                                    <label>Bond/பத்திரம் Documents</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/bond_doc/{{ $services->bond_doc }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Bond/பத்திரம் Documents</label>
                                                <input @if ($services->bond_doc == '') required @endif
                                                    class="form-control" type="file" name="bond_doc">
                                                @if ($services->bond_doc != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/bond_doc/{{ $services->bond_doc }}">Download</a><br>
                                                @endif
                                            @endif

                                            @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->legal_heir != '')
                                                    <label>Legal Heir Certificate</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/legal_heir_certificate/{{ $services->legal_heir }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Legal Heir Certificate</label>
                                                <input @if ($services->legal_heir == '') required @endif
                                                    class="form-control" type="file" name="legal_heir">
                                                @if ($services->legal_heir != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/legal_heir_certificate/{{ $services->legal_heir }}">Download</a><br>
                                                @endif
                                            @endif

                                            @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->chitta_copy != '')
                                                    <label>Chitta Copy</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/chitta/{{ $services->chitta_copy }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Chitta Copy</label>
                                                <input @if ($services->chitta_copy == '') required @endif
                                                    class="form-control" type="file" name="chitta_copy">
                                                @if ($services->chitta_copy != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/chitta/{{ $services->chitta_copy }}">Download</a><br>
                                                @endif
                                            @endif

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="dist_id" class="form-label">District</label>
                                            <select  @if (Auth::user()->id != $apply_user_id ) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $services->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                            <label for="rev_village" class="form-label">Revenue Village</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" maxlength="50" class="form-control"
                                                value="{{ $services->rev_village }}" name="rev_village"
                                                placeholder="Revenue Village" />
                                            <label for="survey_no" class="form-label">Survey No</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" maxlength="30" class="form-control"
                                                value="{{ $services->survey_no }}" name="survey_no"
                                                placeholder="Survey No" />
                                            <label for="transacted_area" class="form-label">Transacted Area</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required
                                                type="text" maxlength="50" class="form-control"
                                                value="{{ $services->transacted_area }}" name="transacted_area"
                                                placeholder="Transacted Area" />
                                             @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->ec != '')
                                                    <label>EC</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/ec/{{ $services->ec }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>EC</label>
                                                <input @if ($services->ec == '') required @endif
                                                    class="form-control" type="file" name="ec">
                                                @if ($services->ec != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/ec/{{ $services->ec }}">Download</a><br>
                                                @endif
                                            @endif

                                            @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->death_certificate != '')
                                                    <label>Death Certificate</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/deathcertificate/{{ $services->death_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Death Certificate</label>
                                                <input @if ($services->death_certificate == '') required @endif
                                                    class="form-control" type="file" name="death_certificate">
                                                @if ($services->death_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/deathcertificate/{{ $services->death_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif ($serviceid == 247 )
                                    <div class="mb-3 col-md-6">
                                        <label for="can_no" class="form-label">Can Number</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->can_no }}" class="form-control" name="can_no"
                                                maxlength="15" placeholder="Can Number" />
                                            
                                        @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->document_page != '')
                                                    <label>பத்திரம் முதல் 2 பக்கம்</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/document_page/{{ $services->document_page }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>பத்திரம் முதல் 2 பக்கம்</label>
                                                <input @if ($services->document_page == '') required @endif
                                                    class="form-control" type="file" name="document_page">
                                                @if ($services->document_page != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/document_page/{{ $services->document_page }}">Download</a><br>
                                                @endif
                                            @endif

                                        @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->Palmistry_page != '')
                                                    <label>கை ரேகை பக்கம் 2</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/Palmistry_page/{{ $services->Palmistry_page }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>கை ரேகை பக்கம் 2</label>
                                                <input @if ($services->Palmistry_page == '') required @endif
                                                    class="form-control" type="file" name="Palmistry_page">
                                                @if ($services->Palmistry_page != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/Palmistry_page/{{ $services->Palmistry_page }}">Download</a><br>
                                                @endif
                                            @endif

                                        @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->oldpatta_chitta != '')
                                                    <label>பழைய பட்டா, சிட்டா, இருந்தால்</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/oldpatta_chitta/{{ $services->oldpatta_chitta }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>பழைய பட்டா, சிட்டா, இருந்தால்</label>
                                                <input @if ($services->oldpatta_chitta == '') required @endif
                                                    class="form-control" type="file" name="oldpatta_chitta">
                                                @if ($services->oldpatta_chitta != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/oldpatta_chitta/{{ $services->oldpatta_chitta }}">Download</a><br>
                                                @endif
                                            @endif

                                        @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->death_certificate != '')
                                                    <label>Death Certificate</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/deathcertificate/{{ $services->death_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>Death Certificate</label>
                                                <input @if ($services->death_certificate == '') required @endif
                                                    class="form-control" type="file" name="death_certificate">
                                                @if ($services->death_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/deathcertificate/{{ $services->death_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->original_document != '')
                                                    <label>ஒரிஜினல் பத்திரம்(ஒரிஜினல் பத்திரம் வங்கியில் இருந்தால்,
                                                 வங்கியிலிருந்து கடிதம்)</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/original_document/{{ $services->original_document }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஒரிஜினல் பத்திரம்(ஒரிஜினல் பத்திரம் வங்கியில் இருந்தால்,
                                                 வங்கியிலிருந்து கடிதம்)</label>
                                                <input @if ($services->original_document == '') required @endif
                                                    class="form-control" type="file" name="original_document">
                                                @if ($services->original_document != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/original_document/{{ $services->original_document }}">Download</a><br>
                                                @endif
                                            @endif

                                        @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->tabasil_property != '')
                                                    <label>தபசில் அல்லது சொத்து விபரம் 2 பக்கம்</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/tabasil_property/{{ $services->tabasil_property }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>தபசில் அல்லது சொத்து விபரம் 2 பக்கம்</label>
                                                <input @if ($services->tabasil_property == '') required @endif
                                                    class="form-control" type="file" name="tabasil_property">
                                                @if ($services->tabasil_property != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/tabasil_property/{{ $services->tabasil_property }}">Download</a><br>
                                                @endif
                                            @endif

                                        @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->anecdotal_evidence != '')
                                                    <label>வில்லங்க சான்று</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/anecdotal_evidence/{{ $services->anecdotal_evidence }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>வில்லங்க சான்று</label>
                                                <input @if ($services->anecdotal_evidence == '') required @endif
                                                    class="form-control" type="file" name="anecdotal_evidence">
                                                @if ($services->anecdotal_evidence != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/anecdotal_evidence/{{ $services->anecdotal_evidence }}">Download</a><br>
                                                @endif
                                            @endif

                                        <label for="survey_no" class="form-label">சர்வே எண் மாறியிருந்தால், புதிய சர்வே எண்
                                                வாரிசு மூலமாக மாற்ற இவற்றுடன் இதனையும் இணைக்க வேண்டும்</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->survey_no }}" class="form-control" name="survey_no"
                                                maxlength="15" placeholder="சர்வே எண் மாறியிருந்தால், புதிய சர்வே எண்" />

                                        @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->heir_proof != '')
                                                    <label>வாரிசு சான்று</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/heir_proof/{{ $services->heir_proof }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>வாரிசு சான்று</label>
                                                <input @if ($services->heir_proof == '') required @endif
                                                    class="form-control" type="file" name="heir_proof">
                                                @if ($services->heir_proof != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/heir_proof/{{ $services->heir_proof }}">Download</a><br>
                                                @endif
                                            @endif
                                    </div>
                                    @elseif($serviceid == 248)
                                          <div class="mb-3 col-md-6">
                                            <label for="patta_no" class="form-label">பட்டா அல்லது சிட்டா எண்</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->patta_no }}" class="form-control number" name="patta_no"
                                                maxlength="20" placeholder="பட்டா அல்லது சிட்டா எண்" />
                                                                                                                            
                                            @if (Auth::user()->id != $apply_user_id )
                                                @if ($services->aadhaar_card != '')
                                                    <label>ஆதார் கார்டு</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஆதார் கார்டு</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="mobile" class="form-label">கைபேசி எண்(ஆதார் அட்டையில் பதிவு                                                செய்யப்பட்ட கைபேசி எண்)</label>
                                            <input  @if (Auth::user()->id != $apply_user_id ) disabled @endif required type="text"
                                                value="{{ $services->mobile }}" class="form-control number" name="mobile"
                                                maxlength="15" placeholder="கைபேசி எண்" />
                                        </div>
                                    @endif
                                   @if (Auth::user()->id != $apply_user_id )
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
                                            <input value="{{ $services->remarks }}" class="form-control" type="text"
                                                name="remarks" maxlength="100" id="remarks" placeholder="Remarks" />
                                        </div>
                                        <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                            <label for="select" class="form-label">Select</label>
                                            <select class="form-control" name="selects" id="select">
                                                <option>select</option>
                                                <option @if ($services->selects == 'Text') selected @endif value = "Text">
                                                    Text</option>
                                                <option @if ($services->selects == 'File') selected @endif value = "File">
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
                                                <option @if ($services->lects == 'Text') selected @endif value = "Text">
                                                    Text</option>
                                                <option @if ($services->lects == 'File') selected @endif value = "File">
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
                                    <button id="save" type="submit" class="btn btn-primary me-2">Submit</button>
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
        var dist_id = "{{ $services->dist_id }}";
        var taluk_id = "{{ $services->taluk_id }}";
        $(function() {
            var status = "{{ $services->status }}";
            var acknowledgement = "{{ $services->acknowledgement }}";
            var certificate = "{{ $services->certificate }}";
            var selects = "{{ $services->selects }}";
            var lects = "{{ $services->lects }}";

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
                }
            });
        }

        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
    </script>
@endpush

