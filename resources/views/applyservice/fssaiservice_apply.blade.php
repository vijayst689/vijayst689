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
    <style>
        .category-header {
            background: #e0e0e0;
            padding: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .kob-card {
            border: 1px solid #ddd;
            margin-bottom: 8px;
        }

        .kob-header {
            background: #009688;
            color: #fff;
            padding: 10px;
            cursor: pointer;
        }

        .kob-body {
            padding: 10px;
            background: #f9f9f9;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
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
                    <div class="card-body">
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('submit_fssaiservice') }}" enctype="multipart/form-data"
                                onsubmit="return checkpayment(event)" method="post" id="myForm">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    @if ($serviceid == 122)
                                        <div class="col-md-12">
                                            <div class=row>
                                                <div class="mb-8 col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio"
                                                            name="fssai_license" id="trade_retail_license" value="1" />
                                                        <label class="form-check-label text-dark"
                                                            for="trade_retail_license">Trade/Retail</label>
                                                    </div>
                                                </div>
                                                <div class="mb-8 col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio"
                                                            name="fssai_license" id="food_service_license" value="2" />
                                                        <label class="form-check-label text-dark"
                                                            for="food_service_license">Food Service</label>
                                                    </div>
                                                </div>
                                                <div class="mb-8 col-md-3">
                                                    <div class="form-check form-check-inline">
                                                        <input required class="form-check-input" type="radio"
                                                            name="fssai_license" id="central_govt_agencies_license"
                                                            value="3" />
                                                        <label class="form-check-label text-dark"
                                                            for="central_govt_agencies_license">Central Govt
                                                            Agencies</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row" id="food_license" style="display:none;">
                                                <div class="mb-3 col-md-6">
                                                    <label for="trade_retail" class="form-label">Trade/Retail</label>
                                                    <select required id="trade_retail" name="trade_retail"
                                                        class="form-control re" maxlength="100">
                                                        <option value="">Select Trade/Retail</option>
                                                        <option value="Storage">Storage (Except Controlled Atmosphere and
                                                            Cold)</option>
                                                        <option value="Wholesaler">Wholesaler</option>
                                                        <option value="Distributor">Distributor</option>
                                                        <option value="Transportation">Transportation (having a number of
                                                            specialized vehicles like insulated refrigerated van/ wagon and
                                                            milk tankers etc.)</option>
                                                        <option value="Retailer">Retailer</option>
                                                        <option value="Direct Seller">Direct Seller</option>
                                                        <option value="Food Vending Agencies">Food Vending Agencies [Sale of
                                                            food from vending machines.]</option>
                                                        <option value="Importer">Importer</option>
                                                        <option value="Trader/Merchant">Trader/Merchant - Exporter </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6" id="storagehide" style="display: none;">
                                            <p class="text-danger">
                                                Storage is an activity where food products in packed or unpacked condition
                                                is stored for further distribution in storage facilities, also called
                                                warehouses, godowns etc.</p>
                                            <label>
                                                <input type="radio" name="storage" value="1" data-license="Central">
                                                Capacity more than 50,000 MT [Central License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="storage" value="2" data-license="State">
                                                Capacity upto 50,000 MT [State License]
                                            </label><br>
                                            <label>
                                                <input type="radio" name="storage" value="3"
                                                    data-license="Registration">
                                                Turnover upto 12 lakhs/annum [Registration]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="wholesalerhide" style="display: none;">
                                            <p class="text-danger">
                                                Wholesale is an activity in the distribution channel where food product is
                                                procured in bulk and then sold to resellers/retailers rather than to
                                                consumers.</p>
                                            <label>
                                                <input type="radio" name="wholesaler" value="1"
                                                    data-license="Central">
                                                Turnover greater than 30 crores/annum [Central License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="wholesaler" value="2"
                                                    data-license="State">
                                                Turnover upto 30 crores/annum [State License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="wholesaler" value="3"
                                                    data-license="Registration">
                                                Turnover upto 12 lakhs/annum [Registration]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="distributorhide" style="display: none;">
                                            <p class="text-danger">

                                                Distribution is an activity in the distribution channel where food product
                                                is distributed from the original place of manufacture to the person who
                                                makes the final delivery or sale of the food product to the ultimate
                                                consumer.</p>
                                            <label>
                                                <input type="radio" name="distributor" value="1"
                                                    data-license="Central">
                                                Turnover greater than 20 crores/annum [Central License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="distributor" value="2"
                                                    data-license="State">
                                                Turnover upto 20 crores/annum [State License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="distributor" value="3"
                                                    data-license="Registration">
                                                Turnover upto 12 lakhs/annum [Registration]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="transportationhide" style="display: none;">
                                            <p class="text-danger">
                                                Transportation is an activity of transporting food products (both packed and
                                                bulk) from one location to another in vehicles/containers including
                                                specialized vehicles like insulated refrigerated van/ wagon, oil/milk
                                                tankers etc.</p>
                                            <label>
                                                <input type="radio" name="transportation" value="1"
                                                    data-license="Central">
                                                Having more than 100 vehicles/wagons or
                                                turnover more than 30 crores/annum [Central License]
                                            </label><br>
                                            <label>
                                                <input type="radio" name="transportation" value="2"
                                                    data-license="State">
                                                Having upto 100 vehicles/wagons or
                                                turnover upto 30 crores/annum [State License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="transportation" value="3"
                                                    data-license="Registration">
                                                Turnover upto 12 lakhs/annum [Registration]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="retailerhide" style="display: none;">
                                            <p class="text-danger">
                                                Retail is an activity where food products is procured from a manufacturer,
                                                distributor or wholesaler and sold to the ultimate end user</p>
                                            <label>
                                                <input type="radio" name="retailer" value="1"
                                                    data-license="Central">
                                                Turnover greater than 20 crores/annum [Central License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="retailer" value="2"
                                                    data-license="State">
                                                Turnover upto 20 crores/annum [State License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="retailer" value="3"
                                                    data-license="Registration">
                                                Turnover upto 12 lakhs/annum [Registration]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="direct_sellerhide" style="display: none;">
                                            <p class="text-danger">
                                                A person appointed or authorized, directly or indirectly,
                                                by a Direct Selling Entity through a legally enforceable
                                                written contract to undertake direct selling business
                                                on principal to principal basis
                                            </p>
                                            <label>
                                                <input type="radio" name="direct_seller" value="1"
                                                    data-license="Central">
                                                Turnover greater than 20 crores/annum [Central License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="direct_seller" value="2"
                                                    data-license="State">
                                                Turnover upto 20 crores/annum [State License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="direct_seller" value="3"
                                                    data-license="Registration">
                                                Turnover upto 12 lakhs/annum [Registration]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="food_vending_agencieshide" style="display: none;">
                                            <p class="text-danger">
                                                Sale of packaged/fresh food from a temporary or fixed
                                                stall/cart/machine by an individual or by automation.
                                            </p>
                                            <label>
                                                <input type="radio" name="food_vending_agencies" value="1"
                                                    data-license="Central">
                                                More than 100 vending machines in one State (or)
                                                Vending machines in two or more States
                                                [Central License]
                                            </label><br>

                                            <label>
                                                <input type="radio" name="food_vending_agencies" value="2"
                                                    data-license="State">
                                                Up to 100 vending machines in one State
                                                [State License]
                                            </label><br>
                                            <label>
                                                <input type="radio" name="food_vending_agencies" value="3"
                                                    data-license="Registration">
                                                Turnover up to 12 Lacs/annum (or)
                                                up to 12 vending machines in one State
                                                [Registration]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="importerhide" style="display: none;">
                                            <p class="text-danger">
                                                Import is an activity where articles of trade from a foreign source
                                                is brought into a domestic market in the course of trade.</p>
                                            <label>
                                                <input type="checkbox" name="importer" value="1">
                                                Importer [Central License]
                                            </label>

                                            <p class="mt-3 text-warning">
                                                <b>Note:</b> To apply under importer category FBO must have
                                                IE Code from DGFT. The address of premises in case of importer
                                                should be same as mentioned in IE Code.
                                                Even if importer is having multiple premises,
                                                only <b>ONE license</b> is applicable if applying for importer
                                                Kind of Business only.
                                            </p>

                                        </div>
                                        <div class="mb-3 col-md-6" id="trader_merchanthide" style="display: none;">
                                            <label>
                                                <input type="radio" name="trader_merchant" value="1">
                                                Exports (Central License) [Central License]
                                            </label>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="row" id="food_license1" style="display:none;">
                                                <div class="mb-3 col-md-6">
                                                    <label for="food_service" class="form-label">Food service</label>
                                                    <select required id="food_service" name="food_service"
                                                        class="form-control re1" maxlength="100">
                                                        <option value="">Select service</option>
                                                        <option value="Petty Retailer">Petty Retailer of snacks/tea shops
                                                        </option>
                                                        <option value="Hawker">Hawker (Itinerant / Mobile food vendor)
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-6" id="petty_retailerhide" style="display: none;">
                                            <p class="text-danger">
                                                Temporary or fixed stall or food premise involved in preperation, storage,
                                                distibution and sale of food products that can be served as a snacks/
                                                tea/coffee and similar variants.</p>
                                            <label>
                                                <input type="checkbox" name="petty_retailer" value="1">
                                                Petty Retailer of snacks/tea shops [Registration]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="hawkerhide" style="display: none;">
                                            <p class="text-danger">

                                                Temporary or fixed stall or food premise involved in preperation, storage,
                                                distibution and sale of food products that can be served as a snacks/
                                                tea/coffee and similar variants.</p>
                                            <label>
                                                <input type="checkbox" name="hawker" value="1">
                                                Hawker [Registration]
                                            </label>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="row" id="food_license2" style="display:none;">
                                                <div class="mb-3 col-md-6">
                                                    <label for="central_govt_agencies" class="form-label">Central Govt
                                                        Agencies</label>
                                                    <select required id="central_govt_agencies"
                                                        name="central_govt_agencies" class="form-control re2"
                                                        maxlength="100">
                                                        <option value="">Select service</option>
                                                        <option value="Storage">Storage (Except Controlled Atmosphere and
                                                            Cold)</option>
                                                        <option value="Wholesaler">Wholesaler</option>
                                                        <option value="Distributor">Distributor</option>
                                                        <option value="Retailer">Retailer</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6" id="storagehide1" style="display: none;">
                                            <p class="text-danger">
                                                Storage is an activity where food products in packed or unpacked condition
                                                is stored for further distribution in storage facilities, also called
                                                warehouses, godowns etc.</p>
                                            <label>
                                                <input type="checkbox" name="storage1" value="1">
                                                Storage (Except Controlled Atmosphere and Cold) [Central License]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="wholesalerhide1" style="display: none;">
                                            <p class="text-danger">

                                                Wholesale is an activity in the distribution channel where food product is
                                                procured in bulk and then sold to resellers/retailers rather than to
                                                consumers.</p>
                                            <label>
                                                <input type="checkbox" name="wholesaler1" value="1">
                                                Wholesaler [Central License]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="distributorhide1" style="display: none;">
                                            <p class="text-danger">

                                                Distribution is an activity in the distribution channel where food product
                                                is distributed from the original place of manufacture to the person who
                                                makes the final delivery or sale of the food product to the ultimate
                                                consumer.</p>
                                            <label>
                                                <input type="checkbox" name="distributor1" value="1">
                                                Distributor [Central License]
                                            </label>

                                        </div>
                                        <div class="mb-3 col-md-6" id="retailerhide1" style="display: none;">
                                            <p class="text-danger">
                                                Retail is an activity where food products is procured from a manufacturer,
                                                distributor or wholesaler and sold to the ultimate end user.</p>
                                            <label>
                                                <input type="checkbox" name="retailer1" value="1">
                                                Retailer [Central License]
                                            </label>
                                        </div>

                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="shop_name" class="form-label">Shop Name</label>
                                                <input required type="text" class="form-control" maxlength="100"
                                                    name="shop_name" placeholder="Shop Name" />

                                                <label for="shop_address" class="form-label">Shop Full Address</label>
                                                <textarea required type="text" rows="2" maxlength="200" class="form-control" name="shop_address"
                                                    placeholder="Shop Full Address"></textarea>

                                                {{-- <label for="pan_no" class="form-label">Pan Number</label>
                                                <input required type="text" class="form-control" maxlength="12"
                                                    name="pan_no" placeholder="Pan Number" />

                                                <label for="name_as_pan" class="form-label">Name As Per Pan</label>
                                                <input required type="text" class="form-control" maxlength="100"
                                                    name="name_as_pan" placeholder="As Per Pan Name" /> --}}

                                                <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
                                                <input required type="text" class="form-control number" maxlength="12"
                                                    name="aadhaar_no" placeholder="Aadhaar Number" />

                                                <label for="email_id" class="form-label">Email Id</label>
                                                <input required type="text" class="form-control" maxlength="50"
                                                    name="email_id" placeholder="Email Id" />

                                                <label for="applicant_name" class="form-label">Applicant Name</label>
                                                <input required type="text" class="form-control" maxlength="100"
                                                    name="applicant_name" placeholder="Applicant Name" />

                                                <label for="mobile" class="form-label">Mobile Number</label>
                                                <input required type="text" class="form-control number" maxlength="10"
                                                    name="mobile" placeholder="Mobile Number" />

                                                <label class="form-label">Documents</label>
                                                <select required id="documents" name="documents" class="form-control">
                                                    <option value="">Select Documents</option>
                                                    <option value="Rental Agreement">Rental Agreement</option>
                                                    <option value="Electricity Bill">Electricity Bill</option>
                                                    <option value="Property Tax">Property Tax</option>

                                                </select>

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Name of the food category</label>
                                                <select required name="food_category" class="form-control">
                                                    <option value="">Select Food Category</option>
                                                    <option
                                                        value="01-Dairy products and analogues, excluding products of food category 2.0">
                                                        01-Dairy products and analogues, excluding products of food category
                                                        2.0
                                                    </option>
                                                    <option value="02-Fats and oils and fat emulsions">02-Fats and oils,
                                                        and
                                                        fat emulsions</option>
                                                    <option value="03-Edible ices including sherbet and sorbe">03-Edible
                                                        ices,
                                                        including sherbet and sorbe</option>
                                                    <option
                                                        value="04-Fruits and vegetables (including mushrooms and fungi/roots and tubers, fresh puises and legumes, and aloe vera), seaweeds, and nuts and seeds">
                                                        04-Fruits and vegetables (including mushrooms and fungi/roots and
                                                        tubers, fresh puises and legumes, and aloe vera), seaweeds, and nuts
                                                        and
                                                        seeds</option>
                                                    <option value="05-Confectionery">05-Confectionery</option>
                                                    <option
                                                        value="06-Cereals and cereal products, derived from cereal grains, from roots and tubers, pulses, legumes and pith or soft core of palm tree, excluding bakery wares of food category 7.0">
                                                        06-Cereals and cereal products, derived from cereal grains, from
                                                        roots
                                                        and tubers, pulses, legumes and pith or soft core of palm tree,
                                                        excluding bakery wares of food category 7.0</option>
                                                    <option value="07-Bakery products">07-Bakery products</option>
                                                    <option value="08-Eggs and egg products">08-Eggs and egg products
                                                    </option>
                                                    <option value="09-Sweeteners, including honey">09-Sweeteners, including
                                                        honey</option>
                                                    <option
                                                        value="10-Salts, spices, soups, sauces, salads and protein products">
                                                        10-Salts, spices, soups, sauces, salads and protein products
                                                    </option>
                                                    <option value="11-Foodstuffs intended for particular nutritional uses">
                                                        11-Foodstuffs intended for particular nutritional uses</option>
                                                    <option value="12-Beverages, excluding dairy products">12-Beverages,
                                                        excluding dairy products</option>
                                                    <option value="13-Ready-to-eat savouries">13-Ready-to-eat savouries
                                                    </option>
                                                    <option value="14-Prepared Foods">14-Prepared Foods</option>
                                                    <option
                                                        value="15-Indian Sweets and Indian Snacks & Savouries products">
                                                        15-Indian Sweets and Indian Snacks & Savouries products</option>
                                                    <option value="16-Substances added to food">16-Substances added to food
                                                    </option>
                                                    <option
                                                        value="17-Standardised Food Product excluding those covered under category 1-14">
                                                        17-Standardised Food Product excluding those covered under category
                                                        1-14
                                                    </option>
                                                </select>
                                                <label for="shop_photo" class="form-label text-danger">Shop Photo</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control text-danger" name="shop_photo">

                                                <label for="block_or_division" class="form-label">Block/Division</label>
                                                <input required type="text" class="form-control" maxlength="100"
                                                    name="block_or_division" placeholder="Block/Division" />

                                                <label for="pin_code" class="form-label">Pin Code</label>
                                                <input required type="text" class="form-control" maxlength="10"
                                                    name="pin_code" placeholder="Pin Code" />

                                                <label for="pan_card" class="form-label text-danger">Pan Card</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control text-danger" name="pan_card" />

                                                {{-- <label for="dob" class="form-label">Dob As Per Pan</label>
                                                <input required type="date" class="form-control" maxlength="10"
                                                    name="dob" placeholder="Dob As Per Pan" /> --}}

                                                <label for="aadhaar_card" class="form-label text-danger">Aadhaar
                                                    Card</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control text-danger" name="aadhaar_card" />
                                                <label for="photo" class="form-label text-danger">Applicant
                                                    Photo</label>
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control text-danger" name="photo" />


                                                <div class="" id="rental_agreementhide" style="display: none;">
                                                    <label class="form-label text-danger">Rental Agreement</label>
                                                    <input id="rental_agreement" class="form-control text-danger"
                                                        type="file" name="rental_agreement">
                                                </div>
                                                <div class="" id="electricity_billhide" style="display: none;">
                                                    <label class="form-label text-danger">Electricity Bill</label>
                                                    <input id="electricity_bill" class="form-control text-danger"
                                                        type="file" name="electricity_bill">
                                                </div>
                                                <div class="" id="property_taxhide" style="display: none;">
                                                    <label class="form-label text-danger">Property Tax</label>
                                                    <input id="property_tax" class="form-control text-danger"
                                                        type="file" name="property_tax">
                                                </div>
                                            </div>

                                        </div>
                                    @elseif ($serviceid == 123)
                                        <div class="mb-3 col-md-6">
                                            <label for="shop_name" class="form-label">Shop Name</label>
                                            <input required type="text" class="form-control" maxlength="30"
                                                name="shop_name" placeholder="Shop Name" />
                                            <label for="mobile" class="form-label">Mobile Number</label>
                                            <input required type="text" class="form-control number" maxlength="10"
                                                name="mobile" placeholder="Mobile Number" />
                                            <label for="email_id" class="form-label">Email Id</label>
                                            <input required type="text" class="form-control" maxlength="50"
                                                name="email_id" placeholder="Email Id" />
                                            <label for="mobile_no" class="form-label">Applicant Mobile Number</label>
                                            <input required type="text" class="form-control number" maxlength="10"
                                                name="mobile_no" placeholder="Applicant Mobile Number" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="photo" class="form-label text-danger">Applicant Photo</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control text-danger" name="photo" />
                                            <label for="shop_photo" class="form-label text-danger">Shop Photo</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control text-danger" name="shop_photo" />
                                            <label for="aadhaar_card" class="form-label text-danger">Aadhaar Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control text-danger" name="aadhaar_card" />
                                            <label for="pan_card" class="form-label text-danger">Pan Card</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control text-danger" name="pan_card" />
                                            <label for="old_food_license" class="form-label text-danger">old food license
                                                certificate</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control text-danger" name="old_food_license" />
                                        </div>
                                    @endif
                                    <div class="text-center">
                                        <p id="nopayment"></p>
                                    </div>
                                    <div class="text-center">
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <button id="save" type="submit"
                                                    class="btn btn-primary">Apply</button>
                                            </div>
                                        </div>
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
        document.getElementById("myForm").addEventListener("submit", function() {
            const btn = document.getElementById("save");
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });

        $(function() {
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = "{{ $payment }}";
            if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            }
        });
        var ramjibalance = "{{ $mainbalance->rawallet }}";
        //alert(ramjibalance);
        ramjibalance = parseFloat(ramjibalance);

        function checkpayment(e) {
            var amount = {{ $admin_payment }};
            if (amount > ramjibalance) {
                alert("LOW BALANCE");
                $('#save').prop("disabled", true);
                $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                    'color': 'red',
                    'font-size': '130%',
                    'font-weight': 'bold'
                });
                return false;
            } else {
                $("#nopayment").html("");
                $("#save").attr("disabled", true);
                $("#ramjidebit_amount").val(amount);
                return true;

            }
        }
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
                $('#property_tax').prop("required", false);
                $('#rental_agreement').prop("required", false);
                $('#electricity_bill').prop("required", true);

            } else if ($('#documents').val() == 'Property Tax') {
                $('#property_taxhide').show("slow");
                $('#electricity_billhide').hide("slow");
                $('#rental_agreementhide').hide("slow");
                $('#rental_agreement').prop("required", false);
                $('#electricity_bill').prop("required", false);
                $('#property_tax').prop("required", true);

            } else {
                $('#property_taxhide').hide("slow");
                $('#electricity_billhide').hide("slow");
                $('#rental_agreementhide').hide("slow");
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
    </script>
@endpush
