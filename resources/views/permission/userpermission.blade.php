@extends('layouts.app')
@section('content')
    <style type="text/css">
        .service-box {
            cursor: pointer;
            background-color: #d9b38c;
            /* default bg */
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }

        .service-box:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .service-box.disabled {
            background-color: #e0e0e0;
            /* ✅ light grey */
            opacity: 1;
            pointer-events: none;
            /* disables clicks */
            cursor: not-allowed;
            border: 2px solid #adb5bd;
            /* optional darker border */
        }

        .selected-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            background: #198754;
            color: white;
            padding: 2px 6px;
            font-size: 12px;
            border-radius: 4px;
            z-index: 1;
        }

        .notselected-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            background: #ff1a1a;
            color: white;
            padding: 2px 6px;
            font-size: 12px;
            border-radius: 4px;
            z-index: 1;
        }

        .selected-box {
            border: 2px solid #0d6efd;
            background-color: #e6f0ff;
            animation: pulse 0.4s ease;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }

            100% {
                transform: scale(1);
            }
        }

        #fullscreen-spinner {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 9999;
        }

        .spinner-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
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
                    @php
                        $selectedIds = collect($checkpermission1)->pluck('service_id')->toArray();
                        $selectedIds2 = collect($checkpermission2)->pluck('service_id')->toArray();
                        $selectedIds3 = collect($checkpermission3)->pluck('service_id')->toArray();
                        $selectedIds4 = collect($checkpermission4)->pluck('service_id')->toArray();
                    @endphp
                   <div class="card-body">
                        <h5 class="card-title">Activation Permissions</h5>
                        <div class="row">
                            <form class="row permissionform" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" id="activation_userid" name="user_id" value="{{ $userid }}">

                                <h3 class="text-center text-danger">PDF Services</h3>
                                @foreach ($findservices as $ser)
                                    @php
                                        $isSelected = in_array($ser->id, $selectedIds);
                                    @endphp

                                    <div class="col-6 col-md-3 mb-4">
                                        <div class="service-box border rounded text-center p-2 position-relative {{ $isSelected ? 'disabled' : '' }}"
                                            data-id="{{ $ser->id }}" data-parent_id="1"
                                            data-activation_amount="{{ $ser->amount }}" data-bs-toggle="tooltip"
                                            title="{{ $ser->name }}">

                                            {{-- Status Badge --}}
                                            @if ($isSelected)
                                                <div class="selected-badge">✔ Active</div>
                                            @else
                                                <div class="notselected-badge">❌ Not Active</div>
                                            @endif

                                            {{-- Image --}}
                                            <div class="border rounded bg-light p-2">
                                                <img src="{{ asset('upload/find_service/' . $ser->ser_image) }}"
                                                    alt="{{ $ser->name }}"
                                                    style="width: 100%; height: 80px; object-fit: contain;">
                                            </div>

                                            {{-- Service Name & Price --}}
                                            <div class="mt-2">
                                                <h6 class="mb-1">{{ $ser->name }}</h6>
                                                <small class="fw-bold d-block">ID Cost ₹ {{ $ser->amount }}</small>
                                                @if (Auth::user()->user_type_id == 3)
                                                    <small class="fw-bold d-block">Service Payment ₹
                                                        {{ $ser->distributor_amount }}</small>
                                                @endif
                                                @if (Auth::user()->user_type_id == 4)
                                                    <small class="fw-bold d-block">Service Payment ₹ {{ $ser->retailer_amount }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <h3 class="text-center text-danger mt-4">Utility Services</h3>
                                @foreach ($utilityservices as $ser1)
                                    @php
                                        $isSelected = in_array($ser1->id, $selectedIds2);
                                    @endphp

                                    <div class="col-6 col-md-3 mb-4">
                                        <div class="service-box border rounded text-center p-2 position-relative {{ $isSelected ? 'disabled' : '' }}"
                                            data-id="{{ $ser1->id }}" data-parent_id="2"
                                            data-activation_amount="{{ $ser1->amount }}" data-bs-toggle="tooltip"
                                            title="{{ $ser1->name }}">

                                            @if ($isSelected)
                                                <div class="selected-badge">✔ Active</div>
                                            @else
                                                <div class="notselected-badge">❌ Not Active</div>
                                            @endif

                                            <div class="border rounded bg-light p-2">
                                                <img src="{{ asset('upload/uti_image/' . $ser1->ser_image) }}"
                                                    alt="{{ $ser1->name }}"
                                                    style="width: 100%; height: 80px; object-fit: contain;">
                                            </div>

                                            <div class="mt-2">
                                                <h6 class="mb-1">{{ $ser1->name }}</h6>
                                                <small class="fw-bold mb-0">ID Cost ₹ {{ $ser1->amount }}</small>
                                                @if (Auth::user()->user_type_id == 3)
                                                    <h6 class="mb-1 fw-bold">Service Payment ₹
                                                        {{ $ser1->distributor_amount }}</h6>
                                                @endif
                                                @if (Auth::user()->user_type_id == 4)
                                                    <h6 class="mb-1 fw-bold">Service Payment ₹ {{ $ser1->retailer_amount }}
                                                    </h6>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach --}}
                                <h3 class="text-center text-danger mt-4">Pancard Services</h3>
                                @foreach ($panservices as $ser2)
                                    @php
                                        $isSelected = in_array($ser2->id, $selectedIds4);
                                    @endphp

                                    <div class="col-6 col-md-3 mb-4">
                                        <div class="service-box border rounded text-center p-2 position-relative {{ $isSelected ? 'disabled' : '' }}"
                                            data-id="{{ $ser2->id }}" data-parent_id="4"
                                            data-activation_amount="{{ $ser2->amount }}" data-bs-toggle="tooltip"
                                            title="{{ $ser2->name }}">

                                            {{-- Status Badge --}}
                                            @if ($isSelected)
                                                <div class="selected-badge">✔ Active</div>
                                            @else
                                                <div class="notselected-badge">❌ Not Active</div>
                                            @endif

                                            {{-- Image --}}
                                            <div class="border rounded bg-light p-2">
                                                <img src="{{ asset('upload/panservice/' . $ser2->ser_image) }}"
                                                    alt="{{ $ser2->name }}"
                                                    style="width: 100%; height: 80px; object-fit: contain;">
                                            </div>

                                            {{-- Service Name & Price --}}
                                            <div class="mt-2">
                                                <h6 class="mb-1">{{ $ser2->name }}</h6>
                                                <small class="fw-bold d-block">ID Cost ₹ {{ $ser2->amount }}</small>
                                                @if (Auth::user()->user_type_id == 3)
                                                    <small class="fw-bold d-block">Service Payment ₹
                                                        {{ $ser2->distributor_amount }}</small>
                                                @endif
                                                @if (Auth::user()->user_type_id == 4)
                                                    <small class="fw-bold d-block">Service Payment ₹ {{ $ser2->retailer_amount }}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <h3 class="text-center text-danger mt-4">Other Services</h3>
                               @foreach ($mainServices as $main)
                                    <div class="mb-4">

                                        {{-- MAIN SERVICE NAME HEADING --}}
                                        <h3 class="text-danger border-bottom pb-2">
                                            {{ $main->service_name ?? $main->name }}
                                        </h3>

                                        <div class="row mt-3">

                                            {{-- Check subservices --}}
                                            @if (isset($subServices[$main->id]))
                                                @foreach ($subServices[$main->id] as $ser)
                                                    @php
                                                        $isSelected = in_array($ser->id, $selectedIds3 ?? []);
                                                    @endphp

                                                    <div class="col-6 col-md-3 mb-4">
                                                        <div class="service-box border rounded text-center p-2 position-relative 
                                {{ $isSelected ? 'disabled' : '' }}"
                                                            data-id="{{ $ser->id }}" data-parent_id="3"
                                                            data-activation_amount="{{ $ser->amount }}"
                                                            data-bs-toggle="tooltip" title="{{ $ser->service_name }}">

                                                            {{-- Active / Inactive Badge --}}
                                                            @if ($isSelected)
                                                                <div class="selected-badge">✔ Active</div>
                                                            @else
                                                                <div class="notselected-badge">❌ Not Active</div>
                                                            @endif

                                                            {{-- Image --}}
                                                            <div class="border rounded bg-light p-2">
                                                                <img src="{{ !empty($ser->sub_service_image)
                                                                    ? asset('upload/sub_service/' . $ser->sub_service_image)
                                                                    : asset('upload/service/default.png') }}"
                                                                    alt="{{ $ser->service_name }}"
                                                                    style="width: 100%; height: 80px; object-fit: contain;">
                                                            </div>

                                                            {{-- Name & Price --}}
                                                            <div class="mt-2">
                                                                <h6 class="mb-1">{{ $ser->service_name }}</h6>
                                                                  <small class="fw-bold d-block">ID Cost ₹ {{ $ser->amount }}</small>
                                                                @if (Auth::user()->user_type_id == 3 || Auth::user()->user_type_id == 4)
                                                                    <small class="fw-bold d-block">Service Payment ₹
                                                                        {{ $ser->serviceamount }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-muted">No Sub-Services Available</p>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach
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
        $(document).on('click', '.service-box:not(.disabled)', function() {
            var $this = $(this);
            if ($this.hasClass('loading')) return; // Block multiple clicks
            var serviceId = $(this).data('id');
            var parentId = $(this).data('parent_id');
            var activationAmount = $(this).data('activation_amount');
            var userId = $("#activation_userid").val();
            const csrfToken = '{{ csrf_token() }}';

            var wallet = "{{ Auth::user()->wallet }}";
            var rawallet = "{{ Auth::user()->rawallet }}";
            var usertype = "{{ Auth::user()->user_type_id }}";

            if (usertype == 2) {
                if (parseFloat(activationAmount) > parseFloat(rawallet)) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Insufficient Ramji Wallet Balance',
                        text: 'No funds in your ramji wallet. Please update your wallet to continue the service.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        backdrop: true
                    });

                    return false;
                }
            } else {
                if (parseFloat(activationAmount) > parseFloat(wallet)) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Insufficient Wallet Balance',
                        text: 'No funds in your wallet. Please update your wallet to continue the service.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK',
                        backdrop: true
                    });

                    return false;
                }
            }

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to activate this service?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Activate',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Example: AJAX call
                    $('#fullscreen-spinner').fadeIn();
                    var postData = {
                        _token: csrfToken,
                        service_id: serviceId,
                        parent_id: parentId,
                        user_id: userId,
                        activation_amount: activationAmount,

                    };
                    $.ajax({
                        url: '/savepermission', // Replace with your actual route
                        type: 'POST',
                        data: postData,
                        success: function(response) {
                            console.log(response);
                            if (response.success == true) {
                                $('#fullscreen-spinner').fadeOut();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Activated Successfully!',
                                    text: 'The service has been activated.',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location
                                    .reload(); // Reload after user clicks OK
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Please Try Again.....',
                                    confirmButtonColor: '#d33',
                                    confirmButtonText: 'OK',
                                    backdrop: true
                                });
                                $('#fullscreen-spinner').fadeOut();
                            }

                        },
                        error: function(xhr) {
                            alert('Error: ' + xhr.responseText);
                            $('#fullscreen-spinner').fadeOut(); // Hide on error
                        }
                    });
                }
            });

        });
    </script>
@endpush
