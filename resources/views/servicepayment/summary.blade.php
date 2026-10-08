@extends('layouts.app')

@section('content')
<style>
    .table-responsive {
        max-height: 500px;
        overflow-y: auto;
    }

    .message-cell {
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<div class="container">
    <h2 class="mb-4">Service Payment Summary (All Websites)</h2>

    <!-- Progress Section -->
    <div class="mb-4">
        <h5>Overall Progress</h5>
        <div class="progress" style="height: 30px; border-radius: 10px; overflow: hidden;">
            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                role="progressbar" style="width: 0%">0%</div>
        </div>
        <small id="progressText" class="text-muted">0 / 0 sites completed</small>
    </div>

    <!-- Responsive Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle" id="summaryTable">
            <thead class="table-dark">
                <tr>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Retries</th>
                    <th>Message</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection

@push('page_scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#summaryTable').DataTable({
            "order": [
                [0, "asc"]
            ],
            "columnDefs": [{
                "orderable": false,
                "targets": [1, 2, 4]
            }],
            "pageLength": 10,
            "lengthChange": false
        });

        function loadLogs() {
            $.get("{{ url('/payment/logs') }}")
                .done(function(response) {
                    if (!response || !response.status) {
                        console.error('Error fetching logs:', response?.message || 'Unknown error');
                        return;
                    }

                    const data = response.data;
                    table.clear();

                    data.forEach(log => {
                        let statusBadge, rowClass;

                        if (log.status === 'success') {
                            statusBadge = `<span class="badge bg-success"><i class="bi bi-check-circle"></i> SUCCESS</span>`;
                            rowClass = 'table-success';
                        } else if (log.status === 'failed') {
                            statusBadge = `<span class="badge bg-danger"><i class="bi bi-x-circle"></i> FAILED</span>`;
                            rowClass = 'table-danger';
                        } else {
                            statusBadge = `<span class="badge bg-secondary">
                                       <div class="spinner-border spinner-border-sm text-light"></div> PENDING
                                   </span>`;
                            rowClass = '';
                        }

                        let typeBadge = log.type ? `<span class="badge bg-info"><i class="bi bi-info-circle"></i> ${log.type}</span>` : '';

                        let message = (log.response ?? '').replace(/\n/g, ' ');
                        let newRow = table.row.add([
                            log.website,
                            statusBadge,
                            typeBadge,
                            log.retries,
                            `<div class="message-cell">${message}</div>`,
                            log.created_at
                        ]);
                        if (rowClass) {
                            $(newRow.node()).addClass(rowClass);
                        }
                    });

                    table.draw();

                    // Update progress bar
                    let total = data.length;
                    let completed = data.filter(l => l.status === 'success').length;
                    let percent = total ? Math.round((completed / total) * 100) : 0;

                    $('#progressBar').css('width', percent + '%').text(percent + '%');
                    $('#progressText').text(`${completed} / ${total} sites completed`);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown, jqXHR.responseText);
                });
        }

        // Initial load
        loadLogs();

        // Refresh every 5 seconds
        setInterval(loadLogs, 5000);
    });
</script>
@endpush