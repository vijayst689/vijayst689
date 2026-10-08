@extends('layouts.app')
@section('content')
<style>
.modal {
    z-index: 1055;
}

.modal-dialog.modal-fullscreen {
    width: 100vw !important;
    max-width: 100vw !important;
    height: 100vh;
    margin: 0;
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
                    <h5 class="card-title mb-3">View Meeting List</h5>

<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addmeeting">
        + Add Meeting
    </button>
</div>

<div class="table-responsive">
    <table id="example2" class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Place</th>
                <th>Amount</th>
                <th>Status</th>
                <th width="260">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $n)
                <tr>
                    <td>{{ $n->id }}</td>
                    <td>{{ $n->title }}</td>
                    <td>{{ \Carbon\Carbon::parse($n->meetingdate)->format('d-m-Y') }}</td>
                    <td>{{ $n->place }}</td>
                    <td>₹ {{ $n->amount }}</td>
                    <td>
                        <span class="badge bg-{{ $n->status == 'Active' ? 'success' : 'secondary' }}">
                            {{ $n->status }}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm"
                            onclick="edit_meeting('{{ $n->id }}','{{ $n->title }}','{{ $n->meetingdate }}','{{ $n->place }}','{{ $n->amount }}')">
                            Edit
                        </button>

                        <button class="btn btn-info btn-sm"
                            onclick="viewUsers('{{ $n->id }}')">
                            Users
                        </button>

                        <a onclick="return confirm('Delete this meeting?')"
                           href="{{ url('/dropmeeting', $n->id) }}"
                           class="btn btn-danger btn-sm">
                            Drop
                        </a>
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
            <div class="modal fade" id="editmeeting">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Update Meeting</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="row g-3" action="{{ url('/updatemeeting') }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="meetingid" id="meetingid" />
                                        <div class="mb-3">
                                            <label for="editname" class="form-label">Title</label>
                                            <input required name="title" type="text" class="form-control"
                                                id="edittitle" placeholder="Title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editmeetingdate" class="form-label">Meeting Date</label>
                                            <input required name="meetingdate" type="date" class="form-control"
                                                id="editmeetingdate" placeholder="Meeting Date">
                                    </div>
                                    <div class="mb-3">
                                            <label for="editplace" class="form-label">Place</label>
                                            <input required name="place" type="text" class="form-control"
                                                id="editplace" placeholder="Place">
                                        </div>
                                        <div class="mb-3">
                                            <label for="editamount" class="form-label">Amount</label>
                                            <input required name="amount" type="number" class="form-control"
                                                id="editamount" placeholder="Amount">
                                        </div>
                                         <div class="mb-3">
                                            <label for="addamount" class="form-label">Meeting Banner</label>
                                            <input required name="meeting_banner" accept="image/*" type="file" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <select required name="status" class="form-control"
                                                id="editstatus">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>  
                                            </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-body">
            <div class="modal fade" id="addmeeting">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center" id="exampleModalform1">Add Meeting</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body mt-1">
                            <div class="form-body">
                                <form class="row g-3" action="{{ url('/savemeeting') }}" method="post"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="addtitle" class="form-label">Title</label>
                                            <input required name="title" type="text" class="form-control"
                                                id="addtitle" placeholder="Title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="addmeetingdate" class="form-label">Meeting Date</label>
                                            <input required name="meetingdate" type="date" class="form-control"
                                                id="addmeetingdate" placeholder="Meeting Date"></div>
                                    <div class="mb-3">
                                            <label for="addplace" class="form-label">Place</label>
                                            <input required name="place" type="text" class="form-control"
                                                id="addplace" placeholder="Place">
                                        </div>
                                        <div class="mb-3">
                                            <label for="addamount" class="form-label">Amount</label>
                                            <input required name="amount" type="number" class="form-control"
                                                id="addamount" placeholder="Amount">
                                        </div>
                                         
                                        <div class="mb-3">
                                            <select required name="status" class="form-control"
                                                id="addstatus">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>  
                                            </select>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">  
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="usersModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header bg-dark text-white">
                <div>
                    <h5 class="mb-0">👥 Registered Users</h5>
                    <small class="text-muted">Meeting participants list</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- BODY -->
            <div class="modal-body bg-light">

              <div class="row mb-3">
    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <h6>Total Users</h6>
                <h4 id="userCount">0</h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center shadow-sm border-success">
            <div class="card-body">
                <h6>Paid Amount</h6>
                <h4 class="text-success">₹ <span id="paidAmount">0</span></h4>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center shadow-sm border-warning">
            <div class="card-body">
                <h6>Unpaid Amount</h6>
                <h4 class="text-warning">₹ <span id="unpaidAmount">0</span></h4>
            </div>
        </div>
    </div>
