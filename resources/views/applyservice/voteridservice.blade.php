@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
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
                            <h5 class="card-title">{{ $servicename }}</h5>
                            <h6 class="card-title">Service Payment : <span class="text-danger">{{ $payment }}</span></h6>
                            <form class="row g-4" action="{{ url('submitvoterid') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                <div class="row mt-3">
                                    <input type="hidden" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" value="{{ $payment }}">
                                    <input type="hidden" name="user_id" value="{{ $customers->id }}">
                                    @if ($serviceid == 113)

                                    <div class="mb-3 col-md-6">
                                     <label for="name" class="form-label">Name</label>
                                     <input required type="text" class="form-control" maxlength="30"
                                     name="name" placeholder="Name"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                     <label for="mobile" class="form-label">Mobile Number</label>
                                     <input required type="text" class="form-control" maxlength="10"
                                     name="mobile" placeholder="Mobile Number"/>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                     <label for="relationship" class="form-label">Relationship</label>
                                     <select required type="text" class="form-control"
                                     name="relationship">
                                         <option value="">Select Relationship</option>
                                         <option value="Father">Father</option>
                                         <option value="Brother">Brother</option>
                                         <option value="Sister">Sister</option>
                                     </select>
                                     
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="photo" class="form-label text-danger">Photo</label>
                                     <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                                     name="photo" />
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="aadhaar_card" class="form-label text-danger">Aadhaar Card</label>
                                     <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                                     name="aadhaar_card" />
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="voter_id" class="form-label text-danger">Relative Voter Id</label>
                                     <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                                     name="voter_id" />
                                 </div>
                                 @elseif ($serviceid == 120)
                                 <div class="mb-3 col-md-6">
                                     <label for="epic_no" class="form-label">Epic No</label>
                                     <input required type="text" class="form-control" maxlength="15"
                                     name="epic_no" placeholder="Epic No"/>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="mobile" class="form-label">Mobile Number</label>
                                     <input required type="text" class="form-control" maxlength="10"
                                     name="mobile" placeholder="Mobile Number"/>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="aadhaar_card" class="form-label text-danger">Old Voter ID/Aadhar Card</label>
                                     <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                                     name="aadhaar_card" />
                                 </div>
                                 @elseif ($serviceid == 164)
                                 <div class="mb-3 col-md-6">
                                     <label for="epic_no" class="form-label">Epic Number</label>
                                     <input required type="text" class="form-control" maxlength="15"
                                     name="epic_no" placeholder="Epic No"/>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="mobile" class="form-label">Mobile Number</label>
                                     <input required type="text" class="form-control" maxlength="10"
                                     name="mobile" placeholder="Mobile Number"/>
                                 </div>                        
                                 @elseif ($serviceid == 182)
                                 <div class="mb-3 col-md-6">
                                     <label for="name" class="form-label">Name</label>
                                     <input required type="text" class="form-control" maxlength="50"
                                     name="name" placeholder="Name"/>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="epic_no" class="form-label">Epic Number</label>
                                     <input required type="text" class="form-control" maxlength="15"
                                     name="epic_no" placeholder="Epic No"/>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="voter_id" class="form-label text-danger">Voter ID</label>
                                     <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                                     name="voter_id" />
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="aadhaar_card" class="form-label text-danger">Aadhaar Card(Front & Back)</label>
                                     <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                                     name="aadhaar_card" />
                                 </div>
                                 @elseif ($serviceid == 181)
                                 <div class="row">
                                 <div class="mb-3 col-md-6">
                                     <label for="name" class="form-label">Name</label>
                                     <input required type="text" class="form-control" maxlength="30"
                                     name="name" placeholder="Name"/>
                                    </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="mobile" class="form-label">Mobile Number</label>
                                     <input required type="text" class="form-control" maxlength="10"
                                     name="mobile" placeholder="Mobile Number"/>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="voter_id" class="form-label text-danger">Voter Id</label>
                                     <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                                     name="voter_id" />
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="aadhaar_card" class="form-label text-danger">Aadhar Card (Front & Back)</label>
                                     <input required accept="image/jpeg, image/png"  type="file" class="form-control text-danger"
                                     name="aadhaar_card" />
                                 </div>
                             </div>
                         <br>
                     </br>
                             <div class="row">
                                         <table id="pricetable" class="table table-bordered">
                                             <thead>
                                                 <tr>
                                                     <th>VOTER ID CORRECTION</th>
                                                     <th>CORRECTION DATA</th>
                                                     <th>CORRECTION DOCUMENTS</th>
                                                     <th>DOCUMENTS</th>
                                                     <th><a class="btn btn-sm btn-success" onclick="addnewrow()"><i class='mdi mdi-plus-circle-outline'></i></a></th>
                                                 </tr>
                                             </thead>
                                         <tbody>
                                         <tr>
                                             <td> <select required name="voterid_correction[]" class="form-control">
                                                     <option value="">Select</option>
                                                     <option value="NAME">NAME</option>
                                                     <option value="GENDER">GENDER</option>
                                                     <option value="DOB/AGE">DOB/AGE</option>
                                                     <option value="RELATION TYPE">RELATION TYPE</option>
                                                     <option value="RELATIVE NAME">RELATIVE NAME</option>
                                                     <option value="ADDRESS">ADDRESS</option>
                                                     <option value="MOBILE NO">MOBILE NO</option>
                                                     <option value="PHOTO">PHOTO</option>
                                                 </select></td>
                                                                         <td><input required class="form-control" type="text"
                                                                             name="new_data[]" maxlength="70"></td>
                                                                 <td><select required name="correction_documents[]"
                                                                         class="form-control correction_docs">
                                                                         <option value="">Select</option>
                                                                         <option value="Name Correction">Name Correction</option>
                                                                         <option value="Gender Correction">Gender Correction</option>
                                                                         <option value="DOB/AGE Correction">DOB/AGE Correction</option>
                                                                         <option value="Relation Type Correction">Relation Type Correction</option>
                                                                         <option value="Relative Name Correction">Relative Name Correction</option>
                                                                         <option value="Address Correction">Address Correction</option>
                                                                         <option value="Mobile No Correction">Mobile No Correction</option>
                                                                         <option value="Photo Correction">Photo Correction</option>
                                                                     </select></td>
                                                                 <td><P class='changename'></P>
                                                                     <input required class="form-control" type="file"
                                                                         name="doc[]" accept="image/jpeg, image/png">
                                                                 </td>
                                                                 <td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-trash-can-outline'></i></a></td>
                                                             </tr>
                                                         </tbody>
                                                     </table>
                                                 </div>
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
    </main>
