<div class="modal fade" id="FormModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                <h5 class="modal-title">Request Amount</h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="card-body">
                        <h5 class="card-title mb-4"></h5>
                        <div class="col">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="upload/qr/qrimg.jpeg" class="w-50 mb-4 rounded" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form method="post" class="row g-3" action="{{ url('/saverequest') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <label for="input1" class="form-label">Request Amount</label>
                        <input type="text" name="amount" maxlength="5" class="form-control number"
                            placeholder="Amount">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Paid Image (Screen)</label>
                        <input type="file" name="req_image" class="form-control">
                    </div>

                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-grd-danger px-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addmoney" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                <h5 class="modal-title">Add Payment</h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body">
                <form method="post" class="row g-3" action="{{ url('/adminaddwallet') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12">
                        <label class="form-label">Add Money</label>
                        <input type="text" maxlength="5" placeholder="Amount" name="wallet" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="submit" class="btn btn-grd-danger px-4">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ramjirequest" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Ramji Wallet Request</h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body">
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
                                <input name="amount" type="text" maxlength="5" class="form-control number"
                                    placeholder="Amount">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Paid Image (Screen)</label>
                                <input type="file" name="req_image" class="form-control" maxlength="10">
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
<div class="modal fade" id="addramji" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Super Admin Payment</h5>
                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                    <i class="material-icons-outlined">close</i>
                </a>
            </div>
            <div class="modal-body">
                <form method="post" class="row g-3" action="{{ url('/superadminaddwallet') }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input name="wallet" maxlength="5" type="text" class="form-control" placeholder="Amount">
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
<header class="top-header">
    <nav class="navbar navbar-expand align-items-center gap-4">
        <div class="btn-toggle">
            <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
        </div>
        <div class="search-bar flex-grow-1">
            <div class="position-relative">
                <div class="search-popup p-3">
                    <div class="card rounded-4 overflow-hidden">
                        <div class="card-body search-content">
                        </div>
                        <div class="card-footer text-center bg-transparent">
                            <a href="javascript:;" class="btn w-100">See All Search Results</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->user_type_id == 3 || Auth::user()->user_type_id == 4 || Auth::user()->user_type_id == 5)
            <span class="form-label text-success">Wallet Amount : {{ Auth::user()->wallet }}</span>
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <button type="button" class="btn btn-grd-primary px-4" data-bs-toggle="modal"
                    data-bs-target="#FormModal">Add Money</button>
            </div>
        @elseif (Auth::user()->user_type_id == 2)
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <span class="text-danger"><b>Ramji Wallet : {{ Auth::user()->rawallet }}</b></span>&nbsp;
                <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#ramjirequest">Add Money</button>
            </div>
            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                <span class="text-danger"><b>Wallet Amount : {{ Auth::user()->wallet }}</b></span>&nbsp;
                <button type="button" class="btn-sm btn btn-success px-4" data-bs-toggle="modal"
                    data-bs-target="#addmoney">Add Payment</button>
            </div>
        @endif
        @if (Auth::user()->user_type_id == 1 )
        <div class="d-flex align-items-center gap-2 justify-content-lg-end">
            <span class="text-danger"><b>Ramji Wallet Amount : {{ Auth::user()->rawallet }}</b></span>&nbsp;
            <button type="button" class="btn-sm btn btn-success px-4" data-bs-toggle="modal"
                data-bs-target="#addramji">Add Payment</button>
        </div>
        @endif

        <ul class="navbar-nav gap-1 nav-right-links align-items-center">
            <li class="nav-item d-lg-none mobile-search-btn">
                <a class="nav-link" href="javascript:;"><i class="material-icons-outlined">search</i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;"
                    data-bs-toggle="dropdown"><img src="assets/images/county/08.png" width="22" alt="">
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                    data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:;"><i
                        class="material-icons-outlined">notifications</i>
                    <span class="badge-notify">0</span>
                </a>
                <div class="dropdown-menu dropdown-notify dropdown-menu-end shadow">
                    <div class="px-3 py-1 d-flex align-items-center justify-content-between border-bottom">
                        <h5 class="notiy-title mb-0">Notifications</h5>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle dropdown-toggle-nocaret option"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="material-icons-outlined">
                                    more_vert
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-option dropdown-menu-end shadow">
                                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                        href="javascript:;"><i
                                            class="material-icons-outlined fs-6">inventory_2</i>Archive All</a></div>
                                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                        href="javascript:;"><i class="material-icons-outlined fs-6">done_all</i>Mark
                                        all as read</a></div>
                                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                        href="javascript:;"><i class="material-icons-outlined fs-6">mic_off</i>Disable
                                        Notifications</a>
                                </div>
                                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                        href="javascript:;"><i class="material-icons-outlined fs-6">grade</i>What's
                                        new ?</a></div>
                                <div>
                                    <hr class="dropdown-divider">
                                </div>
                                <div><a class="dropdown-item d-flex align-items-center gap-2 py-2"
                                        href="javascript:;"><i
                                            class="material-icons-outlined fs-6">leaderboard</i>Reports</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="notify-list">
                        <div>
                            <a class="dropdown-item border-bottom py-2" href="javascript:;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="">
                                        <img src="assets/images/avatars/01.png" class="rounded-circle" width="45"
                                            height="45" alt="">
                                    </div>
                                    <div class="">
                                        <h5 class="notify-title">Congratulations Jhon</h5>
                                        <p class="mb-0 notify-desc">Many congtars jhon. You have won the gifts.</p>
                                        <p class="mb-0 notify-time">Today</p>
                                    </div>
                                    <div class="notify-close position-absolute end-0 me-3">
                                        <i class="material-icons-outlined fs-6">close</i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="dropdown-item border-bottom py-2" href="javascript:;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-wrapper bg-primary text-primary bg-opacity-10">
                                        <span>RS</span>
                                    </div>
                                    <div class="">
                                        <h5 class="notify-title">New Account Created</h5>
                                        <p class="mb-0 notify-desc">From USA an user has registered.</p>
                                        <p class="mb-0 notify-time">Yesterday</p>
                                    </div>
                                    <div class="notify-close position-absolute end-0 me-3">
                                        <i class="material-icons-outlined fs-6">close</i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="dropdown-item border-bottom py-2" href="javascript:;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="">
                                        <img src="assets/images/apps/13.png" class="rounded-circle" width="45"
                                            height="45" alt="">
                                    </div>
                                    <div class="">
                                        <h5 class="notify-title">Payment Recived</h5>
                                        <p class="mb-0 notify-desc">New payment recived successfully</p>
                                        <p class="mb-0 notify-time">1d ago</p>
                                    </div>
                                    <div class="notify-close position-absolute end-0 me-3">
                                        <i class="material-icons-outlined fs-6">close</i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="dropdown-item border-bottom py-2" href="javascript:;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="">
                                        <img src="assets/images/apps/14.png" class="rounded-circle" width="45"
                                            height="45" alt="">
                                    </div>
                                    <div class="">
                                        <h5 class="notify-title">New Order Recived</h5>
                                        <p class="mb-0 notify-desc">Recived new order from michle</p>
                                        <p class="mb-0 notify-time">2:15 AM</p>
                                    </div>
                                    <div class="notify-close position-absolute end-0 me-3">
                                        <i class="material-icons-outlined fs-6">close</i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="dropdown-item border-bottom py-2" href="javascript:;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="">
                                        <img src="assets/images/avatars/06.png" class="rounded-circle" width="45"
                                            height="45" alt="">
                                    </div>
                                    <div class="">
                                        <h5 class="notify-title">Congratulations Jhon</h5>
                                        <p class="mb-0 notify-desc">Many congtars jhon. You have won the gifts.</p>
                                        <p class="mb-0 notify-time">Today</p>
                                    </div>
                                    <div class="notify-close position-absolute end-0 me-3">
                                        <i class="material-icons-outlined fs-6">close</i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div>
                            <a class="dropdown-item py-2" href="javascript:;">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-wrapper bg-danger text-danger bg-opacity-10">
                                        <span>PK</span>
                                    </div>
                                    <div class="">
                                        <h5 class="notify-title">New Account Created</h5>
                                        <p class="mb-0 notify-desc">From USA an user has registered.</p>
                                        <p class="mb-0 notify-time">Yesterday</p>
                                    </div>
                                    <div class="notify-close position-absolute end-0 me-3">
                                        <i class="material-icons-outlined fs-6">close</i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}" class="rounded-circle p-1 border"
                        width="45" height="45" alt="">
                </a>
                <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                    <a class="dropdown-item  gap-2 py-2" href="javascript:;">
                        <div class="text-center">
                            <img src="{!! asset('upload/profile_photo') !!}/{{ Auth::user()->profile }}"
                                class="rounded-circle p-1 shadow mb-3" width="90" height="90" alt="">
                            <h5 class="user-name mb-0 fw-bold">{{ Auth::user()->name }}</h5>
                        </div>
                    </a>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('profile') }}"><i
                            class="material-icons-outlined">person_outline</i>My Profile</a>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                            class="material-icons-outlined">local_bar</i>Setting</a>
                    <hr class="dropdown-divider">
                    @guest
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('signout') }}"><i
                                class="material-icons-outlined">power_settings_new</i>Logout</a>
                    @else
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ route('signout') }}"><i
                                class="material-icons-outlined">power_settings_new</i>Logout</a>
                    @endguest
                </div>
            </li>
        </ul>

    </nav>
</header>
