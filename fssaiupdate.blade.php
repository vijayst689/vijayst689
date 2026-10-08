@extends('layouts.app')
@section('content')
    <style>
        /* Default radio border color */
        /* Default border color */
        .form-check-input {
            border-color: #dd1181;
            /* blue border */
        }

        /* Checked state */
        .form-check-input:checked {
            background-color: #dd1181;
            border-color: #dd1181;
        }

        /* Focus shadow */
        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(238, 4, 82, 0.25);
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Thanvidigipay.in</div>
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
                    <div class="row">
                        <div class="col-12 col-xl-12">
                            <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">
                                <div class="card-body p-4">
                                    <h5 class="card-title">{{ $servicename }}</h5>
                                    <form action="{{ url('/fssaiservice_update') }}" id="myForm" method="POST"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <input type="hidden" name="applied_serviceid" value="{{ $services->id }}">
                                            <input type="hidden" name="user_id" value="{{ $services->user_id }}">
                                            <input type="hidden" name="retailer_id" value="{{ $services->retailer_id }}">
                                            <input type="hidden" name="distributor_id"
                                                value="{{ $services->distributor_id }}">
                                            <input type="hidden" name="serviceid" value="{{ $services->service_id }}">
                                            @php
                                                $apply_user_id = 0;
                                                if ($services->retailer_id == 0) {
                                                    $apply_user_id = $services->distributor_id;
                                                } elseif ($services->distributor_id == 0) {
                                                    $apply_user_id = $services->retailer_id;
                                                }
                                            @endphp

                                            @if ($serviceid == 13)
                                                <div class="col-md-12">
                                                    <div class=row>
                                                        <div class="mb-8 col-md-3">
                                                            <div class="form-check form-check-inline">
                                                                <input @if ($services->fssai_license == 1) checked @endif
                                                                    class="form-check-input" type="radio"
                                                                    name="fssai_license" id="trade_retail_license"
                                                                    value="1" />
                                                                <label class="form-check-label"
                                                                    for="trade_retail_license">Trade/Retail</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-8 col-md-3">
                                                            <div class="form-check form-check-inline">
                                                                <input @if ($services->fssai_license == 2) checked @endif
                                                                    class="form-check-input" type="radio"
                                                                    name="fssai_license" id="food_service_license"
                                                                    value="2" />
                                                                <label class="form-check-label"
                                                                    for="food_service_license">Food
                                                                    Service</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-8 col-md-3">
                                                            <div class="form-check form-check-inline">
                                                                <input @if ($services->fssai_license == 3) checked @endif
                                                                    class="form-check-input" type="radio"
                                                                    name="fssai_license" id="central_govt_agencies_license"
                                                                    value="3" />
                                                                <label class="form-check-label"
                                                                    for="central_govt_agencies_license">Central Govt
                                                                    Agencies</label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row" id="food_license" style="display:none;">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="trade_retail"
                                                                class="form-label">Trade/Retail</label>
                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                id="trade_retail" name="trade_retail"
                                                                class="form-control re" maxlength="100">
                                                                <option value="">Select Trade/Retail</option>
                                                                <option @if ($services->trade_retail == 'Storage') selected @endif
                                                                    value="Storage">Storage (Except Controlled Atmosphere
                                                                    and
                                                                    Cold)</option>
                                                                <option @if ($services->trade_retail == 'Wholesaler') selected @endif
                                                                    value="Wholesaler">Wholesaler</option>
                                                                <option @if ($services->trade_retail == 'Distributor') selected @endif
                                                                    value="Distributor">Distributor</option>
                                                                <option @if ($services->trade_retail == 'Transportation') selected @endif
                                                                    value="Transportation">Transportation (having a number
                                                                    of
                                                                    specialized vehicles like insulated refrigerated van/
                                                                    wagon and
                                                                    milk tankers etc.)</option>
                                                                <option @if ($services->trade_retail == 'Retailer') selected @endif
                                                                    value="Retailer">Retailer</option>
                                                                <option @if ($services->trade_retail == 'Direct Seller') selected @endif
                                                                    value="Direct Seller">Direct Seller</option>
                                                                <option @if ($services->trade_retail == 'Food Vending Agencies') selected @endif
                                                                    value="Food Vending Agencies">Food Vending Agencies
                                                                    [Sale of
                                                                    food from vending machines.]</option>
                                                                <option @if ($services->trade_retail == 'Importer') selected @endif
                                                                    value="Importer">Importer</option>
                                                                <option @if ($services->trade_retail == 'Trader/Merchant') selected @endif
                                                                    value="Trader/Merchant">Trader/Merchant - Exporter
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6" id="storagehide" style="display: none;">
                                                    <label>
                                                        <input @if ($services->storage == 1) checked @endif
                                                            type="radio" name="storage" value="capacity_gt_50000"
                                                            data-license="Central">
                                                        Capacity more than 50,000 MT [Central License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->storage == 2) checked @endif
                                                            type="radio" name="storage" value="capacity_upto_50000"
                                                            data-license="State">
                                                        Capacity upto 50,000 MT [State License]
                                                    </label><br>
                                                    <label>
                                                        <input @if ($services->storage == 3) checked @endif
                                                            type="radio" name="storage" value="turnover_upto_12_lakh"
                                                            data-license="Registration">
                                                        Turnover upto 12 lakhs/annum [Registration]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="wholesalerhide" style="display: none;">

                                                    <label>
                                                        <input @if ($services->wholesaler == 1) checked @endif
                                                            type="radio" name="wholesaler" value="turnover_gt_30cr"
                                                            data-license="Central">
                                                        Turnover greater than 30 crores/annum [Central License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->wholesaler == 2) checked @endif
                                                            type="radio" name="wholesaler" value="turnover_upto_30cr"
                                                            data-license="State">
                                                        Turnover upto 30 crores/annum [State License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->wholesaler == 3) checked @endif
                                                            type="radio" name="wholesaler" value="turnover_upto_12l"
                                                            data-license="Registration">
                                                        Turnover upto 12 lakhs/annum [Registration]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="distributorhide" style="display: none;">

                                                    <label>
                                                        <input @if ($services->distributor == 1) checked @endif
                                                            type="radio" name="distributor" value="turnover_gt_20cr"
                                                            data-license="Central">
                                                        Turnover greater than 20 crores/annum [Central License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->distributor == 2) checked @endif
                                                            type="radio" name="distributor" value="turnover_upto_20cr"
                                                            data-license="State">
                                                        Turnover upto 20 crores/annum [State License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->distributor == 3) checked @endif
                                                            type="radio" name="distributor" value="turnover_upto_12l"
                                                            data-license="Registration">
                                                        Turnover upto 12 lakhs/annum [Registration]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="transportationhide"
                                                    style="display: none;">

                                                    <label>
                                                        <input @if ($services->transportation == 1) checked @endif
                                                            type="radio" name="transportation"
                                                            value="vehicles_gt_100_or_turnover_gt_30cr"
                                                            data-license="Central">
                                                        Having more than 100 vehicles/wagons or
                                                        turnover more than 30 crores/annum [Central License]
                                                    </label><br>
                                                    <label>
                                                        <input @if ($services->transportation == 2) checked @endif
                                                            type="radio" name="transportation"
                                                            value="vehicles_upto_100_or_turnover_upto_30cr"
                                                            data-license="State">
                                                        Having upto 100 vehicles/wagons or
                                                        turnover upto 30 crores/annum [State License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->transportation == 3) checked @endif
                                                            type="radio" name="transportation"
                                                            value="turnover_upto_12l" data-license="Registration">
                                                        Turnover upto 12 lakhs/annum [Registration]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="retailerhide" style="display: none;">

                                                    <label>
                                                        <input @if ($services->retailer == 1) checked @endif
                                                            type="radio" name="retailer" value="turnover_gt_20cr"
                                                            data-license="Central">
                                                        Turnover greater than 20 crores/annum [Central License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->retailer == 2) checked @endif
                                                            type="radio" name="retailer" value="turnover_upto_20cr"
                                                            data-license="State">
                                                        Turnover upto 20 crores/annum [State License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->retailer == 3) checked @endif
                                                            type="radio" name="retailer" value="turnover_upto_12l"
                                                            data-license="Registration">
                                                        Turnover upto 12 lakhs/annum [Registration]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="direct_sellerhide" style="display: none;">

                                                    <label>
                                                        <input @if ($services->direct_seller == 1) checked @endif
                                                            type="radio" name="direct_seller" value="turnover_gt_20cr"
                                                            data-license="Central">
                                                        Turnover greater than 20 crores/annum [Central License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->direct_seller == 2) checked @endif
                                                            type="radio" name="direct_seller"
                                                            value="turnover_upto_20cr" data-license="State">
                                                        Turnover upto 20 crores/annum [State License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->direct_seller == 3) checked @endif
                                                            type="radio" name="direct_seller" value="turnover_upto_12l"
                                                            data-license="Registration">
                                                        Turnover upto 12 lakhs/annum [Registration]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="food_vending_agencieshide"
                                                    style="display: none;">

                                                    <label>
                                                        <input @if ($services->food_vending_agencies == 1) checked @endif
                                                            type="radio" name="food_vending_agencies"
                                                            value="machines_gt_100_or_multi_state" data-license="Central">
                                                        More than 100 vending machines in one State (or)
                                                        Vending machines in two or more States
                                                        [Central License]
                                                    </label><br>

                                                    <label>
                                                        <input @if ($services->food_vending_agencies == 2) checked @endif
                                                            type="radio" name="food_vending_agencies"
                                                            value="machines_upto_100_single_state" data-license="State">
                                                        Up to 100 vending machines in one State
                                                        [State License]
                                                    </label><br>
                                                    <label>
                                                        <input @if ($services->food_vending_agencies == 3) checked @endif
                                                            type="radio" name="food_vending_agencies"
                                                            value="turnover_upto_12l_or_12_machines"
                                                            data-license="Registration">
                                                        Turnover up to 12 Lacs/annum (or)
                                                        up to 12 vending machines in one State
                                                        [Registration]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="importerhide" style="display: none;">
                                                    <label>
                                                        <input @if ($services->importer == 1) checked @endif
                                                            type="checkbox" name="importer" value="1">
                                                        Importer [Central License]
                                                    </label>
                                                </div>
                                                <div class="mb-3 col-md-6" id="trader_merchanthide"
                                                    style="display: none;">
                                                    <label>
                                                        <input @if ($services->trader_merchant == 1) checked @endif
                                                            type="radio" name="trader_merchant" value="exporter">
                                                        Exports (Central License) [Central License]
                                                    </label>

                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row" id="food_license1" style="display:none;">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="food_service" class="form-label">Food
                                                                service</label>
                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                id="food_service" name="food_service"
                                                                class="form-control re1" maxlength="100">
                                                                <option value="">Select service</option>
                                                                <option @if ($services->food_service == 'Petty Retailer') selected @endif
                                                                    value="Petty Retailer">Petty Retailer of snacks/tea
                                                                    shops
                                                                </option>
                                                                <option @if ($services->food_service == 'Hawker') selected @endif
                                                                    value="Hawker">Hawker (Itinerant / Mobile food vendor)
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-md-6" id="petty_retailerhide"
                                                    style="display: none;">

                                                    <label>
                                                        <input @if ($services->petty_retailer == 1) checked @endif
                                                            type="checkbox" name="petty_retailer" value="1">
                                                        Petty Retailer of snacks/tea shops [Registration]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="hawkerhide" style="display: none;">

                                                    <label>
                                                        <input @if ($services->hawker == 1) checked @endif
                                                            type="checkbox" name="hawker" value="Hawker">
                                                        Hawker [Registration]
                                                    </label>

                                                </div>
                                                <div class="col-md-12">
                                                    <div class="row" id="food_license2" style="display:none;">
                                                        <div class="mb-3 col-md-6">
                                                            <label for="central_govt_agencies" class="form-label">Central
                                                                Govt
                                                                Agencies</label>
                                                            <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif
                                                                id="central_govt_agencies" name="central_govt_agencies"
                                                                class="form-control re2" maxlength="100">
                                                                <option value="">Select service</option>
                                                                <option @if ($services->central_govt_agencies == 'Storage') selected @endif
                                                                    value="Storage">Storage (Except Controlled Atmosphere
                                                                    and
                                                                    Cold)</option>
                                                                <option @if ($services->central_govt_agencies == 'Wholesaler') selected @endif
                                                                    value="Wholesaler">Wholesaler</option>
                                                                <option @if ($services->central_govt_agencies == 'Distributor') selected @endif
                                                                    value="Distributor">Distributor</option>
                                                                <option @if ($services->central_govt_agencies == 'Retailer') selected @endif
                                                                    value="Retailer">Retailer</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6" id="storagehide1" style="display: none;">

                                                    <label>
                                                        <input @if ($services->storage1 == 1) checked @endif
                                                            type="checkbox" name="storage1" value="1">
                                                        Storage (Except Controlled Atmosphere and Cold) [Central License]
                                                    </label>

                                                </div>
                                                <div class="mb-3 col-md-6" id="wholesalerhide1" style="display: none;">
                                                    <label>
                                                        <input @if ($services->wholesaler1 == 1) checked @endif
                                                            type="checkbox" name="wholesaler1" value="1">
                                                        Wholesaler [Central License]
                                                    </label>
                                                </div>
                                                <div class="mb-3 col-md-6" id="distributorhide1" style="display: none;">
                                                    <label>
                                                        <input @if ($services->distributor1 == 1) checked @endif
                                                            type="checkbox" name="distributor1" value="1">
                                                        Distributor [Central License]
                                                    </label>
                                                </div>
                                                <div class="mb-3 col-md-6" id="retailerhide1" style="display: none;">
                                                    <label>
                                                        <input @if ($services->retailer1 == 1) checked @endif
                                                            type="checkbox" name="retailer1" value="1">
                                                        Retailer [Central License]
                                                    </label>
                                                </div>

                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="shop_name" class="form-label">Shop Name</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->shop_name }}"
                                                            class="form-control" name="shop_name" maxlength="100"
                                                            placeholder="Shop Name" />

                                                        <label for="shop_address" class="form-label">Shop Full
                                                            Address</label>
                                                        <textarea rows="2" @if (Auth::user()->id != $apply_user_id) disabled @endif required type="text" maxlength="200"
                                                            class="form-control" value="{{ $services->shop_address }}" name="shop_address" placeholder="Shop Full Address">{{ $services->shop_address }}</textarea>

                                                        <label for="aadhaar_no" class="form-label">Aadhaar
                                                            Number</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->aadhaar_no }}"
                                                            class="form-control number" name="aadhaar_no" maxlength="15"
                                                            placeholder="Aadhaar Number" />

                                                        <label for="email_id" class="form-label">Email Id</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->email_id }}"
                                                            class="form-control" name="email_id" maxlength="50"
                                                            placeholder="Email Id" />

                                                        <label class="form-label">Documents</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                            id="documents" name="documents" class="form-control">
                                                            <option value="">Select Documents</option>
                                                            <option @if ($services->documents == 'Rental Agreement') selected @endif
                                                                value="Rental Agreement">Rental Agreement</option>
                                                            <option @if ($services->documents == 'Electricity Bill') selected @endif
                                                                value="Electricity Bill">Electricity Bill</option>
                                                            <option @if ($services->documents == 'Property Tax') selected @endif
                                                                value="Property Tax">Property Tax</option>
                                                        </select>
                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->photo != '')
                                                                <label>Applicant Photo</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>Applicant Photo</label>
                                                            <input @if ($services->photo == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="photo">
                                                            @if ($services->photo != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                            @endif
                                                        @endif
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        <label class="form-label">Name of the food category</label>
                                                        <select @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id) disabled @endif required
                                                            name="food_category" class="form-control">
                                                            <option value="">Select Food Category</option>
                                                            <option @if ($services->food_category == '01-Dairy products and analogues, excluding products of food category 2.0') selected @endif
                                                                value="01-Dairy products and analogues, excluding products of food category 2.0">
                                                                01-Dairy products and analogues, excluding products of
                                                                food category
                                                                2.0
                                                            </option>
                                                            <option @if ($services->food_category == '02-Fats and oils and fat emulsions') selected @endif
                                                                value="02-Fats and oils and fat emulsions">02-Fats and
                                                                oils, and
                                                                fat emulsions</option>
                                                            <option @if ($services->food_category == '03-Edible ices including sherbet and sorbe') selected @endif
                                                                value="03-Edible ices including sherbet and sorbe">
                                                                03-Edible ices,
                                                                including sherbet and sorbe</option>
                                                            <option @if (
                                                                $services->food_category ==
                                                                    '04-Fruits and vegetables (including mushrooms and fungi/roots and tubers, fresh puises and legumes, and aloe vera), seaweeds, and nuts and seeds') selected @endif
                                                                value="04-Fruits and vegetables (including mushrooms and fungi/roots and tubers, fresh puises and legumes, and aloe vera), seaweeds, and nuts and seeds">
                                                                04-Fruits and vegetables (including mushrooms and
                                                                fungi/roots and
                                                                tubers, fresh puises and legumes, and aloe vera),
                                                                seaweeds, and nuts
                                                                and
                                                                seeds</option>
                                                            <option @if ($services->food_category == '05-Confectionery') selected @endif
                                                                value="05-Confectionery">05-Confectionery</option>
                                                            <option @if (
                                                                $services->food_category ==
                                                                    '06-Cereals and cereal products, derived from cereal grains, from roots and tubers, pulses, legumes and pith or soft core of palm tree, excluding bakery wares of food category 7.0') selected @endif
                                                                value="06-Cereals and cereal products, derived from cereal grains, from roots and tubers, pulses, legumes and pith or soft core of palm tree, excluding bakery wares of food category 7.0">
                                                                06-Cereals and cereal products, derived from cereal
                                                                grains, from
                                                                roots
                                                                and tubers, pulses, legumes and pith or soft core of
                                                                palm tree,
                                                                excluding bakery wares of food category 7.0</option>
                                                            <option @if ($services->food_category == '07-Bakery products') selected @endif
                                                                value="07-Bakery products">07-Bakery products</option>
                                                            <option @if ($services->food_category == '08-Eggs and egg products') selected @endif
                                                                value="08-Eggs and egg products">08-Eggs and egg
                                                                products</option>
                                                            <option @if ($services->food_category == '09-Sweeteners, including honey') selected @endif
                                                                value="09-Sweeteners, including honey">09-Sweeteners,
                                                                including
                                                                honey</option>
                                                            <option @if ($services->food_category == '10-Salts, spices, soups, sauces, salads and protein products') selected @endif
                                                                value="10-Salts, spices, soups, sauces, salads and protein products">
                                                                10-Salts, spices, soups, sauces, salads and protein
                                                                products
                                                            </option>
                                                            <option @if ($services->food_category == '11-Foodstuffs intended for particular nutritional uses') selected @endif
                                                                value="11-Foodstuffs intended for particular nutritional uses">
                                                                11-Foodstuffs intended for particular nutritional uses
                                                            </option>
                                                            <option @if ($services->food_category == '12-Beverages, excluding dairy products') selected @endif
                                                                value="12-Beverages, excluding dairy products">
                                                                12-Beverages,
                                                                excluding dairy products</option>
                                                            <option @if ($services->food_category == '13-Ready-to-eat savouries') selected @endif
                                                                value="13-Ready-to-eat savouries">13-Ready-to-eat
                                                                savouries
                                                            </option>
                                                            <option @if ($services->food_category == '14-Prepared Foods') selected @endif
                                                                value="14-Prepared Foods">14-Prepared Foods</option>
                                                            <option @if ($services->food_category == '15-Indian Sweets and Indian Snacks & Savouries products') selected @endif
                                                                value="15-Indian Sweets and Indian Snacks & Savouries products">
                                                                15-Indian Sweets and Indian Snacks & Savouries products
                                                            </option>
                                                            <option @if ($services->food_category == '16-Substances added to food') selected @endif
                                                                value="16-Substances added to food">16-Substances added
                                                                to food
                                                            </option>
                                                            <option @if ($services->food_category == '17-Standardised Food Product excluding those covered under category 1-14') selected @endif
                                                                value="17-Standardised Food Product excluding those covered under category 1-14">
                                                                17-Standardised Food Product excluding those covered
                                                                under category
                                                                1-14
                                                            </option>
                                                        </select>

                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->shop_photo != '')
                                                                <label>Shop Photo</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/shop_photo/{{ $services->shop_photo }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>Shop Photo</label>
                                                            <input @if ($services->shop_photo == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="shop_photo">
                                                            @if ($services->shop_photo != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/shop_photo/{{ $services->shop_photo }}">Download</a><br>
                                                            @endif
                                                        @endif

                                                        <label for="block_or_division"
                                                            class="form-label">Block/Division</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->block_or_division }}"
                                                            class="form-control" name="block_or_division" maxlength="100"
                                                            placeholder="Block/Division" />

                                                        <label for="pin_code" class="form-label">Pin Code</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->pin_code }}"
                                                            class="form-control" name="pin_code" maxlength="10"
                                                            placeholder="Pin Code" />

                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->pan_card != '')
                                                                <label>Pan Card</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>Pan Card</label>
                                                            <input @if ($services->pan_card == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="pan_card">
                                                            @if ($services->pan_card != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}">Download</a><br>
                                                            @endif
                                                        @endif

                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->aadhaar_card != '')
                                                                <label>Aadhaar Card</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>Aadhaar Card</label>
                                                            <input @if ($services->aadhaar_card == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="aadhaar_card">
                                                            @if ($services->aadhaar_card != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                            @endif
                                                        @endif

                                                        <label for="mobile" class="form-label">Mobile Number</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->mobile }}"
                                                            class="form-control number" name="mobile" maxlength="10"
                                                            placeholder="Mobile Number" />

                                                        <div class="" id="rental_agreementhide"
                                                            style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->rental_agreement != '')
                                                                    <label>Rental Agreement</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/rental_agreement/{{ $services->rental_agreement }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label>Rental Agreement</label>
                                                                <input @if ($services->rental_agreement == '' && $services->documents == 'Rental Agreement') required @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="rental_agreement"
                                                                    id="rental_agreement">
                                                                @if ($services->rental_agreement != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/rental_agreement/{{ $services->rental_agreement }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="" id="electricity_billhide"
                                                            style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->electricity_bill != '')
                                                                    <label>Electricity Bill</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/electricity_bill/{{ $services->electricity_bill }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label>Electricity Bill</label>
                                                                <input @if ($services->electricity_bill == '' && $services->documents == 'Electricity Bill') required @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="electricity_bill"
                                                                    id="electricity_bill">
                                                                @if ($services->electricity_bill != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/electricity_bill/{{ $services->electricity_bill }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="" id="property_taxhide" style="display: none;">
                                                            @if (Auth::user()->id != $apply_user_id && Auth::user()->id != $services->user_id)
                                                                @if ($services->property_tax != '')
                                                                    <label>Property Tax</label>
                                                                    <br><a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax }}"
                                                                        class="btn btn-primary me-2">View</a><br>
                                                                @endif
                                                            @else
                                                                <label>Property Tax</label>
                                                                <input @if ($services->property_tax == '' && $services->documents == 'Property Tax') required @endif
                                                                    class="form-control" type="file"
                                                                    accept="image/jpeg, image/png" name="property_tax"
                                                                    id="property_tax">
                                                                @if ($services->property_tax != '')
                                                                    <a target="_blank"
                                                                        href="{{ URL::to('/') }}/upload/services/property_tax/{{ $services->property_tax }}">Download</a><br>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                @elseif ($serviceid == 14)
                                                    <div class="mb-3 col-md-4">
                                                        <label for="shop_name" class="form-label">Shop Name</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->shop_name }}"
                                                            class="form-control" name="shop_name" maxlength="30"
                                                            placeholder="Shop Name" />
                                                        <label for="mobile" class="form-label">Mobile Number</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->mobile }}"
                                                            class="form-control number" name="mobile" maxlength="10"
                                                            placeholder="Mobile Number" />
                                                        <label for="email_id" class="form-label">Email Id</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->email_id }}"
                                                            class="form-control" name="email_id" maxlength="50"
                                                            placeholder="Email Id" />
                                                        <label for="mobile_no" class="form-label">Applicant Mobile
                                                            Number</label>
                                                        <input @if (Auth::user()->id != $apply_user_id) disabled @endif required
                                                            type="text" value="{{ $services->mobile_no }}"
                                                            class="form-control number" name="mobile_no" maxlength="10"
                                                            placeholder="Applicant Mobile Number" />
                                                    </div>
                                                    <div class="mb-3 col-md-4">
                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->photo != '')
                                                                <label>Applicant Photo</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>Applicant Photo</label>
                                                            <input @if ($services->photo == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="photo">
                                                            @if ($services->photo != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/photo/{{ $services->photo }}">Download</a><br>
                                                            @endif
                                                        @endif
                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->shop_photo != '')
                                                                <label>Shop Photo</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/shop_photo/{{ $services->shop_photo }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>Shop Photo</label>
                                                            <input @if ($services->shop_photo == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="shop_photo">
                                                            @if ($services->shop_photo != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/shop_photo/{{ $services->shop_photo }}">Download</a><br>
                                                            @endif
                                                        @endif
                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->aadhaar_card != '')
                                                                <label>Aadhaar Card</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>Aadhaar Card</label>
                                                            <input @if ($services->aadhaar_card == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="aadhaar_card">
                                                            @if ($services->aadhaar_card != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/aadhaar_card/{{ $services->aadhaar_card }}">Download</a><br>
                                                            @endif
                                                        @endif
                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->pan_card != '')
                                                                <label>Pan Card</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>Pan Card</label>
                                                            <input @if ($services->pan_card == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="pan_card">
                                                            @if ($services->pan_card != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/pan_card/{{ $services->pan_card }}">Download</a><br>
                                                            @endif
                                                        @endif
                                                        @if (Auth::user()->id != $apply_user_id)
                                                            @if ($services->old_food_license != '')
                                                                <label>old food license certificate</label>
                                                                <br><a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/old_food_license/{{ $services->old_food_license }}"
                                                                    class="btn btn-primary me-2">View</a><br>
                                                            @endif
                                                        @else
                                                            <label>old food license certificate</label>
                                                            <input @if ($services->old_food_license == '') required @endif
                                                                class="form-control" type="file"
                                                                accept="image/jpeg, image/png" name="old_food_license">
                                                            @if ($services->old_food_license != '')
                                                                <a target="_blank"
                                                                    href="{{ URL::to('/') }}/upload/services/old_food_license/{{ $services->old_food_license }}">Download</a><br>
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
                                                            value="Pending">
                                                            Pending</option>
                                                        <option @if ($services->status == 'Resubmit') selected @endif
                                                            value="Resubmit">
                                                            Resubmit</option>
                                                        <option @if ($services->status == 'Processing') selected @endif
                                                            value="Processing">Processing</option>
                                                        @if ($services->status != 'Approved')
                                                            <option @if ($services->status == 'Rejected') selected @endif
                                                                value="Rejected">
                                                                Rejected</option>
                                                        @endif
                                                        <option @if ($services->status == 'Approved') selected @endif
                                                            value="Approved">
                                                            Approved</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6" id="remarkshide" style="display :none;">
                                                    <label for="remarks" class="form-label">Remarks</label>
                                                    <input value="{{ $services->remarks }}" class="form-control"
                                                        type="text" name="remarks" maxlength="100" id="remarks"
                                                        placeholder="Remarks" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="selecthide" style="display :none;">
                                                    <label for="select" class="form-label">Select</label>
                                                    <select class="form-control" name="selects" id="select">
                                                        <option>select</option>
                                                        <option @if ($services->selects == 'Text') selected @endif
                                                            value = "Text">
                                                            Text</option>
                                                        <option @if ($services->selects == 'File') selected @endif
                                                            value = "File">
                                                            File</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6" id="acknowledgementhide"
                                                    style="display :none;">
                                                    <label for="acknowledgement"
                                                        class="form-label">Acknowledgement</label>
                                                    <input class="form-control" type="file" name="acknowledgement"
                                                        id="acknowledgement" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="applicationnohide" style="display :none;">
                                                    <label for="application_no" class="form-label">Application No</label>
                                                    <input value="{{ $services->application_no }}" class="form-control"
                                                        type="text" maxlength="20" name="application_no"
                                                        id="application_no" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="selectshide" style="display :none;">
                                                    <label for="selects" class="form-label">Select</label>
                                                    <select class="form-control" name="lects" id="selects">
                                                        <option>select</option>
                                                        <option @if ($services->lects == 'Text') selected @endif
                                                            value = "Text">
                                                            Text</option>
                                                        <option @if ($services->lects == 'File') selected @endif
                                                            value = "File">
                                                            File</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3 col-md-6" id="applicationhide" style="display :none;">
                                                    <label for="application" class="form-label">Application</label>
                                                    <input value="{{ $services->application }}" class="form-control"
                                                        type="text" maxlength="150" name="application"
                                                        id="application" />
                                                </div>
                                                <div class="mb-3 col-md-6" id="certhide" style="display :none;">
                                                    <label for="certificate" class="form-label">Certificate</label>
                                                    <input class="form-control" type="file" name="certificate"
                                                        id="certificate" />
                                                </div>
                                            @else
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="service_name" class="form-label">Service
                                                            Status</label>
                                                        <input disabled value="{{ $services->status }}"
                                                            class="form-control" type="text" />
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
                                                <button type="submit" disabled
                                                    class="btn btn-primary me-2">Resubmit</button>
                                            @elseif($services->status == 'Approved')
                                                <button type="button" disabled
                                                    class="btn btn-primary me-2">Completed</button>
                                            @else
                                                <button id="save" type="submit"
                                                    class="btn btn-primary me-2">Submit</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
            @push('page_scripts')
                <script>
                    $(function() {
                        var status = "{{ $services->status }}";
                        var acknowledgement = "{{ $services->acknowledgement }}";
                        var certificate = "{{ $services->certificate }}";
                        var selects = "{{ $services->selects }}";
                        var lects = "{{ $services->lects }}";
                        var fssai = "{{ $services->fssai_license }}";
                        var trade_retail = "{{ $services->trade_retail }}";
                        var central_govt_agencies = "{{ $services->central_govt_agencies }}";
                        var food_service = "{{ $services->food_service }}";
                         var documents = "{{ $services->documents }}";

                        if (documents == "Rental Agreement") {
                            $('#rental_agreementhide').show("slow");
                        } else if (documents == "Electricity Bill") {
                            $('#electricity_billhide').show("slow");
                        } else if (documents == "Property Tax") {
                            $('#property_taxhide').show("slow");

                        }

                        if (trade_retail == "Storage") {
                            $('#storagehide').show("slow");
                        } else if (trade_retail == "Wholesaler") {
                            $('#wholesalerhide').show("slow");
                        } else if (trade_retail == "Distributor") {
                            $('#distributorhide').show("slow");
                        } else if (trade_retail == "Transportation") {
                            $('#transportationhide').show("slow");
                        } else if (trade_retail == "Direct Seller") {
                            $('#direct_sellerhide').show("slow");
                        } else if (trade_retail == "Food Vending Agencies") {
                            $('#food_vending_agencieshide').show("slow");
                        } else if (trade_retail == "Importer") {
                            $('#importerhide').show("slow");
                        } else if (trade_retail == "Trader/Merchant") {
                            $('#trader_merchanthide').show("slow");
                        } else if (trade_retail == "Retailer") {
                            $('#retailerhide').show("slow");
                        } 


                        if (food_service == "Petty Retailer") {
                            $('#petty_retailerhide').show("slow");
                        } else if (food_service == "Hawker") {
                            $('#hawkerhide').show("slow");
                        }

                        if (central_govt_agencies == "Storage") {
                            $('#storagehide1').show("slow");
                        } else if (central_govt_agencies == "Wholesaler") {
                            $('#wholesalerhide1').show("slow");
                        } else if (central_govt_agencies == "Distributor") {
                            $('#distributorhide1').show("slow");
                        } else if (central_govt_agencies == "Retailer") {
                            $('#retailerhide1').show("slow");
                        }

                        if (fssai == 1) {
                            $("#food_license").show().find('.re').attr('required', true);
                            $("#food_license1").hide().find('.re1').removeAttr('required');
                            $("#food_license2").hide().find('.re2').removeAttr('required');
                        } else if (fssai == 2) {
                            $("#food_license1").show().find('.re1').attr('required', true);
                            $("#food_license").hide().find('.re').removeAttr('required');
                            $("#food_license2").hide().find('.re2').removeAttr('required');
                        } else if (fssai == 3) {
                            $("#food_license2").show().find('.re2').attr('required', true);
                            $("#food_license1").hide().find('.re1').removeAttr('required');
                            $("#food_license").hide().find('.re').removeAttr('required');
                        }



                        if (status == "Resubmit") {
                            $('#remarkshide').show("slow");
                            $('#remarks').prop("required", true);
                        } else if (status == "Processing") {
                            if (selects == "Text") {
                                $('#applicationnohide').show("slow");
                            }
                            if (selects == "File") {
                                $('#acknowledgementhide').show("slow");
                                if (acknowledgement == "") {
                                    $('#acknowledgement').prop("required", true);
                                }
                            }
                            $('#selecthide').show("slow");


                        } else if (status == "Approved") {
                            if (lects == "Text") {
                                $('#applicationhide').show("slow");
                            }
                            if (lects == "File") {
                                $('#certhide').show("slow");
                                if (certificate == "") {
                                    $('#certificate').prop("required", true);
                                }
                            }
                            $('#selectshide').show("slow")
                        }
                    });

                    $('#documents').change(function() {
                        if ($('#documents').val() == 'Rental Agreement') {
                            $('#rental_agreementhide').show("slow");
                            $('#electricity_billhide').hide("slow");
                            $('#property_taxhide').hide("slow");
                            $('#property_tax').prop("required", false);
                            $('#electricity_bill').prop("required", false);
                            $('#rental_agreement').prop("required", true);

                        } else if ($('#documents').val() == 'Electricity Bill') {
                            $('#electricity_billhide').show("slow");
                            $('#rental_agreementhide').hide("slow");
                            $('#property_taxhide').hide("slow");
                            $('#rental_agreement').prop("required", false);
                            $('#property_tax').prop("required", false);
                            $('#electricity_bill').prop("required", true);

                        } else if ($('#documents').val() == 'Property Tax') {
                            $('#property_taxhide').show("slow");
                            $('#electricity_bill').hide("slow");
                            $('#rental_agreementhide').hide("slow");
                            $('#rental_agreement').prop("required", false);
                            $('#electricity_bill').prop("required", false);
                            $('#property_tax').prop("required", true);

                        } else {
                            $('#rental_agreementhide').hide("slow");
                            $('#electricity_billhide').hide("slow");
                            $('#property_taxhide').hide("slow");
                            $('#rental_agreement').prop("required", false);
                            $('#electricity_bill').prop("required", false);
                            $('#property_tax').prop("required", false);

                        }
                    });

                    $('input[name="fssai_license"]').change(function() {
                        if ($(this).val() === "1") {
                            $("#food_license").show().find('.re').attr('required', true);;
                            $("#food_license1").hide().find('.re1').removeAttr('required');
                            $("#food_license2").hide().find('.re2').removeAttr('required');

                            $('#storagehide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#transportationhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");

                            $('#petty_retailerhide').hide("slow");
                            $('#hawkerhide').hide("slow");

                            $('#storagehide1').hide("slow");
                            $('#wholesalerhide1').hide("slow");
                            $('#retailerhide1').hide("slow");
                            $('#distributorhide1').hide("slow");
                        } else if ($(this).val() === "2") {
                            $("#food_license1").show().find('.re1').attr('required', true);;
                            $("#food_license").hide().find('.re').removeAttr('required');
                            $("#food_license2").hide().find('.re2').removeAttr('required');

                            $('#storagehide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#transportationhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");

                            $('#petty_retailerhide').hide("slow");
                            $('#hawkerhide').hide("slow");

                            $('#storagehide1').hide("slow");
                            $('#wholesalerhide1').hide("slow");
                            $('#retailerhide1').hide("slow");
                            $('#distributorhide1').hide("slow");
                        } else if ($(this).val() === "3") {
                            $("#food_license2").show().find('.re2').attr('required', true);;
                            $("#food_license").hide().find('.re').removeAttr('required');
                            $("#food_license1").hide().find('.re1').removeAttr('required');

                            $('#storagehide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#transportationhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");

                            $('#petty_retailerhide').hide("slow");
                            $('#hawkerhide').hide("slow");

                            $('#storagehide1').hide("slow");
                            $('#wholesalerhide1').hide("slow");
                            $('#retailerhide1').hide("slow");
                            $('#distributorhide1').hide("slow");

                        }
                    });

                    $('#trade_retail').change(function() {
                        if ($('#trade_retail').val() == 'Storage') {
                            $('#storagehide').show("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#transportationhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#wholesaler').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#trader_merchant').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#storage').prop("required", true);

                        } else if ($('#trade_retail').val() == 'Wholesaler') {
                            $('#wholesalerhide').show("slow");
                            $('#storagehide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#transportationhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#trader_merchant').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#wholesaler').prop("required", true);

                        } else if ($('#trade_retail').val() == 'Distributor') {
                            $('#distributorhide').show("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#storagehide').hide("slow");
                            $('#transportationhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#wholesaler').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#trader_merchant').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#distributor').prop("required", true);

                        } else if ($('#trade_retail').val() == 'Transportation') {
                            $('#transportationhide').show("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#storagehide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#wholesaler').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#trader_merchant').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#transportation').prop("required", true);

                        } else if ($('#trade_retail').val() == 'Retailer') {
                            $('#retailerhide').show("slow");
                            $('#transportationhide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#storagehide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#wholesaler').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#trader_merchant').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#retailer').prop("required", true);

                        } else if ($('#trade_retail').val() == 'Direct Seller') {
                            $('#direct_sellerhide').show("slow");
                            $('#transportationhide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#storagehide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#wholesaler').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#trader_merchant').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#direct_seller').prop("required", true);

                        } else if ($('#trade_retail').val() == 'Food Vending Agencies') {
                            $('#food_vending_agencieshide').show("slow");
                            $('#transportationhide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#storagehide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#wholesaler').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#trader_merchant').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#food_vending_agencies').prop("required", true);

                        } else if ($('#trade_retail').val() == 'Importer') {
                            $('#importerhide').show("slow");
                            $('#transportationhide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#storagehide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#trader_merchanthide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#wholesaler').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#trader_merchant').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#importer').prop("required", true);

                        } else if ($('#trade_retail').val() == 'Trader/Merchant') {
                            $('#trader_merchanthide').show("slow");
                            $('#transportationhide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#storagehide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#wholesaler').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#trader_merchant').prop("required", true);

                        } else {
                            $('#trader_merchanthide').hide("slow");
                            $('#transportationhide').hide("slow");
                            $('#wholesalerhide').hide("slow");
                            $('#storagehide').hide("slow");
                            $('#distributorhide').hide("slow");
                            $('#direct_sellerhide').hide("slow");
                            $('#food_vending_agencieshide').hide("slow");
                            $('#importerhide').hide("slow");
                            $('#retailerhide').hide("slow");
                            $('#storage').prop("required", false);
                            $('#wholesaler').prop("required", false);
                            $('#distributor').prop("required", false);
                            $('#direct_seller').prop("required", false);
                            $('#food_vending_agencies').prop("required", false);
                            $('#importer').prop("required", false);
                            $('#retailer').prop("required", false);
                            $('#transportation').prop("required", false);
                            $('#trader_merchant').prop("required", false);

                        }
                    });


                    $('#food_service').change(function() {
                        if ($('#food_service').val() == 'Petty Retailer') {
                            $('#petty_retailerhide').show("slow");
                            $('#hawkerhide').hide("slow");
                            $('#hawker').prop("required", false);
                            $('#petty_retailer').prop("required", true);

                        } else if ($('#food_service').val() == 'Hawker') {
                            $('#hawkerhide').show("slow");
                            $('#petty_retailerhide').hide("slow");
                            $('#petty_retailer').prop("required", false);
                            $('#hawker').prop("required", true);

                        } else {
                            $('#hawkerhide').hide("slow");
                            $('#petty_retailerhide').hide("slow");
                            $('#petty_retailer').prop("required", false);
                            $('#hawker').prop("required", false);

                        }
                    });

                    $('#central_govt_agencies').change(function() {
                        if ($('#central_govt_agencies').val() == 'Storage') {
                            $('#storagehide1').show("slow");
                            $('#wholesalerhide1').hide("slow");
                            $('#retailerhide1').hide("slow");
                            $('#distributorhide1').hide("slow");
                            $('#wholesaler1').prop("required", false);
                            $('#distributor1').prop("required", false);
                            $('#retailer1').prop("required", false);
                            $('#storage1').prop("required", true);

                        } else if ($('#central_govt_agencies').val() == 'Wholesaler') {
                            $('#wholesalerhide1').show("slow");
                            $('#storagehide1').hide("slow");
                            $('#retailerhide1').hide("slow");
                            $('#distributorhide1').hide("slow");
                            $('#storage1').prop("required", false);
                            $('#retailer1').prop("required", false);
                            $('#distributor1').prop("required", false);
                            $('#wholesaler1').prop("required", true);

                        } else if ($('#central_govt_agencies').val() == 'Distributor') {
                            $('#distributorhide1').show("slow");
                            $('#storagehide1').hide("slow");
                            $('#wholesalerhide1').hide("slow");
                            $('#retailerhide1').hide("slow");
                            $('#retailer1').prop("required", false);
                            $('#storage1').prop("required", false);
                            $('#wholesaler1').prop("required", false);
                            $('#distributor1').prop("required", true);

                        } else if ($('#central_govt_agencies').val() == 'Retailer') {
                            $('#retailerhide1').show("slow");
                            $('#storagehide1').hide("slow");
                            $('#distributorhide1').hide("slow");
                            $('#wholesalerhide1').hide("slow");
                            $('#storage1').prop("required", false);
                            $('#wholesaler1').prop("required", false);
                            $('#distributor1').prop("required", false);
                            $('#retailer1').prop("required", true);

                        } else {
                            $('#retailerhide1').hide("slow");
                            $('#storagehide1').hide("slow");
                            $('#distributorhide1').hide("slow");
                            $('#wholesalerhide1').hide("slow");
                            $('#storage1').prop("required", false);
                            $('#wholesaler1').prop("required", false);
                            $('#distributor1').prop("required", false);
                            $('#retailer1').prop("required", false);

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
                            $('#select').prop("required", false);
                            $('#selecthide').hide("slow");
                            $('#selects').prop("required", false);
                            $('#selectshide').hide("slow");
                        } else if ($('#service_status').val() == 'Processing') {
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#remarkshide').hide("slow");
                            $('#remarks').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#select').prop("required", true);
                            $('#selecthide').show("slow");
                            $('#selects').prop("required", false);
                            $('#selectshide').hide("slow");
                        } else if ($('#service_status').val() == 'Approved') {
                            $('#remarkshide').hide("slow");
                            $('#remarks').prop("required", false);
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#select').prop("required", false);
                            $('#selecthide').hide("slow");
                            $('#selects').prop("required", true);
                            $('#selectshide').show("slow");
                        } else {
                            $('#remarkshide').show("slow");
                            $('#remarks').prop("required", false);
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#select').prop("required", false);
                            $('#selecthide').hide("slow");
                            $('#selects').prop("required", false);
                            $('#selectshide').hide("slow");
                        }
                    });

                    $('#select').change(function() {
                        if ($('#select').val() == 'Text') {
                            $('#applicationnohide').show("slow");
                            $('#application_no').prop("required", true);
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                        } else if ($('#select').val() == 'File') {
                            $('#acknowledgementhide').show("slow");
                            $('#acknowledgement').prop("required", false);
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                        } else {
                            $('#applicationnohide').hide("slow");
                            $('#application_no').prop("required", false);
                            $('#acknowledgementhide').hide("slow");
                            $('#acknowledgement').prop("required", false);
                        }
                    });

                    $('#selects').change(function() {
                        if ($('#selects').val() == 'Text') {
                            $('#applicationhide').show("slow");
                            $('#application').prop("required", true);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                        } else if ($('#selects').val() == 'File') {
                            $('#certhide').show("slow");
                            $('#certificate').prop("required", false);
                            $('#applicationhide').hide("slow");
                            $('#application').prop("required", false);
                        } else {
                            $('#applicationhide').hide("slow");
                            $('#application').prop("required", false);
                            $('#certhide').hide("slow");
                            $('#certificate').prop("required", false);
                        }
                    });

                    document.getElementById("myForm").addEventListener("submit", function() {
                        const btn = document.getElementById("save");
                        btn.disabled = true;
                        btn.innerText = "Submitting...";
                    });
                </script>
            @endpush