</div>

                <div class="table-responsive bg-white rounded shadow-sm">
                    <table  id="usersTable" class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Mobile</th>
                                <th>Meeting Place</th>
                                <th>Photo</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Date</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody">
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="spinner-border text-primary"></div>
                                    <div>Loading...</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



@endsection
@push('page_scripts')
    <script>
      
        
         function edit_meeting(id, title, meetingdate, place, amount) {
                $("#edittitle").val(title);
                $("#editmeetingdate").val(meetingdate);
                $("#editplace").val(place);
                $("#editamount").val(amount);
                $("#meetingid").val(id);
                $("#editmeeting").modal("show");
          }

         let usersTable;

function viewUsers(meetingId) {
    $('#usersModal').modal('show');

    $('#usersTableBody').html(`
        <tr>
            <td colspan="7" class="text-center py-5">
                <div class="spinner-border text-primary"></div>
            </td>
        </tr>
    `);

    fetch(`/meeting/${meetingId}/users`)
        .then(res => res.json())
        .then(res => {

            // COUNTS
            $('#userCount').text(res.count);
            $('#paidAmount').text(res.paid_amount);
            $('#unpaidAmount').text(res.unpaid_amount);

            let html = '';

            if (res.users.length === 0) {
                html = `<tr><td colspan="7" class="text-center">No registrations</td></tr>`;
            } else {
                res.users.forEach((u, i) => {
                   let photo = u.photo
        ? `<a href="/storage/${u.photo}" target="_blank" class="btn btn-sm btn-info">View</a>`
        : '-';
                    html += `
                        <tr>
                            <td>${i + 1}</td>
                            <td>${u.name}</td>
                            <td>${u.username ?? '-'}</td>
                            <td>${u.mobile}</td>
                            <td>${u.meeting_address}</td>
                            <td>${photo}</td>
                            <td>₹ ${u.amount}</td>
                            <td>
                                <span class="badge bg-${u.paymentstatus === 'SUCCESS' ? 'success' : 'warning'}">
                                    ${u.paymentstatus}
                                </span>
                            </td>
                            <td>${new Date(u.created_at).toLocaleDateString()}</td>
                            <td>
${u.paymentstatus === 'SUCCESS'
? (u.attendance_status === 'IN'
    ? `<button class="btn btn-sm btn-danger attendance-btn" data-id="${u.id}">
        OUT
      </button>`
    : `<button class="btn btn-sm btn-success attendance-btn" data-id="${u.id}">
        IN
      </button>`
)
: `<span class="text-muted">Not Paid</span>`
}
</td>
                        </tr>
                    `;
                });
            }

            $('#usersTableBody').html(html);

            // DESTROY OLD DATATABLE
            if ($.fn.DataTable.isDataTable('#usersTable')) {
                $('#usersTable').DataTable().destroy();
            }

            // INIT DATATABLE
            usersTable = $('#usersTable').DataTable({
                pageLength: 10,
                lengthChange: false,
                ordering: true,
                searching: true
            });

        });
}

$(document).on('click','.attendance-btn',function(){

    let meetingid = $(this).data('id');
    let btn = $(this);

    $.ajax({
        url:'/attendance/update',
        type:'POST',
        data:{
            meetingid:meetingid,
            _token:'{{ csrf_token() }}'
        },
        success:function(res){
            if(res.attendance === 'IN'){
                btn.removeClass('btn-success')
                   .addClass('btn-danger')
                   .text('OUT');
            }else{
                btn.removeClass('btn-danger')
                   .addClass('btn-success')
                   .text('IN');
            }

        }
    });

});

    </script>
@endpush
