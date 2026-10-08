@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
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
                    <h2 class="card-title">SitePayment</h2>
                    <div class="table-responsive">
                        <table id="example2" class="table align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>TYPE</th>
                                        <th>REASON</th>
                                        <th>Amount</th>
                                        <th>Payment Status</th>
                                        <th>Paid Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                    @foreach ($data as $key => $d)
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $d->type }}</td>
                                            <td>{{ $d->payment_reason }}</td>
                                            <td>{{ $d->amount }}</td>
                                            <td>{{ $d->payment_status }}</td>
                                            <td>{{ $d->paid_status }}</td>
                                            <td style="white-space: nowrap">
                                                @if( $d->paid_status == "Pending" || $d->paid_status == "Declined" )
                                              <button class="btn btn-sm btn-primary" onclick="payment('{{ $d->id }}','{{ $d->amount }}')">Pay</button>
                                              @else
                                              <button class="btn btn-sm btn-success" disabled>{{ $d->paid_status }}</button>
                                              @endif
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="showrequest">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update PanServices</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                 <form method="post" class="row g-3" action="{{ url('/save_sitepayment') }}"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="row_id" id="row_id" />
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Amount</label>
                                            <input readonly name="amount" id="amount" type="text" maxlength="5"
                                                class="form-control number" placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="text-center">
                                            <img src="" id="paidimg" class="img-fluid" alt="...">
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">PAYMENT IMAGE</label>
                                            <input required name="payment_proof" accept="image/*" type="file" 
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="text-center mb-3">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                       
                                        <button id="aprovedbtn" type="Submit" class="btn btn-primary">Pay</button>
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
       function payment(id, amount) {
            $("#row_id").val(id);
            $("#amount").val(amount);
            $("#disamount").html(amount);
            if (status == "Pending") {
                $("#save").attr("disabled", false);
                $("#declinebtn").attr("disabled", false);
            } else {
                $("#save").attr("disabled", true);
                $("#declinebtn").attr("disabled", true);
            }
            document.getElementById("paidimg").src = "../upload/qr/qrimgramji.jpeg";
            $("#showrequest").modal("show");
            
        }
        </script>
    @endpush
