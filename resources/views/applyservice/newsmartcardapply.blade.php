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
                        <h1 class="card-title">{{ $servicename }}</h1>
                        <h1 class="card-title">Service Payment : <span id="paymentamount"
                                class="text-danger"></span></h1>
                        <div class="row">
                            <form class="row g-4" action="{{ url('newsmartcard_register') }}" enctype="multipart/form-data"
                                method="post" id="myForm">
                                {{ csrf_field() }}

                                <div class="row">
                                    <input type="hidden" id="serviceid" name="serviceid" value="{{ $serviceid }}">
                                    <input type="hidden" name="amount" value="{{ $amount }}">
                                    <input type="hidden" name="service_amount" id="serviceamount">

                                    <div class="row">
                                        <h4 class="text-center"> குடும்ப தலைவர் விபரம்</h4>

                                        <div class="mb-3 col-md-6">

                                            <label for="family_head_name" class="form-label">குடும்ப தலைவர்
                                                பெயர்பெயர் தமிழில்</label>
                                            <input required type="text" class="form-control" name="family_head_name"
                                                maxlength="30" placeholder="பெயர் தமிழில்" />

                                            <label for="mobile" class="form-label number">செல் நம்பர்</label>
                                            <input required type="text" maxlength="10" class="form-control"
                                                name="mobile" placeholder="Mobile Number" />

                                                <label for="dist_id" class="form-label">District</label>
                                                <select required name="dist_id" id="dist_id" class="form-control">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $d)
                                                        <option value="{{ $d->id }}">{{ $d->district_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="family_head_photo" class="form-label">குடும்ப தலைவர்
                                                புகைப்படம்</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="family_head_photo" />

                                            <label for="family_head_aadhaar" class="form-label">குடும்ப தலைவர் ஆதார்</label>
                                            <input required accept="image/jpeg, image/png" type="file"
                                                class="form-control" name="family_head_aadhaar" />

                                            <label for="taluk_id" class="form-label">Taluk</label>
                                            <select required name="taluk_id" id="taluk" class="form-control change">
                                            </select>
                                        </div>
                                        <h3 class="text-center">குடும்ப உறுப்பினர் விபரம்</h3>
                                        <table id="pricetable" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>உறவுமுறை</th>
                                                    <th>Aadhaar Card</th>
                                                    <th> <a class="btn btn-sm btn-success" onclick="addnewrow()"><i
                                                                class='mdi mdi-plus mdi-18px'></i></a></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> <select required name="relationship[]" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="Mother">தாய்</option>
                                                            <option value="Father">தந்தை</option>
                                                            <option value="Husband">கணவர்</option>
                                                            <option value="Wife">மனைவி</option>
                                                            <option value="Son">மகன்</option>
                                                            <option value="Daughter">மகள்</option>
                                                            <option value="Father In Law">மாமனார்</option>
                                                            <option value="Mother In Law">மாமியார்</option>
                                                            <option value="Son In Law">மருமகன்</option>
                                                            <option value="Daughter In Law">மருமகள்</option>
                                                        </select></td>

                                                    <td>
                                                        <input required class="form-control" type="file" name="doc[]"
                                                            accept="image/jpeg, image/png">
                                                    </td>
                                                    <td><a onClick='removerow()'
                                                            class='btn btn-sm btn-danger btnDelete'><i
                                                                class='mdi mdi-delete mdi-18px'></i></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

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
        
        $('.change').on('change', function() {
            var taluk_id = this.value;
            var service_id = $("#serviceid").val();
            var usertype = "{{ Auth::user()->user_type_id }}";
            //alert(usertype);
            var url = "{{ url('get_smartcardtaluk_payment') }}/" + taluk_id + "/" + service_id;
            if (taluk_id != "" && service_id != "") {
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(result) {
                        console.log(result);
                         $("#paymentamount").html("0");
                           $('#save').prop("disabled", false);
                          var wallet = "{{ Auth::user()->wallet }}";
                          wallet = parseFloat(wallet);
                         var amount = 0;
                         if(Object.keys(result).length){
                            if (usertype == "3") {
                                amount = result.distributor_amount;
                            }else if (usertype == "4") {
                                amount = result.retailer_amount;
                            } else if (usertype == "5") {
                                amount = result.customer_amount;
                            }
                        }else{
                            amount = 0;
                        }

                            $("#paymentamount").html(amount);
                            $("#serviceamount").val(amount);
                             amount = parseFloat(amount);
                            if(amount == 0){
                                    $('#save').prop("disabled", true);
                                    $('#nopayment').html("Please Contact Admin...").css({
                                        'color': 'red',
                                        'font-size': '130%',
                                        'font-weight': 'bold'
                                    });
                                    return false;
                            }else if(amount != 0){
                                if(amount > wallet){
                                alert("LOW BALANCE");
                                $('#save').prop("disabled", true);
                                        $('#nopayment').html("Low Balance For the Service.Please Top UP...").css({
                                            'color': 'red',
                                            'font-size': '130%',
                                            'font-weight': 'bold'
                                        });
                                        return false;
                            }else{
                                $("#nopayment").html("");
                                $("#save").attr("disabled",false);
                                return true;

                            }

                            }

                    }
                });
            }

        });

       
    $("form").submit(function() {
        $('#save').prop("disabled", true);
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
                "<tr><td> <select required name='relationship[]' class='form-control'><option value=''>Select</option><option value='Mother'>தாய்</option><option value='Father'>தந்தை</option><option value='Husband'>கணவர்</option><option value='Wife'>மனைவி</option><option value='Son'>மகன்</option><option value='Daughter'>மகள்</option><option value='Father In Law'>மாமனார்</option><option value='Mother In Law'>மாமியார்</option><option value='Son In Law'>மருமகன்</option><option value='Daughter In Law'>மருமகள்</option></select></td><td><input class='form-control' required type='file' name='doc[]' accept='image/jpeg, image/png'></td><td><a onClick='removerow()' class='btn btn-sm btn-danger btnDelete'><i class='mdi mdi-delete mdi-18px'></i></a></td></tr>"
            );
        }
    </script>
@endpush
