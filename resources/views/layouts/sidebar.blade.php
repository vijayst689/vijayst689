<style>
    /* Sidebar Background */
.vertical-menu {
    background: linear-gradient(180deg, #1e1e2f, #2a2a40);
    box-shadow: 2px 0 15px rgba(0,0,0,0.3);
}

/* User Name */
.menu-title h2 {
    color: #ffffff;
    font-size: 18px;
    font-weight: 600;
    padding: 15px 10px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

/* Main Menu Links */
#side-menu li a {
    color: #cfd8dc;
    padding: 12px 20px;
    font-size: 14px;
    border-radius: 6px;
    margin: 3px 10px;
    transition: all 0.3s ease;
}

/* Icons */
#side-menu li a i {
    color: #4fc3f7;
    margin-right: 10px;
    font-size: 18px;
}

/* Hover Effect */
#side-menu li a:hover {
    background: linear-gradient(90deg, #4fc3f7, #0288d1);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(79,195,247,0.4);
}

/* Active Menu */
#side-menu li.mm-active > a {
    background: linear-gradient(90deg, #ff9800, #f57c00);
    color: #ffffff !important;
    font-weight: 600;
}

/* Sub Menu */
#side-menu .sub-menu {
    background: #23233a;
    border-radius: 8px;
    margin: 5px 15px;
    padding: 5px 0;
}

#side-menu .sub-menu li a {
    font-size: 13px;
    padding: 8px 20px;
    color: #b0bec5;
}

/* Sub Menu Hover */
#side-menu .sub-menu li a:hover {
    background: #37474f;
    color: #ffffff;
}

/* Scrollbar */
.vertical-menu ::-webkit-scrollbar {
    width: 6px;
}

.vertical-menu ::-webkit-scrollbar-thumb {
    background: #4fc3f7;
    border-radius: 10px;
}
/* Icons */
#side-menu li a i {
    color: #4fc3f7;
    margin-right: 10px;
    font-size: 18px;
}

/* Hover Effect */
#side-menu li a:hover {
    background: linear-gradient(90deg, #4fc3f7, #0288d1);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(79,195,247,0.4);
}

/* Active Menu */
#side-menu li.mm-active > a {
    background: linear-gradient(90deg, #ff9800, #f57c00);
    color: #ffffff !important;
    font-weight: 600;
}

/* Sub Menu */
#side-menu .sub-menu {
    background: #23233a;
    border-radius: 8px;
    margin: 5px 15px;
    padding: 5px 0;
}

#side-menu .sub-menu li a {
    font-size: 13px;
    padding: 8px 20px;
    color: #b0bec5;
}

/* Sub Menu Hover */
#side-menu .sub-menu li a:hover {
    background: #37474f;
    color: #ffffff;
}

/* Scrollbar */
.vertical-menu ::-webkit-scrollbar {
    width: 6px;
}

.vertical-menu ::-webkit-scrollbar-thumb {
    background: #4fc3f7;
    border-radius: 10px;
}
/* 🔥 Force all sidebar text to white */
#side-menu li a {
    color: #ffffff !important;
}

/* Submenu text white */
#side-menu .sub-menu li a {
    color: #ffffff !important;
}

/* Menu title */
.menu-title h2 {
    color: #ffffff !important;
}

