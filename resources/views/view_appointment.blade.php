@extends('layouts.app')
@section('content')
    <style>
        .modal-lg {
  max-width: 900px !important;
}
    </style>
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
                    <h3 class="card-title">பதவி நியமனச் சான்றிதழ்</h3>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User ID</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>TYPE</th>
                                   
                                    @if (Auth::user()->user_type_id == 1)
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointment as $key => $app)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>@if($app->usertype == 'Retailer')
                                             R{{ $app->user_id }}
                                            @else
                                              D{{ $app->user_id }}
                                            @endif</td>
                                        <td>{{ $app->email }}</td>
                                        <td>{{ $app->mobile }}</td>
                                        <td>{{ $app->usertype }}</td>
                                     
                                     
                                        <td style="white-space: nowrap">
                                            <button
                                                onclick="pending('{{ $app->id }}','{{ $app->name }}','{{ $app->mobile }}','{{ $app->status }}','{{ $app->photo }}','{{ $app->remarks }}','{{ $app->usertype }}','{{ $app->district }}','{{ $app->taluk }}','{{ $app->village }}','{{ $app->station_name }}')" type="button"
                                                style="font-size: small" class="btn-sm btn @if($app->status == 'Pending') btn-warning @elseif($app->status == 'Resubmit') btn-danger @else btn-success @endif">{{ $app->status }}</button>

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

  <div class="modal fade" id="pendingapp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title fw-bold">
          <i class="bi bi-person-badge me-2"></i>Status Update
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form method="post" action="{{ url('/update_appointment') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="pendingid">

        <div class="modal-body">g
          <div class="row align-items-center mb-4">
            <div class="col-md-4 text-center">
              <img id="view_photo" src="{{ asset('images/default-user.png') }}"
                   alt="Photo"
                   class="img-fluid rounded-circle shadow-sm mb-2"
                   width="120" height="120" style="object-fit:cover;">
              <div id="photo_download" style="display:none;">
                <a id="photo_download_btn" href="#" class="btn btn-outline-primary btn-sm mt-2" download>
                  <i class="bi bi-download"></i> Download Photo
                </a>
              </div>
            </div>

            <div class="col-md-8">
              <div class="bg-light rounded p-3">
                <div class="row g-2">
                  <div class="col-6"><strong>Name:</strong> <span id="view_name" class="text-dark"></span></div>
                  <div class="col-6"><strong>Mobile:</strong> <span id="view_mobile" class="text-dark"></span></div>
                  <div class="col-6"><strong>User Type:</strong> <span id="view_usertype" class="text-dark"></span></div>
                  <div class="col-6"><strong>District:</strong> <span id="view_district" class="text-dark"></span></div>
                  <div class="col-6"><strong>Taluk:</strong> <span id="view_taluk" class="text-dark"></span></div>
                  <div class="col-6"><strong>Village:</strong> <span id="view_village" class="text-dark"></span></div>
                  <div class="col-12"><strong>Station:</strong> <span id="view_station_name" class="text-dark"></span></div>
                </div>
              </div>
            </div>
          </div>

          <hr>

          <div class="row g-3">
            <div class="col-md-6">
              <label for="pendingstatus" class="form-label fw-bold">Status</label>
              <select name="status" id="pendingstatus" class="form-select">
                <option value="">Select</option>
                <option value="Pending">Pending</option>
                <option value="Resubmit">Resubmit</option>
                <option value="Approved">Approved</option>
              </select>
            </div>

            <div class="col-md-6" id="remarkshide" style="display:none;">
              <label for="pendingremarks" class="form-label fw-bold">Remarks</label>
              <input type="text" name="remarks" id="pendingremarks" class="form-control" placeholder="Enter remarks">
            </div>

            <div class="col-md-6" id="certificatehide" style="display:none;">
              <label for="certificate" class="form-label fw-bold">Certificate</label>
              <input type="file" name="certificate" id="certificate" class="form-control">
            </div>
          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Close
          </button>
          <button type="submit" class="btn btn-primary" id="pending_submit_btn">
            <i class="bi bi-check-circle"></i> Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>



@endsection
@push('page_scripts')
    <script>
            function pending(id, name, mobile, status, photo, remarks, usertype, district, taluk, village, station_name) {
               $('#pending_submit_btn').prop('disabled', false);
        $("#pendingid").val(id);
        $("#view_name").text(name);
        $("#view_mobile").text(mobile);
        $("#view_usertype").text(usertype);
        $("#view_district").text(district);
        $("#view_taluk").text(taluk);
        $("#view_village").text(village);
        $("#view_station_name").text(station_name);

        $("#pendingstatus").val(status);
        $("#pendingremarks").val(remarks);

        if (photo) {
        let imgPath = "{{ asset('upload/nalavariyam_document/photo') }}/" + photo;
        $("#view_photo").attr("src", imgPath);
        $("#photo_download_btn").attr("href", imgPath);
        $("#photo_download").show();
    } else {
        $("#view_photo").attr("src", "{{ asset('images/default-user.png') }}");
        $("#photo_download").hide();
    }
    if(status == 'Approved') {
      $('#pending_submit_btn').prop('disabled', true);
      $('#pending_submit_btn').text('Approved');

    }

        $("#pendingapp").modal("show");
    }
       
        $('#pendingstatus').change(function() {
            if ($('#pendingstatus').val() == 'Resubmit') {
                $('#remarkshide').show("slow");
                $('#remarks').prop("required", true);
                $('#certificatehide').hide("slow");
                $('#certificate').prop("required", false);

            } else if ($('#pendingstatus').val() == 'Approved') {
                $('#certificatehide').show("slow");
                $('#certificate').prop("required", true);
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
            } else {
                $('#remarkshide').hide("slow");
                $('#remarks').prop("required", false);
                $('#certificatehide').hide("slow");
                $('#certificate').prop("required", false);

            }
        });
    </script>
@endpush
