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
                            <form class="row g-4" action="{{ url('submittnegaincome') }}" enctype="multipart/form-data"
                                method="post" id="myForm" onsubmit="return checkpayment(event)">
                                @csrf

                                <div id="step1">
                                    <h6 class="text-center card-header bg-primary text-white">
                                        Can Details
                                    </h6>
                                    <div class="row">
                                        <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                        <input type="hidden" name="user_id" value="{{ $customers->id ?? '' }}">
                                        <input type="hidden" name="amount" value="{{ $amount }}">
                                        <input type="hidden" id="seramt" name="service_amount"
                                            value="{{ $payment }}">
                                        {{-- <input type="hidden" name="user_id" value="{{ $customers->id }}"> --}}
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
                                        <button type="button" class="btn btn-danger" onclick="nextStep(1)">
                                            Next →
                                        </button>
                                    </div>

                                </div>

                                <div class="row">
                                    <!-- STEP 2 -->
                                    <div id="step2" style="display:none;">

                                        <div class="card shadow border-0 mt-4">

                                            <div class="card-header bg-primary text-white">
                                                <h5 class="mb-0 text-center">Self Details</h5>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label mt-2">Name In Tamil</label>
                                                        <input maxlength="100" required type="text"
                                                            class="form-control" name="name_tamil"
                                                            placeholder="Name In Tamil">
                                                        <label class="form-label mt-2">Age</label>
                                                        <input type="text" class="form-control number" name="age"
                                                            placeholder="Age" maxlength="2" required>

                                                        <label class="form-label">Profession </label>
                                                        <select name="profession" id="self_profession"
                                                            class="form-control" required maxlength="70">
                                                            <option value="">SELECT</option>
                                                            <option value="Government">Government</option>
                                                            <option value="Household/Dependent">Household/Dependent
                                                            </option>
                                                            <option value="Private">Private</option>
                                                            <option value="Professional">Professional</option>
                                                            <option value="Public">Public</option>
                                                            <option value="Student/Dependent">Student/Dependent</option>
                                                        </select>

                                                    </div>

                                                    <div class="col-md-6 mb-3">
                                                        <label class="form-label mt-2">Name In English</label>
                                                        <input maxlength="100" required type="text"
                                                            class="form-control" name="name_english"
                                                            placeholder="Name In English">

                                                        <label class="form-label">Sex</label>
                                                        <select name="sex" class="form-control" required
                                                            maxlength="30">
                                                            <option value="">SELECT</option>
                                                            <option value="Female">Female</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Not Stated">Not Stated</option>
                                                            <option value="Transgender">Transgender</option>
                                                        </select>
                                                        <div id="self_income_section">
                                                            <label class="form-label mt-2">Source of Income</label>
                                                            <select name="income_source" id="income_source"
                                                                class="form-control">
                                                                <option value="">SELECT</option>
                                                                <option value="Agriculture and Allied">Agriculture and
                                                                    Allied</option>
                                                                <option value="Salary">Salary</option>
                                                                <option value="Business">Business</option>
                                                                <option value="Rent">Rent</option>
                                                                <option value="Others">Others</option>
                                                            </select>

                                                            <div id="incomeExtraFields" class="mt-3"></div>

                                                        </div>

                                                        <div class="col-md-8">
                                                            <div id="incomeFields2"></div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-between mt-4">
                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(2)">
                                                        ← Previous
                                                    </button>

                                                    <button type="button" class="btn btn-danger" onclick="nextStep(2)">
                                                        Next →
                                                    </button>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <!-- ================= STEP 3 ================= -->
                                 <div id="step3" style="display:none;">
    <div class="card shadow border-0 mt-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 text-center">Family Details</h5>
        </div>

        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-3">
                    <label>Total Number Of Family Members</label>
                    <input type="text" class="form-control number" id="family_count" name="family_count" maxlength="2">
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Relationship</label>
                    <select class="form-control" id="relationship" name="relation">
                        <option value="">SELECT</option>
                        <option value="Father">Father</option>
                        <option value="Mother">Mother</option>
                        <option value="Husband">Husband</option>
                        <option value="Wife">Wife</option>
                        <option value="Son">Son</option>
                        <option value="Daughter">Daughter</option>
                        <option value="Elder Brother">Elder Brother</option>
                        <option value="Younger Brother">Younger Brother</option>
                        <option value="Elder Sister">Elder Sister</option>
                        <option value="Younger Sister">Younger Sister</option>
                        <option value="Guardian">Guardian</option>
                        <option value="Parent">Parent</option>
                        <option value="Father/Husband">Father/Husband</option>
                        <option value="Single Mother">Single Mother</option>
                        <option value="Others">Others</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Name Tamil</label>
                    <input type="text" class="form-control" id="member_name_tamil" name="relation_name_tamil" maxlength="100">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Name English</label>
                    <input type="text" class="form-control" id="member_name_english" name="relation_name_english" maxlength="100">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>Age</label>
                    <input type="text" class="form-control number" id="member_age" name="relation_age" maxlength="2">
                </div>

                <div class="col-md-3 mb-3">
                    <label>Sex</label>
                    <select class="form-control" id="member_sex" name="relation_status">
                        <option value="">SELECT</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Transgender">Transgender</option>
                        <option value="Not Stated">Not Stated</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Profession</label>
                    <select class="form-control" id="family_profession">
                        <option value="">SELECT</option>
                        <option value="Government">Government</option>
                        <option value="Private">Private</option>
                        <option value="Professional">Professional</option>
                        <option value="Public">Public</option>
                        <option value="Student/Dependent">Student/Dependent</option>
                        <option value="Household/Dependent">Household/Dependent</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Source Of Income</label>
                    <select class="form-control" id="family_income_source">
                        <option value="">SELECT</option>
                        <option value="Agriculture and Allied">Agriculture and Allied</option>
                        <option value="Salary">Salary</option>
                        <option value="Business">Business</option>
                        <option value="Rent">Rent</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
            </div>

            <!-- Dynamic Income & Document Fields -->
            <div id="familyIncomeFields"></div>

            <div class="text-center mt-3">
                <button type="button" class="btn btn-success" id="addRelationBtn">Add Member</button>
            </div>

            <hr>

            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="familytable">
                    <thead class="table-dark">
                        <tr>
                            <th>Relationship</th>
                            <th>Name Tamil</th>
                            <th>Name English</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Profession</th>
                            <th>Income Source</th>
                            <th>Income</th>
                            <th>PAN Card</th>
                            <th>Extra Document</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <button type="button" class="btn btn-secondary" onclick="prevStep(3)">← Previous</button>
        <button type="button" class="btn btn-danger" id="familyNextBtn" onclick="nextStep(3)" disabled>Next →</button>
    </div>
