@extends('layouts.app')
@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">SitePayment</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ url('addcustomer') }}" class="btn btn-grd btn-grd-info px-3"><i
                                class="bi bi-chat me-2"></i>Add Customers</a>
                    </div>
                </div> -->
            </div>
            <!--end breadcrumb-->
            <hr />
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
                    <div class="customer-table">
                        <div class="table-responsive white-space-nowrap">
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
                    <div class="col-12">
                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="">
                                    <div class="modal fade" id="showrequest">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                                                    <h5 class="modal-title">Pay</h5>
                                                    <a href="javascript:;" class="primaery-menu-close"
                                                        data-bs-dismiss="modal">
                                                        <i class="material-icons-outlined">close</i>
                                                    </a>
                                                </div>
                                                <div class="modal-body">
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
                                </div>
                            </div>
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
