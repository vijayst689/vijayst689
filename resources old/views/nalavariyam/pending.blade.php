@extends('layouts.app')
@section('content')
    <main class="main-wrapper">
        <div class="main-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <h5 class="card-title">{{ $status }}</h5>
            </div>
            <div class="row g-3">
                <div class="col-auto flex-grow-1 overflow-auto">
                </div>
            </div><!--end row-->
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
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S No</th>
                                    <th>District Name</th>
                                    <th>Mobile</th>
                                    @if (Auth::user()->user_type_id != 2)
                                        <th>Name</th>
                                    @endif
                                    <th>Date</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicestatus as $key => $servicestatuslist)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $servicestatuslist->district_name }}</td>
                                        <td>{{ $servicestatuslist->phone }}</td>
                                        @if (Auth::user()->user_type_id != 2)
                                            <td>{{ $servicestatuslist->name }}</td>
                                        @endif
                                        <td>{{ $servicestatuslist->date }}</td>
                                        <td>{{ $servicestatuslist->reason }}</td>
                                        <td>
                                            @if ($servicestatuslist->service_status == 'Pending')
                                                @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2)
                                                    <button
                                                        onclick="show_form('{{ $servicestatuslist->id }}','{{ $servicestatuslist->from_image }}','{{ $servicestatuslist->service_name }}','{{ $servicestatuslist->userID }}','{{ $servicestatuslist->service_status }}')"
                                                        type="button" class="btn-sm btn btn-primary">OUTPUT</button>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-sm"> WAITING</button>
                                                @endif
                                            @else
                                                <a onclick="resubmit_upload('{{ $servicestatuslist->id }}','{{ $servicestatuslist->customer_id }}','{{ $servicestatuslist->customer_user_type_id }}')"
                                                    class="btn btn-sm btn-info">Resubmit Form</a>
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
        <div class="modal fade" id="showform">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form action="{{ url('/nalavariyam_formstatus') }}" method="post">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="title"></h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="background-color: lightsalmon;">
                            <div class="form-group text-center">
                                <img id="formimage" src="" style="opacity: .8; width:100%;">
                            </div>
                            <br>
                            @if ($status == 'Pending' || $status == 'Rejected')
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="service_id" id="service_id">
                                        <div class="form-group row">
                                            <label for="upi" class="col-sm-4 col-form-label"><span
                                                    style="color:red">*</span>Status</label>
                                            <div class="col-sm-8">
                                                <select id="brand" class="form-control" name="service_status"
                                                    id="service_status" required="requiered" style="width: 100%;">
                                                    <option value="Pending">
                                                        Pending
                                                    </option>
                                                    <option id="appr" value="Completed">
                                                        Approve
                                                    </option>
                                                    <option id="resub" value="Resubmit">
                                                        Resubmit
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div id="svn" style="display: none" class="form-group row">
                                            <label class="col-sm-4 col-form-label"><span
                                                    style="color:red">*</span>Reason</label>
                                            <div class="col-sm-8">
                                                <select type="text" name="reason" class="form-control">
                                                    <option value="">Select </option>
                                                    @foreach ($remarks as $r)
                                                        <option value="{{ $r->remarks }}">{{ $r->remarks }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2)
                                <button type="submit" class="btn btn-primary">Confirm</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="image_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Upload Image</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('/nalavariyam_createapplication') }}" method="post"
                            enctype="multipart/form-data" id="serviceimage">
                            <input type="hidden" id="imservice_id" name="imservice_id" value="">
                            <input type="hidden" id="imcustomer_id" name="imcustomer_id" value="">
                            <input type="hidden" id="imcustomer_user_type_id" name="imcustomer_user_type_id"
                                value="">
                            {{ csrf_field() }}
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label"><span
                                                    style="color:red">*</span>Image(800 x 1100)</label>
                                            <div class="col-sm-8">
                                                <input accept="image/png,image/jpeg,image/jpg" type="file"
                                                    name="photo" id="photo" required="required"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default"
                                            data-bs-dismiss="modal">Close</button>
                                        <input class="btn btn-primary" type="submit" value="Submit" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>
        function show_form(id, from_image, service_name, service_id, servicestatus) {
            var url = "{{ url('/') }}";
            $("#formimage").attr("src", url + '/upload/output/' + from_image);
            $("#title").html(service_name);
            $("#service_id").val(service_id);
            $("#service_status").val(servicestatus);
            $("#showform").modal("show");
        }

        function resubmit_upload(service_id, customer_id, customer_user_type_id) {
            $("#imservice_id").val(service_id);
            $("#imcustomer_id").val(customer_id);
            $("#imcustomer_user_type_id").val(customer_user_type_id);
            $("#image_modal").modal("show");
        }


        $('#brand').change(function() {
            var brandValue = $(this).val();
            if (brandValue == "Resubmit") {
                $("svn").attr('required', true);
                $("#svn").show("slow");
            } else if (brandValue == "Approved") {
                $("#svn").hide("slow");
            }
        })
    </script>
@endpush