</div>

                                    </div>

                                    <div class="row">
                                        <!-- STEP 4 -->
                                        <div id="step4" style="display:none;">

                                            <div class="card shadow border-0 mt-4">

                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="mb-0 text-center">Documents</h5>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-6 mb-3">
                                                            <label>1. Photo *</label>
                                                            <input type="file" name="photo" class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>2. Smart Card *</label>
                                                            <input type="file" name="smart_card" class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>3. Signature *</label>
                                                            <input type="file" name="signature" class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label>4. Aadhaar Card *</label>
                                                            <input type="file" name="aadhaar_card"
                                                                class="form-control" required>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="d-flex justify-content-between mt-4">

                                                    <button type="button" class="btn btn-secondary"
                                                        onclick="prevStep(4)">
                                                        ← Previous
                                                    </button>
                                                    <div class="text-center">
                                                        <p id="nopayment"></p>
                                                    </div>
                                                    <button id="save" type="submit" class="btn btn-success">
                                                        Submit
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

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


        $("#pricetable").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
        });


        function addnewrow() {
            $("#pricetable tbody").append(
                "<tr><td> <select required name='family_relationship[]' class='form-control'><option value=''>Select</option><option value='Father'>தகப்பன்</option><option value='Mother'>தாய்</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Younger Brother'>அண்ணன்</option><option value='Elder Brother'>தம்பி</option><option value='Younger Sister'>அக்கா</option><option value='Elder Sister'>தங்கை</option><option value='Relation'>உறவினர்</option><option value='Self'>தனக்கு</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'></td><td><input class='form-control' required type='text' name='relation_name_tamil[]'maxlength='80'></td><td width='10%'><input class='form-control number' required type='text' name='relation_age[]'maxlength='2'></td><td><input class='form-control' required type='text' name='relation_income[]'maxlength='100'></td><td><select required name='occupation[]' class='form-control'><option value=''>Select</option><option value='Student'>Student</option><option value='Home Maker'>Home maker</option><option value='Govt Employee'>Govt employee</option><option value='Private Employee'>Private Employee</option><option value='Daily Wages'>Daily Wages</option><option value='Agriculture'>Agriculture</option><option value='Others'>Others</option></select></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
            );
        }
        //step2 self details script

        $('#income_source').change(function() {

            let value = $(this).val();
            let html = '';

            if (value != '') {

                html += `
        <div class="row mt-2">

            <div class="col-md-4">
                <label>Income<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="income">
            </div>

            <div class="col-md-4">
                <label>PAN Card</label>
                <input type="file" class="form-control" name="pancard">
            </div>
        `;

                if (value == 'Agriculture and Allied') {

                    html += `
            <div class="col-md-4">
                <label>Land Holding Details<span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="land_hold">
            </div>`;
                }

                if (value == 'Salary') {

                    html += `
            <div class="col-md-4">
                <label>Salary Certificate(Latest Copy)<span class="text-danger">*</span></label>
                <input type="file" class="form-control" name="salary_slip">
            </div>`;
                }

                if (value == 'Business') {

                    html += `
            <div class="col-md-4">
                <label>TIN Number / Trade<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="tin_number">
            </div>`;
                }

                if (value == 'Rent') {

                    html += `
                     <div class="col-md-4">
                <label>Details of houses owned ward wise<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="owned_house">
            </div>`;

                }
                if (value == 'Others') {

                    html += `
                     <div class="col-md-4">
                <label>Work In English<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="work_english">
            </div>
                     <div class="col-md-4">
                <label>தொழில் பெயர்<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="work_tamil">
            </div>`;

                }

                html += `</div>`;
            }

            $('#incomeExtraFields').html(html);

        });

        // STEP 2 - Profession Change
        $(document).on("change", "#self_profession", function() {

            let profession = $(this).val();

            if (profession == "Student/Dependent" ||
                profession == "Household/Dependent") {

                // Source of Income Label Hide
                $("label[for='income_source'], label:contains('Source of Income')")
                    .last()
                    .hide();

                // Source of Income Dropdown Hide
                $("#income_source").hide();

                // Clear value
                $("#income_source").val("");

                // Remove Dynamic Fields
                $("#incomeExtraFields").html("").hide();

            } else {

                // Show Again
                $("label[for='income_source'], label:contains('Source of Income')")
                    .last()
                    .show();

                $("#income_source").show();

                $("#incomeExtraFields").show();

            }

        });

        $(document).on("change", "#self_profession", function() {

            let profession = $(this).val();

            if (profession == "Student/Dependent" ||
                profession == "Household/Dependent") {

                $("#self_income_section").hide();
                $("#income_source").val("");
                $("#incomeExtraFields").html("");

            } else {

                $("#self_income_section").show();

            }

        });


        //====================================================
        // STEP 3 - FAMILY DETAILS
        //====================================================

        // Selected Relationship
     var selectedRelations = [];

    // Relationship Dropdown Refresh
    function refreshRelationship() {
        $("#relationship option").show();
        $.each(selectedRelations, function(index, value) {
            $("#relationship option[value='" + value + "']").hide();
        });
        $("#relationship").val("");
    }

    // Next Button Enable/Disable Check
    function checkFamilyCount() {
        let total = parseInt($("#family_count").val()) || 0;
        let added = $("#familytable tbody tr").length;
        if (total > 0 && added == total) {
            $("#familyNextBtn").prop("disabled", false);
        } else {
            $("#familyNextBtn").prop("disabled", true);
        }
    }

    // Input Validations
    $(document).on("input", "#family_count, #member_age", function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if($(this).attr('id') == 'family_count') checkFamilyCount();
    });

    $(document).on("input", "#member_name_tamil, #member_name_english", function() {
        this.value = this.value.replace(/[0-9]/g, '');
    });

    // Profession Change
    $(document).on("change", "#family_profession", function() {
        let profession = $(this).val();
        if (profession == "Student/Dependent" || profession == "Household/Dependent") {
            $("#family_income_source").val("");
            $("#family_income_source").closest(".col-md-3").hide();
            $("#familyIncomeFields").html("");
        } else {
            $("#family_income_source").closest(".col-md-3").show();
        }
    });

    // Income Source Change (Dynamic UI logic)
    $(document).on("change", "#family_income_source", function() {
        let value = $(this).val();
        let html = "";
        $("#familyIncomeFields").html("");

        if (value == "") return;

        html += `
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <label>Income <span class="text-danger">*</span></label>
                <input type="text" class="form-control number" id="family_income" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
            </div>
            <div class="col-md-4 mb-3">
                <label>PAN Card <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="family_pan" name="family_pan" accept=".pdf,.jpg,.jpeg,.png">
            </div>
        `;

        if (value == "Agriculture and Allied") {
            html += `
            <div class="col-md-4 mb-3">
                <label>Land Holding Details <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="family_extra" name="family_extra" accept=".pdf,.jpg,.jpeg,.png">
            </div>`;
        } else if (value == "Salary") {
            html += `
            <div class="col-md-4 mb-3">
                <label>Salary Certificate (Latest Copy) <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="family_extra" name="family_extra" accept=".pdf,.jpg,.jpeg,.png">
            </div>`;
        } else if (value == "Business") {
            html += `
            <div class="col-md-4 mb-3">
                <label>TIN Number / Trade License <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="family_extra" name="family_extra">
            </div>`;
        } else if (value == "Rent") {
            html += `
            <div class="col-md-4 mb-3">
                <label>House Details <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="family_extra" name="family_extra">
            </div>`;
        } else if (value == "Others") {
            html += `
            <div class="col-md-4 mb-3">
                <label>Work In English <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="work_english" name="family_work_english">
            </div>
            <div class="col-md-4 mb-3">
                <label>தொழில் பெயர் (Tamil) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="work_tamil" name="family_work_tamil">
            </div>`;
        }

        html += `</div>`;
        $("#familyIncomeFields").html(html);
    });

    // Add Family Member Logic
    $(document).off("click", "#addRelationBtn").on("click", "#addRelationBtn", function(e) {
        e.preventDefault();

        let total = parseInt($("#family_count").val()) || 0;
        let added = $("#familytable tbody tr").length;

        if ($("#family_count").val().trim() == "" || total <= 0) {
            alert("Please Enter a Valid Total Number Of Family Members");
            $("#family_count").focus();
            return false;
        }

        if (added >= total) {
            alert("Already Added All Family Members");
            return false;
        }

        if ($("#relationship").val() == "") { alert("Please Select Relationship"); return false; }
        if ($("#member_name_tamil").val().trim() == "") { alert("Please Enter Name Tamil"); return false; }
        if ($("#member_name_english").val().trim() == "") { alert("Please Enter Name English"); return false; }
        if ($("#member_age").val().trim() == "" || parseInt($("#member_age").val()) > 120) { alert("Invalid Age"); return false; }
        if ($("#member_sex").val() == "") { alert("Please Select Sex"); return false; }
        if ($("#family_profession").val() == "") { alert("Please Select Profession"); return false; }

        let incomeSource = $("#family_income_source").val() || "";
        let profession = $("#family_profession").val();

        // Validation for income earners
        if (profession != "Student/Dependent" && profession != "Household/Dependent") {
            if (incomeSource == "") { alert("Please Select Source Of Income"); return false; }
            if ($("#family_income").val().trim() == "") { alert("Please Enter Income"); return false; }
            if ($("#family_pan")[0].files.length == 0) { alert("Please Upload PAN Card"); return false; }
            
            if (incomeSource != "Others") {
                let extraElem = $("#family_extra")[0];
                if (extraElem.type == "file" && extraElem.files.length == 0) {
                    alert("Please Upload the Required Extra Document");
                    return false;
                }
                if (extraElem.type == "text" && $(extraElem).val().trim() == "") {
                    alert("Please Fill the Required Document Details");
                    return false;
                }
            } else {
                if ($("#work_english").val().trim() == "" || $("#work_tamil").val().trim() == "") {
                    alert("Please Fill both Tamil and English Work Details");
                    return false;
                }
            }
        }

        let relation = $("#relationship").val();
        if (selectedRelations.includes(relation)) {
            alert("This Relationship Already Added");
            return false;
        }

        let tamil = $("#member_name_tamil").val().trim();
        let english = $("#member_name_english").val().trim();
        let age = $("#member_age").val().trim();
        let sex = $("#member_sex").val();
        let income = $("#family_income").val() || "";

        let index = added; 
        selectedRelations.push(relation);

        let panName = "-";
        let extraName = "-";

        // FIXED LOGIC: Student/Household Dependent ஆக இருந்தால், கோப்புப் பெயர்கள் கட்டாயம் "-" என மாறும்
        if (profession != "Student/Dependent" && profession != "Household/Dependent") {
            if ($("#family_pan").length && $("#family_pan")[0].files.length > 0) {
                panName = $("#family_pan")[0].files[0].name;
            }

            if (incomeSource == "Others") {
                let workEngVal = $("#work_english").val().trim();
                let workTamVal = $("#work_tamil").val().trim();
                extraName = `En: ${workEngVal} / த: ${workTamVal}`;
            } else if ($("#family_extra").length) {
                let extraElem = $("#family_extra")[0];
                if (extraElem.type == "file" && extraElem.files.length > 0) {
                    extraName = extraElem.files[0].name;
                } else if (extraElem.type == "text" && $(extraElem).val().trim() != "") {
                    extraName = $(extraElem).val();
                }
            }
        }

        // Construct HTML Row
        let row = `
        <tr data-index="${index}">
            <td>${relation}<input type="hidden" name="relation[${index}]" value="${relation}"></td>
            <td>${tamil}<input type="hidden" name="relation_name_tamil[${index}]" value="${tamil}"></td>
            <td>${english}<input type="hidden" name="relation_name[${index}]" value="${english}"></td>
            <td>${age}<input type="hidden" name="relation_age[${index}]" value="${age}"></td>
            <td>${sex}<input type="hidden" name="relation_status[${index}]" value="${sex}"></td>
            <td>${profession}<input type="hidden" name="family_profession[${index}]" value="${profession}"></td>
            <td>${incomeSource}<input type="hidden" name="family_income_source[${index}]" value="${incomeSource}"></td>
            <td>${income}<input type="hidden" name="family_income[${index}]" value="${income}"></td>
            <td class="pan-file-cell">${panName}</td>
            <td class="extra-file-cell">${extraName}</td>
            <td><button type="button" class="btn btn-danger btn-sm removeMember">Delete</button></td>
        </tr>`;

        let $rowHtml = $(row);

        // நபர் வருமானம் ஈட்டுபவராக இருந்தால் மட்டுமே ஃபைல்களைப் பிரித்து டேபிளில் சேர்க்கும்
        if (profession != "Student/Dependent" && profession != "Household/Dependent") {
            if ($("#family_pan").length && $("#family_pan")[0].files.length > 0) {
                let $panInput = $("#family_pan").detach().attr("name", `family_pan[${index}]`).hide();
                $rowHtml.find(".pan-file-cell").append($panInput);
            }
            
            if (incomeSource == "Others") {
                if ($("#work_english").val().trim() != "" && $("#work_tamil").val().trim() != "") {
                    let $workEn = $("#work_english").detach().attr("name", `family_work_english[${index}]`).hide();
                    let $workTa = $("#work_tamil").detach().attr("name", `family_work_tamil[${index}]`).hide();
                    $rowHtml.find(".extra-file-cell").append($workEn).append($workTa);
                }
            } else if ($("#family_extra").length) {
                let extraElem = $("#family_extra")[0];
                if ((extraElem.type == "file" && extraElem.files.length > 0) || (extraElem.type == "text" && $(extraElem).val().trim() != "")) {
                    let $extraInput = $("#family_extra").detach().attr("name", `family_extra[${index}]`).hide();
                    $rowHtml.find(".extra-file-cell").append($extraInput);
                }
            }
        }

        $("#familytable tbody").append($rowHtml);

        // Reset all primary pickers safely
        $("#relationship, #member_name_tamil, #member_name_english, #member_age, #member_sex, #family_profession, #family_income_source").val("");
        $("#familyIncomeFields").html("");

        refreshRelationship();
        checkFamilyCount();
    });

    // Delete Member Action
    $(document).on("click", ".removeMember", function() {
        let row = $(this).closest("tr");
        let relation = row.find("input[name^='relation']").val();

        selectedRelations = $.grep(selectedRelations, function(value) {
            return value != relation;
        });

        row.remove();
        refreshRelationship();
        checkFamilyCount();
    });
    </script>

    <script>
        function nextStep(step) {

            if (step == 1) {
                document.getElementById('step1').style.display = 'none';
                document.getElementById('step2').style.display = 'block';
            } else if (step == 2) {
                document.getElementById('step2').style.display = 'none';
                document.getElementById('step3').style.display = 'block';

            } else if (step == 3) {
                document.getElementById('step3').style.display = 'none';
                document.getElementById('step4').style.display = 'block';
            }
        }

        function prevStep(step) {

            if (step == 2) {
                document.getElementById('step2').style.display = 'none';
                document.getElementById('step1').style.display = 'block';
            } else if (step == 3) {
                document.getElementById('step3').style.display = 'none';
                document.getElementById('step2').style.display = 'block';
            } else if (step == 4) {
                document.getElementById('step4').style.display = 'none';
                document.getElementById('step3').style.display = 'block';
            }
        }
    </script>
@endpush
