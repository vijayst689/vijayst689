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
                        <form action="{{ url('/pvcprint_update') }}" id="myForm" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row">
                                @foreach ($services as $pvc)
                                @php
                                $apply_user_id = 0;
                                if ($pvc->distributor_id == 0 && $pvc->retailer_id == 0) {
                                $apply_user_id = $pvc->user_id;
                                } elseif ($pvc->retailer_id == 0) {
                                $apply_user_id = $pvc->distributor_id;
                                } elseif ($pvc->distributor_id == 0) {
                                $apply_user_id = $pvc->retailer_id;
                                }
                                @endphp

                                <input type="hidden" name="applied_serviceid" value="{{ $pvc->id }}">
                                <input type="hidden" name="pvc_id" value="{{ $pvc->id }}">
                                <input type="hidden" name="serviceid" value="{{ $pvc->service_id }}">
                                <input type="hidden" name="user_id" value="{{ $pvc->user_id }}">
                                <input type="hidden" name="retailer_id" value="{{ $pvc->retailer_id }}">
                                <input type="hidden" name="distributor_id" value="{{ $pvc->distributor_id }}">

                                <div class="border rounded-3 p-3 mb-4 bg-white">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">PVC ID : {{ $pvc->id }}</h6>
                                        <span class="badge bg-warning">{{ $pvc->status }}</span>
                                    </div>

                                    {{-- PVC DETAILS --}}
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-sm align-middle">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th width="25%">Service</th>
                                                                    <th>Document</th>
                                                                    <th width="20%">Password</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="editTable{{ $pvc->id }}">
                                                                @foreach ($pvc->details as $i => $detail)
                                                                    <tr>
                                                                        <td>
                                                                            <select id="svn"
                                                                                name="service[{{ $i }}][name]"
                                                                                class="form-select form-select-sm">
                                                                                <option value="aadhaar"
                                                                                    {{ $detail->service_name === 'aadhaar' ? 'selected' : '' }}>
                                                                                    Aadhaar</option>
                                                                                <option value="pan"
                                                                                    {{ $detail->service_name === 'pan' ? 'selected' : '' }}>
                                                                                    PAN</option>
                                                                                <option value="voter"
                                                                                    {{ $detail->service_name === 'voter' ? 'selected' : '' }}>
                                                                                    Voter</option>
                                                                                <option value="ration"
                                                                                    {{ $detail->service_name === 'ration' ? 'selected' : '' }}>
                                                                                    Ration</option>
                                                                                <option value="ayushman"
                                                                                    {{ $detail->service_name === 'ayushman' ? 'selected' : '' }}>
                                                                                    Ayushman</option>
                                                                                <option value="esharam"
                                                                                    {{ $detail->service_name === 'esharam' ? 'selected' : '' }}>
                                                                                    Esharam</option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            @if (Auth::user()->id != $apply_user_id)
                                                                                <a href="{{ asset($detail->document) }}"
                                                                                    target="_blank"
                                                                                    class="btn btn-sm btn-primary">View</a>
                                                                            @else
                                                                                <input type="file"
                                                                                    name="service[{{ $i }}][file]"
                                                                                    class="form-control form-control-sm">
                                                                                @if ($detail->document)
                                                                                    <small>
                                                                                        <a href="{{ asset($detail->document) }}"
                                                                                            target="_blank">View</a>
                                                                                    </small>
                                                                                @endif
                                                                            @endif
                                                                        </td>

                                                                        <td>
                                                                            <input type="text"
                                                                                name="service[{{ $i }}][password]"
                                                                                value="{{ $detail->password }}"
                                                                                class="form-control form-control-sm password-field">
                                                                        </td>                                                                     
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="border rounded-3 p-3 bg-white">

                                                            <div class="d-flex align-items-center mb-2">
                                                                <i class="bx bx-map text-primary me-2"></i>
                                                                <h6 class="mb-0 fw-semibold">Delivery Address</h6>
                                                            </div>

                                                            <hr class="my-2">

                                                            <div class="row g-3">

                                                                <div class="col-md-6">
                                                                    <label class="form-label small fw-semibold">Full
                                                                        Name</label>
                                                                    <input type="text" name="delivery[name]"
                                                                        class="form-control form-control-sm"
                                                                        placeholder="Full name"
                                                                        value="{{ old('delivery.name', $pvc->delivery_name ?? '') }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label
                                                                        class="form-label small fw-semibold">Mobile</label>
                                                                    <input type="text" name="delivery[mobile]"
                                                                        class="form-control form-control-sm number"
                                                                        placeholder="Mobile number" maxlength="10"
                                                                        value="{{ old('delivery.mobile', $pvc->delivery_mobile ?? '') }}">
                                                                </div>

                                                                <div class="col-12">
                                                                    <label
                                                                        class="form-label small fw-semibold">Address</label>
                                                                    <textarea name="delivery[address]" rows="2" class="form-control form-control-sm"
                                                                        placeholder="House no, street, area">{{ old('delivery.address', $pvc->delivery_address ?? '') }}</textarea>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <label
                                                                        class="form-label small fw-semibold">Pincode</label>
                                                                    <input type="text" name="delivery[pincode]"
                                                                        class="form-control form-control-sm number"
                                                                        placeholder="Pincode" maxlength="6"
                                                                        value="{{ old('delivery.pincode', $pvc->pincode ?? '') }}">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if (Auth::user()->id != $apply_user_id)
                                                <div class="row mt-3">
                                                    {{-- STATUS --}}
                                                    <div class="mb-3 col-md-6">
                                                        <label class="form-label fw-semibold">Service Status</label>
                                                        <select class="form-control" name="status" id="service_status"
                                                            required>
                                                            <option value="">Select</option>
                                                            @foreach (['Pending', 'Resubmit', 'Processing', 'Rejected', 'Approved'] as $st)
                                                                <option value="{{ $st }}"
                                                                    {{ $services[0]->status == $st ? 'selected' : '' }}>
                                                                    {{ $st }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- REMARKS --}}
                                                    <div class="mb-3 col-md-6 d-none" id="remarkshide">
                                                        <label class="form-label">Remarks</label>
                                                        <input type="text" name="remarks" id="remarks"
                                                            maxlength="100" value="{{ $services[0]->remarks }}"
                                                            class="form-control">
                                                    </div>

                                                    {{-- PROCESSING OPTIONS --}}
                                                    <div class="mb-3 col-md-6 d-none" id="selecthide">
                                                        <label class="form-label">Select</label>
                                                        <select class="form-control" name="selects" id="select">
                                                            <option value="">Select</option>
                                                            <option value="Text"
                                                                {{ $services[0]->selects == 'Text' ? 'selected' : '' }}>
                                                                Text
                                                            </option>
                                                            <option value="File"
                                                                {{ $services[0]->selects == 'File' ? 'selected' : '' }}>
                                                                File
                                                            </option>
                                                        </select>
                                                    </div>

                                                    {{-- ACKNOWLEDGEMENT --}}
                                                    <div class="mb-3 col-md-6 d-none" id="acknowledgementhide">
                                                        <label class="form-label">Acknowledgement</label>
                                                        <input type="file" name="acknowledgement"
                                                            class="form-control">
                                                    </div>

                                                    {{-- APPLICATION NO --}}
                                                    <div class="mb-3 col-md-6 d-none" id="applicationnohide">
                                                        <label class="form-label">Application No</label>
                                                        <input type="text" name="application_no" maxlength="20"
                                                            value="{{ $services[0]->application_no }}"
                                                            class="form-control">
                                                    </div>

                                                    {{-- APPROVED OPTIONS --}}
                                                    <div class="mb-3 col-md-6 d-none" id="selectshide">
                                                        <label class="form-label">Select</label>
                                                        <select class="form-control" name="lects" id="selects">
                                                            <option value="">Select</option>
                                                            <option value="Text"
                                                                {{ $services[0]->lects == 'Text' ? 'selected' : '' }}>Text
                                                            </option>
                                                            <option value="File"
                                                                {{ $services[0]->lects == 'File' ? 'selected' : '' }}>File
                                                            </option>
                                                        </select>
                                                    </div>

                                                    {{-- APPLICATION --}}
                                                    <div class="mb-3 col-md-6 d-none" id="applicationhide">
                                                        <label class="form-label">Application</label>
                                                        <input type="text" name="application" maxlength="150"
                                                            value="{{ $services[0]->application }}" class="form-control">
                                                    </div>

                                                    {{-- CERTIFICATE --}}
                                                    <div class="mb-3 col-md-6 d-none" id="certhide">
                                                        <label class="form-label">Certificate</label>
                                                        <input type="file" name="certificate" class="form-control">
                                                    </div>

                                                </div>
                                            @else
                                                {{-- VIEW ONLY --}}
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Service Status</label>
                                                        <input disabled value="{{ $services[0]->status }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Remarks</label>
                                                        <textarea disabled class="form-control">{{ $services[0]->remarks }}</textarea>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mt-3 text-center">
                                            @if ($services[0]->status == 'Resubmit' && ($services[0]->user_id != Auth::user()->id && $apply_user_id != Auth::user()->id))
                                                <button type="submit" disabled class="btn btn-primary me-2" id="save">Resubmit</button>
                                            @elseif($services[0]->status == 'Approved')
                                                <button type="button" disabled class="btn btn-primary me-2" id="save">Completed</button>
                                            @else
                                                <button type="submit" class="btn btn-primary me-2" id="save">Submit</button>
                                            @endif
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
            $(function() {
                var status = @json($services[0]->status);
                var acknowledgement = @json($services[0]->acknowledgement);
                var certificate = @json($services[0]->certificate);
                var selects = @json($services[0]->selects);
                var lects = @json($services[0]->lects);
                var svn = "{{ $detail->service_name }}";

                function toggleVisibility() {
                    // Hide all elements first by adding d-none
                    $('#remarkshide, #selecthide, #acknowledgementhide, #applicationnohide, #certhide, #selectshide, #applicationhide')
                        .addClass('d-none');
                    $('#remarks, #acknowledgement, #application_no, #certificate, #select, #selects, #application')
                        .prop('required', false);

                    if (status === "Resubmit") {
                        $('#remarkshide').removeClass('d-none');
                        $('#remarks').prop("required", true);
                    } else if (status === "Processing") {
                        $('#selecthide').removeClass('d-none');
                        $('#select').prop('required', true);

                        if (selects === "Text") {
                            $('#applicationnohide').removeClass('d-none');
                            $('#application_no').prop('required', true);
                        } else if (selects === "File") {
                            $('#acknowledgementhide').removeClass('d-none');
                            if (!acknowledgement) {
                                $('#acknowledgement').prop('required', true);
                            }
                        }
                    } else if (status === "Approved") {
                        $('#selectshide').removeClass('d-none');
                        $('#selects').prop('required', true);

                        if (lects === "Text") {
                            $('#applicationhide').removeClass('d-none');
                            $('#application').prop('required', true);
                        } else if (lects === "File") {
                            $('#certhide').removeClass('d-none');
                            if (!certificate) {
                                $('#certificate').prop('required', true);
                            }
                        }
                    }
                }

                toggleVisibility();

                $('#service_status').change(function() {
                    status = $(this).val();
                    toggleVisibility();
                });

                $('#select').change(function() {
                    selects = $(this).val();
                    toggleVisibility();
                });

                $('#selects').change(function() {
                    lects = $(this).val();
                    toggleVisibility();
                });

                // Disable submit button on form submit
                $('#myForm').submit(function() {
                    const btn = $('#save');
                    if (btn.length) {
                        btn.prop('disabled', true).text('Submitting...');
                    }
                });

                if (svn == "ration") {
                    $('#rationopen').show("slow");
                } else {
                    $('#rationopen').hide("slow");
                }
            });
        </script>
@endpush