@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Payment Request</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card mt-4">
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
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
                            <table class="table align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sl No</th>
                                        <th>FromID</th>
                                        <th>ToID</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        @if( Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3)
                                        <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requestamount as $key => $a)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $a->from_id }}</td>
                                            <td>{{ $a->to_id }}</td>
                                            <td>{{ $a->amount }}</td>
                                            <td>{{ $a->req_date }}&nbsp;{{ $a->req_time }}</td>
                                            <td>{{ $a->status }}</td>
                                            <td style="white-space: nowrap">
                                                @if( Auth::user()->user_type_id == 2 || Auth::user()->user_type_id == 3 )
                                                <a onclick="showrequest('{{ $a->id }}','{{ $a->from_id }}','{{ $a->amount }}','{{ $a->req_image }}','{{ $a->status }}')"
                                                    class="btn btn-info"><i
                                                        class="material-icons-outlined">remove_red_eye</i>
                                                </a>
                                                @endif
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="showrequest">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                    <h5 class="modal-title">Payment Request</h5>
                                    <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                        <i class="material-icons-outlined">close</i>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form method="post" class="row g-3" action="{{ url('/approvepayment') }}"
                                        enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="request_id" id="request_id" />
                                        <input type="hidden" name="from_id" id="from_id" />
                                        <input type="hidden" name="type" id="type" />
                                        <div class="col-md-12">
                                            <label for="plan_name">Amount</label>
                                            <input readonly type="text" id="amount" name="amount" maxlength="5"
                                                class="form-control number" placeholder="Amount">
                                        </div>
                                        <div class="form-body">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4"></h5>
                                                <div class="col">
                                                    <div class="card-body">
                                                        <div class="text-center">
                                                            <img src="" id="paidimg" class="w-50 mb-4 rounded"
                                                                alt="...">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                                data-bs-dismiss="modal">Close</button>
                                            <input id="declinebtn" type="button" value="Decline" class="btn btn-danger">
                                            <button id="save" type="submit"
                                                class="btn btn-primary">Approve</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>A
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>

        function showrequest(id, from_id, amount, req_image, status) {
            $("#request_id").val(id);
            $("#from_id").val(from_id);
            $("#amount").val(amount);
            $("#disamount").html(amount);
            if (status == "Pending") {
                $("#save").attr("disabled", false);
                $("#declinebtn").attr("disabled", false);
            } else {
                $("#save").attr("disabled", true);
                $("#declinebtn").attr("disabled", true);
            }
            document.getElementById("paidimg").src = "../upload/paidimage/" + req_image;
            $("#showrequest").modal("show");
            var decline = "{{ url('declinerequest_payment') }}";
            $('#declinebtn').click(function(e) {
                var r = confirm("Are you sure to Decline?");
                if (r == true) {
                    var url = decline + "/" + id;
                    window.location.href = url;
                }
            });
        }
    </script>
@endpush
