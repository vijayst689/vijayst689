@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card rounded-4 border-top border-4 border-primary border-gradient-1">

                        <div class="card-body p-4">
                            <form class="row g-4 permissionform" action="{{ url('updatenalavariyam_activation') }}"
                                enctype="multipart/form-data" method="post">
                                @csrf
                                 <div class="row">
                                    <input type="hidden" name="userid" value="{{ $userid }}" />
                                   <input type="hidden" name="activation_amount_hidden" id="act_amount_hidden" value="0"/>
                                <input type="hidden" name="admin_amount" id="adminamt" value="0">
                                    <div class="mb-3 col-md-6">

                                        <label for="nalavariyam_usertype" class="form-label">User Type</label>
                                        <select required type="text" class="form-control" id="nalavariyam_usertype"
                                            name="nalavariyam_usertype">
                                            <option value="">Select</option>
                                            <option value="3">பஞ்சாயத்து ஐடி</option>
                                            <option value="4">கிளை நிர்வாக ஐடி</option>
                                        </select>
                                        <label for="nalavariyam_dist_id" class="form-label">District</label>
                                        <select required name="nalavariyam_dist_id" id="dist_id" class="form-control">
                                            <option value="">Select District</option>
                                            @foreach ($districts as $d)
                                                <option value="{{ $d->id }}">{{ $d->district_name }}</option>
                                            @endforeach
                                        </select>

                                        <div class="row mt-1">
                                            <label for="aadhaar_no" class=""><span style="color:red"></span>Aadhaar
                                                No</label>
                                            <div class="col-md-8">
                                                <input required="required" type="text" class="form-control number"
                                                    id="aadhaar_no" maxlength="12" name="aadhaar_no"
                                                    placeholder="Aadhar No">
                                            </div>
                                            <div id="verifybtnhide" class="input-group-append col-sm-2">
                                                <button onclick="getaadhaar_otpf();" id="checkotp" type="submit"
                                                    class="btn btn-primary">Verify</button>
                                            </div>
                                            <div class="col-md-12 mt-1" id="verifyotphide" style="display:none;">
                                                <div class="row">
                                                    <label for="aadhaar_no" class=""><span
                                                            style="color:red"></span>OTP</label>
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <input type="text" name="otp" id="otp"
                                                                placeholder="Enter OTP" maxlength="6"
                                                                class="form-control" required="required">
                                                            <input type="hidden" id="refid">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4" id="verifydatabtnhide">
                                                        <button onclick="getaadhaar_dataf();" id="subotp"
                                                            type="button" class="btn btn-primary">Submit OTP</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label">Activation Payment</label>
                                        <input readonly required="required" type="text" class="form-control"
                                            name="activation_amount" id="act_amount">
                                        <label for="nalavariyam_taluk_id" class="form-label">Taluk</label>
                                        <select name="nalavariyam_taluk_id" id="taluk" class="form-control">
                                        </select>

                                        <label for="name" class="form-label">Name</label>
                                        <input readonly required="required" type="text" class="form-control"
                                            name="full_name" id="fullname" maxlength="150" placeholder="Full Name">

                                        <label for="address" class="form-label">Address</label>
                                        <textarea readonly required name="address" id="address" class="form-control" placeholder="Address" rows="3"
                                            maxlength="500"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="form-group row">
                             <div class="mt-2 text-center" id="details"></div>
                            <div class="mt-2 text-center" id="nopayment"></div>
                            <div class="col-md-12 text-center">
                                <button id="save" class="btn btn-info" type="submit">Save</button>
                                <a href="{{ url('/') }}" class="btn btn-info">Back</a>
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
        $(function() {
            $("#save").attr("disabled", true);
        });
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

        function getaadhaar_otpf() {
            var aadhaar = $("#aadhaar_no").val().trim();
            if (aadhaar == "") {
                alert("Please Enter Aadhaar Number");
                $("#aadhaar_no").focus();
                return false;
            }
            var aadhaar_length = aadhaar.length;
            if (aadhaar_length < 12) {
                alert("Entered Aadhaar Number is Incorrect");
                $("#aadhaar_no").focus();
                return false;
            }
            $("#checkotp").attr("disabled", true);
            var url = "{{ url('/getaadhaar_otpf') }}/" + aadhaar;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    if (result.status == "Failure") {
                        alert(result.message);
                        $("#checkotp").attr("disabled", false);
                    } else {
                        $("#refid").val(result.ref_id);
                        $("#verifybtnhide").hide();
                        $("#verifyotphide").show();
                        $("#aadhaar_no").attr("readonly", true);
                    }
                }
            });
        }

        function getaadhaar_dataf() {
            var otp = $("#otp").val().trim();
            var aadhaar = $("#aadhaar_no").val().trim();
            var refid = $("#refid").val().trim();
            var userid = "{{ $userid }}";
            if (otp == "") {
                alert("Please Enter OTP");
                $("#otp").focus();
                return false;
            }
            var otp_length = otp.length;
            if (otp_length < 6) {
                alert("Entered OTP is Incorrect");
                $("#otp").focus();
                return false;
            }
            $("#subotp").attr("disabled", true);
            var url = "{{ url('/getaadhaar_dataf') }}/" + otp + "/" + refid + "/" + aadhaar + "/" + userid;
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(result) {
                    var data = result;
                    console.log(data);
                    //var obj = JSON.parse(data);
                    if (data.status == "Failure") {
                        alert(data.message);
                        $("#subotp").attr("disabled", false);
                    } else {
                        alert(data.name);
                        $("#verifybtnhide").hide();
                        $("#verifyotphide").hide();
                        $("#aadhaar_no").attr("readonly", true);
                        $("#userid").val(result.userid);
                        $("#fullname").val(data.name);
                        $("#address").val(data.address);
                        $("#save").attr("disabled", false);
                    }
                }
            });
        }

         var ramjibalance = "{{ Auth::user()->rawallet }}";
         $(".permissionform").submit(function() {
             var amount =  $("#act_amount_hidden").val();
             var adminamount =  $("#adminamt").val();



    if(parseInt(adminamount) > parseFloat(ramjibalance)){
            alert("LOW BALANCE");
            $('#save').prop("disabled", true);
                    $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                        'color': 'red',
                        'font-size': '130%',
                        'font-weight': 'bold'
                    });
                    return false;
        }
            $('#save').prop("disabled", false);
            $('#save').prop("disabled", false);
});

         var wallet = "{{ Auth::user()->wallet }}";

        $('#nalavariyam_usertype').on('change', function() {
            var usertypeid = this.value;
            var com = 0;
            //alert(usertypeid);

            $("#act_amount").val("");
            $('#nopayment').html("");
            $('#details').html("");
            $('#verifybtnhide').show();
             var d = "";
                if(usertypeid == 3){
                     d = "ஐடி ஆக்டிவ் கட்டணம் ரூ.4,000/- விண்ணப்ப கட்டணம் ரூ. 90/-";
                     com = 2500;
                }else{
                     d = "ஐடி ஆக்டிவ் கட்டணம் ரூ.15,00/- விண்ணப்ப கட்டணம் ரூ. 120/-";
                     com = 600;

                }
                 $('#details').html(d).css({
                    'color': 'green',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
            var url = "{{ url('nalavariyam/get_activationamount') }}/" + usertypeid;
            $.ajax({
                url: url,
                type: "GET",
                success: function(result) {
                    $("#act_amount").val(result.amount);
                    $("#act_amount_hidden").val(result.amount);
                    $("#adminamt").val(com);


        if(parseInt(com) > parseFloat(ramjibalance)){
            alert("LOW BALANCE");
            $('#save').prop("disabled", true);
                    $('#nopayment').html("Low Balance For the Service.Please Contact Admin...").css({
                        'color': 'red',
                        'font-size': '130%',
                        'font-weight': 'bold'
                    });
                    $('#verifybtnhide').hide();
                    return false;
        }
                }
            });

        });
    </script>
@endpush