/* Icons also white (optional) */
#side-menu li a i {
    color: #ffffff !important;
}
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">
        @if (Auth::user()->user_type_id == 1)
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">
                        <h2>{{ Auth::user()->name }}</h2>
                    </li>
                    <li>
                        <a href="{{ url('/dashboard') }}" class="waves-effect">
                            <i class="mdi mdi-speedometer"></i>
                            <span class="badge rounded-pill bg-danger float-end"></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/payment/summary') }}" class="waves-effect">
                            <i class="mdi mdi-speedometer"></i>
                            <span class="badge rounded-pill bg-danger float-end"></span>
                            <span>SUMMARY</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>User Activation</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/useractivation') }}/3">Services</a>
                            <li><a href="{{ url('/useractivation') }}/1">Pdf</a>
                            <li><a href="{{ url('/useractivation') }}/2">Utility</a>
                            <li><a href="{{ url('/useractivation') }}/4">Pan</a>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Service Status</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/appliedservice') }}/Pending">Pending</a></li>
                            <li><a href="{{ url('/appliedservice') }}/Resubmit">Resubmit</a></li>
                            <li><a href="{{ url('/appliedservice') }}/Processing">Processing</a></li>
                            <li><a href="{{ url('/appliedservice') }}/Rejected">Rejected</a></li>
                            <li><a href="{{ url('/appliedservice') }}/Approved">Approved</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Service Payment</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @foreach ($services as $service)
                                <li><a
                                        href="{{ url('/servicepayment', $service->id) }}">{{ $service->service_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>NalaVariyam</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/nalavariyampayment') }}">Payment</a></li>
                            <li><a href="{{ url('/nalauseractivationpayment') }}">User Activation</a></li>
                            <li><a href="{{ url('/splmemberactivationpayment') }}">Special Member</a></li>
                        </ul>

                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>PDF Services</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/addfindservice') }}">Add Find Services</a></li>
                            <li><a href="{{ url('/viewfind') }}">View Find</a></li>
                            <li><a href="{{ url('/findpayment') }}">Payment</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Utility Services</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/addutilityservice') }}">Add Utility Services</a></li>
                            <li><a href="{{ url('/viewutility') }}">View Utility</a></li>
                            <li><a href="{{ url('/viewoperators') }}">View Operators</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Utility Commission</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @foreach ($utilityservice as $uti)
                                <li><a href="{{ url('/rechargepayment', $uti->id) }}">{{ $uti->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>PanCard Services</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/addpan') }}">Add Pan</a></li>
                            <li><a href="{{ url('/viewpan') }}">View Pan</a></li>
                            <li><a href="{{ url('/panservicepayment') }}">PanPayment</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Services</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/service') }}">Add Service</a></li>
                            <li><a href="{{ url('/viewservice') }}">View Services</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Our Service</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/allservices') }}">Our Service</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Admin</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/admins') }}">View Admins</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Distributor</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/adddistributor') }}">Add Distributor</a></li>
                            <li><a href="{{ url('/distributors') }}">View Distributors</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Retailer</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/addretailer') }}">Add Retailler</a></li>
                            <li><a href="{{ url('/retailers') }}">View Retailer</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('/website') }}" class="waves-effect">
                            <i class="mdi mdi-speedometer"></i>
                            <span class="badge rounded-pill bg-danger float-end"></span>
                            <span>Website</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Ramji Wallet</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/rawallet') }}">Ramji Wallet</a></li>
                            <li><a href="{{ url('/rapaymentrequest') }}">Ramji Paymentrequest</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Wallet</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/wallet') }}">Wallet</a></li>
                            <li><a href="{{ url('/paymentrequest') }}">Paymentrequest</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Application</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/application') }}">Application</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="mdi mdi-email-variant"></i>
                            <span>Meeting List</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ url('/meetinglist') }}">Meeting List</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
    </div>
    @endif
    @if (Auth::user()->user_type_id == 2)
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">
                    <h2>{{ Auth::user()->name }}</h2>
                </li>
                <li>
                    <a href="{{ url('/dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        <span class="badge rounded-pill bg-danger float-end"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>User Permission</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('/userpermission') }}/{{ Auth::user()->id }}" class="waves-effect">
                                <i class="mdi mdi-speedometer"></i>
                                <span class="badge rounded-pill bg-danger float-end"></span>
                                <span>User Permission</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Service Status</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/appliedservice') }}/Pending">Pending</a></li>
                        <li><a href="{{ url('/appliedservice') }}/Resubmit">Resubmit</a></li>
                        <li><a href="{{ url('/appliedservice') }}/Processing">Processing</a></li>
                        <li><a href="{{ url('/appliedservice') }}/Rejected">Rejected</a></li>
                        <li><a href="{{ url('/appliedservice') }}/Approved">Approved</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>User Activation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/useractivation') }}/3">Services</a>
                        <li><a href="{{ url('/useractivation') }}/1">Pdf</a>
                        <li><a href="{{ url('/useractivation') }}/2">Utility</a>
                        <li><a href="{{ url('/useractivation') }}/4">Pan</a>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Service Payment</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @foreach ($services as $service)
                            <li><a href="{{ url('/servicepayment', $service->id) }}">{{ $service->service_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>PDF Services</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/findpayment') }}">Payment</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Our Service</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/allservices') }}">Our Service</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Utility Commission</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @foreach ($utilityservice as $uti)
                            <li><a href="{{ url('/rechargepayment', $uti->id) }}">{{ $uti->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>PanCard Services</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/panservicepayment') }}">PanPayment</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Distributor</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/adddistributor') }}">Add Distributor</a></li>
                        <li><a href="{{ url('/distributors') }}">View Distributors</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Retailer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/addretailer') }}">Add Retailler</a></li>
                        <li><a href="{{ url('/retailers') }}">View Retailer</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Notification</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/addnotification') }}">Add Notification</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Ramji Wallet</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/rawallet') }}">Ramji Wallet</a></li>
                        <li><a href="{{ url('/rapaymentrequest') }}">Ramji Paymentrequest</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-variant"></i>
                        <span>Wallet</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('/wallet') }}">Wallet</a></li>
                        <li><a href="{{ url('/paymentrequest') }}">Paymentrequest</a></li>
                    </ul>
                </li>
            </ul>
        </div>
