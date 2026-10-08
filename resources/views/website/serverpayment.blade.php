@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <strong> {{ session('success') }} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong> {{ session('error') }} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title">SERVER ACTIVATION</h5>
                
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead class="table-light">

                            <tr>
                                <th>ID</th>
                                <th>Website Name</th>
                                <th>PAyment</th>
                                <th>Activation DAte</th>
                                <th>Payment DAte</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($payment as $key => $web)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $web->website_name }}</td>
                                        <td>{{ $web->payment }}</td>
                                        <td>{{ $web->activation_date }}</td>
                                        <td>{{ $web->date }}</td>
                                        <td>{{ $web->status }}</td>
                                        
                                        <td style="white-space: nowrap">
                                                 <button onclick="approve('{{ $web->id }}','{{ $web->payment_proof }}','{{ $web->payment }}','{{ $web->status }}')"
                                                type="button" class="btn-sm btn btn-info">Approve</button>


                                        </td>
                                
                                    </tr>
                                @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

        

       

        <div class="modal fade" id="showrequest"  role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalform1">Update Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mt-1">
                    <div class="form-body">
                        <form method="post" class="row g-3" action="{{ url('/approve_serverpayment') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                   <input type="hidden" name="request_id" id="request_id" />
                                    
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                            <input required name="amount" type="text"  class="form-control" id="amount" >
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

    function approve(id, proof, amount,status) {
        $("#request_id").val(id);
            $("#amount").val(amount);
            $("#disamount").html(amount);
            if (status == "Pending") {
                $("#save").attr("disabled", false);
                $("#declinebtn").attr("disabled", false);
            } else {
                $("#save").attr("disabled", true);
                $("#declinebtn").attr("disabled", true);
            }
            if (status == "Approved") {
                $("#aprovedbtn").attr("disabled", true);
            }
            document.getElementById("paidimg").src = proof;
            $("#showrequest").modal("show");
            var  decline = "{{ url('declineserver_payment') }}";
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
