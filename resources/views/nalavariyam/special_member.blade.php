@extends('layouts.app')
@section('content')
<style>
    .modal-lg {
        max-width: 900px !important;
    }
</style>
    <div class="row">
        <div class="col-md-12">
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
                        <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title mb-0">Special Member</h5>

                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addsplmember">
                        Add Member
                    </button>

                </div>
                       <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                                <thead>
                                <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($special_member as $key => $spl)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $spl->name }}</td>
                                        <td>{{ $spl->mobile }}</td>
                                        <td>{{ $spl->status }}</td>
                                        <td style="white-space: nowrap">
                                            <button
                                        onclick="edit_splmember('{{ $spl->id }}','{{ $spl->district }}','{{ $spl->taluk }}','{{ $spl->name }}','{{ $spl->father_hus_name }}','{{ $spl->dob }}','{{ $spl->aadhaar_no }}','{{ $spl->photo }}','{{ $spl->door_no }}','{{ $spl->post_office_name }}','{{ $spl->profession }}','{{ $spl->mobile }}','{{ $spl->registration_no }}','{{ $spl->street_name }}','{{ $spl->pincode }}','{{ $spl->status }}','{{ $spl->relation }}')"
                                        type="button" class="btn-sm btn btn-info">Edit</button>

                                    <button
                                        onclick="view('{{ $spl->id }}','{{ $spl->district }}','{{ $spl->taluk }}','{{ $spl->name }}','{{ $spl->father_hus_name }}','{{ $spl->dob }}','{{ $spl->aadhaar_no }}','{{ $spl->photo }}','{{ $spl->door_no }}','{{ $spl->post_office_name }}','{{ $spl->profession }}','{{ $spl->mobile }}','{{ $spl->registration_no }}','{{ $spl->street_name }}','{{ $spl->pincode }}','{{ $spl->status }}','{{ $spl->relation }}','{{ $spl->cardstatus }}','{{ $spl->remarks }}','{{ $spl->certificate }}')"
                                        type="button" class="btn-sm btn btn-success">View </button>

                                    @if ($spl->is_completed == '0')
                                    <a onclick="payment('{{ $spl->id }}','{{ $activationamount }}','{{ $spl->is_completed }}')"
                                        type="button" class="btn-sm btn btn-warning">Pay</a>
                                    @else
                                    <a href="{{ url('/online_services/' . $spl->id . '_' . $spl->customer_user_type_id) }}" type="button"
                                        class="btn-sm btn btn-primary">Services</a>
                                    @endif
                                </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
           
        <div class="modal fade" id="addsplmember" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Add Special Member</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form method="post" action="{{ url('/savespecial_member') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="modal-body">

                            <div class="row g-4">
                                <!-- LEFT -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">மாவட்டம் தமிழில்</label>
                                        <select required name="district" class="form-select" id="dist_id">
                                            <option value="">Select District</option>
                                            @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">
                                                {{ $district->district_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">பெயர் தமிழில்</label>
                                        <input type="text" name="name" class="form-control" required
                                            maxlength="100">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">பிறந்த தேதி</label>
                                        <input type="date" name="dob" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ஆதார் எண்</label>
                                        <input type="text" onkeyup="specialmember_duplicateaadhar()" name="aadhaar_no" class="form-control number" required
                                            maxlength="12">
                                        <span id="dupaadhar" style="color:red"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">தந்தை/கணவர் பெயர்</label>
                                        <select required name="relation" class="form-select">
                                            <option value="">Select</option>
                                            <option value="Father">தந்தை</option>
                                            <option value="Husband">கணவர்</option>

                                        </select>
                                    </div>



                                    <div class="mb-3">
                                        <label class="form-label">கதவு எண்</label>
                                        <input type="text" name="door_no" class="form-control" required
                                            maxlength="10">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">அஞ்சலக பெயர்</label>
                                        <input type="text" name="post_office_name" class="form-control" required
                                            maxlength="100">
                                    </div>
                                </div>

                                <!-- RIGHT -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label">தாலுகா தமிழில்</label>
                                        <select required name="taluk_id" id="taluk" class="form-control">
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">பதிவு எண்</label>
                                        <input type="text" name="registration_no" class="form-control" required
                                            maxlength="20">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">செல் நம்பர்</label>
                                        <input type="text" onkeyup="specialmember_duplicatemobile()" name="mobile" class="form-control number" required
                                            maxlength="10">
                                        <span id="dupphone" style="color:red"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">தொழில்</label>
                                        <input type="text" name="profession" class="form-control" required
                                            maxlength="100">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">தந்தை/கணவர் பெயர்</label>
                                        <input type="text" name="father_hus_name" class="form-control" required
                                            maxlength="100">
                                    </div>






                                    <div class="mb-3">
                                        <label class="form-label">தெருப்பெயர்</label>
                                        <input type="text" name="street_name" class="form-control" required
                                            maxlength="100">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">பின்கோடு</label>
                                        <input type="text" name="pincode" class="form-control" required
                                            maxlength="10">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">புகைப்படம்</label>
                                        <input type="file" name="photo" accept="image/jpeg, image/png"
                                            class="form-control" required>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="saveBtn">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="modal fade" id="paymentModal" tabindex="-1">
            <div class="modal-dialog modal-md">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Make Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form id="paymentForm" method="post" action="{{ url('/updatesplmember_status') }}">
                        {{ csrf_field() }}
                        <div class="modal-body">

                            <input type="hidden" name="memberid" id="memberid">
                            <input type="hidden" name="activation_amount" id="activation_amount">
                            <div class="mb-3">
                                <label>Activation Amount</label>
                                <input type="text" class="form-control" id="activation_amount_display"
                                    name="activation_amount_display" readonly>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm">Confirm Payment</button>
                            <button type="button" class="btn btn-secondary btn-sm"
                                data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Update Special Member -->

        <!-- Update Special Member -->
        <div class="modal fade" id="editsplmember" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Update Special Member</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="post" action="{{ url('/update_spl_member') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="id" id="editid" />

                        <div class="modal-body">
                            <div class="row g-4">

                                <!-- LEFT -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label">மாவட்டம் தமிழில்</label>
                                        <select required name="editdistrict" class="form-select" id="editdist_id">
                                            <option value="">Select District</option>
                                            @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">
                                                {{ $district->district_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">பெயர் தமிழில்</label>
                                        <input required type="text" class="form-control" name="editname"
                                            id="editsplmember_name" maxlength="100">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">பிறந்த தேதி</label>
                                        <input required type="date" class="form-control" name="editdob"
                                            id="editsplmember_dob" maxlength="10">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">ஆதார் எண்</label>
                                        <input required type="text" class="form-control number"
                                            onkeyup="specialmember_duplicateaadhar()"
                                            name="editaadhaar_no" id="editsplmember_aadhaar_no" maxlength="12">
                                        <span id="edit_dupaadhar" style="color:red"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">தந்தை/கணவர் பெயர்</label>
                                        <select required name="editrelation" class="form-select" id="editsplmember_relation">
                                            <option value="">Select</option>
                                            <option value="Father">தந்தை</option>
                                            <option value="Husband">கணவர்</option>

                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">கதவு எண்</label>
                                        <input required type="text" class="form-control" name="editdoor_no"
                                            id="editsplmember_doorno" maxlength="10">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">அஞ்சலக பெயர்</label>
                                        <input required type="text" class="form-control" name="editpost_office_name"
                                            id="editsplmember_postoffice" maxlength="100">
                                    </div>

                                </div>

                                <!-- RIGHT -->
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="form-label">தாலுகா தமிழில்</label>
                                        <select required name="edittaluk" id="edittaluk" class="form-control">
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">பதிவு எண்</label>
                                        <input required type="text" class="form-control" name="editregistration_no"
                                            id="editsplmember_regno" maxlength="20">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">செல் நம்பர்</label>
                                        <input required type="text" maxlength="10" class="form-control number"
                                            onkeyup="specialmember_duplicatemobile()"
                                            name="editmobile" id="editsplmember_mobile">
                                        <span id="edit_dupphone" style="color:red"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">தொழில்</label>
                                        <input required type="text" class="form-control" name="editprofession"
                                            id="editsplmember_profession" maxlength="100">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">தந்தை/கணவர் பெயர்</label>
                                        <input required type="text" class="form-control" name="editfather_hus_name"
                                            id="editsplmember_fathername" maxlength="100">
                                    </div>


                                    <div class="mb-3">
                                        <label class="form-label">தெருப்பெயர்</label>
                                        <input required type="text" class="form-control" name="editstreet_name"
                                            id="editsplmember_street" maxlength="100">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">பின்கோடு</label>
                                        <input required type="text" class="form-control" name="editpincode"
                                            id="editsplmember_pincode" maxlength="10">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">புகைப்படம்</label><br>
                                        <img id="editsplmember_photo"
                                            src=""
                                            class="img-fluid rounded shadow mb-2"
                                            width="140" height="140" style="object-fit:cover;">
                                        <input type="file" name="editphoto" accept="image/jpeg, image/png"
                                            class="form-control mt-2">
                                    </div>



                                </div>

                            </div>
                        </div>

                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button id="updateBtn" type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- View Special Member -->

        <div class="modal fade" id="viewspl" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold">
                            <i class="bi bi-person-badge me-2"></i>View Special Member
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                     <form method="post" action="{{ url('/update_splmember_idcard') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <input type="hidden" name="id" id="viewid">

                    <div class="modal-body">
                        
                        <div class="row align-items-center mb-4">
                            <div class="col-md-4 text-center">
                                <img id="view_photo" src="{{ asset('images/default-user.png') }}" alt="Photo"
                                    class="img-fluid rounded-circle shadow-sm mb-2" width="120" height="120"
                                    style="object-fit:cover;">
                                <div id="photo_download" style="display:none;">
                                    <a id="photo_download_btn" href="#"
                                        class="btn btn-outline-primary btn-sm mt-2" download>
                                        <i class="bi bi-download"></i> Download Photo
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="bg-light rounded p-3">
                                    <div class="row g-2">
                                        <div class="col-6"><strong>மாவட்டம்:</strong> <span id="view_district"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>பதிவு எண்:</strong> <span
                                                id="view_regno" class="text-dark"></span></div>
                                        <div class="col-6"><strong>தாலுகா தமிழில்:</strong> <span id="view_taluk"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>பெயர்:</strong> <span id="view_name"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>அஞ்சலக பெயர்:</strong> <span
                                                id="view_postoffice" class="text-dark"></span></div>
                                        <div class="col-6"><strong>தந்தை/கணவர்:</strong> <span
                                                id="view_relation" class="text-dark"></span></div>
                                        <div class="col-6"><strong>தந்தை/கணவர் பெயர்:</strong> <span
                                                id="view_fathername" class="text-dark"></span></div>
                                        <div class="col-6"><strong>கதவு எண்:</strong> <span id="view_doorno"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>பிறந்த தேதி:</strong> <span id="view_dob"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>தெருப்பெயர்:</strong> <span id="view_street"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>ஆதார் எண்:</strong> <span id="view_aadhaar_no"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>பின்கோடு:</strong> <span id="view_pincode"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>செல் நம்பர்:</strong> <span id="view_mobile"
                                                class="text-dark"></span></div>
                                        <div class="col-6"><strong>Status:</strong> <span id="view_status"
                                                class="text-dark"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user()->user_type_id == 1)
                        <div class="mt-4 p-3 bg-white border rounded shadow-sm">
                            <h6 class="mb-3 fw-bold text-primary">Update Member Status</h6>

                            <div class="row g-3">

                                <!-- Status Dropdown -->
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select id="view_status_update" name="view_status_update" class="form-select">
                                        <option value="">Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Resubmit">Resubmit</option>
                                        <option value="Completed">Completed</option>
                                    </select>
                                </div>

                                <!-- File Upload -->
                                <div class="col-md-8" style="display: none;">
                                    <label class="form-label fw-semibold">Upload Document</label>
                                    <input type="file" id="view_upload_file" name="view_upload_file" accept="image/jpeg,image/png,application/pdf" class="form-control">
                                    <small class="text-muted">Allowed: PDF, JPG, PNG</small>
                                </div>

                                <!-- Remarks -->
                                <div class="col-12" style="display: none;">
                                    <label class="form-label fw-semibold">Remarks</label>
                                    <textarea id="view_remarks" name="view_remarks" class="form-control" rows="3" placeholder="Enter remarks..."></textarea>
                                </div>

                            </div>
                        </div>
                        @else
                       <!-- Remarks Display -->
                        <div class="col-12" style="display: none;" id="view_remarks_section">
                            <label class="form-label fw-semibold">Remarks</label>
                            <textarea id="viewremarks" name="view_remarks" class="form-control" rows="3" readonly></textarea>
                        </div>

                        <div class="col-md-12 mt-2" id="view_download_section" style="display:none;">
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-semibold">Uploaded File:</span>

                                <a id="idcard_download_btn" href="#"
                                    class="btn btn-outline-primary btn-sm" download>
                                    <i class="bi bi-download"></i> Download ID CARD
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> Close
                        </button>
                        @if(Auth::user()->user_type_id == 1)
                        <button type="submit" class="btn btn-primary" id="pending_submit_btn">
                            <i class="bi bi-check-circle"></i> Submit
                        </button>
                        @endif
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            
    @endsection
    @push('page_scripts')
       <script>
        $('#dist_id').on('change', function() {
            var dist_id = this.value;
            $("#taluk").html('');
            var url = "{{ url('nalavariyam/variyamget_taluk') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                }
            });
        });

        $('#editdist_id').on('change', function() {
            var dist_id = this.value;
            $("#editaluk").html('');
            var url = "{{ url('nalavariyam/variyamget_taluk') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#edittaluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#edittaluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                }
            });
        });

        function loadTalukEdit(district_id, selected_taluk) {
            var url = "{{ url('nalavariyam/variyamget_taluk') }}/" + district_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(res) {
                    $("#edittaluk").html('');
                    $("#edittaluk").html('<option value="">Select Taluk</option>');

                    $.each(res, function(key, value) {
                        $("#edittaluk").append(
                            '<option value="' + value.id + '">' + value.taluk_name + '</option>'
                        );
                    });

                    $("#edittaluk").val(selected_taluk);
                }
            });
        }



        function specialmember_duplicateaadhar() {
            var id = $("#editid").val() || 0;
            var aadhaar_no = $("input[name='aadhaar_no']:visible, input[name='editaadhaar_no']:visible").val();
            var isEdit = $("#editsplmember").is(":visible");

            var msgBox = isEdit ? $("#edit_dupaadhar") : $("#dupaadhar");

            $.post('{{ url('specialmember_checkaadhar') }}', {
                    id: id,
                    aadhaar_no: aadhaar_no,
                    _token: $('input[name="_token"]').val()
                },
                function(res) {

                    if (res.exists) {
                        msgBox.html("Aadhaar already exists!");
                    } else {
                        msgBox.html("");
                    }

                    validateSaveButton();
                });
        }


        function specialmember_duplicatemobile() {
            var id = $("#editid").val() || 0;
            var phone = $("input[name='mobile']:visible, input[name='editmobile']:visible").val();
            var isEdit = $("#editsplmember").is(":visible");

            var msgBox = isEdit ? $("#edit_dupphone") : $("#dupphone");

            $.post('{{ url('specialmember_checkphone') }}', {
                    id: id,
                    phone: phone,
                    _token: $('input[name="_token"]').val()
                },
                function(res) {

                    if (res.exists) {
                        msgBox.html("Mobile already exists!");
                    } else {
                        msgBox.html("");
                    }

                    validateSaveButton();
                });
        }

        function validateSaveButton() {

            let isEdit = $("#editsplmember").is(":visible");

            let aadhaarError = isEdit ? $("#edit_dupaadhar").html() : $("#dupaadhar").html();
            let phoneError = isEdit ? $("#edit_dupphone").html() : $("#dupphone").html();

            if (aadhaarError !== "" || phoneError !== "") {

                // disable button
                if (isEdit) {
                    $("#updateBtn").prop("disabled", true);
                } else {
                    $("#saveBtn").prop("disabled", true);
                }

            } else {

                // enable button
                if (isEdit) {
                    $("#updateBtn").prop("disabled", false);
                } else {
                    $("#saveBtn").prop("disabled", false);
                }
            }
        }

        function edit_splmember(id, district, taluk, name, father_hus_name, dob, aadhaar_no, photo, door_no,
            post_office_name, profession, mobile, registration_no, street_name, pincode, status, relation) {
            $("#editid").val(id);
            $("#editdist_id").val(district);
            $("#editsplmember_name").val(name);
            $("#editsplmember_fathername").val(father_hus_name);
            $("#editsplmember_dob").val(dob);
            $("#editsplmember_aadhaar_no").val(aadhaar_no);
            $("#editsplmember_relation").val(relation);
            $("#editsplmember_doorno").val(door_no);
            $("#editsplmember_postoffice").val(post_office_name);
            $("#editsplmember_profession").val(profession);
            $("#editsplmember_mobile").val(mobile);
            $("#editsplmember_regno").val(registration_no);
            $("#editsplmember_street").val(street_name);
            $("#editsplmember_pincode").val(pincode);
            $("#editsplmember_status").val(status);
            loadTalukEdit(district, taluk);

            if (photo) {
                let imgPath = "{{ asset('upload/nalavariyam_document/photo') }}/" + photo;
                $("#editsplmember_photo").attr("src", imgPath);

            } else {
                $("#editsplmember_photo").attr("src", "{{ asset('images/default-user.png') }}");
            }
            $("#editsplmember").modal("show");
        }

        function payment(id, activationamount, is_completed) {
            $("#memberid").val(id);
            $("#activation_amount_display").val(activationamount);
            $("#activation_amount").val(activationamount);
            $("#paymentModal").modal("show");
        }

        function view(id, district, taluk, name, father_hus_name, dob, aadhaar_no, photo, door_no,
            post_office_name, profession, mobile, registration_no, street_name, pincode, status, relation, cardstatus, remarks,certificate) {
            $("#pending_submit_btn").prop("disabled",true);
            $("#viewid").val(id);
            $("#view_district").text(district);
            $("#view_taluk").text(taluk);
            $("#view_name").text(name);
            $("#view_fathername").text(father_hus_name);
            $("#view_dob").text(dob);
            $("#view_aadhaar_no").text(aadhaar_no);
            $("#view_photo").text(photo);
            $("#view_doorno").text(door_no);
            $("#view_postoffice").text(post_office_name);
            $("#view_profession").text(profession);
            $("#view_mobile").text(mobile);
            $("#view_regno").text(registration_no);
            $("#view_street").text(street_name);
            $("#view_pincode").text(pincode);
            $("#view_status").text(status);
            $("#view_relation").text(relation);
            $("#view_status_update").val(cardstatus);
            if (photo) {
                let imgPath = "{{ asset('upload/nalavariyam_document/photo') }}/" + photo;
                $("#view_photo").attr("src", imgPath);
                $("#photo_download_btn").attr("href", imgPath);
                $("#photo_download").show();
            } else {
                $("#view_photo").attr("src", "{{ asset('images/default-user.png') }}");
                $("#photo_download").hide();
            }

            if (cardstatus == "Resubmit") {
                $("#view_remarks_section").show();
                $("#viewremarks").val(remarks);
            } else if (cardstatus == "Completed") {
                let imgPath = "{{ asset('upload/nalavariyam_document/specialmember_idcard') }}/" + certificate;
                $("#idcard_download_btn").attr("href", imgPath);
                $("#view_download_section").show();
                $("#pending_submit_btn").prop("disabled",true);
            }
            $("#viewspl").modal("show");
        }

        var userBalance = "{{ Auth::user()->wallet ?? 0 }}";
        var paidAmount = "{{ $activationamount ?? 0 }}";
        document.getElementById("paymentForm").addEventListener("submit", function(e) {

            parseFloat(userBalance);
            parseFloat(paidAmount);


            if (userBalance < paidAmount) {
                alert("Insufficient Wallet Balance! Available: " + userBalance);
                e.preventDefault(); // 🔥 stop normal submit
                return;
            }

        });

        $('#view_status_update').on('change', function() {
            var selectedStatus = $(this).val();
            if (selectedStatus === 'Resubmit') {
                $('#view_upload_file').parent().hide();
                $('#view_remarks').parent().show();
            } else if (selectedStatus === 'Completed') {
                $('#view_upload_file').parent().show();
                $('#view_remarks').parent().hide();
            } else {
                $('#view_upload_file').parent().hide();
                $('#view_remarks').parent().hide();
            }
        });
    </script>
    @endpush
