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
                            <form action="{{ url('/submitsmartcard_register_update') }}" id="formAccountSettings"
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
                                        if ($services->distributor_id == 0 && $services->retailer_id == 0) {
                                            $apply_user_id = $services->user_id;
                                        }
                                        elseif ($services->retailer_id == 0) {
                                            $apply_user_id = $services->distributor_id;
                                        } elseif ($services->distributor_id == 0) {
                                            $apply_user_id = $services->retailer_id;
                                        }
                                    @endphp

                                    @if ($serviceid == 37)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                value="{{ $services->name }}" class="form-control" name="name"
                                                maxlength="30" placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required type="text"
                                                maxlength="10" class="form-control number" value="{{ $services->mobile }}"
                                                name="mobile" placeholder="Mobile No" />

                                            <label for="dist_id" class="form-label">மாவட்டம்</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif name="dist_id"
                                                id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option @if ($d->id == $services->dist_id) selected @endif
                                                        value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>ஆதார் அட்டை</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஆதார் அட்டை</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->smart_card != '')
                                                    <label>ஸ்மார்ட் கார்டு</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஸ்மார்ட் கார்டு</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->photo != '')
                                                    <label>புகைப்படம்</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>புகைப்படம்</label>
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif($serviceid == 43)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->name }}" class="form-control"
                                                name="name" maxlength="30" placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" maxlength="10" class="form-control number"
                                                value="{{ $services->mobile }}" name="mobile"
                                                placeholder="Mobile No" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>ஆதார் அட்டை</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஆதார் அட்டை</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->smart_card != '')
                                                    <label>ஸ்மார்ட் கார்டு</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஸ்மார்ட் கார்டு</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->photo != '')
                                                    <label>புகைப்படம்</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>புகைப்படம்</label>
                                                <input @if ($services->photo == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="photo">
                                                @if ($services->photo != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif($serviceid == 41)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->name }}" class="form-control"
                                                name="name" maxlength="30" placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" maxlength="10" class="form-control number"
                                                value="{{ $services->mobile }}" name="mobile"
                                                placeholder="Mobile No" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->smart_card != '')
                                                    <label>ஸ்மார்ட் கார்டு</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஸ்மார்ட் கார்டு</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <h4 class="text-center"> Additional Details </h4>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Choose Proof</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required id="new_proof" name="new_proof" class="form-control">
                                                <option value="">ஏதேனும் ஒரு ஆவணம்</option>
                                                <option @if ($services->new_proof == 'ஆதார் அட்டை') selected @endif value="ஆதார் அட்டை">ஆதார் அட்டை</option>
                                                <option @if ($services->new_proof == 'பிறப்பு சான்றிதழ்') selected @endif value="பிறப்பு சான்றிதழ்">பிறப்பு சான்றிதழ்</option>
                                                <option @if ($services->new_proof == 'வாக்காளர் அட்டை') selected @endif value="வாக்காளர் அட்டை">வாக்காளர் அட்டை</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                        <div class="" id="adh_hide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>ஆதார் அட்டை</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஆதார் அட்டை</label>
                                                <input @if ($services->aadhaar_card == '') @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png" id="adhar"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="" id="born_hide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->birth_certificate != '')
                                                    <label>பிறப்பு சான்றிதழ்</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/birth_certificate/{{ $services->birth_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>பிறப்பு சான்றிதழ்</label>
                                                <input @if ($services->birth_certificate == '') @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png" id="born"
                                                    name="birth_certificate">
                                                @if ($services->birth_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/birth_certificate/{{ $services->birth_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="" id="voterhide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->voter_id != '')
                                                    <label>வாக்காளர் அட்டை</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voter_id }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>வாக்காளர் அட்டை</label>
                                                <input @if ($services->voter_id == '') @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png" id="voter"
                                                    name="voter_id">
                                                @if ($services->voter_id != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voter_id }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        </div>
                                    @elseif($serviceid == 38)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->name }}" class="form-control"
                                                name="name" maxlength="30" placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" maxlength="10" class="form-control number"
                                                value="{{ $services->mobile }}" name="mobile"
                                                placeholder="Mobile No" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>ஆதார் அட்டை</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஆதார் அட்டை</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->smart_card != '')
                                                    <label>ஸ்மார்ட் கார்டு</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஸ்மார்ட் கார்டு</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <h4 class="text-center"> Additional Details </h4>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Choose Proof</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required id="any_proof" name="any_proof" class="form-control">
                                                <option value="">ஏதேனும் ஒரு ஆவணம்</option>
                                                <option @if ($services->any_proof == 'இறப்பு சான்றிதழ்') selected @endif value="இறப்பு சான்றிதழ்">இறப்பு சான்றிதழ்</option>
                                                <option @if ($services->any_proof == 'திருமண சான்று') selected @endif value="திருமண சான்று">திருமண சான்று</option>
                                                <option @if ($services->any_proof == 'திருமண பத்திரிக்கை') selected @endif value="திருமண பத்திரிக்கை">திருமண பத்திரிக்கை</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                        <div class="" id="death_hide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->death_certificate != '')
                                                    <label>இறப்பு சான்றிதழ் </label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/deathcertificate/{{ $services->death_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>இறப்பு சான்றிதழ் </label>
                                                <input id="death" @if ($services->death_certificate == '')  @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="death_certificate">
                                                @if ($services->death_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/deathcertificate/{{ $services->death_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="" id="invite_hide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->mrg_invitation != '')
                                                    <label>திருமண பத்திரிக்கை </label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/mrginvitation/{{ $services->mrg_invitation }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>திருமண பத்திரிக்கை</label>
                                                <input id="invite" @if ($services->mrg_invitation == '')  @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="mrg_invitation">
                                                @if ($services->mrg_invitation != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/mrginvitation/{{ $services->mrg_invitation }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="" id="maraige_hide" style="display: none">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->mrg_certificate != '')
                                                    <label>திருமண சான்று</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/mrgcertificate/{{ $services->mrg_certificate }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>திருமண சான்று </label>
                                                <input id="maraige" @if ($services->mrg_certificate == '')  @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="mrg_certificate">
                                                @if ($services->mrg_certificate != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/mrgcertificate/{{ $services->mrg_certificate }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                        </div>
                                    @elseif($serviceid == 39)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->name }}" class="form-control"
                                                name="name" maxlength="30" placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" maxlength="10" class="form-control number"
                                                value="{{ $services->mobile }}" name="mobile"
                                                placeholder="Mobile No" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>ஆதார் அட்டை</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஆதார் அட்டை</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->smart_card != '')
                                                    <label>ஸ்மார்ட் கார்டு</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஸ்மார்ட் கார்டு</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                        </div>
                                    @elseif($serviceid == 42)
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label">பெயர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" value="{{ $services->name }}" class="form-control"
                                                name="name" maxlength="30" placeholder="Name" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                type="text" maxlength="10" class="form-control number"
                                                value="{{ $services->mobile }}" name="mobile"
                                                placeholder="Mobile No" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->aadhaar_card != '')
                                                    <label>ஆதார் அட்டை</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஆதார் அட்டை</label>
                                                <input @if ($services->aadhaar_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="aadhaar_card">
                                                @if ($services->aadhaar_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                @if ($services->smart_card != '')
                                                    <label>ஸ்மார்ட் கார்டு</label>
                                                    <br><a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}"
                                                        class="btn btn-primary me-2">View</a><br>
                                                @endif
                                            @else
                                                <label>ஸ்மார்ட் கார்டு</label>
                                                <input @if ($services->smart_card == '') required @endif
                                                    class="form-control" type="file" accept="image/jpeg, image/png"
                                                    name="smart_card">
                                                @if ($services->smart_card != '')
                                                    <a target="_blank"
                                                        href="{{ URL::to('/') }}/upload/services/smart_card/{{ $services->smart_card }}">Download</a><br>
                                                @endif
                                            @endif
                                            <label class="form-label">ஏதேனும் ஒரு ஆவணம்</label>
                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                id="any_document" name="any_document" class="form-control">
                                                <option value="">ஏதேனும் ஒரு ஆவணம்</option>
                                                <option @if ($services->any_document == 'ஆதார் அட்டை') selected @endif
                                                    value="ஆதார் அட்டை">
                                                    ஆதார்
                                                    அட்டை</option>
                                                <option @if ($services->any_document == 'வாக்காளர் அடையாள அட்டை') selected @endif
                                                    value="வாக்காளர் அடையாள அட்டை">வாக்காளர் அடையாள அட்டை</option>
                                                <option @if ($services->any_document == 'பாஸ்போர்ட்') selected @endif
                                                    value="பாஸ்போர்ட்">
                                                    பாஸ்போர்ட்</option>
                                                <option @if ($services->any_document == 'மின்சார கட்டணம் ரசீது') selected @endif
                                                    value="மின்சார கட்டணம் ரசீது">மின்சார கட்டணம் ரசீது</option>
                                                <option @if ($services->any_document == 'தொலைபேசி கட்டணம்') selected @endif
                                                    value="தொலைபேசி கட்டணம்">
                                                    தொலைபேசி கட்டணம்</option>
                                                <option @if ($services->any_document == 'எரிவாயு சிலிண்டர் ரசீது') selected @endif
                                                    value="எரிவாயு சிலிண்டர் ரசீது">எரிவாயு சிலிண்டர் ரசீது</option>
                                                <option @if ($services->any_document == 'விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி') selected @endif
                                                    value="விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி">
                                                    விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி</option>
                                                <option @if ($services->any_document == 'வாடகை ஒப்பந்த பத்திரம்') selected @endif
                                                    value="வாடகை ஒப்பந்த பத்திரம்">வாடகை ஒப்பந்த பத்திரம்</option>
                                                <option @if (
                                                    $services->any_document ==
                                                        'குடிசை மாற்று
                                                                                                                                                                                                                                                                                                                    வாரியத்தின் ஒதுக்கீடு ஆணை') selected @endif
                                                    value="குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை">குடிசை மாற்று
                                                    வாரியத்தின் ஒதுக்கீடு ஆணை</option>
                                                <option @if ($services->any_document == 'கொத்தடிமை விடுப்பு சான்று') selected @endif
                                                    value="கொத்தடிமை விடுப்பு சான்று">கொத்தடிமை விடுப்பு சான்று
                                                </option>
                                                <option @if (
                                                    $services->any_document ==
                                                        'வங்கி கணக்கு
                                                                                                                                                                                                                                                                                                                    புத்தகத்தின் முதல் பக்கம்') selected @endif
                                                    value="வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்">வங்கி கணக்கு
                                                    புத்தகத்தின் முதல் பக்கம்</option>
                                            </select>
                                            <div class="" id="aadhaar_cardhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->aadhaar_card != '')
                                                        <label>ஆதார் அட்டை</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>ஆதார் அட்டை</label>
                                                    <input @if ($services->aadhaar_card == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" id="aadhaar_card"
                                                        name="aadhaar_card">
                                                    @if ($services->aadhaar_card != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="voteridhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->voter_id != '')
                                                        <label>வாக்காளர் அட்டை</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voter_id }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>வாக்காளர் அட்டை</label>
                                                    <input @if ($services->voter_id == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" id="voterid" name="voter_id">
                                                    @if ($services->voter_id != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voter_id }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="passporthide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->passport != '')
                                                        <label>பாஸ்போர்ட்</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/passport/{{ $services->passport }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>பாஸ்போர்ட்</label>
                                                    <input @if ($services->passport == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" id="passport" name="passport">
                                                    @if ($services->passport != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/passport/{{ $services->passport }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="electricity_bill_receipthide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->electricity_bill_receipt != '')
                                                        <label>மின்சார கட்டணம் ரசீது</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/electricity_bill/{{ $services->electricity_bill_receipt }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>மின்சார கட்டணம் ரசீது</label>
                                                    <input @if ($services->electricity_bill_receipt == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" id="electricity_bill_receipt"
                                                        name="electricity_bill_receipt">
                                                    @if ($services->electricity_bill_receipt != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/electricity_bill/{{ $services->electricity_bill_receipt }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="telephone_chargeshide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->telephone_charges != '')
                                                        <label>தொலைபேசி கட்டணம்</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/telephonebill/{{ $services->telephone_charges }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>தொலைபேசி கட்டணம்</label>
                                                    <input @if ($services->telephone_charges == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" id="telephone_charges"
                                                        name="telephone_charges">
                                                    @if ($services->telephone_charges != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/telephonebill/{{ $services->telephone_charges }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="gas_cylinder_receipthide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->gas_cylinder_receipt != '')
                                                        <label>எரிவாயு சிலிண்டர் ரசீது</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/gas_cylinder/{{ $services->gas_cylinder_receipt }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>எரிவாயு சிலிண்டர் ரசீது</label>
                                                    <input @if ($services->gas_cylinder_receipt == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" id="gas_cylinder_receipt"
                                                        name="gas_cylinder_receipt">
                                                    @if ($services->gas_cylinder_receipt != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/gas_cylinder/{{ $services->gas_cylinder_receipt }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="property_tax_applicant_owns_househide"
                                                style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->property_tax_applicant_owns_house != '')
                                                        <label>விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax_applicant_owns_house }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி</label>
                                                    <input @if ($services->property_tax_applicant_owns_house == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png"
                                                        id="property_tax_applicant_owns_house"
                                                        name="property_tax_applicant_owns_house">
                                                    @if ($services->property_tax_applicant_owns_house != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax_applicant_owns_house }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="lease_deedhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->lease_deed != '')
                                                        <label>வாடகை ஒப்பந்த பத்திரம்</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/lease_deed/{{ $services->lease_deed }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>வாடகை ஒப்பந்த பத்திரம்</label>
                                                    <input @if ($services->lease_deed == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" id="lease_deed" name="lease_deed">
                                                    @if ($services->lease_deed != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/lease_deed/{{ $services->lease_deed }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="allotment_rder_of_slum_replacement_boardhide"
                                                style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->allotment_rder_of_slum_replacement_board != '')
                                                        <label>குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/allotment/{{ $services->allotment_rder_of_slum_replacement_board }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை</label>
                                                    <input @if ($services->allotment_rder_of_slum_replacement_board == '')  @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png"
                                                        id="allotment_rder_of_slum_replacement_board"
                                                        name="allotment_rder_of_slum_replacement_board">
                                                    @if ($services->allotment_rder_of_slum_replacement_board != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/allotment/{{ $services->allotment_rder_of_slum_replacement_board }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="bond_leave_proofhide" style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->bond_leave_proof != '')
                                                        <label>கொத்தடிமை விடுப்பு சான்று</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/bond_leave/{{ $services->bond_leave_proof }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>கொத்தடிமை விடுப்பு சான்று</label>
                                                    <input @if ($services->bond_leave_proof == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" id="bond_leave_proof"
                                                        name="bond_leave_proof">
                                                    @if ($services->bond_leave_proof != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/bond_leave/{{ $services->bond_leave_proof }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="" id="first_page_of_bank_account_bookhide"
                                                style="display: none;">
                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->first_page_of_bank_account_book != '')
                                                        <label>வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/first_page_of_bank/{{ $services->first_page_of_bank_account_book }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்</label>
                                                    <input @if ($services->first_page_of_bank_account_book == '') @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png"
                                                        id="first_page_of_bank_account_book"
                                                        name="first_page_of_bank_account_book">
                                                    @if ($services->first_page_of_bank_account_book != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/first_page_of_bank/{{ $services->first_page_of_bank_account_book }}">Download</a><br>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                        @elseif($serviceid == 36)
                                            <h4 class="text-center"> குடும்ப தலைவர் விபரம்</h4>
                                            <div class="mb-3 col-md-6">
                                                <label for="family_head_name" class="form-label">குடும்ப தலைவர்
                                                    பெயர்(தமிழில் மட்டும்)</label>
                                                <select required id="family_head_name" name="family_head_name"
                                                    class="form-control">
                                                    <option value="">குடும்ப தலைவர் பெயரை உள்ளிடவும்</option>
                                                    <option @if ($services->family_head_name == 'திரு.') selected @endif
                                                        value="திரு.">
                                                        திரு.
                                                    </option>
                                                    <option @if ($services->family_head_name == 'திருமதி.') selected @endif
                                                        value="திருமதி.">
                                                        திருமதி.
                                                    </option>
                                                    <option @if ($services->family_head_name == 'செல்வி.') selected @endif
                                                        value="செல்வி.">
                                                        செல்வி.
                                                    </option>
                                                </select>

                                                <label for="name_tamil" class="form-label number">பெயர் தமிழில்</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" maxlength="30" class="form-control"
                                                    value="{{ $services->name_tamil }}" name="name_tamil"
                                                    placeholder="பெயர் தமிழில்" />

                                                <label for="father_or_husband_tamil" class="form-label">தந்தை / கணவர்
                                                    பெயர்</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" maxlength="30" class="form-control"
                                                    value="{{ $services->father_or_husband_tamil }}"
                                                    name="father_or_husband_tamil" placeholder="தந்தை / கணவர் பெயர்" />

                                                <label for="address_tamil_1" class="form-label">முகவரி வரி 1</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control" maxlength="200"
                                                    value="{{ $services->address_tamil_1 }}" name="address_tamil_1"
                                                    placeholder="முகவரி வரி 1" />

                                                <label for="address_tamil_2" class="form-label">முகவரி வரி 2</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control" maxlength="200"
                                                    value="{{ $services->address_tamil_2 }}" name="address_tamil_2"
                                                    placeholder="முகவரி வரி 2" />

                                                <label for="address_tamil_3" class="form-label">முகவரி வரி 3</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control" maxlength="200"
                                                    value="{{ $services->address_tamil_3 }}" name="address_tamil_3"
                                                    placeholder="முகவரி வரி 3" />

                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->aadhaar_card != '')
                                                        <label>ஆதார் அட்டை</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>ஆதார் அட்டை</label>
                                                    <input @if ($services->aadhaar_card == '') required @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="aadhaar_card">
                                                    @if ($services->aadhaar_card != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                    @endif
                                                @endif

                                                @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                    @if ($services->family_head_photo != '')
                                                        <label>குடும்ப தலைவர்
                                                            புகைப்படம்</label>
                                                        <br><a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/family_head_photo/{{ $services->family_head_photo }}"
                                                            class="btn btn-primary me-2">View</a><br>
                                                    @endif
                                                @else
                                                    <label>குடும்ப தலைவர்
                                                        புகைப்படம்</label>
                                                    <input @if ($services->family_head_photo == '') required @endif
                                                        class="form-control" type="file"
                                                        accept="image/jpeg, image/png" name="family_head_photo">
                                                    @if ($services->family_head_photo != '')
                                                        <a target="_blank"
                                                            href="{{ URL::to('/') }}/upload/services/family_head_photo/{{ $services->family_head_photo }}">Download</a><br>
                                                    @endif
                                                @endif

                                                <label for="monthly_income" class="form-label">மாத வருமானம் </label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control number"
                                                    value="{{ $services->monthly_income }}" name="monthly_income"
                                                    maxlength="10" placeholder="மாத வருமானம்" />

                                                <label for="email_id" class="form-label">மின்னஞ்சல் முகவரி </label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    maxlength="40" type="text" class="form-control" name="email_id"
                                                    value="{{ $services->email_id }}" placeholder="மின்னஞ்சல் முகவரி" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="name_tamil" class="form-label">Name of Family Head</label>
                                                <select id="name_tamil" name="name_tamil" class="form-control">
                                                    <option value="">Select Name of Family Head</option>
                                                    <option @if ($services->name_tamil == 'Mr.') selected @endif
                                                        value="Mr.">Mr.
                                                    </option>
                                                    <option @if ($services->name_tamil == 'Mrs.') selected @endif
                                                        value="Mrs.">
                                                        Mrs.
                                                    </option>
                                                    <option @if ($services->name_tamil == 'Ms.') selected @endif
                                                        value="Ms.">Ms.
                                                    </option>
                                                </select>

                                                <label for="name_english" class="form-label">Name in English</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control" name="name_english"
                                                    value="{{ $services->name_english }}"
                                                    placeholder="Name in English" />

                                                <label for="father_or_husband_english" class="form-label">Father's /
                                                    Husband's</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control"
                                                    value="{{ $services->father_or_husband_english }}"
                                                    name="father_or_husband_english"
                                                    placeholder="Father's / Husband's in English" />

                                                <label for="address_english_1" class="form-label">Address Line 1</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control"
                                                    value="{{ $services->address_english_1 }}" name="address_english_1"
                                                    placeholder="Address Line 1" />

                                                <label for="address_english_2" class="form-label">Address Line 2</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control"
                                                    value="{{ $services->address_english_2 }}" name="address_english_2"
                                                    placeholder="Address Line 2" />

                                                <label for="address_english_3" class="form-label">Address Line 3</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control"
                                                    value="{{ $services->address_english_3 }}" name="address_english_3"
                                                    placeholder="Address Line 3" />

                                                <label for="pin_code" class="form-label">Pin Code</label>
                                                <input @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                    type="text" class="form-control" name="pin_code"
                                                    value="{{ $services->pin_code }}" placeholder="Pin Code" />

                                                <label for="dist_id" class="form-label">District</label>
                                                <select disabled name="dist_id" id="dist_id" class="form-control">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $d)
                                                        <option @if ($d->id == $customers->dist_id) selected @endif
                                                            value="{{ $d->id }}">{{ $d->district_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <label for="taluk_id" class="form-label">Taluk</label>
                                                <select disabled name="taluk_id" id="taluk" class="form-control">
                                                </select>

                                                <label for="panchayath_id" class="form-label">VAO</label>
                                                <select disabled name="panchayath_id" id="panchayath"
                                                    class="form-control">
                                                </select>
                                            </div>

                                            <table id="pricetable" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>உறவுமுறை</th>
                                                        <th>Name</th>
                                                        <th>DOB</th>
                                                        <th>Living Status</th>
                                                        <th>Aadhaar Card</th>
                                                        <th><a class="btn btn-sm btn-success" onclick="addnewrow()"><i
                                                                    class='bx bx-plus-medical'></i></a></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td> <select required name="relationship[]" class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="Mother">தாய்</option>
                                                                <option value="Father">தந்தை</option>
                                                                <option value="Husband">கணவர்</option>
                                                                <option value="Wife">மனைவி</option>
                                                                <option value="Son">மகன்</option>
                                                                <option value="Daughter">மகள்</option>
                                                                <option value="Father In Law">மாமனார்</option>
                                                                <option value="Mother In Law">மாமியார்</option>
                                                                <option value="Son In Law">மருமகன்</option>
                                                                <option value="Daughter In Law">மருமகள்</option>
                                                            </select></td>

                                                        <td><input required class="form-control" type="text"
                                                                name="relation_name[]" maxlength="70"></td>
                                                        <td><input required class="form-control" type="date"
                                                                name="relation_dob[]">
                                                        </td>
                                                        <td><select required name="maritial_status[]"
                                                                class="form-control">
                                                                <option value="">Select</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Single">Single</option>
                                                                <option value="Divorced">Divorced</option>
                                                            </select></td>
                                                        <td>
                                                            <input required class="form-control" type="file"
                                                                name="doc[]" accept="image/jpeg, image/png">
                                                        </td>
                                                        <td><a onClick='removerow()'
                                                                class='btn btn-sm btn-danger btnDelete'><i
                                                                    class='bx bx-trash'></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <h4 class="text-center"> எரிவாயு இணைப்பு பற்றிய விவரங்கள் </h4>
                                            <div class="mb-3 col-md-6">
                                                <label for="gas_connection_no" class="form-label">எரிவாயு இணைப்பு
                                                    எண்</label>
                                                <select required id="gas_connection_no" name="gas_connection_no"
                                                    class="form-control">
                                                    <option value="">அட்டை தேர்வு</option>
                                                    <option @if ($services->gas_connection_no == '0') selected @endif
                                                        value="0">0
                                                    </option>
                                                    <option @if ($services->gas_connection_no == '1') selected @endif
                                                        value="1">1
                                                    </option>
                                                    <option @if ($services->gas_connection_no == '2') selected @endif
                                                        value="2">2
                                                    </option>
                                                    <option @if ($services->gas_connection_no == '3') selected @endif
                                                        value="3">3
                                                    </option>
                                                    <option @if ($services->gas_connection_no == '4') selected @endif
                                                        value="4">4
                                                    </option>
                                                    <option @if ($services->gas_connection_no == '5') selected @endif
                                                        value="5">5
                                                    </option>
                                                    <option @if ($services->gas_connection_no == 'இல்லை') selected @endif
                                                        value="இல்லை">
                                                        இல்லை
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <h4 class="text-center"> கூடுதல் ஆவணம் </h4>
                                            <div class="mb-3 col-md-6">

                                                <label for="card_selection" class="form-label">அட்டை தேர்வு</label>
                                                <select required id="card_selection" name="card_selection"
                                                    class="form-control">
                                                    <option value="">அட்டை தேர்வு</option>
                                                    <option @if ($services->card_selection == 'No Commodity Card') selected @endif
                                                        value="No Commodity Card">
                                                        பண்டகமில்லா அட்டை( No Commodity Card
                                                        )</option>
                                                    <option @if ($services->card_selection == 'Rice Card') selected @endif
                                                        value="Rice Card">
                                                        அரிசி
                                                        அட்டை(Rice Card)</option>
                                                    <option @if ($services->card_selection == 'Sugar Card') selected @endif
                                                        value="Sugar Card">
                                                        சர்க்கரை அட்டை(Sugar Card)</option>
                                                    <option @if ($services->card_selection == 'Others') selected @endif
                                                        value="Others">
                                                        மற்றவை(Others)</option>
                                                </select>
                                                <div class="" id="commodity_card" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->commodity_card != '')
                                                            <label>பண்டகமில்லா அட்டை</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/commodity/{{ $services->commodity_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>பண்டகமில்லா அட்டை</label>
                                                        <input @if ($services->commodity_card == '') @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="commodity_card"
                                                            id="voterid">
                                                        @if ($services->commodity_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/commodity/{{ $services->commodity_card }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="passporthide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->rice_card != '')
                                                            <label>அரிசி அட்டை</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/ricecard/{{ $services->rice_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>அரிசி அட்டை</label>
                                                        <input @if ($services->rice_card == '') @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="rice_card"
                                                            id="passport">
                                                        @if ($services->rice_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/ricecard/{{ $services->rice_card }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="electricity_bill_receipt" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->sugar_card != '')
                                                            <label>சர்க்கரை அட்டை</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/sugarcard/{{ $services->sugar_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>சர்க்கரை அட்டை</label>
                                                        <input @if ($services->sugar_card == '') @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="sugar_card"
                                                            id="sugar_card">
                                                        @if ($services->sugar_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/sugarcard/{{ $services->sugar_card }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="telephone_charges" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->others != '')
                                                            <label>மற்றவை</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/others/{{ $services->others }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>மற்றவை</label>
                                                        <input @if ($services->others == '') @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="others"
                                                            id="telephone_charges">
                                                        @if ($services->others != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/others/{{ $services->others }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="residence_proof" class="form-label">குடியிருப்புச்
                                                    சான்று</label>
                                                <select required id="residence_proof" name="residence_proof"
                                                    class="form-control">
                                                    <option value="">குடியிருப்புச் சான்று</option>
                                                    <option @if ($services->residence_proof == 'ஆதார் அட்டை') selected @endif
                                                        value="ஆதார் அட்டை">ஆதார் அட்டை</option>
                                                    <option @if ($services->residence_proof == 'மின்சாரக் கட்டணம்') selected @endif
                                                        value="மின்சாரக் கட்டணம்">மின்சாரக் கட்டணம்</option>
                                                    <option @if ($services->residence_proof == 'வங்கி கணக்குப் புத்தகத்தின் முன் பக்கம்') selected @endif
                                                        value="வங்கி கணக்குப் புத்தகத்தின் முன் பக்கம்">வங்கி கணக்குப்
                                                        புத்தகத்தின் முன் பக்கம்</option>
                                                    <option @if ($services->residence_proof == 'எரிவாயு நுகர்வோர் அட்டை') selected @endif
                                                        value="எரிவாயு நுகர்வோர் அட்டை">எரிவாயு நுகர்வோர் அட்டை
                                                    </option>
                                                    <option @if ($services->residence_proof == 'சொந்த வீடு இருந்தால் அதன் சொத்து வரி') selected @endif
                                                        value="சொந்த வீடு இருந்தால் அதன் சொத்து வரி"> சொந்த வீடு
                                                        இருந்தால் அதன் சொத்து வரி</option>
                                                    <option @if ($services->residence_proof == 'பாஸ்போர்ட்') selected @endif
                                                        value="பாஸ்போர்ட்">பாஸ்போர்ட்</option>
                                                    <option @if ($services->residence_proof == 'வாடகை ஒப்பந்தம் (வாடகைக்கு குடியிருப்போருக்கு)') selected @endif
                                                        value="வாடகை ஒப்பந்தம் (வாடகைக்கு குடியிருப்போருக்கு)">வாடகை
                                                        ஒப்பந்தம் (வாடகைக்கு குடியிருப்போருக்கு)</option>
                                                    <option @if (
                                                        $services->residence_proof ==
                                                            'குடிசை மாற்று
                                                                                                                                                                                                            வாரியத்தின் ஒதுக்கீட்டு ஆணை') selected @endif
                                                        value="குடிசை மாற்று வாரியத்தின் ஒதுக்கீட்டு ஆணை">குடிசை மாற்று
                                                        வாரியத்தின் ஒதுக்கீட்டு ஆணை</option>
                                                    <option @if ($services->residence_proof == 'தொலைபேசி கட்டணம்') selected @endif
                                                        value="தொலைபேசி கட்டணம்">தொலைபேசி கட்டணம்</option>
                                                    <option @if ($services->residence_proof == 'வாக்காளர் அடையாள அட்டை') selected @endif
                                                        value="வாக்காளர் அடையாள அட்டை">வாக்காளர் அடையாள அட்டை</option>
                                                    <option @if ($services->residence_proof == 'கொத்தடிமை விடுவிப்புச் சான்று') selected @endif
                                                        value="கொத்தடிமை விடுவிப்புச் சான்று"> கொத்தடிமை விடுவிப்புச்
                                                        சான்று</option>
                                                </select>

                                                <div class="" id="aadhaar_card" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->aadhaar_card != '')
                                                            <label>ஆதார் அட்டை</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>ஆதார் அட்டை</label>
                                                        <input @if ($services->aadhaar_card == '') @endif
                                                            class="form-control" type="file"
                                                            accept="image/jpeg, image/png" name="aadhaar_card"
                                                            id="aadhaar_card">
                                                        @if ($services->aadhaar_card != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="voterid" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->voter_id != '')
                                                            <label>வாக்காளர் அட்டை</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voter_id }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>வாக்காளர் அட்டை</label>
                                                        <input @if ($services->voter_id == '') @endif
                                                            class="form-control" id="voterid" type="file"
                                                            accept="image/jpeg, image/png" name="voter_id">
                                                        @if ($services->voter_id != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/voterid/{{ $services->voter_id }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="passporthide" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->passport != '')
                                                            <label>பாஸ்போர்ட்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/passport/{{ $services->passport }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>பாஸ்போர்ட்</label>
                                                        <input @if ($services->passport == '') @endif
                                                            class="form-control" id="passport" type="file"
                                                            accept="image/jpeg, image/png" name="passport">
                                                        @if ($services->passport != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/passport/{{ $services->passport }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="electricity_bill_receipt" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->electricity_bill_receipt != '')
                                                            <label>மின்சார கட்டணம் ரசீது</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/electricity_bill/{{ $services->electricity_bill_receipt }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>மின்சார கட்டணம் ரசீது</label>
                                                        <input @if ($services->electricity_bill_receipt == '') @endif
                                                            class="form-control" id="electricity_bill_receipt"
                                                            type="file" accept="image/jpeg, image/png"
                                                            name="electricity_bill_receipt">
                                                        @if ($services->electricity_bill_receipt != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/electricity_bill/{{ $services->electricity_bill_receipt }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="telephone_charges" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->telephone_charges != '')
                                                            <label>தொலைபேசி கட்டணம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/telephonebill/{{ $services->telephone_charges }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>தொலைபேசி கட்டணம்</label>
                                                        <input @if ($services->telephone_charges == '') @endif
                                                            class="form-control" id="telephone_charges" type="file"
                                                            accept="image/jpeg, image/png" name="telephone_charges">
                                                        @if ($services->telephone_charges != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/telephonebill/{{ $services->telephone_charges }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="gas_cylinder_receipt" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->gas_cylinder_receipt != '')
                                                            <label>எரிவாயு சிலிண்டர் ரசீது</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/gas_cylinder/{{ $services->gas_cylinder_receipt }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>எரிவாயு சிலிண்டர் ரசீது</label>
                                                        <input @if ($services->gas_cylinder_receipt == '') @endif
                                                            class="form-control" id="gas_cylinder_receipt" type="file"
                                                            accept="image/jpeg, image/png" name="gas_cylinder_receipt">
                                                        @if ($services->gas_cylinder_receipt != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/gas_cylinder/{{ $services->gas_cylinder_receipt }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="property_tax_applicant_owns_house"
                                                    style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->property_tax_applicant_owns_house != '')
                                                            <label>விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து
                                                                வரி</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax_applicant_owns_house }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி</label>
                                                        <input @if ($services->property_tax_applicant_owns_house == '') @endif
                                                            class="form-control" id="property_tax_applicant_owns_house"
                                                            type="file" accept="image/jpeg, image/png"
                                                            name="property_tax_applicant_owns_house">
                                                        @if ($services->property_tax_applicant_owns_house != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax_applicant_owns_house }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="lease_deed" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->lease_deed != '')
                                                            <label>வாடகை ஒப்பந்த பத்திரம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/lease_deed/{{ $services->lease_deed }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>வாடகை ஒப்பந்த பத்திரம்</label>
                                                        <input @if ($services->lease_deed == '') @endif
                                                            class="form-control" id="lease_deed" type="file"
                                                            accept="image/jpeg, image/png" name="lease_deed">
                                                        @if ($services->lease_deed != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/lease_deed/{{ $services->lease_deed }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="allotment_rder_of_slum_replacement_board"
                                                    style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->allotment_rder_of_slum_replacement_board != '')
                                                            <label>குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/allotment/{{ $services->allotment_rder_of_slum_replacement_board }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை</label>
                                                        <input @if ($services->allotment_rder_of_slum_replacement_board == '') @endif
                                                            class="form-control"
                                                            id="allotment_rder_of_slum_replacement_board" type="file"
                                                            accept="image/jpeg, image/png"
                                                            name="allotment_rder_of_slum_replacement_board">
                                                        @if ($services->allotment_rder_of_slum_replacement_board != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/allotment/{{ $services->allotment_rder_of_slum_replacement_board }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="bond_leave_proof" style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->bond_leave_proof != '')
                                                            <label>கொத்தடிமை விடுப்பு சான்று</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/bond_leave/{{ $services->bond_leave_proof }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>கொத்தடிமை விடுப்பு சான்று</label>
                                                        <input @if ($services->bond_leave_proof == '') @endif
                                                            class="form-control" id="bond_leave_proof" type="file"
                                                            accept="image/jpeg, image/png" name="bond_leave_proof">
                                                        @if ($services->bond_leave_proof != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/bond_leave/{{ $services->bond_leave_proof }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="" id="first_page_of_bank_account_book"
                                                    style="display: none;">
                                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                        @if ($services->first_page_of_bank_account_book != '')
                                                            <label>வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்</label>
                                                            <br><a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/first_page_of_bank/{{ $services->first_page_of_bank_account_book }}"
                                                                class="btn btn-primary me-2">View</a><br>
                                                        @endif
                                                    @else
                                                        <label>வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்</label>
                                                        <input @if ($services->first_page_of_bank_account_book == '') @endif
                                                            class="form-control" id="first_page_of_bank_account_book"
                                                            type="file" accept="image/jpeg, image/png"
                                                            name="first_page_of_bank_account_book">
                                                        @if ($services->first_page_of_bank_account_book != '')
                                                            <a target="_blank"
                                                                href="{{ URL::to('/') }}/upload/services/first_page_of_bank/{{ $services->first_page_of_bank_account_book }}">Download</a><br>
                                                        @endif
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    @endif

                                    @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                        <div class="mb-3 col-md-6">
                                            <label for="service_name" class="form-label">Service Status</label>
                                            <select class="form-control" name="status" id="service_status">
                                                <option value="">Select</option>
                                                <option @if ($services->status == 'Pending') selected @endif
                                                    value="Pending">
                                                    Pending
                                                </option>
                                                <option @if ($services->status == 'Resubmit') selected @endif
                                                    value="Resubmit">
                                                    Resubmit
                                                </option>
                                                <option @if ($services->status == 'Processing') selected @endif
                                                    value="Processing">
                                                    Processing</option>
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
                                                    <option @if ($services->selects == 'Text') selected @endif value = "Text">Text</option>
                                                    <option @if ($services->selects == 'File') selected @endif value = "File">File</option>
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
            var any_proof = "{{ $services->any_proof }}";
            var new_proof = "{{ $services->new_proof }}";


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


        var status = "{{ $services->status }}";
        var any_document = "{{ $services->any_document }}";

        if (any_document = "ஆதார் அட்டை") {
            $('#aadhaar_cardhide').show("slow");
        } else if (any_document == "வாக்காளர் அடையாள அட்டை") {
            $('#voteridhide').show("slow");
        } else if (any_document == "பாஸ்போர்ட்") {
            $('#passporthide').show("slow");
        } else if (any_document == "மின்சார கட்டணம் ரசீது") {
            $('#electricity_bill_receipthide').show("slow");
        } else if (any_document == "தொலைபேசி கட்டணம்") {
            $('#telephone_chargeshide').show("slow");
        } else if (any_document == "எரிவாயு சிலிண்டர் ரசீது") {
            $('#gas_cylinder_receipthide').show("slow");
        } else if (any_document == "விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி") {
            $('#property_tax_applicant_owns_househide').show("slow");
        } else if (any_document == "வாடகை ஒப்பந்த பத்திரம்") {
            $('#lease_deedhide').show("slow");
        } else if (any_document == "குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை") {
            $('#allotment_rder_of_slum_replacement_boardhide').show("slow");
        } else if (any_document == "கொத்தடிமை விடுப்பு சான்று") {
            $('#bond_leave_proofhide').show("slow");
        } else if (any_document == "வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்") {
            $('#first_page_of_bank_account_bookhide').show("slow");
        }


        if (any_proof = "இறப்பு சான்றிதழ்") {
            $('#death_hide').show("slow");
        }if(any_proof == "திருமண சான்று"){
            $('#maraige_hide').show("slow");
        }if(any_proof == "திருமண பத்திரிக்கை"){
            $('#invite_hide').show("slow");
        }

        if (new_proof = "ஆதார் அட்டை") {
            $('#adh_hide').show("slow");
        }if(new_proof == "பிறப்பு சான்றிதழ்"){
            $('#born_hide').show("slow");
        }if(new_proof == "வாக்காளர் அட்டை"){
            $('#born_hide').show("slow");
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

        $('#any_document').change(function() {
            if ($('#any_document').val() == 'ஆதார் அட்டை') {
                $('#aadhaar_cardhide').show("slow");
                $('#voteridhide').hide("slow");
                $('#passporthide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#aadhaar_card').prop("required", true);

            } else if ($('#any_document').val() == 'வாக்காளர் அடையாள அட்டை') {
                $('#voteridhide').show("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#passporthide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#voterid').prop("required", true);

            } else if ($('#any_document').val() == 'பாஸ்போர்ட்') {
                $('#passporthide').show("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#passport').prop("required", true);

            } else if ($('#any_document').val() == 'மின்சார கட்டணம் ரசீது') {
                $('#electricity_bill_receipthide').show("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#electricity_bill_receipt').prop("required", true);

            } else if ($('#any_document').val() == 'தொலைபேசி கட்டணம்') {
                $('#telephone_chargeshide').show("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required");
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required");
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#telephone_charges').prop("required", true);

            } else if ($('#any_document').val() == 'எரிவாயு சிலிண்டர் ரசீது') {
                $('#gas_cylinder_receipthide').show("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required");
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", true);

            } else if ($('#any_document').val() == 'விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி') {
                $('#property_tax_applicant_owns_househide').show("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required");
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", true);

            } else if ($('#any_document').val() == 'வாடகை ஒப்பந்த பத்திரம்') {
                $('#lease_deedhide').show("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#lease_deed').prop("required", true);

            } else if ($('#any_document').val() == 'குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை') {
                $('#allotment_rder_of_slum_replacement_boardhide').show("slow");
                $('#lease_deedhide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", true);

            } else if ($('#any_document').val() == 'கொத்தடிமை விடுப்பு சான்று') {
                $('#bond_leave_proofhide').show("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $$('#aadhaar_card').prop("required");
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#bond_leave_proof').prop("required", true);

            } else if ($('#any_document').val() == 'வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்') {
                $('#first_page_of_bank_account_bookhide').show("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#allotment_rder_of_slum_replacement_boardhide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#passporthide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#aadhaar_cardhide').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required");
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", true);

            } else {
                $('#aadhaar_cardhide').hide("slow");
                $('#voteridhide').hide("slow");
                $('#passporthide').hide("slow");
                $('#electricity_bill_receipthide').hide("slow");
                $('#telephone_chargeshide').hide("slow");
                $('#gas_cylinder_receipthide').hide("slow");
                $('#property_tax_applicant_owns_househide').hide("slow");
                $('#lease_deedhide').hide("slow");
                $('#first_page_of_bank_account_bookhide').hide("slow");
                $('#bond_leave_proofhide').hide("slow");
                $('#driving_licensehide').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);

            }
        });
        $('#residence_proof').change(function() {
            if ($('#residence_proof').val() == 'ஆதார் அட்டை') {
                $('#aadhaar_card').show("slow");
                $('#voterid').hide("slow");
                $('#passport').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#aadhaar_card').prop("required", true);

            } else if ($('#residence_proof').val() == 'வாகாளர் அடையாள அட்டை') {
                $('#voterid').show("slow");
                $('#aadhaar_card').hide("slow");
                $('#passport').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#voterid').prop("required", true);

            } else if ($('#residence_proof').val() == 'பாஸ்போர்ட்') {
                $('#passport').show("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#passport').prop("required", true);

            } else if ($('#residence_proof').val() == 'மின்சார கட்டணம் ரசீது') {
                $('#electricity_bill_receipt').show("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#electricity_bill_receipt').prop("required", true);

            } else if ($('#residence_proof').val() == 'தொலைபேசி கட்டணம்') {
                $('#telephone_charges').show("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#telephone_charges').prop("required", true);

            } else if ($('#residence_proof').val() == 'எரிவாயு சிலிண்டர் ரசீது') {
                $('#gas_cylinder_receipt').show("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required");
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", true);

            } else if ($('#residence_proof').val() == 'விண்ணப்பதாரர் சொந்த வீடு இருந்தால் அதன் சொத்து வரி') {
                $('#property_tax_applicant_owns_house').show("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#lease_deed').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", true);

            } else if ($('#residence_proof').val() == 'வாடகை ஒப்பந்த பத்திரம்') {
                $('#lease_deed').show("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receip').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#lease_deed').prop("required", true);

            } else if ($('#residence_proof').val() == 'குடிசை மாற்று வாரியத்தின் ஒதுக்கீடு ஆணை') {
                $('#allotment_rder_of_slum_replacement_board').show("slow");
                $('#lease_deed').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required");
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", true);

            } else if ($('#residence_proof').val() == 'கொத்தடிமை விடுப்பு சான்று') {
                $('#bond_leave_proof').show("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#lease_deed').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
                $('#bond_leave_proof').prop("required", true);

            } else if ($('#residence_proof').val() == 'வங்கி கணக்கு புத்தகத்தின் முதல் பக்கம்') {
                $('#first_page_of_bank_account_book').show("slow");
                $('#bond_leave_proof').hide("slow");
                $('#allotment_rder_of_slum_replacement_board').hide("slow");
                $('#lease_deed').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#passport').hide("slow");
                $('#voterid').hide("slow");
                $('#aadhaar_card').hide("slow");
                $$('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", true);

            } else {
                $('#aadhaar_card').hide("slow");
                $('#voterid').hide("slow");
                $('#passport').hide("slow");
                $('#electricity_bill_receipt').hide("slow");
                $('#telephone_charges').hide("slow");
                $('#gas_cylinder_receipt').hide("slow");
                $('#property_tax_applicant_owns_house').hide("slow");
                $('#lease_deed').hide("slow");
                $('#first_page_of_bank_account_book').hide("slow");
                $('#bond_leave_proof').hide("slow");
                $('#driving_license').hide("slow");
                $('#aadhaar_card').prop("required", false);
                $('#voterid').prop("required", false);
                $('#passport').prop("required", false);
                $('#electricity_bill_receipt').prop("required", false);
                $('#telephone_charges').prop("required", false);
                $('#gas_cylinder_receipt').prop("required", false);
                $('#property_tax_applicant_owns_house').prop("required", false);
                $('#lease_deed').prop("required", false);
                $('#allotment_rder_of_slum_replacement_board').prop("required", false);
                $('#bond_leave_proof').prop("required", false);
                $('#first_page_of_bank_account_book').prop("required", false);
            }
        });

        $('#any_proof').change(function() {
            if ($('#any_proof').val() == 'இறப்பு சான்றிதழ்') {
                $('#death_hide').show("slow");
                $('#death').prop("required", true);
                $('#maraige_hide').hide("slow");
                $('#maraige').prop("required", false);
                $('#invite_hide').hide("slow");
                $('#invite').prop("required", false);
            } else if ($('#any_proof').val() == 'திருமண சான்று') {
                $('#maraige_hide').show("slow");
                $('#maraige').prop("required", true);
                $('#death_hide').hide("slow");
                $('#death').prop("required", false);
                $('#invite_hide').hide("slow");
                $('#invite').prop("required", false);
            } else if ($('#any_proof').val() == 'திருமண பத்திரிக்கை') {
                $('#invite_hide').show("slow");
                $('#invite').prop("required", true);
                $('#death_hide').hide("slow");
                $('#death').prop("required", false);
                $('#maraige_hide').hide("slow");
                $('#maraige').prop("required", false);
            }
        });

        $('#new_proof').change(function() {
            if ($('#new_proof').val() == 'ஆதார் அட்டை') {
                $('#adh_hide').show("slow");
                $('#adhar').prop("required", true);
                $('#born_hide').hide("slow");
                $('#born').prop("required", false);
                $('#voterhide').hide("slow");
                $('#voter').prop("required", false);
            } else if ($('#new_proof').val() == 'பிறப்பு சான்றிதழ்') {
                $('#born_hide').show("slow");
                $('#born').prop("required", true);
                $('#adh_hide').hide("slow");
                $('#adhar').prop("required", false);
                $('#voterhide').hide("slow");
                $('#voter').prop("required", false);
            } else if ($('#new_proof').val() == 'வாக்காளர் அட்டை') {
                $('#voterhide').show("slow");
                $('#voter').prop("required", true);
                $('#adh_hide').hide("slow");
                $('#adhar').prop("required", false);
                $('#born_hide').hide("slow");
                $('#born').prop("required", false);
            }
        });
    </script>
@endpush