@endsection
@push('page_scripts')
    <script>
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

        $("#pricetable").on('change', '.correction_docs', function() {
            if ($(this).val() == "DOB/AGE Correction") {
                $(this).closest('tr').find('.changename').text("Birth Certificate or Driving License");
            } else if ($(this).val() == "Photo Correction") {
                $(this).closest('tr').find('.changename').text("Applicant Photo");
            }else {
                $(this).closest('tr').find('.changename').text("Aadhaar Card");
            }
        });

        $("#pricetable").on('click', '.btnDelete', function() {
            $(this).closest('tr').remove();
        });

        function addnewrow() {
            $("#pricetable tbody").append(
                "<tr><td><select required name='voterid_correction[]' class='form-control'><option value=''>Select</option><option value='NAME'>NAME</option><option value='GENDER'>GENDER</option><option value='DOB/AGE'>DOB/AGE</option><option value='RELATION TYPE'>RELATION TYPE</option><option value='RELATIVE NAME'>RELATIVE NAME</option><option value='ADDRESS'>ADDRESS</option><option value='MOBILE NO'>MOBILE NO</option><option value='PHOTO'>PHOTO</option></select></td></td><td><input required class='form-control' type='text' name='new_data[]' maxlength='70'></td><td><select required name='correction_documents[]' class='form-control correction_docs'><option value=''>Select</option> <option value='Name Correction'>Name Correction</option><option value='Gender Correction'>Gender Correction</option><option value='DOB/AGE Correction'>DOB/AGE Correction</option><option value='Relation Type Correction'>Relation Type Correction</option> <option value='Relative Name Correction'>Relative Name Correction</option><option value='Address Correction'>Address Correction</option><option value='Mobile No Correction'>Mobile No Correction</option><option value='Photo Correction'>Photo Correction</option></select></td><td><P class='changename'></P><input required class='form-control' type='file' name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-trash-can-outline'></i></a></td></tr>"
            );
        }

    </script>
@endpush
