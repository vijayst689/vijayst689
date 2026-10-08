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
                    @foreach ($nalavariyam_services as $service)
                        <form action="{{ url('/updatenalavariyam_service') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                                    <div class="form-group">
                                        <label for="service_name">Service Name</label>
                                        <textarea type="text" class="form-control" rows="2" maxlength="200" name="service_name" id="editservicename"
                                            placeholder="Enter Service Name">{{ $service->service_name }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="service_payment">Service Payment</label>
                                        <input type="text" maxlength="3" class="form-control number"
                                            value="{{ $service->service_payment }}" name="service_payment"
                                            id="editservicepayment" placeholder="Enter Service Payment">
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status" id="editstatus">
                                            <option @if ($service->status == 'Active') selected @endif value="Active">Active
                                            </option>
                                            <option @if ($service->status == 'Inactive') selected @endif value="Inactive">
                                                Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="from_image">புகைப்படம்</label>
                                        <div class="input-group">
                                            <input type="file" class="custom-file-input" name="from_image"
                                                id="from_image" autocomplete="off">
                                            <label class="custom-file-label" for="from_image">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Service Type</label>
                                        <select class="form-control select2" name="servicetype" id="service_type"
                                            required="required" style="width: 100%;">
                                            <option @if ($service->servicetype == 1) selected @endif value="1">Normal
                                            </option>
                                            <option @if ($service->servicetype == 2) selected @endif value="2">
                                                Scholarship</option>
                                        </select>
                                    </div>
                                    <div class="row" id="datehidden">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_name">From Date</label>
                                                <input value="{{ $service->from_date }}" type="date" class="form-control"
                                                    name="from_date" id="from_date">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>To Date</label>
                                                <input value="{{ $service->to_date }}" type="date" class="form-control"
                                                    name="to_date" id="to_date">
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <table id="" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th> S No</th>
                                                <th> Service Name</th>
                                                <th> Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($service->type) == 0)
                                                @foreach ($district as $key => $districtlist)
                                                    <tr>
                                                        <td>{{ $districtlist->id }}
                                                            <input type="hidden" name="dist_id[]"
                                                                value="{{ $districtlist->id }}">
                                                        </td>
                                                        <td>{{ $districtlist->district_name }}</td>
                                                        <td>
                                                            <label>
                                                                <input type="checkbox" name="check_{{ $districtlist->id }}"
                                                                    value="2">
                                                                Offline
                                                            </label>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @foreach ($service->type as $key2 => $type)
                                                    <tr>
                                                        <td>{{ $type->district_id }}
                                                            <input type="hidden" name="dist_id[]"
                                                                value="{{ $type->district_id }}">
                                                        </td>
                                                        <td>{{ $type->district_name }}</td>
                                                        <td>
                                                            @if ($type->service_type == 2)
                                                                <label>
                                                                    <input type="checkbox" checked
                                                                        name="check_{{ $type->district_id }}"
                                                                        value="2">
                                                                    Offline
                                                                </label>
                                                            @else
                                                                <label>

                                                                    <input type="checkbox"
                                                                        name="check_{{ $type->district_id }}"
                                                                        value="2">
                                                                    Offline
                                                                </label>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 text-center">
                                    <input id="save" class="btn btn-info" type="submit" name="submit"
                                        value="Submit" />
                                    <a href="{{ url('/nalavariyam_services') }}" class="btn btn-info">Back</a>
                                </div>
                            </div>
                    @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </section>
@endsection
@push('page_scripts')
    <script>
        $(function() {
            var servicetype = $("#service_type").val();
            if (servicetype == 2) {
                $('#datehidden').show("slow");
                $('#from_date').prop("required", true);
                $('#to_date').prop("required", true);
            } else {
                $('#datehidden').hide();
                $('#from_date').prop("required", false);
                $('#to_date').prop("required", false);
            }

            $('#service_type').change(function() {
                if ($(this).val() == "2") {

                    $('#datehidden').show('slow');
                    $('#from_date').prop("required", true);
                    $('#to_date').prop("required", true);

                } else {

                    $('#datehidden').hide("slow");
                    $('#from_date').prop("required", false);
                    $('#to_date').prop("required", false);

                }
            });
        });
    </script>
@endpush
