@extends('layouts.app')
@section('content')
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
                        <div class="col-auto">
                            <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                                <a href="{{ url('customers') }}" class="btn-sm btn btn-danger"><i
                                        class=""></i>View Customers</a>
                            </div>
                        </div>
                        <h5 class="card-title">Add Customer</h5>
                        <div class="row">
                            <form class="row g-4" action="{{ url('/savecustomer') }}" enctype="multipart/form-data"
                            method="post">
                            {{ csrf_field() }}
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-3 form-label">Applicant Name</label>
                                    <div class="col-sm-9">
                                        <input required class="form-control" name="name" maxlength="100" type="text"
                                            id="example-text-input" placeholder="Applicant Name">
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
                                    <label for="example-text-input" class="col-sm-3 form-label">VAO</label>
                                    <div class="col-sm-9">
                                        <input required class="form-control" name="panchayath_name" id="panchayath_name" maxlength="50" type="text"
                                            id="example-text-input" placeholder="VAO">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="aadhaar_no" class="col-sm-3 form-label">Aadhaar No</label>
                                    <div class="col-sm-9">
                                        <input required class="form-control number" maxlength="12"
                                            type="text" name="aadhaar_no" placeholder="Aadhaar No">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input-lg" class="col-sm-3 form-label">Smart Card No</label>
                                    <div class="col-sm-9">
                                        <input required type="text"
                                            class="form-control" name="smartcard_no" maxlength="15" placeholder="SmartCard No"/>
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label for="example-text-input-lg" class="col-sm-3 form-label">Signature</label>
                                    <div class="col-sm-9">
                                        <input required accept="image/jpeg, image/png" type="file"
                                            class="form-control" name="signature" />
                                    </div>
                                </div>

                                

                            </div>

                            <div class="col-lg-6">

                                 <div class="mb-3 row">
                                    <label for="example-url-input" class="col-sm-3 form-label">DOB</label>
                                    <div class="col-sm-9">
                                        <input required class="form-control" type="date" onkeyup="return false;" name="date_of_birth"
                                            id="example-url-input">
                                    </div>
                                </div>
                               
                                <div class="mb-3 row">
                                    <label for="example-month-input" class="col-sm-3 form-label">Phone</label>
                                    <div class="col-sm-9">
                                        <input required class="form-control number" type="text"
                                            name="phone" maxlength="10" placeholder="Phone">
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
                                    <label for="example-text-input-lg" class="col-sm-3 form-label">Photo</label>
                                    <div class="col-sm-9">
                                        <input required class="form-control" type="file" name="profile"
                                            id="example-text-input-lg">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="example-text-input-lg" class="col-sm-3 form-label">Aadhar Card</label>
                                    <div class="col-sm-9">
                                        <input required accept="image/jpeg, image/png" type="file"
                                            class="form-control" name="aadhaar_file" />
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
                                    <label for="example-url-input" class="col-sm-3 form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea required class="form-control" maxlength="100" type="text" rows="3" name="address" id="example-url-input"
                                            placeholder="Address"></textarea>
                                    </div>
                                </div>
                            </div>
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
            </div>
        </div>
    </div>
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
