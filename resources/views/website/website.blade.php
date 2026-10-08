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
                <h5 class="card-title">Website Data</h5>
                <div class="d-flex align-items-center gap-2 justify-content-lg-end">
                    <button type="button" class="btn-sm btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addwebsite">Add Website</button>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead class="table-light">

                            <tr>
                                <th>ID</th>
                                <th>Website Name</th>
                                <th>Website Link</th>
                                <th>Website Index</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach ($website as $key => $web)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $web->website_name }}</td>
                                        <td>{{ $web->website_link }}</td>
                                        <td>{{ $web->index }}</td>                                        
                                        <td>{{ $web->status }}</td>
                                        
                                        <td style="white-space: nowrap">

                                            <button onclick="editwebsite_name('{{ $web->id }}','{{ $web->website_name }}','{{ $web->website_link }}','{{ $web->index }}','{{ $web->status }}','{{ $web->agree_payment }}')"
                                                type="button" class="btn-sm btn btn-success">Status Update</button>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addwebsite" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalLongTitle-1">Add Website</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" class="row g-3" action="{{ url('/savewebsite') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="mb-3">
                                <label for="" class="form-label">Website Name</label>
                                <input name="website_name" type="text" maxlength="100" class="form-control"
                                    placeholder="Website Name">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Website Link</label>
                                <input name="website_link" type="text" maxlength="100" class="form-control"
                                    placeholder="Website Link">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="" class="form-label">Website Index</label>
                                <input name="index" type="text" maxlength="50" class="form-control"
                                    placeholder="Website Index">
                            </div> --}}
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        

       <div class="modal fade" id="editwebsite"  role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalform1">Update Website</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mt-1">
                    <div class="form-body">
                        <form method="post" class="row g-3" action="{{ url('/updatewebsite') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="editid" />
                                    <div class="mb-3">
                                        <label for="editwebsite_name" class="form-label">Website name</label>
                                            <input  required name="website_name" type="text" maxlength="100" class="form-control" id="editwebsite_name" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="editwebsite_link" class="form-label">Website Link</label>
                                            <input  required name="website_link" type="text" maxlength="100" class="form-control" id="editwebsite_link" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="editindex" class="form-label">Website index</label>
                                            <input  readonly name="index" type="text" maxlength="100" class="form-control" id="editindex" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="editstatus" class="form-label">Status</label>
                                        <select required id="editstatus" type="text" class="form-control"
                                            maxlength="7" name="status">
                                            <option>Select</option>
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                          <label>
                                            <input type="checkbox" name="agree_payment" id="agree_payment" value="1" {{ old('agree_payment') ? 'checked' : '' }}>
                                            Update Admin Payment for this website..
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center"><p id="nopayment"></p></div>
                            <div class="text-center mb-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button id="save" type="Submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="dateupdate"  role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center" id="exampleModalform1">Update Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body mt-1">
                    <div class="form-body">
                        <form method="post" class="row g-3" action="{{ url('/update_paymentdate') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="edit_id" />
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Payment Date</label>
                                            <input  required name="payment_date" type="date" maxlength="100" class="form-control" id="date" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="amount" class="form-label">Amount</label>
                                            <input required name="amount" type="text"  class="form-control" id="amount" >
                                    </div>
                           
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button id="save" type="Submit" class="btn btn-primary">Submit</button>
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
    $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;

    // or instead:
    // var maxDate = dtToday.toISOString().substr(0, 10);

    //alert(maxDate);
    $('#date').attr('min', maxDate);
});
function editwebsite_name(id, website_name, website_link, index,status,agree_payment) {
        $("#agree_payment").prop('checked', false);
        $("#editwebsite_name").val(website_name);
        $("#editwebsite_link").val(website_link);
        $("#editindex").val(index);
        $("#editstatus").val(status);
        $("#editid").val(id);
        if(agree_payment == 1) {
         $("#agree_payment").prop('checked', true);
        } 
        $("#editwebsite").modal("show");
    }

    function date_update(id, date, amount) {
        $("#date").val(date);
        $("#amount").val(amount);
        $("#edit_id").val(id);
        $("#dateupdate").modal("show");
    }
</script>


@endpush
