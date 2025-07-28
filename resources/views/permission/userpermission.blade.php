@extends('layouts.app')
@section('content')
    <style type="text/css">
        .row-padded {
            background-color: ;
            padding: 1px;
            margin: 4px;
            border: 1px solid skyblue;
        }
    </style>
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
            <!--end row-->
            <div class="card mt-4">
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
                    <div class="row">
                        <h5 class="card-title">Activation Permissions</h5>
                        <div class="row">
                            <form class="row permissionform" action="{{ url('/savepermission') }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" id="activation_userid" name="user_id" value="{{ $userid }}">
                                <h5 class="text-danger">Activation Payment : <span id="actamount"></span></h5>
                                <input type="hidden" name="superadmin_amount" id="superadmin_amount" value="0">
                                <input type="hidden" name="activation_charge" id="actamount_input">
                                <input type="hidden" name="referral_amount" id="admin_amount_input" value="0">
                                <input type="hidden" name="referral_id" id="referral_id">
                                <h5 class="text-center text-danger">PDF Services</h5>
                                @foreach ($findservices as $ser)
                                    <div class="col-6 col-xl-6">
                                        <div class="row row-padded">
                                            <label class="form-check-label col-sm-10"
                                                for="pdf{{ $ser->id }}">{{ $ser->name }}</label>
                                            <div class="icheck-success d-inline col-sm-2">

                                                <input class="checkajax" name="service_id[]"
                                                    @foreach ($checkpermission1 as $c) @if ($c->service_id == $ser->id) checked disabled @endif @endforeach
                                                    type="checkbox" id="pdf{{ $ser->id }}"
                                                    value="{{ $ser->id }}_1">

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <h5 class="text-center text-danger mt-4">Utility Services</h5>
                                @foreach ($utilityservices as $ser1)
                                    <div class="col-6 col-xl-6">
                                        <div class="row row-padded">
                                            <label class="form-check-label col-sm-10"
                                                for="ut{{ $ser1->id }}">{{ $ser1->name }}</label>
                                            <div class="icheck-success d-inline col-sm-2">
                                                <input class="checkajax" name="service_id[]"
                                                    @foreach ($checkpermission2 as $c) @if ($c->service_id == $ser1->id) checked disabled @endif @endforeach
                                                    type="checkbox" id="ut{{ $ser1->id }}"
                                                    value="{{ $ser1->id }}_2">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <h5 class="text-center text-danger mt-4">Pancard Services</h5>
                                @foreach ($panservices as $ser2)
                                    <div class="col-6 col-xl-6">
                                        <div class="row row-padded">
                                            <label class="form-check-label col-sm-10"
                                                for="pan{{ $ser2->id }}">{{ $ser2->name }}</label>
                                            <div class="icheck-success d-inline col-sm-2">
                                                <input class="checkajax" name="service_id[]"
                                                    @foreach ($checkpermission4 as $c) @if ($c->service_id == $ser2->id) checked disabled @endif @endforeach
                                                    type="checkbox" id="pan{{ $ser2->id }}"
                                                    value="{{ $ser2->id }}_4">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <h5 class="text-center text-danger mt-4">Other Services</h5>
                                @foreach ($services as $ser2)
                                    <div class="col-6 col-xl-6">
                                        <div class="row row-padded">
                                            <label class="form-check-label col-sm-10"
                                                for="ser{{ $ser2->id }}">{{ $ser2->service_name }}</label>
                                            <div class="icheck-success d-inline col-sm-2">
                                                <input class="checkajax" name="service_id[]"
                                                    @foreach ($checkpermission3 as $c) @if ($c->service_id == $ser2->id) checked disabled @endif @endforeach
                                                    type="checkbox" id="ser{{ $ser2->id }}"
                                                    value="{{ $ser2->id }}_3">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="mt-2 text-center" id="nopayment"></div>
                                <div class="text-center">
                                    <div class="col-12">
                                        <div class="mb-0">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
    </main>
@endsection
@push('page_scripts')
    <script>
        $(document).ready(function() {
            $('body').css('pointer-events', 'all');
            $("#actamount").html("0");
        });

        $(".permissionform").submit(function() {
            var user_type = "{{ Auth::user()->user_type_id }}";
            var wallet = "{{ Auth::user()->wallet }}";
            var amount = $("#actamount_input").val();
            if(user_type != 2){
                if (parseFloat(amount) > parseInt(wallet)) {
                $('#save').prop("disabled", true);
                $('#nopayment').html("No Fund in Wallet.Please Update Your wallet To Continue the Service").css({
                    'color': 'red',
                    'font-size': '150%',
                    'font-weight': 'bold'
                });
                return false;
            }
            }

            $('#save').prop("disabled", false);
            $("input").removeAttr("disabled");
        });

        $('.checkajax').click(function() {
            var userid = "{{ Auth::user()->id }}";
            var activation_userid = $("#activation_userid").val();
            var service_activate = $(this).val();
            if (this.checked) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('activation/get_activationamount') }}/" + userid + "/" +
                        activation_userid + "/" + service_activate,

                    success: function(data) {
                        //console.log(data);
                        var activationamount = data.activation_amount;

                        var actamount = $("#actamount").html();
                        var tot = parseFloat(activationamount) + parseFloat(actamount);
                        $("#actamount").html(tot);
                        $("#actamount_input").val(tot);

                        /*console.log(sptot);
                        console.log(admintot);*/

                    },
                    error: function() {
                        //alert('it broke');
                    },
                    complete: function() {
                        //alert('it completed');
                    }
                });

            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ url('activation/get_activationamount') }}/" + userid + "/" +
                        activation_userid + "/" + service_activate,
                    success: function(data) {
                        //console.log(data);
                        var activationamount = data.activation_amount;


                        var actamount = $("#actamount").html();
                        var tot = parseFloat(actamount) - parseFloat(activationamount);
                        $("#actamount").html(tot);
                        $("#actamount_input").val(tot);

                    },
                    error: function() {
                        //alert('it broke');
                    },
                    complete: function() {
                        //alert('it completed');
                    }
                });
            }
        });
    </script>
@endpush
