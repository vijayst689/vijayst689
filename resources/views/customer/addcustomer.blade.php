@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Add Customer</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="col-auto">
                        <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                            <a href="{{ url('customers') }}" class="btn btn-grd btn-grd-info px-3"><i
                                    class="bi bi-chat me-2"></i>View Customers</a>
                        </div>
                    </div>
                </div>
            </div>
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
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="">
                                    <h5 class="mb-0 fw-bold">Add Customer</h5>
                                </div>
                            </div>
                            <form class="row g-4" action="{{ url('/savecustomer') }}" enctype="multipart/form-data"
                                method="post">
                                {{ csrf_field() }}
                                <div class="col-lg-6">
                                    <div class="mb-3 row">
                                        <label for="example-text-input" class="col-sm-3 form-label">Applicant Name</label>
                                        <div class="col-sm-9">
                                            <input required class="form-control" name="name" maxlength="100"
                                                type="text" id="example-text-input" placeholder="Applicant Name">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="example-email-input" class="col-sm-3 form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input required onkeyup="duplicateemail(0)" class="form-control" type="email"
                                                maxlength="50" name="email" id="email" placeholder="Email">
                                            <span id="dupemail" style="color:red"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label class="col-sm-3 form-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select required class="form-select" name="gender" required>
                                                <option>Select</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Taluk</label>
                                        <div class="col-sm-9">
                                            <select required name="taluk_id" id="taluk" class="form-control">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="aadhaar_no" class="col-sm-3 form-label">Aadhaar No</label>
                                        <div class="col-sm-9">
                                            <input required onkeyup="duplicateaadhar(0)" class="form-control number"
                                                maxlength="12" type="text" name="aadhaar_no" id="aadhaar_no"
                                                placeholder="Aadhaar No">
                                            <span id="dupaadhar" style="color:red"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Signature</label>
                                        <div class="col-sm-9">
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="signature" />
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Smart Card</label>
                                        <div class="col-sm-9">
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="smartcard" />
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Smart Card
                                            No</label>
                                        <div class="col-sm-9">
                                            <input required type="text" class="form-control" name="smartcard_no"
                                                maxlength="10" placeholder="SmartCard No" />
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 form-label">Gender</label>
                                    <div class="col-sm-9">
                                        <select required class="form-select" name="gender" required>
                                            <option>Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                                <div class="col-lg-6">

                                    <div class="mb-3 row">
                                        <label for="example-url-input" class="col-sm-3 form-label">DOB</label>
                                        <div class="col-sm-9">
                                            <input required class="form-control" type="date" onkeyup="return false;"
                                                name="date_of_birth" id="example-url-input">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-month-input" class="col-sm-3 form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input required class="form-control" type="password" name="password"
                                                maxlength="10" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="example-month-input" class="col-sm-3 form-label">Phone</label>
                                        <div class="col-sm-9">
                                            <input required onkeyup="duplicatephone(0)" class="form-control number"
                                                type="text" name="phone" maxlength="10" id="phone"
                                                placeholder="Phone">
                                            <span id="dupphone" style="color:red"></span>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="dist_id" class="col-sm-3 form-label">District</label>
                                        <div class="col-sm-9">
                                            <select required name="dist_id" id="dist_id" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($districts as $d)
                                                    <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="panchayath" class="col-sm-3 form-label">VAO</label>
                                        <div class="col-sm-9">
                                            <select required name="panchayath_id" id="panchayath" class="form-control">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="example-text-input-lg" class="col-sm-3 form-label">Smart Card No</label>
                                    <div class="col-sm-9">
                                        <input required type="text" class="form-control" name="smartcard_no"
                                            maxlength="13" placeholder="SmartCard No" />


                                    <div class="mb-3 row">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Aadhar Card</label>
                                        <div class="col-sm-9">
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="aadhaar_file" />
                                        </div>

                                    </div>

                                    <div class="mb-3 row">
                                        <label for="example-text-input-lg" class="col-sm-3 form-label">Profile</label>
                                        <div class="col-sm-9">
                                            <input required class="form-control" type="file" name="profile"
                                                id="example-text-input-lg">
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="mb-3 row">
                                    <label for="example-month-input" class="col-sm-3 form-label">Phone</label>
                                    <div class="col-sm-9">
                                        <input required onkeyup="duplicatephone(0)" class="form-control number"
                                            type="text" name="phone" maxlength="10" id="phone"
                                            placeholder="Phone">
                                        <span id="dupphone" style="color:red"></span>
                                    </div>
                                </div>


                                    <div class="mb-3 row">
                                        <label for="example-url-input" class="col-sm-3 form-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea required class="form-control" maxlength="100" type="text" rows="3" name="address"
                                                id="example-url-input" placeholder="Address"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <h3 class="text-center">Family Details</h3>
                                <table id="pricetable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Relationship</th>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Profession</th>
                                            <th>Income</th>
                                            <th>Living Status</th>
                                            <th>Aadhaar/Death Cert</th>
                                            <th><a class="btn btn-sm btn-success" onclick="addnewrow()"><i
                                                        class='material-symbols-outlined'>add</i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> <select required name="relationship[]" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Father">தகப்பன்</option>
                                                    <option value="Mother">தாய்</option>
                                                    <option value="Husband">கணவர்</option>
                                                    <option value="Wife">மனைவி</option>
                                                    <option value="Son">மகன்</option>
                                                    <option value="Daughter">மகள்</option>
                                                </select></td>
                                            <td><input required class="form-control" type="text"
                                                    name="relation_name[]" maxlength="50"></td>
                                            <td width="10%"><input required class="form-control number" type="text"
                                                    name="relation_age[]" maxlength="2"></td>

                                            <td> <select required name="profession[]" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="Students">Students</option>
                                                    <option value="Farmer">Farmer</option>
                                                    <option value="Daily Wages">Daily Wages</option>
                                                    <option value="Self Employee">Self Employee</option>
                                                    <option value="Business">Business</option>
                                                    <option value="Govt Job">Govt Job</option>
                                                    <option value="Private Job">Private Job</option>
                                                </select></td>

                                            <td> <input required name="income[]" type="text"
                                                    class="form-control number" maxlength="7" placeholder="Income">
                                            </td>

                                            <td><select required name="relationship_status[]"
                                                    class="form-control alive_or_dead">
                                                    <option value="">Select</option>
                                                    <option value="Dead">Dead</option>
                                                    <option value="Alive">Alive</option>
                                                </select></td>
                                            <td>
                                                <P class="changename"></P><input required class="form-control"
                                                    type="file" name="doc[]" accept="image/jpeg, image/png">
                                            </td>
                                            <td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i
                                                        class='material-symbols-outlined'>Remove</i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    <div class="col-12">
                                        <div class="mb-0">
                                            <button id="save" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>
        $("#pricetable").on('change', '.alive_or_dead', function() {
            if ($(this).val() == "Alive") {
                $(this).closest('tr').find('.changename').text("Aadhaar Card");
            } else {
                $(this).closest('tr').find('.changename').text("Death Certificate");
            }
        });

        $('#dist_id').on('change', function() {
            var dist_id = this.value;
            $("#taluk").html('');
            var url = "{{ url('service/get_taluk') }}/" + dist_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#taluk').html('<option value="">-- Select Taluk Name --</option>');
                    $.each(result, function(key, value) {
                        $("#taluk").append('<option value="' + value
                            .id + '">' + value.taluk_name + '</option>');
                    });
                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            $("#panchayath").html('');
            var url = "{{ url('service/get_panchayath') }}/" + taluk_id;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $('#panchayath').html('<option value="">-- Select Panchayath Name --</option>');
                    $.each(result, function(key, value) {
                        $("#panchayath").append('<option value="' + value
                            .id + '">' + value.panchayath_name + '</option>');
                    });
                }
            });
        });

        $("#pricetable").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
        });


        function addnewrow() {
            $("#pricetable tbody").append(
                "<tr><td> <select required name='relationship[]' class='form-control'><option value=''>Select</option><option value='Father'>தகப்பன்</option><option value='Mother'>தாய்</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'></td><td width='10%'><input class='form-control number' required type='text' name='relation_age[]'maxlength='2'></td><td><select required name='profession[]' class='form-control'><option value=''>Select</option><option value='Students'>Students</option><option value='Farmer'>Farmer</option><option value='Daily Wages'>Daily Wages</option><option value='Self Employee'>Self Employee</option><option value='Business'>Business</option><option value='Govt Job'>Govt Job</option><option value='Private Job'>Private Job</option></select></td><td><input class='form-control number' required type='text' name='income[]' maxlength='7' placeholder='Income'></td><td><select required name='relationship_status[]' class='form-control alive_or_dead'><option value=''>Select</option><option value='Dead'>Dead</option><option value='Alive'>Alive</option></select></td><td><P class='changename'></P><input class='form-control' required type='file' name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
            );
        }
    </script>
    </script>
@endpush
