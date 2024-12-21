<aside class="sidebar-wrapper" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
        <div class="simplebar-height-auto-observer-wrapper">
            <div class="simplebar-height-auto-observer"></div>
        </div>
        <div class="simplebar-mask">
            <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                    <div class="simplebar-content" style="padding: 0px;">
                        <div class="sidebar-header">
                            <div class="logo-icon">
                                <img src="{{ asset('assets/images/pkrm.png') }}" width="100%" alt="">
                            </div>
                            <div class="logo-name flex-grow-1"> <a href="{{ url('dashboard') }}">

                            </div>
                            <div class="sidebar-close">
                                <span class="material-icons-outlined">close</span>
                            </div>
                        </div>

                        <div class="sidebar-nav mm-active">
                            <!--navigation-->
                            @if (Auth::user()->user_type_id == 1)
                                <ul class="metismenu mm-show" id="sidenav">
                                    <li>
                                        <a href="{{ url('dashboard') }}">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Dashboard</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Service Status</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="material-icons-outlined">arrow_right</i>Pending</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="material-icons-outlined">arrow_right</i>Processing</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="material-icons-outlined">arrow_right</i>Resubmit</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="material-icons-outlined">arrow_right</i>Approved</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Find Services</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('/addfindservice') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Find Services</a>
                                            </li>
                                            <li><a href="{{ url('/viewfind') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>View Find</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Utility Services</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('/addutilityservice') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Utility Services</a>
                                            </li>
                                            <li><a href="{{ url('/viewutility') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>View Utility</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="has-arrow">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Services</div>
                                        </a>
                                        <ul>
                                            <li><a href="{{ url('/service') }}"><i class="material-icons-outlined">arrow_right</i>Add
                                                    Services</a>
                                            </li>
                                            <li><a href="{{ url('/viewservice') }}"><i
                                                class="material-icons-outlined">arrow_right</i>Services</a>
                                    </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Distributor</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('adddistributor') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add
                                                    Distributor</a>
                                            </li>
                                            <li><a href="{{ url('distributors') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Distributors</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Retailer</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('addretailer') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Retailer</a>
                                            </li>
                                            <li><a href="{{ url('retailers') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Retailers</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="has-arrow">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">TNEGA</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('addcustomer') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Customer</a>
                                            </li>
                                            <li><a href="{{ url('customers') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Customers</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="javascript:;" class="has-arrow" aria-expanded="false">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Ramji Wallet</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('rawallet') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Ramji Wallet</a>
                                            </li>
                                            <li><a href="{{ url('rapaymentrequest') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Ramji Payment
                                                    Request</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="javascript:;" class="has-arrow" aria-expanded="false">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Wallet</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('wallet') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Wallet</a>
                                            </li>
                                            <li><a href="{{ url('paymentrequest') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Payment
                                                    Request</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                            <!--end navigation-->
                            <!--navigation-->
                            @if (Auth::user()->user_type_id == 2)
                                <ul class="metismenu mm-show" id="sidenav">
                                    <li>
                                        <a href="{{ url('dashboard') }}">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Dashboard</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Service Status</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="material-icons-outlined">arrow_right</i>Pending</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="material-icons-outlined">arrow_right</i>Processing</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="material-icons-outlined">arrow_right</i>Resubmit</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="material-icons-outlined">arrow_right</i>Approved</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Service Payment</div>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            @foreach($services as $service)
                                            <li><a href="{{ url('/servicepayment',$service->id) }}">{{ $service->service_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Smartcard Payment</div>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            @foreach($smartservice as $service)
                                            <li><a href="{{ url('/smartcardpayment',$service->id) }}">{{ $service->service_name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Distributor</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('adddistributor') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add
                                                    Distributor</a>
                                            </li>
                                            <li><a href="{{ url('distributors') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Distributors</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Retailer</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('addretailer') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Retailer</a>
                                            </li>
                                            <li><a href="{{ url('retailers') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Retailers</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="has-arrow">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">TNEGA</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('addcustomer') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Customer</a>
                                            </li>
                                            <li><a href="{{ url('customers') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Customers</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="has-arrow">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Other Services</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('allservices') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Services</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Ramji Wallet</div>
                                        </a>
                                        <ul class="sub-menu" aria-expanded="false">
                                            <li><a href="{{ url('/rawallet') }}">Ramji Wallet</a></li>
                                            <li><a href="{{ url('/rapaymentrequest') }}">Ramji Paymentrequest</a></li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="javascript:;" class="has-arrow" aria-expanded="false">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Wallet</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('wallet') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Wallet</a>
                                            </li>
                                            <li><a href="{{ url('paymentrequest') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Payment
                                                    Request</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                            @if (Auth::user()->user_type_id == 3)
                                <ul class="metismenu mm-show" id="sidenav">
                                    <li>
                                        <a href="{{ url('dashboard') }}">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Dashboard</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Service Status</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="material-icons-outlined">arrow_right</i>Pending</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="material-icons-outlined">arrow_right</i>Processing</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="material-icons-outlined">arrow_right</i>Resubmit</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="material-icons-outlined">arrow_right</i>Approved</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Retailer</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('addretailer') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Retailer</a>
                                            </li>
                                            <li><a href="{{ url('retailers') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Retailers</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="has-arrow">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">TNEGA</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('addcustomer') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Customer</a>
                                            </li>
                                            <li><a href="{{ url('customers') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Customers</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="has-arrow">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Other Services</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('allservices') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Services</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="javascript:;" class="has-arrow" aria-expanded="false">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Wallet</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('wallet') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Wallet</a>
                                            </li>
                                            <li><a href="{{ url('paymentrequest') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Payment
                                                    Request</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                            @if (Auth::user()->user_type_id == 4)
                                <ul class="metismenu mm-show" id="sidenav">
                                    <li>
                                        <a href="{{ url('dashboard') }}">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Dashboard</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Service Status</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="material-icons-outlined">arrow_right</i>Pending</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="material-icons-outlined">arrow_right</i>Processing</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="material-icons-outlined">arrow_right</i>Resubmit</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="material-icons-outlined">arrow_right</i>Approved</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="has-arrow">
                                            <div class="parent-icon"><i></i>
                                            </div>
                                            <div class="menu-title">TNEGA</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('addcustomer') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Add Customer</a>
                                            </li>
                                            <li><a href="{{ url('customers') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Customers</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="has-arrow">
                                            <div class="parent-icon"><i></i>
                                            </div>
                                            <div class="menu-title">Other Services</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('allservices') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Services</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="javascript:;" class="has-arrow" aria-expanded="false">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Wallet</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('wallet') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Wallet</a>
                                            </li>
                                            <li><a href="{{ url('paymentrequest') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Payment
                                                    Request</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                            <!--end navigation-->
                            <!--navigation-->
                            @if (Auth::user()->user_type_id == 5)
                                <ul class="metismenu mm-show" id="sidenav">
                                    <li>
                                        <a href="{{ url('dashboard') }}">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Dashboard</div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="has-arrow" href="javascript:;">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Service Status</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('/appliedservice') }}/Pending"><i
                                                        class="material-icons-outlined">arrow_right</i>Pending</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Processing"><i
                                                        class="material-icons-outlined">arrow_right</i>Processing</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Resubmit"><i
                                                        class="material-icons-outlined">arrow_right</i>Resubmit</a>
                                            </li>
                                            <li><a href="{{ url('/appliedservice') }}/Approved"><i
                                                        class="material-icons-outlined">arrow_right</i>Approved</a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="">
                                        <a href="javascript:;" class="has-arrow" aria-expanded="false">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Services</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('/allservice') }}/{{ Auth::user()->id }}"><i
                                                class="material-icons-outlined">arrow_right</i>
                                            TNEGA</a>
                                              </li>
                                            <li><a href="{{ url('allservices') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>
                                                    Other Services</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="javascript:;" class="has-arrow" aria-expanded="false">
                                            <div class="parent-icon"><i class="material-icons-outlined"></i>
                                            </div>
                                            <div class="menu-title">Wallet</div>
                                        </a>
                                        <ul class="mm-collapse">
                                            <li><a href="{{ url('wallet') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Wallet</a>
                                            </li>
                                            <li><a href="{{ url('paymentrequest') }}"><i
                                                        class="material-icons-outlined">arrow_right</i>Payment
                                                    Request</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                            <!--end navigation-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="simplebar-placeholder" style="width: auto; height: 1425px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
        <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
        <div class="simplebar-scrollbar"
            style="height: 100px; transform: translate3d(0px, 0px, 0px); display: block;">
        </div>
    </div>
</aside>
<!--  -->
