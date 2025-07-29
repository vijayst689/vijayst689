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
                                    <th>Application No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($completed as $key => $c)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $c->district_name }}</td>
                                        <td>{{ $c->phone }}</td>
                                        @if (Auth::user()->user_type_id != 2)
                                            <td>{{ $c->name }}</td>
                                        @endif
                                        <td>{{ $c->date }}</td>
                                        <td>{{ $c->application_no }}</td>
                                        <td>
                                            <button
                                                onclick="show_form('{{ $c->id }}','{{ $c->from_image }}','{{ $c->service_name }}','{{ $c->form_id }}','{{ $c->application_no }}')"
                                                type="button" class="btn-sm btn btn-primary">
                                                @if (Auth::user()->user_type_id == 1 || Auth::user()->user_type_id == 2)
                                                    OUTPUT
                                                @else
                                                    Download
                                                @endif
                                            </button>
                                             @if($c->bill == 0)
                                   @if($c->application_no == "")
                                    <a class="btn btn-sm btn-info" onclick="alert('Please Enter Aplication Number...!'); return false;"
                                                    href="{{ url('/createbill',$c->form_id) }}"><i
                                                        class="fas fa-arrow-circle-right"></i> Create Bill</a>
                                   @else
                                   <a class="btn btn-sm btn-info"
                                                    href="{{ url('/createbill',$c->form_id) }}"><i
                                                        class="fas fa-arrow-circle-right"></i> Create Bill</a>
                                    @endif
                                   @else
                                   <a class="btn btn-sm btn-success"
                                                    href="{{ url('/receipt',$c->form_id) }}/{{ $c->customersID }}"><i
                                                        class="fas fa-arrow-circle-right"></i> View Bill</a>
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
                    <form action="{{ url('/updatecompleteddetails') }}" method="post">
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
                            <div class="form-group text-center">
                                <a id="fromimages" href="" type="button" class="btn-sm btn btn-primary"
                                download>Download</a>
                            </div>
                            <input type="hidden" name="payments_id" id="paymentid">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label"><span style="color:red">*</span>Application
                                        Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" id="application_no" name="application_no" required="required"
                                            class="form-control" maxlength="30" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('page_scripts')
    <script>
        function show_form(id, from_image, service_name, formid, application_no) {
            var url = "{{ url('/') }}";
            $("#formimage").attr("src", url + '/upload/output/' + from_image);
            $("#title").html(service_name);
            $("#paymentid").val(formid);
            $("#application_no").val(application_no);
            $("#showform").modal("show");
        }
    </script>
@endpush