</div>
@endif
@if (Auth::user()->user_type_id == 3)
    <div id="sidebar-menu">
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">
                <h2>{{ Auth::user()->name }}</h2>
            </li>
            <li>
                <a href="{{ url('/dashboard') }}" class="waves-effect">
                    <i class="mdi mdi-speedometer"></i>
                    <span class="badge rounded-pill bg-danger float-end"></span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>User Permission</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="{{ url('/userpermission') }}/{{ Auth::user()->id }}" class="waves-effect">
                            <i class="mdi mdi-speedometer"></i>
                            <span class="badge rounded-pill bg-danger float-end"></span>
                            <span>User Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Service Status</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/appliedservice') }}/Pending">Pending</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Resubmit">Resubmit</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Processing">Processing</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Rejected">Rejected</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Approved">Approved</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Our Service</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/allservices') }}">Our Service</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Retailer</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/addretailer') }}">Add Retailler</a></li>
                    <li><a href="{{ url('/retailers') }}">View Retailer</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Wallet</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/wallet') }}">Wallet</a></li>
                    <li><a href="{{ url('/paymentrequest') }}">Paymentrequest</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Application</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/application') }}">Application</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
@endif
@if (Auth::user()->user_type_id == 4)
    <div id="sidebar-menu">
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">
                <h2>{{ Auth::user()->name }}</h2>
            </li>
            <li>
                <a href="{{ url('/dashboard') }}" class="waves-effect">
                    <i class="mdi mdi-speedometer"></i>
                    <span class="badge rounded-pill bg-danger float-end"></span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>User Permission</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="{{ url('/userpermission') }}/{{ Auth::user()->id }}" class="waves-effect">
                            <i class="mdi mdi-speedometer"></i>
                            <span class="badge rounded-pill bg-danger float-end"></span>
                            <span>User Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Service Status</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/appliedservice') }}/Pending">Pending</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Resubmit">Resubmit</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Processing">Processing</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Rejected">Rejected</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Approved">Approved</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Our Service</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/allservices') }}">Our Service</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Wallet</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/wallet') }}">Wallet</a></li>
                    <li><a href="{{ url('/paymentrequest') }}">Paymentrequest</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Application</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/application') }}">Application</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
@endif
@if (Auth::user()->user_type_id == 5)
    <div id="sidebar-menu">
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">
                <h2>{{ Auth::user()->name }}</h2>
            </li>
            <li>
                <a href="{{ url('/dashboard') }}" class="waves-effect">
                    <i class="mdi mdi-speedometer"></i>
                    <span class="badge rounded-pill bg-danger float-end"></span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Service Status</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/appliedservice') }}/Pending">Pending</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Resubmit">Resubmit</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Processing">Processing</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Rejected">Rejected</a></li>
                    <li><a href="{{ url('/appliedservice') }}/Approved">Approved</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Services</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/allservice') }}/{{ Auth::user()->id }}">TNeGA</a></li>
                </ul>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('allservices') }}">Other Services</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-email-variant"></i>
                    <span>Wallet</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('/wallet') }}">Wallet</a></li>
                    <li><a href="{{ url('/paymentrequest') }}">Paymentrequest</a></li>
                </ul>
            </li>
        </ul>
    </div>
    </div>
@endif
</div>
