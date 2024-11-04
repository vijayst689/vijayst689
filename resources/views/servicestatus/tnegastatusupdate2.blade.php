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
                            <form class="row g-4" action="{{ url('submit_statusupdate_tnegaservices2') }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
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
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <div class="mb-3 row">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Do You Have Can Number</label>
                                        <div class="col-sm-6">
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif  required name="can_details" id="can_details" class="form-control">
                                                <option value="">Select Can Details</option>
                                                <option @if($services->can_details == "Yes") selected @endif value="Yes">Yes</option>
                                                <option @if($services->can_details == "No") selected @endif value="No">No</option>
                                                <option @if($services->can_details == "Find") selected @endif value="Find">Find Can</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 row" id="cannumberhide" style="display: none;">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Can
                                        Number</label>
                                        <div class="col-sm-6">
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif  class="form-control" id="cannumber" type="text"
                                            name="can_number" value="{{ $services->can_number }}" maxlength="15">
                                        </div>
                                    </div>
                                </div>
                                <h4 class="text-center"> Basic Details </h4>

                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input value="{{ $customers->name }}" readonly  required type="text" class="form-control"
                                    name="name" placeholder="Name"/>


                                    <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                    <input value="{{ $customers->aadhaar_no }}" readonly required type="text" maxlength="12" class="form-control"
                                    name="aadhaar_no" placeholder="Aadhaar Number"/>

                                    <label for="mobile" class="form-label number">Mobile Number</label>
                                    <input value="{{ $customers->phone }}" readonly required type="text" maxlength="10" class="form-control"
                                    name="mobile" placeholder="Mobile Number"/>

                                    <label for="dist_id" class="form-label">District</label>
                                    <select disabled name="dist_id" id="dist_id" class="form-control">
                                        <option value="">Select District</option>
                                        @foreach($districts as $d)
                                        <option @if($d->id == $customers->dist_id) selected @endif value="{{ $d->id }}">{{ $d->district_name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="taluk_id" class="form-label">Taluk</label>
                                    <select disabled name="taluk_id" id="taluk"  class="form-control">
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="panchayath_id" class="form-label">VAO</label>
                                    <select disabled name="panchayath_id" id="panchayath"  class="form-control">
                                    </select>

                                    <label for="aadhaar_card" class="form-label">Aadhaar Card</label>
                                    @if($customers->aadhaar_file == "")
                                    <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                    @else
                                    <br><a target="_blank" href="/upload/services/aadhaar_card/{{ $customers->aadhaar_file }}" class="btn btn-primary me-2">View</a><br>
                                    @endif

                                    <label for="smart_card" class="form-label">Smart Card</label>
                                    @if($customers->smartcard == "")
                                    <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                    @else
                                    <br><a target="_blank" href="/upload/services/smart_card/{{ $customers->smartcard }}" class="btn btn-primary me-2">View</a><br>
                                    @endif
                                    <label for="signature" class="form-label">Signature</label>
                                    @if($customers->signature == "")
                                    <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                    @else
                                    <br><a target="_blank" href="/upload/services/signature/{{ $customers->signature }}" class="btn btn-primary me-2">View</a><br>
                                    @endif
                                    <label for="photo" class="form-label">Photo</label>
                                    @if($customers->profile == "")
                                    <br><a  href="#" class="btn btn-primary me-2">No File Uploaded</a><br>
                                    @else
                                    <br><a target="_blank" href="/upload/services/photo/{{ $customers->profile }}" class="btn btn-primary me-2">View</a><br>
                                    @endif

                                </div>
                            </div>
                            <div class="row">
                                <h4 class="text-center"> Additional Details </h4>




                            @if($serviceid == 22)
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->hus_wife_photo != '')
                                <label>கணவன் மற்றும் மனைவியின் ஒருங்கிணைந்த புகைப்படம்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/hus_wife_photo/{{ $services->hus_wife_photo }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>கணவன் மற்றும் மனைவியின் ஒருங்கிணைந்த புகைப்படம்</label>
                                <input @if ($services->hus_wife_photo == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="hus_wife_photo">
                                @if ($services->hus_wife_photo != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/hus_wife_photo/{{ $services->hus_wife_photo }}">Download</a><br>
                                @endif
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->permanent_social_certificate_groom != '')
                                <label>மணமகனின் நிரந்தர சமூகச் சான்றிதழ்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/permanent_social_certificate_groom/{{ $services->permanent_social_certificate_groom }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>மணமகனின் நிரந்தர சமூகச் சான்றிதழ்</label>
                                <input @if ($services->permanent_social_certificate_groom == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="permanent_social_certificate_groom">
                                @if ($services->permanent_social_certificate_groom != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/permanent_social_certificate_groom/{{ $services->permanent_social_certificate_groom }}">Download</a><br>
                                @endif
                                @endif
                            </div>
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->bride_permanent_social_certificate != '')
                                <label>மணமகளின் நிரந்தர சமூகச் சான்றிதழ்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/bride_permanent_social_certificate/{{ $services->bride_permanent_social_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>மணமகளின் நிரந்தர சமூகச் சான்றிதழ்</label>
                                <input @if ($services->bride_permanent_social_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="bride_permanent_social_certificate">
                                @if ($services->bride_permanent_social_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/bride_permanent_social_certificate/{{ $services->bride_permanent_social_certificate }}">Download</a><br>
                                @endif
                                @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->mrg_registration_certificate != '')
                                <label>திருமணப் பதிவுச் சான்றிதழ்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/mrg_registration_certificate/{{ $services->mrg_registration_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>திருமணப் பதிவுச் சான்றிதழ்</label>
                                <input @if ($services->mrg_registration_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="mrg_registration_certificate">
                                @if ($services->mrg_registration_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/mrg_registration_certificate/{{ $services->mrg_registration_certificate }}">Download</a><br>
                                @endif
                                @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                     @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->anyothers_certificate != '')
                                <label>ஏதேனும் முகவரி ஆதாரம்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/anyothers_certificate/{{ $services->anyothers_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>ஏதேனும் முகவரி ஆதாரம்</label>
                                <input @if ($services->anyothers_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="anyothers_certificate">
                                @if ($services->anyothers_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/anyothers_certificate/{{ $services->anyothers_certificate }}">Download</a><br>
                                @endif
                                @endif
                                </div>
                                 <div class="mb-3 col-md-6"></div>
                                @elseif($serviceid == 23)
                                <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->chitta != '')
                                <label>சிட்டா</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/chitta/{{ $services->chitta }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>சிட்டா</label>
                                <input @if ($services->chitta == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="chitta">
                                @if ($services->chitta != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/chitta/{{ $services->chitta }}">Download</a><br>
                                @endif
                                @endif

                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->aggregation != '')
                                <label>அடங்கல்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/aggregation/{{ $services->aggregation }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>அடங்கல்</label>
                                <input @if ($services->aggregation == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="aggregation">
                                @if ($services->aggregation != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/aggregation/{{ $services->aggregation }}">Download</a><br>
                                @endif
                                @endif

                                </div>
                                <div class="mb-3 col-md-6">
                                     @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->ec_certificate != '')
                                <label>கூட்டுபட்டாவாக இருந்தால் EC சான்றிதழ்  அல்லது பத்திரம் வேண்டும்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/ec_certificate/{{ $services->ec_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>கூட்டுபட்டாவாக இருந்தால் EC சான்றிதழ்  அல்லது பத்திரம் வேண்டும்</label>
                                <input @if ($services->ec_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="ec_certificate">
                                @if ($services->ec_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/ec_certificate/{{ $services->ec_certificate }}">Download</a><br>
                                @endif
                                @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->villankam != '')
                                <label>வில்லங்கம்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/villankam/{{ $services->villankam }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>வில்லங்கம்</label>
                                <input @if ($services->villankam == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="villankam">
                                @if ($services->villankam != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/villankam/{{ $services->villankam }}">Download</a><br>
                                @endif
                                @endif

                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->vao_certificate != '')
                                <label>வீ.ஏ.ஓ சான்று</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/vao_certificate/{{ $services->vao_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>வீ.ஏ.ஓ சான்று</label>
                                <input @if ($services->vao_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="vao_certificate">
                                @if ($services->vao_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/vao_certificate/{{ $services->vao_certificate }}">Download</a><br>
                                @endif
                                @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->self_declaration_certificate != '')
                                <label>சுய வாக்குமூலம்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>சுய வாக்குமூலம்</label>
                                <input @if ($services->self_declaration_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="self_declaration_certificate">
                                @if ($services->self_declaration_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/self_declaration_certificate/{{ $services->self_declaration_certificate }}">Download</a><br>
                                @endif
                                @endif
                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->other_certificate != '')
                                <label>மற்றவைகள் இருந்தால் அதன் நகல்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/other_certificate/{{ $services->other_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>மற்றவைகள் இருந்தால் அதன் நகல்</label>
                                <input @if ($services->other_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="other_certificate">
                                @if ($services->other_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/other_certificate/{{ $services->other_certificate }}">Download</a><br>
                                @endif
                                @endif
                                </div>
                                <div class="mb-3 col-md-6"></div>
                                @elseif($serviceid == 24)
                                <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->bank_pass_book != '')
                                <label>வங்கி பாஸ்புக்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>வங்கி பாஸ்புக்</label>
                                <input @if ($services->bank_pass_book == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="bank_pass_book">
                                @if ($services->bank_pass_book != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/bank_pass_book/{{ $services->bank_pass_book }}">Download</a><br>
                                @endif
                                @endif
                                </div>
                                <div class="mb-3 col-md-6">
                               <label>ஏதேனும் ஐடி ஆதாரம்</label>
                                <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required class="form-control" id="other_certificate" name="any_proof"  style="width: 100%;">
                                    <option value="">Select Id Proof</option>
                                    <option @if($services->any_proof == "Passport") selected @endif value="Passport">Passport</option>
                                    <option @if($services->any_proof == "PAN Card") selected @endif value="PAN Card">PAN Card</option>
                                    <option @if($services->any_proof == "Voter Id") selected @endif value="Voter Id">Voter Id</option>
                                    <option @if($services->any_proof == "Driving License") selected @endif value="Driving License">Driving License</option>
                                </select>

                                <div class="" id="pass_porthide" style="display: none;">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                        @if ($services->passport != '')
                        <label>Passport</label>
                        <br><a target="_blank"
                        href="{{ URL::to('/') }}/upload/services/passport/{{ $services->passport }}"
                        class="btn btn-primary me-2">View</a><br>
                        @endif
                        @else
                        <label>Passport</label>
                        <input @if ($services->passport == '' && $services->any_proof == 'Passport') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="passport" id="pass_port">
                        @if ($services->passport != '')
                        <a target="_blank"
                        href="{{ URL::to('/') }}/upload/services/passport/{{ $services->passport }}">Download</a><br>
                        @endif
                        @endif

                                </div>
                                <div class="" id="pan_cardhide" style="display: none;">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                        @if ($services->pancard != '')
                        <label>PAN கார்டு</label>
                        <br><a target="_blank"
                        href="{{ URL::to('/') }}/upload/services/pancard/{{ $services->pancard }}"
                        class="btn btn-primary me-2">View</a><br>
                        @endif
                        @else
                        <label>PAN கார்டு</label>
                        <input @if ($services->pancard == '' && $services->any_proof == 'PAN Card') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="pancard" id="pan_card">
                        @if ($services->pancard != '')
                        <a target="_blank"
                        href="{{ URL::to('/') }}/upload/services/pancard/{{ $services->pancard }}">Download</a><br>
                        @endif
                        @endif

                                </div>
                                <div class="" id="voteridhide" style="display: none;">
                                     @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                        @if ($services->voterid != '')
                        <label>வாக்காளர் ஐடி</label>
                        <br><a target="_blank"
                        href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}"
                        class="btn btn-primary me-2">View</a><br>
                        @endif
                        @else
                        <label>வாக்காளர் ஐடி</label>
                        <input @if ($services->voterid == '' && $services->any_proof == 'Voter Id') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="voterid" id="voter_id">
                        @if ($services->voterid != '')
                        <a target="_blank"
                        href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voterid }}">Download</a><br>
                        @endif
                        @endif

                                </div>
                                <div class="" id="driving_licensehide" style="display: none;">
                                     @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                        @if ($services->driving_license != '')
                        <label>ஓட்டுநர் உரிமம்</label>
                        <br><a target="_blank"
                        href="{{ URL::to('/') }}/upload/services/driving_license/{{ $services->driving_license }}"
                        class="btn btn-primary me-2">View</a><br>
                        @endif
                        @else
                        <label>ஓட்டுநர் உரிமம்</label>
                        <input @if ($services->driving_license == '' && $services->any_proof == 'Driving License') required @endif class="form-control"
                        type="file" accept="image/jpeg, image/png" name="driving_license" id="drivinglicense">
                        @if ($services->driving_license != '')
                        <a target="_blank"
                        href="{{ URL::to('/') }}/upload/services/driving_license/{{ $services->driving_license }}">Download</a><br>
                        @endif
                        @endif

                                </div>
                                </div>

                                @elseif($serviceid == 25)
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->placement_registration != '')
                                <label>வேலை வாய்ப்பு பதிவு</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/placement_registration/{{ $services->placement_registration }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>வேலை வாய்ப்பு பதிவு</label>
                                <input @if ($services->placement_registration == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="placement_registration">
                                @if ($services->placement_registration != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/placement_registration/{{ $services->placement_registration }}">Download</a><br>
                                @endif
                                @endif

                                </div>
                                <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->school_transfer_certificate != '')
                                <label>பள்ளி மாற்றுச் சான்று</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/school_transfer_certificate/{{ $services->school_transfer_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>பள்ளி மாற்றுச் சான்று</label>
                                <input @if ($services->school_transfer_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="school_transfer_certificate">
                                @if ($services->school_transfer_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/school_transfer_certificate/{{ $services->school_transfer_certificate }}">Download</a><br>
                                @endif
                                @endif

                                </div>
                                <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->study_proof != '')
                                <label>படிப்பு சான்று</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/study_proof/{{ $services->study_proof }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>படிப்பு சான்று</label>
                                <input @if ($services->study_proof == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="study_proof">
                                @if ($services->study_proof != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/study_proof/{{ $services->study_proof }}">Download</a><br>
                                @endif
                                @endif

                                </div>
                                <div class="mb-3 col-md-6">
                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->family_income_certificate != '')
                                <label>குடும்ப வருமான சான்றிதழ்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/family_income_certificate/{{ $services->family_income_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>குடும்ப வருமான சான்றிதழ்</label>
                                <input @if ($services->family_income_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="family_income_certificate">
                                @if ($services->family_income_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/family_income_certificate/{{ $services->family_income_certificate }}">Download</a><br>
                                @endif
                                @endif

                            </div>
                            @elseif($serviceid == 26)
                            <div class="mb-3 col-md-6">
                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->husband_death_certificate != '')
                                <label>கணவன் இறப்பு சான்றிதழ்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/husband_death_certificate/{{ $services->husband_death_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>கணவன் இறப்பு சான்றிதழ்</label>
                                <input @if ($services->husband_death_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="husband_death_certificate">
                                @if ($services->husband_death_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/husband_death_certificate/{{ $services->husband_death_certificate }}">Download</a><br>
                                @endif
                                @endif

                            </div>
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->legal_heir_certificate != '')
                                <label>சட்டப்பூர்வ வாரிசு சான்றிதழ்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/legal_heir_certificate/{{ $services->legal_heir_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>சட்டப்பூர்வ வாரிசு சான்றிதழ்</label>
                                <input @if ($services->legal_heir_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="legal_heir_certificate">
                                @if ($services->legal_heir_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/legal_heir_certificate/{{ $services->legal_heir_certificate }}">Download</a><br>
                                @endif
                                @endif


                            </div>
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->income_certificate != '')
                                <label>வருமானச் சான்றிதழ்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/income_certificate/{{ $services->income_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>வருமானச் சான்றிதழ்</label>
                                <input @if ($services->income_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="income_certificate">
                                @if ($services->income_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/income_certificate/{{ $services->income_certificate }}">Download</a><br>
                                @endif
                                @endif

                            </div>
                            <div class="mb-3 col-md-6">
                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                @if ($services->anyothers_certificate != '')
                                <label>முகவரி ஆதாரம்</label>
                                <br><a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/anyothers_certificate/{{ $services->anyothers_certificate }}"
                                class="btn btn-primary me-2">View</a><br>
                                @endif
                                @else
                                <label>முகவரி ஆதாரம்</label>
                                <input @if ($services->anyothers_certificate == '') required @endif class="form-control"
                                type="file" accept="image/jpeg, image/png" name="anyothers_certificate">
                                @if ($services->anyothers_certificate != '')
                                <a target="_blank"
                                href="{{ URL::to('/') }}/upload/services/anyothers_certificate/{{ $services->anyothers_certificate }}">Download</a><br>
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
                                        @if ($services->status == 'Processing' || $services->status == 'Approved')
                                        <option @if ($services->status == 'Approved') selected @endif
                                            value="Approved">Approved</option>
                                            @endif
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
                                    <div class="text-center"><p id="nopayment"></p></div>
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
        var candetails = "{{ $services->can_details }}";
        var anyproof = "{{ $services->any_proof }}";
        if(anyproof == "Passport"){
           $('#pass_porthide').show("slow");
         }else if(anyproof == "PAN Card"){
            $('#pan_cardhide').show("slow");
         }else if(anyproof == "Voter Id"){
            $('#voteridhide').show("slow");
         }else if(anyproof == "Driving License"){
             $('#driving_licensehide').show("slow");
         }


        if(candetails == "Yes"){
            $('#cannumberhide').show("slow");
            $('#cannumber').prop("required",true);
        }

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


    var customerid = "{{ $customers->id }}";
    $('#can_details').change(function(){
        if($('#can_details').val() == 'Yes') {
            $('#cannumberhide').show("slow");
            $('#cannumber').prop("required",true);
        }else if($('#can_details').val() == 'No'){
            window.location.href = "{{ url('applyservice') }}/"+60+"/"+customerid;
        }else if($('#can_details').val() == 'Find'){
            window.location.href = "{{ url('applyservice') }}/"+121+"/"+customerid;
        } else {
            $('#cannumberhide').hide("slow");
            $('#cannumber').prop("required",false);
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

    $('#other_certificate').change(function(){
        if($('#other_certificate').val() == 'Passport') {
             $('#pass_porthide').show("slow");
             $('#pan_cardhide').hide("slow");
             $('#voter_idhide').hide("slow");
             $('#driving_licensehide').hide("slow");
             $('#pan_card').prop("required",false);
            $('#voter_id').prop("required",false);
            $('#drivinglicense').prop("required",false);
            $('#pass_port').prop("required",true);

        } else if($('#other_certificate').val() == 'PAN Card') {
            $('#pan_cardhide').show("slow");
            $('#pass_porthide').hide("slow");
             $('#voter_idhide').hide("slow");
             $('#driving_licensehide').hide("slow");
             $('#pass_port').prop("required",false);
            $('#voter_id').prop("required",false);
            $('#drivinglicense').prop("required",false);
            $('#pan_card').prop("required",true);

        } else if($('#other_certificate').val() == 'Voter Id') {
            $('#voteridhide').show("slow");
            $('#pass_porthide').hide("slow");
            $('#pan_cardhide').hide("slow");
            $('#driving_licensehide').hide("slow");
            $('#pass_port').prop("required",false);
            $('#drivinglicense').prop("required",false);
            $('#pan_card').prop("required",false);
            $('#voter_id').prop("required",true);

        } else if($('#other_certificate').val() == 'Driving License') {
            $('#driving_licensehide').show("slow");
            $('#pass_porthide').hide("slow");
            $('#pan_cardhide').hide("slow");
            $('#voteridhide').hide("slow");
            $('#pass_port').prop("required",false);
            $('#voter_id').prop("required",false);
            $('#pan_card').prop("required",false);
            $('#drivinglicense').prop("required",true);
        } else{
            $('#driving_licensehide').hide("slow");
            $('#pass_porthide').hide("slow");
            $('#pan_cardhide').hide("slow");
            $('#voteridhide').hide("slow");
            $('#pass_port').prop("required",false);
            $('#pan_card').prop("required",false);
            $('#voter_id').prop("required",false);
            $('#drivinglicense').prop("required",false);

        }
    });
</script>
@endpush
