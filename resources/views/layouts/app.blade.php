<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Pragadeesheservice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Newsite.co.in" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <link href="{{ asset('assets/libs/metrojs/release/MetroJs.Full/MetroJs.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Datatables Css -->

    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-topbar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">


        @include('layouts.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('layouts.sidebar')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                @yield('content')
                <div id="fullscreen-spinner" style="display: none;">
                    <div class="spinner-overlay">
                        <div class="spinner-border text-light" style="width: 4rem; height: 4rem;" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            @include('layouts.footer')

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.rightsidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!--Morris Chart-->

    <script src="{{ asset('assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metrojs/release/MetroJs.Full/MetroJs.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.4.4/qrcode.min.js"></script>

    @stack('page_scripts')
     <script>

        $('#customerOtpModal').on('shown.bs.modal', function () {
    $('#modal_user_otp').prop('disabled', false); // Enable validation when modal is visible
});

$('#customerOtpModal').on('hidden.bs.modal', function () {
    $('#modal_user_otp').prop('disabled', true); // Disable validation when modal is hidden
});

document.addEventListener("DOMContentLoaded", function () {
    let pendingQueue = [];
    let currentIndex = 0;
    let customerModalEl = document.getElementById('customerOtpModal');
    if (!customerModalEl) return;
    
    let customerModal = new bootstrap.Modal(customerModalEl);

    // Check if current user has pending OTP requirements
    fetch("{{ route('service.check-customer-otp') }}")
        .then(res => res.json())
        .then(data => {
            if (data.has_pending && data.services.length > 0) {
                pendingQueue = data.services;
                showNextModal();
            }
        });

    function showNextModal() {
        if (currentIndex < pendingQueue.length) {
            let item = pendingQueue[currentIndex];
            document.getElementById('modal_service_id').value = item.id;
            document.getElementById('modal_smartcard').value = item.smartcard_number;
            document.getElementById('modal_mobile').value = item.mobile;
            document.getElementById('modal_user_otp').value = '';
            document.getElementById('modal_user_otp').classList.remove('is-invalid');
            customerModal.show();
        } else {
            customerModal.hide();
            location.reload();
        }
    }

    // Customer submits OTP
    document.getElementById('customerOtpForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let serviceId = document.getElementById('modal_service_id').value;
        let otpVal = document.getElementById('modal_user_otp').value;
        let btn = document.getElementById('verifyOtpBtn');

        btn.disabled = true;
        btn.innerText = "Verifying...";

        fetch("{{ route('service.verify-customer-otp') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                service_id: serviceId,
                otp: otpVal
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                currentIndex++;
                showNextModal();
            } else {
                document.getElementById('customerOtpError').innerText = data.message || 'Invalid OTP';
                document.getElementById('modal_user_otp').classList.add('is-invalid');
                btn.disabled = false;
                btn.innerText = "Submit OTP";
            }
        })
        .catch(() => {
            alert('An error occurred.');
            btn.disabled = false;
            btn.innerText = "Submit OTP";
        });
    });
});
</script>
    <script>
 document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.modal').forEach(function(modal){

        const amountInput  = modal.querySelector('.amountInput');
        const payBtn       = modal.querySelector('.payBtn');
        const payBtnText   = modal.querySelector('.payBtnText');
        const payLoader    = modal.querySelector('.payLoader');
        const finalAmount  = modal.querySelector('.finalAmount');
        const onlineForm   = modal.querySelector('.onlinePaymentForm');
        const manualLink   = modal.querySelector('.switchToManual');
       const manualTabBtn = modal.querySelector('[data-bs-target*="manualTab"]');

        if (!amountInput || !payBtn || !onlineForm) return;

        // Quick amount buttons inside this modal
        modal.querySelectorAll('.quick-amount').forEach(btn => {
            btn.addEventListener('click', function () {

                modal.querySelectorAll('.quick-amount')
                    .forEach(b => b.classList.remove('active'));

                this.classList.add('active');
                amountInput.value = this.dataset.amount;
                validateAmount();
            });
        });

        function validateAmount() {
            let amount = parseInt(amountInput.value);

            if (isNaN(amount) || amount < 1) {
                payBtn.disabled = true;
                return false;
            }

            payBtn.disabled = false;
            finalAmount.value = amount;
            return true;
        }

        amountInput.addEventListener('input', function () {
            modal.querySelectorAll('.quick-amount')
                .forEach(b => b.classList.remove('active'));
            validateAmount();
        });

        onlineForm.addEventListener('submit', function (e) {

            if (!validateAmount()) {
                e.preventDefault();
                return;
            }

            payBtn.disabled = true;
            payBtnText.textContent = 'Processing...';
            payLoader.classList.remove('d-none');
        });

        if (manualLink && manualTabBtn) {
            manualLink.addEventListener('click', function (e) {
                e.preventDefault();
                new bootstrap.Tab(manualTabBtn).show();
            });
        }

    });

});

        $("datatable").DataTable();

        function duplicateaadhar(id) {
            var aadhaar_no = $("#aadhaar_no").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkaadhar') }}',
                data: {
                    id: id,
                    aadhaar_no: aadhaar_no,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupaadhar").html("aadhar no alredy exists!");
                    } else {
                        $("#dupaadhar").html("");
                    }
                    if ($("#dupphone").html() == "" && $("#dupaadhar").html() == "") {
                        $("#save").prop('disabled', false);
                    } else {
                        $("#save").prop('disabled', true);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        function duplicatephone(id) {
            var phone = $("#phone").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkphone') }}',
                data: {
                    id: id,
                    phone: phone,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupphone").html("mobile no alredy exists!");
                    } else {
                        $("#dupphone").html("");
                    }
                    if ($("#dupphone").html() == "" && $("#dupaadhar").html() == "") {
                        $("#save").prop('disabled', false);
                    } else {
                        $("#save").prop('disabled', true);
                    }
                },

                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        function duplicateemail(id) {
            var email = $("#email").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkemail') }}',
                data: {
                    id: id,
                    email: email,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#dupemail").html("email no alredy exists!");
                    } else {
                        $("#dupemail").html("");
                    }
                    if ($("#dupemail").html() == "" && $("#dupemail").html() == "") {
                        $("#save").prop('disabled', false);
                    } else {
                        $("#save").prop('disabled', true);
                    }
                },

                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        function duplicatepan(id) {
            var pan_no = $("#pan_no").val().trim();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "post",
                url: '{{ url('checkpan') }}',
                data: {
                    id: id,
                    pan_no: pan_no,
                    _token: _token
                },

                success: function(res) {
                    if (res.exists) {
                        $("#save").prop('disabled', true);
                        $("#duppan").html("pan no alredy exists!");
                    } else {
                        $("#duppan").html("");
                    }
                    if ($("#dupphone").html() == "" && $("#duppan").html() == "" && $("#duppan").html() ==
                        "") {
                        $("#save").prop('disabled', false);
                    } else {
                        $("#save").prop('disabled', true);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

        $('.number').keypress(function(event) {
            var keycode = event.which;
            if (!(event.shiftKey == false && (keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 &&
                    keycode <= 57)))) {
                event.preventDefault();
            }
        });
    </script>
<script>
        let debounceTimer = null;

        $(document).on('keyup change', '.dup-check', function() {

            let input = $(this);
            let value = input.val().trim();
            let field = input.data('field');
            let msgBox = input.siblings('.dup-msg');
            let loader = input.siblings('.loader');
            let saveBtn = $('#save');

            clearTimeout(debounceTimer);

            if (value.length < 3) {
                msgBox.text('');
                saveBtn.prop('disabled', false);
                return;
            }

            debounceTimer = setTimeout(() => {

                loader.removeClass('d-none');

                $.ajax({
                    url: "{{ url('check-duplicate') }}",
                    type: "POST",
                    data: {
                        field: field,
                        value: value,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res) {

                        loader.addClass('d-none');

                        if (res.exists) {
                            msgBox.text(field.replace('_', ' ') + ' already exists');
                            saveBtn.prop('disabled', true);
                        } else {
                            msgBox.text('');
                            checkAllDuplicates();
                        }
                    }
                });

            }, 500);
        });

        function checkAllDuplicates() {
            let hasError = false;
            $('.dup-msg').each(function() {
                if ($(this).text() !== '') {
                    hasError = true;
                }
            });
            $('#save').prop('disabled', hasError);
        }
    </script>
    <script>
        function shouldShowPopup() {
            const lastClosed = localStorage.getItem('headerPopupLastClosed');
            const now = new Date().getTime();

            // If never closed or 1 hour has passed since close
            if (!lastClosed || (now - parseInt(lastClosed)) > 60 * 60 * 1000) {
                return true;
            }

            return false;
        }

        function showHeaderPopup() {
            const alertBox = document.getElementById('headerAlert');
            alertBox.style.display = 'block';
        }

        function closeHeaderPopup() {
            const alertBox = document.getElementById('headerAlert');
            alertBox.style.display = 'none';

            // Store current time as "last closed"
            localStorage.setItem('headerPopupLastClosed', new Date().getTime());
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (shouldShowPopup()) {
                showHeaderPopup();
            }
        });

        function shouldShowPopup1() {
        const lastClosed = localStorage.getItem('headerPopupLastClosed1');
        const now = new Date().getTime();

        // If never closed OR 10 minutes have passed since last close
        if (!lastClosed || (now - parseInt(lastClosed)) > 10 * 60 * 1000) {
            return true;
        }

        return false;
    }

    function showHeaderPopup1() {
        const alertBox = document.getElementById('headerAlert1');
        if (alertBox) {
            alertBox.style.display = 'block';
        }
    }

    function closeHeaderPopup1() {
        const alertBox = document.getElementById('headerAlert1');
        if (alertBox) {
            alertBox.style.display = 'none';
        }

        // Save close time
        localStorage.setItem('headerPopupLastClosed1', new Date().getTime());
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Show immediately if needed
        if (shouldShowPopup1()) {
            showHeaderPopup1();
        }

        // Check every 1 minute if popup should reappear
        setInterval(function() {
            if (shouldShowPopup1()) {
                showHeaderPopup1();
            }
        }, 60 * 1000); // 60 sec
    });
    </script>
</body>

</html>
