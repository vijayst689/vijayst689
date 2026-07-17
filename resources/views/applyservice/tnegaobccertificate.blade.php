@extends('layouts.app')
@section('content')
    <style>
        body {
            background: linear-gradient(135deg, #141e30, #243b55);
        }

        .can-form-box {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
        }

        .can-title {
            background: linear-gradient(135deg, #ff512f, #dd2476);
            color: #fff;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 25px;
        }

        .can-title h4 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-top: 10px;
        }

        .form-control {
            border: 2px solid #e6e6e6;
            border-radius: 12px;
            padding: 12px;
            transition: all .3s ease;
        }

        .form-control:focus {
            border-color: #ff512f;
            box-shadow: 0 0 15px rgba(255, 81, 47, .25);
        }

        textarea {
            resize: none;
        }

        .btn-next {
            background: linear-gradient(135deg, #ff512f, #dd2476);
            color: #fff;
            border: none;
            padding: 12px 45px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(221, 36, 118, .4);
        }

        .section-head {
            background: #f8f9fa;
            padding: 10px 15px;
            border-left: 5px solid #ff512f;
            border-radius: 10px;
            margin-bottom: 20px;
            color: #2c3e50;
            font-weight: bold;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content">
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
 <div class="card-body">
                        <h6 class="card-title">{{ $servicename }}</h6>
                        <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>

                        <div class="row">
                            <form class="row g-4" action="{{ url('submittnegaobc') }}" enctype="multipart/form-data"
                                method="post" id="myForm" onsubmit="return checkpayment(event)">
                                @csrf


                                <div id="step1">
                                    <h6 class="text-center card-header bg-success text-white">
                                        Can Details
                                    </h6>
                                    <div class="row">
                                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" id="seramt" name="service_amount"
                                            value="{{ $payment }}">
                                        <input type="hidden" name="user_id" value="{{ $customers->id ?? '' }}">
                                        <!-- LEFT SIDE -->
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label class="form-label">Can Number</label>
                                                <input required type="text" maxlength="15" class="form-control number"
                                                    name="can_number" value="{{ $customers->can_number ?? '' }}"
                                                    placeholder="Can Number">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Name In English</label>
                                                <input maxlength="100" required type="text"
                                                    value="{{ $customers->name ?? '' }}" class="form-control"
                                                    name="name" placeholder="Name In English">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Father Name In English</label>
                                                <input maxlength="100" value="{{ $customers->father_name_english ?? '' }}"
                                                    required type="text" class="form-control" name="father_name_english"
                                                    placeholder="Father Name In English">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Mother Name In English</label>
                                                <input maxlength="100" value="{{ $customers->mother_name_english ?? '' }}"
                                                    required type="text" class="form-control" name="mother_name_english"
                                                    placeholder="Mother Name In English">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Gender</label>
                                                <select required class="form-control" name="gender">
                                                    <option value="">Select</option>
                                                    <option value="Male"
                                                        {{ ($customers->gender ?? '') == 'Male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ ($customers->gender ?? '') == 'Female' ? 'selected' : '' }}>
                                                        Female</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">DOB</label>
                                                <input value="{{ $customers->dob ?? '' }}" required type="date"
                                                    class="form-control" name="dob">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">District</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    name="district_name" value="{{ $customers->district_name ?? '' }}"
                                                    placeholder="District">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">VAO</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    name="panchayath_name"
                                                    value="{{ $customers->panchayath_name ?? '' }}" placeholder="VAO">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Address English</label>
                                                <textarea maxlength="500" required class="form-control" rows="3" name="address"
                                                    placeholder="Address English">{{ $customers->address ?? '' }}</textarea>
                                            </div>

                                        </div>

                                        <!-- RIGHT SIDE -->
                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label class="form-label">Aadhaar Number</label>
                                                <input maxlength="12" required type="text" maxlength="12"
                                                    class="form-control number"
                                                    value="{{ request('aadhaar_no') ?? ($customers->aadhaar_no ?? '') }}"
                                                    name="aadhaar_no" placeholder="Aadhaar Number">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Name In Tamil</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    name="name_tamil" placeholder="Name In Tamil"
                                                    value="{{ $customers->name_tamil ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Father Name In Tamil</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    value="{{ $customers->father_name_tamil ?? '' }}"
                                                    name="father_name_tamil" placeholder="Father Name In Tamil">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Mother Name In Tamil</label>
                                                <input maxlength="100" required type="text" class="form-control"
                                                    name="mother_name_tamil"
                                                    value="{{ $customers->mother_name_tamil ?? '' }}"
                                                    placeholder="Mother Name In Tamil">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Religion</label>
                                                <select required class="form-control" name="religion">
                                                    <option value="">Select</option>
                                                    <option value="Hindu"
                                                        {{ ($customers->religion ?? '') == 'Hindu' ? 'selected' : '' }}>
                                                        Hindu</option>
                                                    <option value="Christian"
                                                        {{ ($customers->religion ?? '') == 'Christian' ? 'selected' : '' }}>
                                                        Christian</option>
                                                    <option value="Muslim"
                                                        {{ ($customers->religion ?? '') == 'Muslim' ? 'selected' : '' }}>
                                                        Muslim</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Marital Status</label>
                                                <select required class="form-control" name="marital_status">
                                                    <option value="">Select</option>
                                                    <option value="Married"
                                                        {{ ($customers->marital_status ?? '') == 'Married' ? 'selected' : '' }}>
                                                        Married</option>
                                                    <option value="UnMarried"
                                                        {{ ($customers->marital_status ?? '') == 'UnMarried' ? 'selected' : '' }}>
                                                        UnMarried</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Taluk</label>
                                                <input maxlength="50" required type="text" class="form-control"
                                                    name="taluk_name" placeholder="Taluk Name"
                                                    value="{{ $customers->taluk_name ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Mobile Number</label>
                                                <input required type="text" maxlength="10" class="form-control number"
                                                    name="mobile" placeholder="Mobile Number"
                                                    value="{{ $customers->mobile ?? '' }}">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Address Tamil</label>
                                                <textarea maxlength="500" required class="form-control" rows="3" name="address_tamil"
                                                    placeholder="Address Tamil">{{ $customers->address_tamil ?? '' }}</textarea>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-primary px-5" onclick="nextStep(1)">
                                            Next →
                                        </button>
                                    </div>

                                </div>

                                <div class="row">

                                    <!-- STEP 2 -->
                                    <div id="step2" style="display:none;">

                                        <div class="card border-success shadow-sm mb-4">

                                            <!-- Card Body -->
                                            <div class="card-body">
                                                <!-- Education Details -->
                                                <!-- Personal Details -->
                                                <h6 class="text-primary mb-3">Personal Details</h6>

                                                <div class="row">

                                                    <div class="col-md-4 mb-3">
                                                        <label>Religion <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="tnega_religion" required>
                                                            <option value="">SELECT</option>
                                                            <option value="Hindu">HINDU</option>
                                                            <option value="Muslim">MUSLIM</option>
                                                            <option value="Christian">CHRISTIAN</option>
                                                            <option value="Others">OTHERS</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Caste <span class="text-danger">*</span></label>
                                                        <select name="caste" id="caste" class="form-control"
                                                            required>
                                                            <option value="">SELECT</option>

                                                            @foreach ($obc as $row)
                                                                <option value="{{ $row->id }}"
                                                                    data-serial="{{ $row->serial_no }}">
                                                                    {{ $row->caste_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Serial Number of the Caste in Central List of OBCs <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="serial_no" id="serial_no"
                                                            class="form-control" readonly>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label>Occupational Group <span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control" name="graduation" required>
                                                            <option value="">SELECT</option>
                                                            <option value="Student">Student</option>
                                                            <option value="Service">Service</option>
                                                            <option value="Business">Business</option>
                                                            <option value="Agriculture">Agriculture</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <hr>

                                                <h6 class="text-primary mb-3">Status of Father / Husband</h6>

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Whether Alive? <span
                                                                class="text-danger">*</span></label><br>

                                                        <label class="me-3">
                                                            <input type="radio" name="father_alive" value="Yes"> Yes
                                                        </label>

                                                        <label>
                                                            <input type="radio" name="father_alive" value="No"> No
                                                        </label>
                                                    </div>

                                                </div>

                                                <div id="fatherDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Nature of Occupation <span
                                                                    class="text-danger">*</span></label>

                                                            <select class="form-control" name="father_occupation"
                                                                id="father_occupation">
                                                                <option value="">SELECT</option>
                                                                <option value="Employed">Employed</option>
                                                                <option value="Self Employed">Self Employed</option>
                                                                <option value="Unemployed">Unemployed</option>
                                                            </select>
                                                        </div>


                                                        <div class="col-md-6 mb-3">
                                                            <label>Status <span class="text-danger">*</span></label>

                                                            <select class="form-control" name="father_status"
                                                                id="father_status" required>
                                                                <option value="">SELECT</option>
                                                                <option value="Constitutional Posts">Constitutional Posts
                                                                </option>
                                                                <option value="Government Services">Government Services
                                                                </option>
                                                                <option value="International Organization">International
                                                                    Organization</option>
                                                                <option value="Death/Permanent Incapacitation">
                                                                    Death/Permanent Incapacitation</option>
                                                                <option value="Public Sector Undertakings">Public Sector
                                                                    Undertakings</option>
                                                                <option value="Armed Forces/Para Military Forces">Armed
                                                                    Forces/Para Military Forces</option>
                                                                <option value="Professional Class">Professional Class
                                                                </option>
                                                                <option
                                                                    value="Agricultural Land Holding (Owned by Mother, Father, Minor Child)">
                                                                    Agricultural Land Holding (Owned by Mother, Father,
                                                                    Minor Child)</option>
                                                                <option value="Plantation (Property Owners)">Plantation
                                                                    (Property Owners)</option>
                                                                <option
                                                                    value="Vacant Land and/or Building in Urban Areas or Urban Agglomeration">
                                                                    Vacant Land and/or Building in Urban Areas or Urban
                                                                    Agglomeration</option>
                                                                <option value="Income/Wealth (Property Owners)">
                                                                    Income/Wealth (Property Owners)</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                        <div class="row" id="fatherIncomeProofSection"
                                                            style="display:none;">

                                                            <div class="col-md-6 mb-3">
                                                                <label>Proof of Income <span
                                                                        class="text-danger">*</span></label><br>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Payslip"> Payslip
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Income Certificate"> Income Certificate
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="ITR"> ITR
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Others"> Others
                                                                </label>
                                                            </div>

                                                            <div class="col-md-6 mb-3" id="fatherIncomeFile"
                                                                style="display:none;">
                                                                <label>Upload Proof <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="file" class="form-control"
                                                                    name="father_income_proof_file">
                                                            </div>

                                                        </div>
                                                        <div id="fatherCommonDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Pay of Scale <span
                                                                            class="text-danger">*</span></label>

                                                                    <input type="text" class="form-control number"
                                                                        name="father_pay_scale">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Designation <span
                                                                            class="text-danger">*</span></label>

                                                                    <input type="text" class="form-control"
                                                                        name="father_designation">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="fatherLocationDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">

                                                                    <label>
                                                                        Location
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input type="text" class="form-control"
                                                                        name="father_location">

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div id="fatherConstitutional" style="display:none;">


                                                </div>
                                                <div id="fatherGovernmentService" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Service <span class="text-danger">*</span></label><br>

                                                            <label class="me-3">
                                                                <input type="radio" name="father_service"
                                                                    value="Central">
                                                                Central
                                                            </label>

                                                            <label>
                                                                <input type="radio" name="father_service"
                                                                    value="State">
                                                                State
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Scale of Pay, including classification, if any
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input type="text" class="form-control"
                                                                name="father_pay_scale">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Date of Appointment of Post
                                                                <span class="text-danger">*</span>
                                                            </label>

                                                            <input type="date" class="form-control"
                                                                name="father_date_of_appointment">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>
                                                                Age at the time of promotion for Class I post
                                                                (If applicable)
                                                            </label>

                                                            <input type="text" class="form-control"
                                                                name="father_promotion_age">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherInternationalOrg" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Name Of The Organization<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="name_organization">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>Period Of Service (From Date)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="service_fromdate">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Period Of Service (To Date)<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                name="service_todate">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div id="fatherDeathDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Date of Death/Permanent Incapacitation <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                name="father_death_date">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Details of Permanent Incapacitation <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_incapacitation_details">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherPSUDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Name of the Organisation <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="name_organization">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Date of Appointment of Post <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="date" class="form-control"
                                                                name="father_psu_appointment_date">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherArmedForcesDetails" style="display:none;">

                                                    <div class="row">

                                                    </div>

                                                </div>
                                                <div id="fatherProfessionalDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Occupation / Profession <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_profession">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div id="fatherAgricultureDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Irrigated Land <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_irrigated_land">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Percentage of Irrigated Land Holding (Statutory Ceiling
                                                                Limit under State Land Ceiling Laws) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_irrigated_percentage">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Size of Holding <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_holding_size">
                                                        </div>

                                                        <div class="col-md-12 mb-3">
                                                            <label>Of land and/or building this both irrigated/un-irrigated
                                                                to total land holding on the basis of the conversion formula
                                                                in State Land Ceiling Law <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_conversion_formula">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherPlantationDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Crops/Fruits <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_crops_fruits">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Area of Plantation <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_area_plantation">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Un-irrigated Land (to be certified by District Revenue
                                                                Officer not below the rank of Tahsildar) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_unirrigated_land">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Size of Holding <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_size_holding">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherVacantLandDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Use to which it is put <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_property_use">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Details of the Property <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_property_details">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherIncomeWealthDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Annual Family Income from all Sources (Includes salaries
                                                                and income from agricultural land) <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="father_annual_income">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Whether Tax Payer (If Yes, copy of last three years
                                                                return be furnished) <span
                                                                    class="text-danger">*</span></label><br>

                                                            <label class="me-3">
                                                                <input type="radio" name="father_tax_payer"
                                                                    value="Yes"> Yes
                                                            </label>

                                                            <label>
                                                                <input type="radio" name="father_tax_payer"
                                                                    value="No"> No
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Whether covered in Wealth Tax Act (If so, furnish
                                                                details) <span class="text-danger">*</span></label><br>

                                                            <label class="me-3">
                                                                <input type="radio" name="father_wealth_tax"
                                                                    value="Yes"> Yes
                                                            </label>

                                                            <label>
                                                                <input type="radio" name="father_wealth_tax"
                                                                    value="No"> No
                                                            </label>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Wealth Tax Details</label>
                                                            <input type="text" class="form-control"
                                                                name="father_wealth_tax_details">
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Any Other Remarks</label>
                                                            <input type="text" class="form-control"
                                                                name="father_other_remarks">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div id="fatherOtherDetails" style="display:none;">

                                                    <div class="row">

                                                    </div>

                                                </div>
                                                <hr>

                                                <h5 class="text-primary mb-3">Status of Mother</h5>

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Whether Alive? <span
                                                                class="text-danger">*</span></label><br>

                                                        <label class="me-3">
                                                            <input type="radio" name="mother_alive" value="Yes"> Yes
                                                        </label>

                                                        <label>
                                                            <input type="radio" name="mother_alive" value="No"> No
                                                        </label>
                                                    </div>

                                                </div>

                                                <div id="motherDetails" style="display:none;">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>Nature of Occupation <span
                                                                    class="text-danger">*</span></label>

                                                            <select class="form-control" name="mother_occupation" id="mother_occupation">
                                                                <option value="">SELECT</option>
                                                                <option value="Employed">Employed</option>
                                                                <option value="Self Employed">Self Employed</option>
                                                                <option value="Unemployed">Unemployed</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label>Status <span class="text-danger">*</span></label>

                                                            <select class="form-control" name="mother_status"
                                                                id="mother_status" required>
                                                                <option value="">SELECT</option>
                                                                <option value="Constitutional Posts">Constitutional Posts
                                                                </option>
                                                                <option value="Government Services">Government Services
                                                                </option>
                                                                <option value="International Organization">International
                                                                    Organization</option>
                                                                <option value="Death/Permanent Incapacitation">
                                                                    Death/Permanent Incapacitation</option>
                                                                <option value="Public Sector Undertakings">Public Sector
                                                                    Undertakings</option>
                                                                <option value="Armed Forces/Para Military Forces">Armed
                                                                    Forces/Para Military Forces</option>
                                                                <option value="Professional Class">Professional Class
                                                                </option>
                                                                <option
                                                                    value="Agricultural Land Holding (Owned by Mother, Father, Minor Child)">
                                                                    Agricultural Land Holding (Owned by Mother, Father,
                                                                    Minor Child)</option>
                                                                <option value="Plantation (Property Owners)">Plantation
                                                                    (Property Owners)</option>
                                                                <option
                                                                    value="Vacant Land and/or Building in Urban Areas or Urban Agglomeration">
                                                                    Vacant Land and/or Building in Urban Areas or Urban
                                                                    Agglomeration</option>
                                                                <option value="Income/Wealth (Property Owners)">
                                                                    Income/Wealth (Property Owners)</option>
                                                                <option value="Others">Others</option>
                                                            </select>
                                                        </div>
                                                         <div class="row" id="motherIncomeProofSection"
                                                            style="display:none;">

                                                            <div class="col-md-6 mb-3">
                                                                <label>Proof of Income <span
                                                                        class="text-danger">*</span></label><br>

                                                                <label class="me-3">
                                                                    <input type="radio" name="mother_income_proof"
                                                                        value="Payslip"> Payslip
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="mother_income_proof"
                                                                        value="Income Certificate"> Income Certificate
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="mother_income_proof"
                                                                        value="ITR"> ITR
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="mother_income_proof"
                                                                        value="Others"> Others
                                                                </label>
                                                            </div>

                                                            <div class="col-md-6 mb-3" id="motherIncomeFile"
                                                                style="display:none;">
                                                                <label>Upload Proof <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="file" class="form-control"
                                                                    name="mother_income_proof_file">
                                                            </div>

                                                        </div>
                                                        <div class="row" id="fatherIncomeProofSection"
                                                            style="display:none;">

                                                            <div class="col-md-6 mb-3">
                                                                <label>Proof of Income <span
                                                                        class="text-danger">*</span></label><br>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Payslip"> Payslip
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Income Certificate"> Income Certificate
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="ITR"> ITR
                                                                </label>

                                                                <label class="me-3">
                                                                    <input type="radio" name="father_income_proof"
                                                                        value="Others"> Others
                                                                </label>
                                                            </div>

                                                            <div class="col-md-6 mb-3" id="fatherIncomeFile"
                                                                style="display:none;">
                                                                <label>Upload Proof <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="file" class="form-control"
                                                                    name="father_income_proof_file">
                                                            </div>

                                                        </div>
                                                        <div id="motherCommonDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Designation <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_designation">
                                                                </div>


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Pay of Scale <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control number"
                                                                        name="mother_pay_scale">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherLocationDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">

                                                                    <label>Mother Location <span
                                                                            class="text-danger">*</span></label>

                                                                    <input type="text" class="form-control"
                                                                        name="mother_location">

                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherConstitutional" style="display:none;">

                                                            <div class="row">

                                                            </div>

                                                        </div>
                                                        <div id="motherGovernmentService" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Service <span
                                                                            class="text-danger">*</span></label><br>

                                                                    <label class="me-3">
                                                                        <input type="radio" name="mother_service"
                                                                            value="Central">
                                                                        Central
                                                                    </label>

                                                                    <label>
                                                                        <input type="radio" name="mother_service"
                                                                            value="State">
                                                                        State
                                                                    </label>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Designation <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_gov_designation">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Scale of Pay, including classification, if any
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input type="text" class="form-control"
                                                                        name="mother_scale_of_pay">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Date of Appointment of Post
                                                                        <span class="text-danger">*</span>
                                                                    </label>

                                                                    <input type="date" class="form-control"
                                                                        name="mother_date_of_appointment">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>
                                                                        Age at the time of promotion for Class I post
                                                                        (If applicable)
                                                                    </label>

                                                                    <input type="text" class="form-control"
                                                                        name="mother_promotion_age">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherInternationalOrg" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Name Of The Organization <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        name="mother_name_organization">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Period Of Service (From Date) <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        name="mother_servicefromdate">
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label>Period Of Service (To Date) <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        name="mother_servicetodate">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherDeathDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Date of Death/Permanent Incapacitation <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        name="mother_death_date">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Details of Permanent Incapacitation <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_incapacitation_details">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherPSUDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Name of the Organisation <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_psu_organisation">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Date of Appointment of Post <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="date" class="form-control"
                                                                        name="mother_psu_appointment_date">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherArmedForcesDetails" style="display:none;">

                                                            <div class="row">

                                                            </div>

                                                        </div>
                                                        <div id="motherProfessionalDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Occupation / Profession <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_profession">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherAgricultureDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Irrigated Land <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_irrigated_land">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Percentage of Irrigated Land Holding (Statutory
                                                                        Ceiling Limit under State Land Ceiling Laws)
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_irrigated_percentage">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Size of Holding <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_holding_size">
                                                                </div>

                                                                <div class="col-md-12 mb-3">
                                                                    <label>Of land and/or building this both
                                                                        irrigated/un-irrigated to total land holding on the
                                                                        basis of the conversion formula in State Land
                                                                        Ceiling Law
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_conversion_formula">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherPlantationDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Crops/Fruits <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_crops_fruits">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Area of Plantation <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_area_plantation">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Un-irrigated Land (to be certified by District
                                                                        Revenue Officer not below the rank of Tahsildar)
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_unirrigated_land">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Size of Holding <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_holding_size">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherVacantLandDetails" style="display:none;">

                                                            <div class="row">


                                                                <div class="col-md-6 mb-3">
                                                                    <label>Use to which it is put <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_property_use">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Details of the Property <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_property_details">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="fatherIncomeWealthDetails" style="display:none;">

                                                            <div class="row">

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Annual Family Income from all Sources (Includes
                                                                        salaries and income from agricultural land) <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_annual_income">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Whether Tax Payer (If Yes, copy of last three
                                                                        years return be furnished) <span
                                                                            class="text-danger">*</span></label><br>

                                                                    <label class="me-3">
                                                                        <input type="radio" name="mother_tax_payer"
                                                                            value="Yes"> Yes
                                                                    </label>

                                                                    <label>
                                                                        <input type="radio" name="mother_tax_payer"
                                                                            value="No"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Whether covered in Wealth Tax Act (If so, furnish
                                                                        details) <span
                                                                            class="text-danger">*</span></label><br>

                                                                    <label class="me-3">
                                                                        <input type="radio" name="mother_wealth_tax"
                                                                            value="Yes"> Yes
                                                                    </label>

                                                                    <label>
                                                                        <input type="radio" name="mother_wealth_tax"
                                                                            value="No"> No
                                                                    </label>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Wealth Tax Details</label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_wealth_tax_details">
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label>Any Other Remarks</label>
                                                                    <input type="text" class="form-control"
                                                                        name="mother_other_remarks">
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div id="motherOtherDetails" style="display:none;">

                                                            <div class="row">

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>

                                                <hr>

                                            </div>
                                            <!-- Buttons -->
                                            <div class="card-footer bg-white">
                                                <div class="d-flex justify-content-between">

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(2)">
                                                        <i class="fa fa-arrow-left"></i> Previous
                                                    </button>
                                    <div class="text-center mt-4">
                                        <button type="button" class="btn btn-primary px-5" onclick="nextStep(2)">
                                            Next →
                                        </button>
                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                  <div class="row">

                                    <!-- STEP 3 -->
                                    <div id="step3" style="display:none;">

                                        <div class="card border-success shadow-sm mb-4">

                                            <!-- Header -->
                                            <div class="card-header bg-light">
                                                <h6 class="mb-2 text-success">
                                                    <i class="fa fa-graduation-cap"></i>Documents
                                                </h6>
                                            </div>

                                            <!-- Body -->
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label>Photo</label>
                                                        <input required type="file" class="form-control"
                                                            name="photo">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Aadhaar + Smart Card</label>
                                                        <input required type="file" class="form-control"
                                                            name="aadhaar_card">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Community Certificate</label>
                                                        <input required type="file" class="form-control"
                                                            name="community">
                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label>Signature</label>
                                                        <input required type="file" class="form-control"
                                                            name="signature">
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Footer -->
                                            <div class="card-footer bg-white">
                                                <div class="d-flex justify-content-between">

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(3)">
                                                        <i class="fa fa-arrow-left"></i> Previous
                                                    </button>

                                                    <div class="text-center">
                                                        <div class="col-12">
                                                            <div class="mb-0">
                                                                <button id="save" type="submit"
                                                                    class="btn btn-primary">Apply</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <p id="nopayment"></p>
                    </div>

                    </form>
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

        var wallet = "{{ Auth::user()->wallet }}";
        var amount = "{{ $payment }}";
    $(function() {
        if (parseFloat(amount) > parseInt(wallet)) {
            $('#save').prop("disabled", true);
            $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                'color': 'red',
                'font-size': '150%',
                'font-weight': 'bold'
            });
        }
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
        gettaluk(dist_id);
        getpanchayath(taluk_id);
    });
    </script>
    <script>
        function nextStep(step) {

            console.log('Current:', 'step' + step);
            console.log('Next:', 'step' + (step + 1));

            let currentStep = document.getElementById('step' + step);
            let nextStepDiv = document.getElementById('step' + (step + 1));

            console.log(currentStep);
            console.log(nextStepDiv);

            if (currentStep) currentStep.style.display = 'none';
            if (nextStepDiv) nextStepDiv.style.display = 'block';
        }

        function prevStep(step) {

            console.log('Current:', 'step' + step);
            console.log('Previous:', 'step' + (step - 1));

            let currentStep = document.getElementById('step' + step);
            let prevStepDiv = document.getElementById('step' + (step - 1));

            if (currentStep) currentStep.style.display = 'none';
            if (prevStepDiv) prevStepDiv.style.display = 'block';
        }
    </script>

    {{-- Add Script --}}

    <script>
        // Caste Script

        $('#caste').on('change', function() {
            let serial = $(this).find(':selected').data('serial');
            $('#serial_no').val(serial ?? '');
        });

        $(document).ready(function() {

            // Father
            $("input[name='father_alive']").change(function() {

                if ($(this).val() == "Yes") {
                    $("#fatherDetails").slideDown();
                } else {
                    $("#fatherDetails").slideUp();
                    $("#fatherDetails").find("select").val("");
                }

            });

            // Mother
            $("input[name='mother_alive']").change(function() {

                if ($(this).val() == "Yes") {
                    $("#motherDetails").slideDown();
                } else {
                    $("#motherDetails").slideUp();
                    $("#motherDetails").find("select").val("");
                }

            });

        });

        // Required varama irukurathuku

        $(document).ready(function() {

            $("input[name='father_alive']").change(function() {

                if ($(this).val() == "Yes") {
                    $("#fatherDetails").show();
                    $("#fatherDetails").find("select").prop("required", true);
                } else {
                    $("#fatherDetails").hide();
                    $("#fatherDetails").find("select").prop("required", false).val("");
                }

            });

            $("input[name='mother_alive']").change(function() {

                if ($(this).val() == "Yes") {
                    $("#motherDetails").show();
                    $("#motherDetails").find("select").prop("required", true);
                } else {
                    $("#motherDetails").hide();
                    $("#motherDetails").find("select").prop("required", false).val("");
                }

            });

        });

        $(document).ready(function() {


            function toggleFatherStatus() {

                let status = $("#father_status").val();


                // Hide all father sections
                $("#fatherConstitutional, #fatherGovernmentService, #fatherInternationalOrg, #fatherDeathDetails, #fatherPSUDetails, #fatherArmedForcesDetails, #fatherProfessionalDetails, #fatherAgricultureDetails, #fatherPlantationDetails, #fatherVacantLandDetails, #fatherIncomeWealthDetails, #fatherOtherDetails, #fatherCommonDetails, #fatherLocationDetails")
                    .hide();


                // Remove required
                $("#fatherConstitutional, #fatherGovernmentService, #fatherInternationalOrg, #fatherDeathDetails, #fatherPSUDetails, #fatherArmedForcesDetails, #fatherProfessionalDetails, #fatherAgricultureDetails, #fatherPlantationDetails, #fatherVacantLandDetails, #fatherIncomeWealthDetails, #fatherOtherDetails, #fatherCommonDetails, #fatherLocationDetails")
                    .find("input")
                    .prop("required", false);


                let commonStatus = [
                    "Constitutional Posts",
                    "Government Services",
                    "International Organization",
                    "Death/Permanent Incapacitation",
                    "Public Sector Undertakings",
                    "Armed Forces/Para Military Forces"
                ];


                let locationStatus = [
                    "Agricultural Land Holding (Owned by Mother, Father, Minor Child)",
                    "Plantation (Property Owners)",
                    "Vacant Land and/or Building in Urban Areas or Urban Agglomeration"
                ];


                // Common Designation + Pay Scale
                if (commonStatus.includes(status)) {

                    $("#fatherCommonDetails").show();

                    $("#fatherCommonDetails")
                        .find("input")
                        .prop("required", true);

                }


                // Common Location
                if (locationStatus.includes(status)) {

                    $("#fatherLocationDetails").show();

                    $("#fatherLocationDetails")
                        .find("input")
                        .prop("required", true);

                }


                let sections = {

                    "Government Services": "#fatherGovernmentService",

                    "International Organization": "#fatherInternationalOrg",

                    "Death/Permanent Incapacitation": "#fatherDeathDetails",

                    "Public Sector Undertakings": "#fatherPSUDetails",

                    "Armed Forces/Para Military Forces": "#fatherArmedForcesDetails",

                    "Professional Class": "#fatherProfessionalDetails",

                    "Agricultural Land Holding (Owned by Mother, Father, Minor Child)": "#fatherAgricultureDetails",

                    "Plantation (Property Owners)": "#fatherPlantationDetails",

                    "Vacant Land and/or Building in Urban Areas or Urban Agglomeration": "#fatherVacantLandDetails",

                    "Income/Wealth (Property Owners)": "#fatherIncomeWealthDetails",

                    "Others": "#fatherOtherDetails"

                };


                if (sections[status]) {

                    $(sections[status]).show();

                    $(sections[status])
                        .find("input")
                        .prop("required", true);

                }


            }



            function toggleMotherStatus() {

                let status = $("#mother_status").val();


                $("#motherConstitutional, #motherGovernmentService, #motherInternationalOrg, #motherDeathDetails, #motherPSUDetails, #motherArmedForcesDetails, #motherProfessionalDetails, #motherAgricultureDetails, #motherPlantationDetails, #motherVacantLandDetails, #motherIncomeWealthDetails, #motherOtherDetails, #motherCommonDetails, #motherLocationDetails")
                    .hide();


                $("#motherConstitutional, #motherGovernmentService, #motherInternationalOrg, #motherDeathDetails, #motherPSUDetails, #motherArmedForcesDetails, #motherProfessionalDetails, #motherAgricultureDetails, #motherPlantationDetails, #motherVacantLandDetails, #motherIncomeWealthDetails, #motherOtherDetails, #motherCommonDetails, #motherLocationDetails")
                    .find("input")
                    .prop("required", false);



                let commonStatus = [
                    "Constitutional Posts",
                    "Government Services",
                    "International Organization",
                    "Death/Permanent Incapacitation",
                    "Public Sector Undertakings",
                    "Armed Forces/Para Military Forces"
                ];


                let locationStatus = [
                    "Agricultural Land Holding (Owned by Mother, Father, Minor Child)",
                    "Plantation (Property Owners)",
                    "Vacant Land and/or Building in Urban Areas or Urban Agglomeration"
                ];



                if (commonStatus.includes(status)) {

                    $("#motherCommonDetails").show();

                    $("#motherCommonDetails")
                        .find("input")
                        .prop("required", true);

                }


                if (locationStatus.includes(status)) {

                    $("#motherLocationDetails").show();

                    $("#motherLocationDetails")
                        .find("input")
                        .prop("required", true);

                }



                let sections = {

                    "Government Services": "#motherGovernmentService",

                    "International Organization": "#motherInternationalOrg",

                    "Death/Permanent Incapacitation": "#motherDeathDetails",

                    "Public Sector Undertakings": "#motherPSUDetails",

                    "Armed Forces/Para Military Forces": "#motherArmedForcesDetails",

                    "Professional Class": "#motherProfessionalDetails",

                    "Agricultural Land Holding (Owned by Mother, Father, Minor Child)": "#motherAgricultureDetails",

                    "Plantation (Property Owners)": "#motherPlantationDetails",

                    "Vacant Land and/or Building in Urban Areas or Urban Agglomeration": "#motherVacantLandDetails",

                    "Income/Wealth (Property Owners)": "#motherIncomeWealthDetails",

                    "Others": "#motherOtherDetails"

                };


                if (sections[status]) {

                    $(sections[status]).show();

                    $(sections[status])
                        .find("input")
                        .prop("required", true);

                }


            }



            // Page Load
            toggleFatherStatus();
            toggleMotherStatus();



            // Change Event
            $("#father_status").change(function() {

                toggleFatherStatus();

            });


            $("#mother_status").change(function() {

                toggleMotherStatus();

            });


        });

// Employed select panura time Father

$(document).ready(function () {

    function toggleFatherIncomeProof() {

        let occupation = $("#father_occupation").val();

        if (occupation === "Employed" || occupation === "Self Employed") {

            $("#fatherIncomeProofSection").show();
            $("input[name='father_income_proof']").prop("required", true);

        } else {

            $("#fatherIncomeProofSection").hide();
            $("#fatherIncomeFile").hide();

            $("input[name='father_income_proof']")
                .prop("checked", false)
                .prop("required", false);

            $("input[name='father_income_proof_file']")
                .prop("required", false)
                .val("");
        }
    }

    $("#father_occupation").on("change", function () {
        toggleFatherIncomeProof();
    });

    $("input[name='father_income_proof']").on("change", function () {

        $("#fatherIncomeFile").show();

        $("input[name='father_income_proof_file']").prop("required", false);

    });

    toggleFatherIncomeProof();

    if ($("input[name='father_income_proof']:checked").length > 0) {
        $("#fatherIncomeFile").show();
    }

});

// Employed select panura time Mother


$(document).ready(function () {

    function toggleMotherIncomeProof() {

        let occupation = $("#mother_occupation").val();

        if (occupation == "Employed" || occupation == "Self Employed") {

            $("#motherIncomeProofSection").show();

            $("input[name='mother_income_proof']").prop("required", true);

            // Update page-ல் radio already selected இருந்தா file upload section-ஐ show பண்ணு
            if ($("input[name='mother_income_proof']:checked").length > 0) {

                $("#motherIncomeFile").show();

                @if(empty($services->mother_income_proof_file))
                    $("input[name='mother_income_proof_file']").prop("required", true);
                @else
                    $("input[name='mother_income_proof_file']").prop("required", false);
                @endif
            }

        } else {

            $("#motherIncomeProofSection").hide();
            $("#motherIncomeFile").hide();

            $("input[name='mother_income_proof']")
                .prop("checked", false)
                .prop("required", false);

            $("input[name='mother_income_proof_file']")
                .val("")
                .prop("required", false);
        }
    }

    // Occupation Change
    $("#mother_occupation").on("change", function () {
        toggleMotherIncomeProof();
    });

    // Radio Change
    $("input[name='mother_income_proof']").on("change", function () {

        $("#motherIncomeFile").show();

        @if(empty($services->mother_income_proof_file))
            $("input[name='mother_income_proof_file']").prop("required", true);
        @else
            $("input[name='mother_income_proof_file']").prop("required", false);
        @endif

    });

    // Page Load
    toggleMotherIncomeProof();

});
    </script>
@endpush

