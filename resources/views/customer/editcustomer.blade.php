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
                                    <h5 class="mb-0 fw-bold">Update Customer</h5>
                                </div>
                            </div>
                            @foreach ($editcustomer as $cus)
                                <form class="row g-4" action="{{ url('/updatecustomer') }}" enctype="multipart/form-data"
                                    method="post">
                                    {{ csrf_field() }}
                                    <div class="col-lg-6">
                                        <input type="hidden" name="customer_id" value="{{ $cus->id }}">
                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-sm-2 form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input value="{{ $cus->name }}" class="form-control" name="name"
                                                    maxlength="20" type="text" id="example-text-input"
                                                    placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-sm-2 form-label">Aadhaar No</label>
                                            <div class="col-sm-10">
                                                <input class="form-control number" maxlength="12"
                                                    value="{{ $cus->aadhaar_no }}" type="text" name="aadhaar_no"
                                                    placeholder="Aadhaar No">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-email-input" class="col-sm-2 form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input value="{{ $cus->email }}" class="form-control" type="email"
                                                    maxlength="30" name="email" placeholder="Email">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-sm-2 form-label">DOB</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" value="{{ $cus->date_of_birth }}" type="date"
                                                    name="date_of_birth" id="example-url-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input-lg" class="col-sm-2 form-label">Taluk</label>
                                            <div class="col-sm-10">
                                                <select required name="taluk_id" id="taluk" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input-lg" class="col-sm-2 form-label">Aadhar
                                                Card</label>
                                            <div class="col-sm-10">
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="aadhaar_file" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input-lg"
                                                class="col-sm-2 form-label">Signature</label>
                                            <div class="col-sm-10">
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="signature" />
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-sm-2 form-label">Address</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" maxlength="100" type="text" rows="3" name="address" id="example-url-input"
                                                    placeholder="Address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 row">
                                            <label for="example-month-input" class="col-sm-2 form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input class="form-control number" type="text"
                                                    value="{{ $cus->phone }}" name="phone" maxlength="10"
                                                    placeholder="Phone">
                                            </div>
                                        </div>

                                        <div class="mb-3 row">
                                            <label class="col-sm-2 form-label">Gender</label>
                                            <div class="col-sm-10" name="gender">
                                                <select class="form-select">
                                                    <option @if ($cus->gender == 'Male') selected @endif
                                                        value="Male">
                                                        Male</option>
                                                    <option @if ($cus->gender == 'Female') selected @endif
                                                        value="Female">
                                                        Female</option>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" value="{{ $cus->dist_id }}" id="getdist_id">
                                        <input type="hidden" value="{{ $cus->taluk_id }}" id="gettaluk_id">
                                        <input type="hidden" value="{{ $cus->panchayath_id }}" id="getpanchayath_id">
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-sm-2 form-label">District</label>
                                            <div class="col-sm-10">
                                                <select required name="dist_id" id="dist_id" class="form-control">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $d)
                                                        <option @if ($cus->dist_id == $d->id) selected @endif
                                                            value="{{ $d->id }}">{{ $d->district_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input-lg" class="col-sm-2 form-label">VAO</label>
                                            <div class="col-sm-10">
                                                <select required name="panchayath_id" id="panchayath"
                                                    class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input-lg" class="col-sm-2 form-label">Profile</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" maxlength="10" type="file" name="profile"
                                                    placeholder="Profile" id="example-text-input-lg">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-text-input-lg" class="col-sm-2 form-label">Smart
                                                Card</label>
                                            <div class="col-sm-10">
                                                <input required accept="image/jpeg, image/png" type="file"
                                                    class="form-control" name="smartcard" />
                                            </div>
                                        </div>

                                    </div>
                                    <h3 class="text-center">View Family Details</h3>
                                    <div class="table-responsive">
                                        <table id="pricetable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Relationship</th>
                                                    <th>Name</th>
                                                    <th>Age</th>
                                                    <th>Living Status</th>
                                                    <th>Aadhaar/Death Cert</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cus->familymember as $key => $fam)
                                                    <tr>
                                                        <td> <select required name="relationship[]" class="form-control">
                                                                <option value="">Select</option>
                                                                <option @if ($fam->relation == 'Husband') selected @endif
                                                                    value="Husband">கணவர்</option>
                                                                <option @if ($fam->relation == 'Wife') selected @endif
                                                                    value="Wife">மனைவி</option>
                                                                <option @if ($fam->relation == 'Son') selected @endif
                                                                    value="Son">மகன்</option>
                                                                <option @if ($fam->relation == 'Daughter') selected @endif
                                                                    value="Daughter">மகள்</option>
                                                            </select></td>
                                                        <td><input value="{{ $fam->relation_name }}" required
                                                                class="form-control" type="text"
                                                                name="relation_name[]" maxlength="50"></td>
                                                        <td width="10%"><input value="{{ $fam->relation_age }}"
                                                                required class="form-control number" type="text"
                                                                name="relation_age[]" maxlength="2"></td>
                                                        <td><select required name="relationship_status[]"
                                                                class="form-control alive_or_dead">
                                                                <option value="">Select</option>
                                                                <option @if ($fam->relation_status == 'Dead') selected @endif
                                                                    value="Dead">Dead</option>
                                                                <option @if ($fam->relation_status == 'Alive') selected @endif
                                                                    value="Alive">Alive</option>
                                                            </select></td>
                                                        <td>
                                                            <P class="changename_{{ $key }}"> </P>
                                                            {{--  @if ($fam->relationaadhaar_card != '')
                                            <a target="_blank" href="/upload/users/relationaadhaar_card/{{ $fam->relationaadhaar_card }}" class="btn btn-primary me-2">View</a>
                                          @endif --}}
                                                            <input class="form-control" type="file" name="doc[]"
                                                                accept="image/jpeg, image/png">
                                                        </td>


                                                        {{--  @if ($fam->relationdeath_cert != '')<input class="form-control"  type="hidden" name="doc2[]" value="{{ $fam->relationaadhaar_card }}" accept="image/jpeg, image/png"> @endif --}}
                                                        <td><a onClick='removerow()'
                                                                class='btn btn-sm btn-danger btnDelete'><i
                                                                    class='mdi mdi-delete mdi-18px'></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="text-center">
                                        <div class="col-12">
                                            <div class="mb-0">
                                                <button id="save" type="submit"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div><!--end row-->
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>
        var distid = $("#getdist_id").val();
        var talukid = $("#gettaluk_id").val();
        var panchayathid = $("#getpanchayath_id").val();
        $(function() {
            gettaluk(distid);
            getpanchayath(talukid);
        });

        $('#dist_id').on('change', function() {
            var dist_id = this.value;
            gettaluk(dist_id);
        });

        $('#taluk').on('change', function() {
            var taluk_id = this.value;
            getpanchayath(taluk_id);
        });

        function gettaluk(dist_id) {
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
                    $("#taluk").val(talukid);

                    $('#panchayath').html('<option value="">-- Select Panchayath --</option>');
                }
            });
        }

        function getpanchayath(taluk_id) {
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
                    $("#panchayath").val(panchayathid);

                }
            });
        }
        $("#pricetable").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
        });

        var live_status = $(".alive_or_dead");
        for (var i = 0; i < live_status.length; i++) {
            if ($(live_status[i]).val() == "Alive") {
                $('.changename_' + i).text("Aadhaar Card");
            } else {
                $('.changename_' + i).text("Death Certificate");
            }
        }


        $("#pricetable").on('change', '.alive_or_dead', function() {
            if ($(this).val() == "Alive") {
                $(this).closest('tr').find('.changename').text("Aadhaar Card");
            } else {
                $(this).closest('tr').find('.changename').text("Death Certificate");
            }
        });

        function addnewrow() {
            $("#pricetable tbody").append(
                "<tr><td> <select required name='relationship[]' class='form-control'><option value=''>Select</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option></select></td><td><input class='form-control' required type='text' name='relation_name[]'maxlength='80'></td><td width='10%'><input class='form-control number' required type='text' name='relation_age[]'maxlength='2'></td><td><select required name='relationship_status[]' class='form-control alive_or_dead'><option value=''>Select</option><option value='Dead'>Dead</option><option value='Alive'>Alive</option></select></td><td><P class='changename'></P><input class='form-control' required type='file' name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='bx bx-trash'></i></a></td></tr>"
            );
        }
    </script>
@endpush
