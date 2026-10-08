<div class="modal fade" id="customerOtpModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">OTP Verification Required</h5>
            </div>
            <div class="modal-body">
                <p class="text-muted small">
                    An OTP has been sent to your Customer registered mobile number. Please enter it below to complete your request.
                </p>
                <form id="customerOtpForm">
                    <input type="hidden" id="modal_service_id" name="service_id" />
                    
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Ration Card Number</label>
                        <input type="text" id="modal_smartcard" class="form-control bg-light" readonly />
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Mobile Number</label>
                        <input type="text" id="modal_mobile" class="form-control bg-light" readonly />
                    </div>

                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Enter Received OTP <span class="text-danger">*</span></label>
                        <input type="text" id="modal_user_otp" name="modal_user_otp" class="form-control" placeholder="Enter OTP from SMS" required maxlength="10" />
                        <div class="invalid-feedback" id="customerOtpError"></div>
                    </div>

                    <button type="submit" class="btn btn-success w-100" id="verifyOtpBtn">Submit OTP</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card-body">
        <div class="modal fade" id="requestamount" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Wallet Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="form-body">
                        <form method="post" class="row g-3" action="{{ url('/saverequest') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="/upload/qrimage/{{ $qrlabel->qrimage }}" class="img-fluid" alt="...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Amount</label>
                                        <input required name="amount" type="text" maxlength="5"
                                            class="form-control number" placeholder="Amount">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Paid Image (Screen)</label>
                                        <input required type="file" name="req_image" class="form-control"
                                            maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="Submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card-body">
        <div class="modal fade" id="addmoney" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="row g-3" action="{{ url('/adminaddwallet') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input required name="wallet" maxlength="5" type="text" class="form-control"
                                placeholder="Amount">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card-body">
        <div class="modal fade" id="ramjirequest" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Api Wallet Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="form-body">
                        <form method="post" class="row g-3" action="{{ url('/ramjisaverequest') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="/upload/qr/qrimgramji.jpeg" class="img-fluid" alt="...">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Amount</label>
                                        <input required name="amount" type="text" maxlength="5"
                                            class="form-control number" placeholder="Amount">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Paid Image (Screen)</label>
                                        <input required type="file" name="req_image" class="form-control"
                                            maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="Submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card-body">
        <div class="modal fade" id="addramji" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Super Admin Payment
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="row g-3" action="{{ url('/superadminaddwallet') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input required name="wallet" maxlength="5" type="text" class="form-control"
                                placeholder="Amount">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<header id="page-topbar">
    <div class="navbar-header bg-dark text-white p-3">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/') }}" alt="" height="17">
                    </span>
                </a>

                <a href="{{ url('/dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assetss/img/') }}" alt="" height="17">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                id="vertical-menu-btn">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <!-- Search input -->
        <div class="search-wrap" id="search-wrap">
            <div class="search-bar">
                <input class="search-input form-control" placeholder="Search" />
                <a href="#" class="close-search toggle-search" data-target="#search-wrap">
                    <i class="mdi mdi-close-circle"></i>
                </a>
            </div>
        </div>

        <div class="d-flex">

            @if (Auth::user()->user_type_id == 4 || Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 3)
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <span class="text-white"><b>Wallet Amount : {{ Auth::user()->wallet }}</b></span>&nbsp;
                    <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#requestamount">Add Money</button>
                </div>
            @elseif (Auth::user()->user_type_id == 2)
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <span class="text-white"><b>Api Wallet : {{ Auth::user()->rawallet }}</b></span>&nbsp;
                    <button type="button" class="btn-sm btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#ramjirequest">Add Money</button>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <span class="text-white"><b>Wallet Amount : {{ Auth::user()->wallet }}</b></span>&nbsp;
                    <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addmoney">Add Payment</button>
                </div>
            @endif
            @if (Auth::user()->user_type_id == 1)
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <span class="text-white"><b>Ramji Wallet Amount : {{ Auth::user()->rawallet }}</b></span>&nbsp;
                    <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addramji">Add Payment</button>
                </div>
            @endif

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <button class="btn btn-primary" type="submit"><i
                                        class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <!-- Notification -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect notification-step"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="badge bg-danger rounded-pill">0</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <h6 class="m-0">Notifications (258) </h6>
                    </div>

                    <div data-simplebar style="max-height: 230px;">
                        <a href="#" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="mdi mdi-cart-outline"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1 font-size-15">Your order is placed</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-12">Dummy text of the printing and typesetting
                                            industry.</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-warning rounded-circle font-size-16">
                                        <i class="mdi mdi-message"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1 font-size-15">New Message received</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-12">You have 87 unread messages</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="text-reset notification-item">
                            <div class="d-flex align-items-start">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-info rounded-circle font-size-16">
                                        <i class="mdi mdi-help"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1 font-size-15">Your order is placed</h6>
                                    <div class="text-muted">
                                        <p class="mb-1 font-size-12">It is a long established fact that a reader will
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>

                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> View all
                        </a>
                    </div>
                </div>
            </div>

            <!-- full-screen -->
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <!-- User -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect user-step" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}" alt
                        class="rounded-circle header-profile-user" />
                    <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ url('/profile') }}"><i
                            class="dripicons-user d-inline-block text-muted me-2"></i>
                        Profile</a>
                    <a class="dropdown-item" href="{{ url('/changepassword') }}"><i
                            class="dripicons-user d-inline-block text-muted me-2"></i>
                        ChangePassword</a>
                    {{-- <a class="dropdown-item" href="#"><i class="dripicons-wallet d-inline-block text-muted me-2"></i> My
                                    Wallet</a> --}}
                    <div class="dropdown-divider"></div>
                    @guest
                        <a class="dropdown-item" href="{{ route('signout') }}"><i
                                class="dripicons-exit d-inline-block text-muted me-2"></i>
                            Logout</a>
                    @else
                        <a class="dropdown-item" href="{{ route('signout') }}"><i
                                class="dripicons-exit d-inline-block text-muted me-2"></i>
                            Logout</a>
                    @endguest
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="mdi mdi-spin mdi-cog"></i>
                </button>
            </div>

        </div>
    </div>
    @if ($showPopup)
        <div id="headerAlert" class="alert alert-danger alert-dismissible fade show mb-0 text-center" role="alert"
            style="display: none; border-radius: 0;">
            <strong>Reminder:</strong> Your Server activation is due in {{ $daysLeft }}
            day{{ $daysLeft > 1 ? 's' : '' }}. Automatically debited from your wallet.
            <button type="button" class="btn-close" onclick="closeHeaderPopup()" aria-label="Close"></button>
        </div>
    @endif
    
    {{-- @if($siteshowPopup && $unpaidPayment)

     <div id="headerAlert1" class="alert alert-warning alert-dismissible fade show text-center w-100 m-0" role="alert"
        style="border-radius: 0; position: fixed; top: 0; left: 0; z-index: 1055;">
        ⚠️ Reminder: Payment of 
            <strong>{{ $unpaidPayment->amount }}</strong> 
            for <strong>{{ $unpaidPayment->payment_reason }}</strong> 
            is due tomorrow ({{ \Carbon\Carbon::parse($unpaidPayment->payment_date)->format('d M Y') }}).
        <div class="mt-3">
            <a href="{{ url('/websitepayment') }}" class="btn btn-sm btn-primary px-4">
                💳 Make Payment
            </a>
        </div>
        <button type="button" class="btn-close" onclick="closeHeaderPopup1()" aria-label="Close"></button>
    </div>
       
        @endif --}}
</header>
