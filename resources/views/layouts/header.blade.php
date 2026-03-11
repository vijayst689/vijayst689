 <!--start header -->
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
                                    <img src="/upload/qrimage/{{ $qrlabel->qrimage }}" class="img-fluid" alt="">
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
         <div class="modal fade" id="ramjirequest" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">

                    <!-- Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Add Money to Rawallet</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Wallet Info -->
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <small class="text-muted">Wallet Balance</small>
                                <h4>₹ {{ Auth::user()->rawallet ?? 0 }}</h4>
                            </div>
                            <div class="text-end">
                                <small>Welcome</small><br>
                                <strong>{{ Auth::user()->name }}</strong>
                            </div>
                        </div>

                        <div class="alert alert-warning text-center mt-3 py-2">
                            <strong>⚠️ Having trouble with online payment?</strong><br>
                            Please use
                            <a href="#"  class="fw-bold text-decoration-underline text-danger switchToManual">
                                Manual Payment
                            </a>
                        </div>


                        <!-- Tabs -->
                        <ul class="nav nav-pills mb-3 justify-content-center" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#ramji_onlineTab">
                                    💳 Online Payment
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#ramji_manualTab">
                                    📸 Manual Payment
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- ================= ONLINE PAYMENT ================= -->
                            <div class="tab-pane fade show active" id="ramji_onlineTab">

                                <div class="mb-3">
                                    <label class="form-label">Enter Amount (Min ₹50)</label>
                                    <input type="number" id="amountInput" class="form-control border-warning amountInput" min="50">
                                </div>

                                <div class="d-flex flex-wrap gap-2 justify-content-center mb-3">
                                    @foreach([50,100,300,500,1000,2000,5000] as $amt)
                                    <button type="button"
                                        class="btn btn-outline-primary quick-amount"
                                        data-amount="{{ $amt }}">
                                        ₹{{ $amt }}
                                    </button>
                                    @endforeach
                                </div>

                                <form method="POST" action="{{ route('ramjionline.create') }}" class="onlinePaymentForm">
                                    @csrf
                                    <input type="hidden" name="mobile" value="{{ Auth::user()->mobile }}">
                                    <input type="hidden" name="amount" id="finalAmount" class="finalAmount">

                                    <button type="submit"
                                        class="btn btn-primary w-100 payBtn"
                                        id="payBtn"
                                        disabled>
                                        <span class="payBtnText">➕ Pay Online</span>
                                        <span id="payLoader" class="spinner-border spinner-border-sm d-none payLoader"></span>
                                    </button>
                                </form>

                            </div>

                            <!-- ================= MANUAL PAYMENT ================= -->
                            <div class="tab-pane fade" id="ramji_manualTab">

                                <div class="text-center mb-3">
                                    <img src="/upload/qr/qrimgramji.jpeg" alt="QR Code"
                                        class="img-fluid"
                                        style="max-width:300px">
                                </div>

                                <form method="POST" action="{{ url('/ramjisaverequest') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Amount</label>
                                            <input type="number" name="amount" class="form-control  border-warning" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Payment Screenshot</label>
                                            <input type="file" name="req_image" class="form-control" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">
                                        📤 Submit Manual Request
                                    </button>
                                </form>

                            </div>

                        </div>
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
                         <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Super Admin
                             Payment
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
 <header>
     <div class="topbar d-flex align-items-center">
         <nav class="navbar navbar-expand gap-3">
             <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
             </div>
             @if(Auth::check())
             @if (Auth::check() && Auth::user()->user_type_id == 2)
                 <a class="copy_text btn-sm btn btn-primary" data-toggle="tooltip" title="Copy to Clipboard"
                     href="https://pkrmsolution.com/addenquiry/{{ Auth::user()->id }}">Share Link</a>
             @endif
             @endif

             @if(Auth::check())
             @if (Auth::user()->user_type_id == 4 || Auth::user()->user_type_id == 5 || Auth::user()->user_type_id == 3)
                 <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                     <span class="text-danger"><b>Wallet Amount : {{ Auth::user()->wallet }}</b></span>&nbsp;
                     <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                         data-bs-target="#requestamount">Add Money</button>
                 </div>
             @elseif (Auth::user()->user_type_id == 2)
                 <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                     <span class="text-danger"><b>Ramji Wallet : {{ Auth::user()->rawallet }}</b></span>&nbsp;
                     <button type="button" class="btn-sm btn btn-danger" data-bs-toggle="modal"
                         data-bs-target="#ramjirequest">Add Money</button>
                 </div>
                 &nbsp;&nbsp;&nbsp;&nbsp;
                 <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                     <span class="text-danger"><b>Wallet Amount : {{ Auth::user()->wallet }}</b></span>&nbsp;
                     <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                         data-bs-target="#addmoney">Add Payment</button>
                 </div>
             @endif
             @if (Auth::user()->user_type_id == 1)
                 <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                     <span class="text-danger"><b>Ramji Wallet Amount :
                             {{ Auth::user()->rawallet }}</b></span>&nbsp;
                     <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                         data-bs-target="#addramji">Add Payment</button>
                 </div>
             @endif
             @endif

             <div class="top-menu ms-auto">
                 <ul class="navbar-nav align-items-center gap-1">
                     <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal"
                         data-bs-target="#SearchModal">
                         <a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
                         </a>
                     </li>



                     <li class="nav-item dark-mode d-none d-sm-flex">
                         <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
                         </a>
                     </li>

                     <li class="nav-item dropdown dropdown-app">
                         <div class="dropdown-menu dropdown-menu-end p-0">
                             <div class="app-container p-2 my-2">
                             </div>
                         </div>
                     </li>

                     <li class="nav-item dropdown dropdown-large">
                         <div class="dropdown-menu dropdown-menu-end">
                             <a href="javascript:;">
                                 <div class="msg-header">
                                     <p class="msg-header-title">Notifications</p>
                                     <p class="msg-header-badge">8 New</p>
                                 </div>
                             </a>
                             <div class="header-notifications-list">
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="user-online">
                                             <img src="assets/images/avatars/avatar-1.png" class="msg-avatar"
                                                 alt="user avatar">
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5 sec
                                                     ago</span></h6>
                                             <p class="msg-info">The standard chunk of lorem</p>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="notify bg-light-danger text-danger">dc
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
                                                     ago</span></h6>
                                             <p class="msg-info">You have recived new orders</p>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="user-online">
                                             <img src="assets/images/avatars/avatar-2.png" class="msg-avatar"
                                                 alt="user avatar">
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
                                                     sec ago</span></h6>
                                             <p class="msg-info">Many desktop publishing packages</p>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="notify bg-light-success text-success">
                                             <img src="assets/images/app/outlook.png" width="25"
                                                 alt="user avatar">
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">Account Created<span class="msg-time float-end">28
                                                     min
                                                     ago</span></h6>
                                             <p class="msg-info">Successfully created new email</p>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="notify bg-light-info text-info">Ss
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">New Product Approved <span
                                                     class="msg-time float-end">2 hrs ago</span></h6>
                                             <p class="msg-info">Your new product has approved</p>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="user-online">
                                             <img src="assets/images/avatars/avatar-4.png" class="msg-avatar"
                                                 alt="user avatar">
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
                                                     min ago</span></h6>
                                             <p class="msg-info">Making this the first true generator</p>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="notify bg-light-success text-success"><i
                                                 class='bx bx-check-square'></i>
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">Your item is shipped <span
                                                     class="msg-time float-end">5 hrs
                                                     ago</span></h6>
                                             <p class="msg-info">Successfully shipped your item</p>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="notify bg-light-primary">
                                             <img src="assets/images/app/github.png" width="25"
                                                 alt="user avatar">
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
                                                     ago</span></h6>
                                             <p class="msg-info">24 new authors joined last week</p>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center">
                                         <div class="user-online">
                                             <img src="assets/images/avatars/avatar-8.png" class="msg-avatar"
                                                 alt="user avatar">
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6
                                                     hrs
                                                     ago</span></h6>
                                             <p class="msg-info">It was popularised in the 1960s</p>
                                         </div>
                                     </div>
                                 </a>
                             </div>
                             <a href="javascript:;">
                                 <div class="text-center msg-footer">
                                     <button class="btn btn-primary w-100">View All Notifications</button>
                                 </div>
                             </a>
                         </div>
                     </li>
                     <li class="nav-item dropdown dropdown-large">
                         {{-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
									<i class='bx bx-shopping-bag'></i>
								</a> --}}
                         <div class="dropdown-menu dropdown-menu-end">
                             <a href="javascript:;">
                             </a>
                             <div class="header-message-list">
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="position-relative">
                                             <div class="cart-product rounded-circle bg-light">
                                                 <img src="assets/images/products/02.png" class=""
                                                     alt="product image">
                                             </div>
                                         </div>
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="position-relative">
                                             <div class="cart-product rounded-circle bg-light">
                                                 <img src="assets/images/products/03.png" class=""
                                                     alt="product image">
                                             </div>
                                         </div>
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="position-relative">
                                             <div class="cart-product rounded-circle bg-light">
                                                 <img src="assets/images/products/04.png" class=""
                                                     alt="product image">
                                             </div>
                                         </div>
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="position-relative">
                                             <div class="cart-product rounded-circle bg-light">
                                                 <img src="assets/images/products/05.png" class=""
                                                     alt="product image">
                                             </div>
                                         </div>
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="position-relative">
                                             <div class="cart-product rounded-circle bg-light">
                                                 <img src="assets/images/products/06.png" class=""
                                                     alt="product image">
                                             </div>
                                         </div>
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="position-relative">
                                             <div class="cart-product rounded-circle bg-light">
                                                 <img src="assets/images/products/07.png" class=""
                                                     alt="product image">
                                             </div>
                                         </div>
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="position-relative">
                                             <div class="cart-product rounded-circle bg-light">
                                                 <img src="assets/images/products/08.png" class=""
                                                     alt="product image">
                                             </div>
                                         </div>
                                         <div class="flex-grow-1">
                                             <h6 class="cart-product-title mb-0">Men White T-Shirt</h6>
                                             <p class="cart-product-price mb-0">1 X $29.00</p>
                                         </div>
                                         <div class="">
                                             <p class="cart-price mb-0">$250</p>
                                         </div>
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                                 <a class="dropdown-item" href="javascript:;">
                                     <div class="d-flex align-items-center gap-3">
                                         <div class="position-relative">
                                             <div class="cart-product rounded-circle bg-light">
                                                 <img src="assets/images/products/09.png" class=""
                                                     alt="product image">
                                             </div>
                                         </div>
                                         <div class="cart-product-cancel"><i class="bx bx-x"></i>
                                         </div>
                                     </div>
                                 </a>
                             </div>
                             <a href="javascript:;">
                                 <div class="text-center msg-footer">
                                     <button class="btn btn-primary w-100">Checkout</button>
                                 </div>
                             </a>
                         </div>
                     </li>
                 </ul>
             </div>
             <div class="user-box dropdown px-3">
                @if(Auth::check())
                 <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret"
                     href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}" class="user-img"
                         alt="user avatar">
                     <div class="user-info">
                         <p class="user-name mb-0">{{ Auth::user()->name }}</p>
                     </div>
                 </a>
                 @endif
                 <ul class="dropdown-menu dropdown-menu-end">
                     <li><a class="dropdown-item d-flex align-items-center" href="{{ 'profile' }}"><i
                                 class="bx bx-user fs-5"></i><span>Profile</span></a>
                     </li>
                     <li><a class="dropdown-item d-flex align-items-center" href="{{ 'changepassword' }}"><i
                                 class="bx bx-user fs-5"></i><span>ChangePassword</span></a>
                     </li>
                     <li><a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                 class="bx bx-cog fs-5"></i><span>Settings</span></a>
                     </li>
                     <li>
                         <div class="dropdown-divider mb-0"></div>
                     </li>
                     <li><a class="dropdown-item d-flex align-items-center" href="{{ route('signout') }}"><i
                                 class="bx bx-log-out-circle"></i><span>Logout</span></a>
                     </li>
                 </ul>
             </div>
         </nav>
     </div>
 </header>
 <!--end header -->
@if(Auth::check())
 @if ($showPopup)
     <div id="headerAlert" class="alert alert-danger alert-dismissible fade show text-center w-100 m-0"
         role="alert" style="border-radius: 0; position: fixed; top: 0; left: 0; z-index: 1055;">
         <strong>Reminder:</strong> Your Server activation is due in {{ $daysLeft }}
         day{{ $daysLeft > 1 ? 's' : '' }}.
         Please make your payment.
         <div class="mt-3">
             <a href="{{ url('/serverpayment') }}" class="btn btn-sm btn-primary px-4">
                 💳 Make Payment
             </a>
         </div>
         <button type="button" class="btn-close" onclick="closeHeaderPopup()" aria-label="Close"></button>
     </div>
 @endif
 @if ($siteshowPopup && $unpaidPayment)
     <div id="headerAlert1" class="alert alert-warning alert-dismissible fade show text-center w-100 m-0"
         role="alert" style="border-radius: 0; position: fixed; top: 0; left: 0; z-index: 1055;">
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
 @endif
 @endif
