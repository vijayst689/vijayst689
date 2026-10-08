@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded h-100 p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> {{ session('success') }} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <strong> {{ session('error') }} </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <h5 class="card-title">Nalavariyam Request</h5>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                   <thead>
                                <tr>
                                    <th>Sl No</th>
                                    <th>FromID</th>
                                    <th>ToID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    @if ( Auth::user()->user_type_id == 1 )
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($request as $key => $a)
                                    <tr>
                                       <td>{{ $key + 1 }}</td>
                                        <td>{{ $a->from_id }}</td>
                                         <td>{{ $a->to_id ?? '-' }}</td>
                                         <td>{{ $a->amount }}</td>
                                         <td>{{ $a->req_date }} {{ $a->req_time }}</td>
                                         <td>{{ $a->status }}</td>
                                        @if (Auth::user()->user_type_id == 1)
                                        <td style="white-space: nowrap">
                                                <a onclick="showrequest('{{ $a->id }}','{{ $a->from_id }}','{{ $a->amount }}','{{ $a->file }}','{{ $a->status }}')"
                                                    class="btn btn-sm btn-success text-white">Approve
                                                </a>

                                        </td>
                                         @endif
                                    </tr>
                                     @endforeach
                            </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showrequest" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center" id="exampleModalform1">Update Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-1">
                    <div class="form-body">
                        <form method="post" class="row g-3" action="{{ url('/nalavariyam/payment/approve') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="request_id" id="request_id" />

                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input required name="amount" type="text" class="form-control" id="amount">
                                    </div>

                                    <div class="text-center">
                                        <img src="" id="paidimg" class="img-fluid" alt="...">
                                    </div>

                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <input id="declinebtn" type="button" value="Decline" class="btn btn-danger">
                                <button type="Submit" id="aprovedbtn" class="btn btn-primary">Approve</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
    <script>
         function showrequest(id, from_id, amount, req_image, status) {
            $("#request_id").val(id);
            $("#from_id").val(from_id);
            $("#amount").val(amount);
            $("#disamount").html(amount);
            if (status == "Pending") {
                $("#aprovedbtn").attr("disabled", false);
                $("#declinebtn").attr("disabled", false);
            } else {
                $("#aprovedbtn").attr("disabled", true);
                $("#declinebtn").attr("disabled", true);
            }
            document.getElementById("paidimg").src = "../upload/nalavariyamamount/" + req_image;
            $("#showrequest").modal("show");
            var decline = "{{ url('/nalavariyam/payment/decline') }}";
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
