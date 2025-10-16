<!--sidebar wrapper -->
<div class="wrapper">
    <div class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            <div class="col text-center">
                <img src="{{ asset('assets/images/logo-icon.png') }}" width="120" alt="logo icon">
            </div>
            <div>
                <h5 class="logo-text text-info"></h5>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
            </div>
        </div>
        <!--navigation-->
        @if (Auth::user()->user_type_id == 1)
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ url('/dashboard') }}" class="has-arrow">
                        <div class="parent-icon"><i class='bx bx-home-alt'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">User Activation</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/useractivation') }}/3"><i class='bx bx-radio-circle'></i>Services</a>
                        </li>
                        <li> <a href="{{ url('/useractivation') }}/1"><i class='bx bx-radio-circle'></i>Pdf</a>
                        </li>
                        <li> <a href="{{ url('/useractivation') }}/2"><i class='bx bx-radio-circle'></i>Utility</a>
                        </li>
                        <li> <a href="{{ url('/useractivation') }}/4"><i class='bx bx-radio-circle'></i>Pan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-category"></i>
                        </div>
                        <div class="menu-title">Service Status</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/appliedservice') }}/Pending"><i
                                    class='bx bx-radio-circle'></i>Pending</a>
                        </li>
                        <li> <a href="{{ url('/appliedservice') }}/Resubmit"><i
                                    class='bx bx-radio-circle'></i>Resubmit</a>
                        </li>
                        <li> <a href="{{ url('/appliedservice') }}/Processing"><i
                                    class='bx bx-radio-circle'></i>Processing</a>
                        </li>
                        <li> <a href="{{ url('/appliedservice') }}/Rejected"><i
                                    class='bx bx-radio-circle'></i>Rejected</a>
                        </li>
                        <li> <a href="{{ url('/appliedservice') }}/Approved"><i
                                    class='bx bx-radio-circle'></i>Approved</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-diamond"></i>
                        </div>
                        <div class="menu-title">Service Payment</div>
                    </a>
                    <ul>
                        @foreach ($services as $service)
                            <li> <a href="{{ url('/servicepayment', $service->id) }}"><i
                                        class='bx bx-radio-circle'></i>{{ $service->service_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                        </div>
                        <div class="menu-title">Nalavariyam</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/nalavariyampayment') }}"><i class='bx bx-radio-circle'></i>Payment</a>
                        </li>
                        <li> <a href="{{ url('/nalauseractivationpayment') }}"><i class='bx bx-radio-circle'></i>User
                                Activation</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="bx bx-cookie"></i>
                        </div>
                        <div class="menu-title">PDF Services</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/addfindservice') }}"><i class='bx bx-radio-circle'></i>Add Pdf</a></li>
                        <li> <a href="{{ url('/viewfind') }}"><i class='bx bx-radio-circle'></i>View Find</a>
                        <li> <a href="{{ url('/findpayment') }}"><i class='bx bx-radio-circle'></i>Payment</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-repeat"></i>
                        </div>
                        <div class="menu-title">Utility Services</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/addutilityservice') }}"><i class='bx bx-radio-circle'></i>Add
                                Utility</a>
                        </li>
                        <li> <a href="{{ url('/viewutility') }}"><i class='bx bx-radio-circle'></i>View Utility</a>
                        </li>
                        <li> <a href="{{ url('/viewoperators') }}"><i class='bx bx-radio-circle'></i>View Operators</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                        </div>
                        <div class="menu-title">Utility Commission</div>
                    </a>
                    <ul>
                        @foreach ($utilityservice as $uti)
                            <li> <a href="{{ url('/rechargepayment', $uti->id) }}"><i
                                        class='bx bx-radio-circle'></i>{{ $uti->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-map-alt"></i>
                        </div>
                        <div class="menu-title">PanCard Services</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/addpan') }}"><i class='bx bx-radio-circle'></i>Add Pan</a>
                        </li>
                        <li> <a href="{{ url('/viewpan') }}"><i class='bx bx-radio-circle'></i>View Pan</a>
                        </li>
                        <li> <a href="{{ url('/panservicepayment') }}"><i
                                    class='bx bx-radio-circle'></i>PanPayment</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-line-chart"></i>
                        </div>
                        <div class="menu-title">Services</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/service') }}"><i class='bx bx-radio-circle'></i>Add Service</a>
                        </li>
                        <li> <a href="{{ url('/viewservice') }}"><i class='bx bx-radio-circle'></i>View Services</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-repeat"></i>
                        </div>
                        <div class="menu-title">Our Service</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/allservices') }}"><i class='bx bx-radio-circle'></i>Our Service</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-menu"></i>
                        </div>
                        <div class="menu-title">Admin</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/admins') }}"><i class='bx bx-radio-circle'></i>Admins</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-menu"></i>
                        </div>
                        <div class="menu-title">Distributors</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/distributors') }}"><i class='bx bx-radio-circle'></i>Distributors</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-menu"></i>
                        </div>
                        <div class="menu-title">Retailers</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/retailers') }}"><i class='bx bx-radio-circle'></i>Retailers</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-diamond"></i>
                        </div>
                        <div class="menu-title">Ramji Wallet</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/rawallet') }}"><i class='bx bx-radio-circle'></i>Ramji Wallet</a>
                        </li>
                        <li> <a href="{{ url('/rapaymentrequest') }}"><i class='bx bx-radio-circle'></i>Ramji
                                Paymentrequest</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class="bx bx-diamond"></i>
                        </div>
                        <div class="menu-title">Wallet</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/wallet') }}"><i class='bx bx-radio-circle'></i>Wallet</a>
                        </li>
                        <li> <a href="{{ url('/paymentrequest') }}"><i
                                    class='bx bx-radio-circle'></i>Paymentrequest</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow" href="javascript:;">
                        <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                        </div>
                        <div class="menu-title">Application</div>
                    </a>
                    <ul>
                        <li> <a href="{{ url('/application') }}"><i class='bx bx-radio-circle'></i>Application</a>
                        </li>
                    </ul>
                </li>
            </ul>
    </div>
    @endif
    @if (Auth::user()->user_type_id == 2)
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ url('/dashboard') }}" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-home-alt'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">User Permission</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/userpermission') }}/{{ Auth::user()->id }}"><i
                                class='bx bx-radio-circle'></i>User Permission</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Service Status</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/appliedservice') }}/Pending"><i class='bx bx-radio-circle'></i>Pending</a>
                    </li>
                    <li> <a href="{{ url('/appliedservice') }}/Resubmit"><i
                                class='bx bx-radio-circle'></i>Resubmit</a>
                    </li>
                    <li> <a href="{{ url('/appliedservice') }}/Processing"><i
                                class='bx bx-radio-circle'></i>Processing</a>
                    </li>
                    <li> <a href="{{ url('/appliedservice') }}/Rejected"><i
                                class='bx bx-radio-circle'></i>Rejected</a>
                    </li>
                    <li> <a href="{{ url('/appliedservice') }}/Approved"><i
                                class='bx bx-radio-circle'></i>Approved</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">User Activation</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/useractivation') }}/3"><i class='bx bx-radio-circle'></i>Services</a>
                    </li>
                    <li> <a href="{{ url('/useractivation') }}/1"><i class='bx bx-radio-circle'></i>Pdf</a>
                    </li>
                    <li> <a href="{{ url('/useractivation') }}/2"><i class='bx bx-radio-circle'></i>Utility</a>
                    </li>
                    <li> <a href="{{ url('/useractivation') }}/4"><i class='bx bx-radio-circle'></i>Pan</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-diamond"></i>
                    </div>
                    <div class="menu-title">Service Payment</div>
                </a>
                <ul>
                    @foreach ($services as $service)
                        <li> <a href="{{ url('/servicepayment', $service->id) }}"><i
                                    class='bx bx-radio-circle'></i>{{ $service->service_name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-cookie"></i>
                    </div>
                    <div class="menu-title">PDF Services</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/findpayment') }}"><i class='bx bx-radio-circle'></i>Payment</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-repeat"></i>
                    </div>
                    <div class="menu-title">Our Service</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/allservices') }}"><i class='bx bx-radio-circle'></i>Our Service</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-repeat"></i>
                    </div>
                    <div class="menu-title">Services</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/viewservice') }}"><i class='bx bx-radio-circle'></i>Services</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                    </div>
                    <div class="menu-title">Utility Commission</div>
                </a>
                <ul>
                    @foreach ($utilityservice as $uti)
                        <li> <a href="{{ url('/rechargepayment', $uti->id) }}"><i
                                    class='bx bx-radio-circle'></i>{{ $uti->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-menu"></i>
                    </div>
                    <div class="menu-title">PanCard Services</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/panservicepayment') }}"><i class='bx bx-radio-circle'></i>PanPayment</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-menu"></i>
                    </div>
                    <div class="menu-title">Distributors</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/adddistributor') }}"><i class='bx bx-radio-circle'></i>Add
                            Distributors</a>
                    </li>
                    <li> <a href="{{ url('/distributors') }}"><i class='bx bx-radio-circle'></i>Distributors</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-menu"></i>
                    </div>
                    <div class="menu-title">Retailers</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/addretailer') }}"><i class='bx bx-radio-circle'></i>Add Retailers</a>
                    </li>
                    <li> <a href="{{ url('/retailers') }}"><i class='bx bx-radio-circle'></i>Retailers</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-diamond"></i>
                    </div>
                    <div class="menu-title">Ramji Wallet</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/rawallet') }}"><i class='bx bx-radio-circle'></i>Ramji Wallet</a>
                    </li>
                    <li> <a href="{{ url('/rapaymentrequest') }}"><i class='bx bx-radio-circle'></i>Ramji
                            Paymentrequest</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-diamond"></i>
                    </div>
                    <div class="menu-title">Wallet</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/wallet') }}"><i class='bx bx-radio-circle'></i>Wallet</a>
                    </li>
                    <li> <a href="{{ url('/paymentrequest') }}"><i class='bx bx-radio-circle'></i>Paymentrequest</a>
                    </li>
                </ul>
            </li>
               <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-cookie"></i>
                    </div>
                    <div class="menu-title">Requirement</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/requirement') }}"><i class='bx bx-radio-circle'></i>Add
                            Requirement</a>
                    </li>
                    <li> <a href="{{ url('/viewrequirement') }}"><i class='bx bx-radio-circle'></i>View
                            Requirement</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class="bx bx-menu"></i>
                    </div>
                    <div class="menu-title">Notification</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/addnotification') }}"><i class='bx bx-radio-circle'></i>Add
                            Notification</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:;">
                    <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Application</div>
                </a>
                <ul>
                    <li> <a href="{{ url('/application') }}"><i class='bx bx-radio-circle'></i>Application</a>
                    </li>
                </ul>
            </li>
        </ul>
</div>
@endif
@if (Auth::user()->user_type_id == 3)
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('/dashboard') }}" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">User Permission</div>
            </a>
            <ul>
                <li> <a href="{{ url('/userpermission') }}/{{ Auth::user()->id }}"><i
                            class='bx bx-radio-circle'></i>User Permission</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Service Status</div>
            </a>
            <ul>
                <li> <a href="{{ url('/appliedservice') }}/Pending"><i class='bx bx-radio-circle'></i>Pending</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Resubmit"><i class='bx bx-radio-circle'></i>Resubmit</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Processing"><i
                            class='bx bx-radio-circle'></i>Processing</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Rejected"><i class='bx bx-radio-circle'></i>Rejected</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Approved"><i class='bx bx-radio-circle'></i>Approved</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Our Service</div>
            </a>
            <ul>
                <li> <a href="{{ url('/allservices') }}"><i class='bx bx-radio-circle'></i>Our Service</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-menu"></i>
                </div>
                <div class="menu-title">Retailers</div>
            </a>
            <ul>
                <li> <a href="{{ url('/addretailer') }}"><i class='bx bx-radio-circle'></i>Add Retailers</a>
                </li>
                <li> <a href="{{ url('/retailers') }}"><i class='bx bx-radio-circle'></i>Retailers</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-diamond"></i>
                </div>
                <div class="menu-title">Wallet</div>
            </a>
            <ul>
                <li> <a href="{{ url('/wallet') }}"><i class='bx bx-radio-circle'></i>Wallet</a>
                </li>
                <li> <a href="{{ url('/paymentrequest') }}"><i class='bx bx-radio-circle'></i>Paymentrequest</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Application</div>
            </a>
            <ul>
                <li> <a href="{{ url('/application') }}"><i class='bx bx-radio-circle'></i>Application</a>
                </li>
            </ul>
        </li>
    </ul>
    </div>
@endif
@if (Auth::user()->user_type_id == 4)
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('/dashboard') }}" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">User Permission</div>
            </a>
            <ul>
                <li> <a href="{{ url('/userpermission') }}/{{ Auth::user()->id }}"><i
                            class='bx bx-radio-circle'></i>User Permission</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Service Status</div>
            </a>
            <ul>
                <li> <a href="{{ url('/appliedservice') }}/Pending"><i class='bx bx-radio-circle'></i>Pending</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Resubmit"><i class='bx bx-radio-circle'></i>Resubmit</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Processing"><i
                            class='bx bx-radio-circle'></i>Processing</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Rejected"><i class='bx bx-radio-circle'></i>Rejected</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Approved"><i class='bx bx-radio-circle'></i>Approved</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Our Service</div>
            </a>
            <ul>
                <li> <a href="{{ url('/allservices') }}"><i class='bx bx-radio-circle'></i>Our Service</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-diamond"></i>
                </div>
                <div class="menu-title">Wallet</div>
            </a>
            <ul>
                <li> <a href="{{ url('/wallet') }}"><i class='bx bx-radio-circle'></i>Wallet</a>
                </li>
                <li> <a href="{{ url('/paymentrequest') }}"><i class='bx bx-radio-circle'></i>Paymentrequest</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Application</div>
            </a>
            <ul>
                <li> <a href="{{ url('/application') }}"><i class='bx bx-radio-circle'></i>Application</a>
                </li>
            </ul>
        </li>
    </ul>
    </div>
@endif
@if (Auth::user()->user_type_id == 5)
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('/dashboard') }}" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Service Status</div>
            </a>
            <ul>
                <li> <a href="{{ url('/appliedservice') }}/Pending"><i class='bx bx-radio-circle'></i>Pending</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Resubmit"><i class='bx bx-radio-circle'></i>Resubmit</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Processing"><i
                            class='bx bx-radio-circle'></i>Processing</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Rejected"><i class='bx bx-radio-circle'></i>Rejected</a>
                </li>
                <li> <a href="{{ url('/appliedservice') }}/Approved"><i class='bx bx-radio-circle'></i>Approved</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Services</div>
            </a>
            <ul>
                <li> <a href="{{ url('/allservice') }}/{{ Auth::user()->id }}"><i
                            class='bx bx-radio-circle'></i>TNeGA</a>
                </li>
                <li> <a href="{{ url('/allservices') }}"><i class='bx bx-radio-circle'></i>Other Services</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-diamond"></i>
                </div>
                <div class="menu-title">Wallet</div>
            </a>
            <ul>
                <li> <a href="{{ url('/wallet') }}"><i class='bx bx-radio-circle'></i>Wallet</a>
                </li>
                <li> <a href="{{ url('/paymentrequest') }}"><i class='bx bx-radio-circle'></i>Paymentrequest</a>
                </li>
            </ul>
        </li>
    </ul>
    </div>
@endif
