<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
     <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <title>pkrmsolution.com</title>
</head>

<body onload="info_noti()">

    <div id="layout-wrapper">
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
            </div>

            @include('layouts.footer')

        </div>
    </div>
    <div class="rightbar-overlay"></div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/js/chart.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparkline-charts/jquery.sparkline.min.js') }}"></script>
    <!--notification js -->
    <script src="{{ asset('assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('assets/js/index3.js') }}"></script>
    <!--app JS-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    @stack('page_scripts')
    <script>

        $(document).ready(function() {
            var table = $('#example2').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'print']
            });

            table.buttons().container()
                .appendTo('#example2_wrapper .col-md-6:eq(0)');
        });

        $(document).ready(function() {
            var status = $("#statuscheck").val();
            if (status == "Inactive") {
                $('#myModal').modal("show")({
                    backdrop: 'static',
                    keyboard: false
                });
            } else if (status == "Active") {
                $('#paidstatuscheck').modal("hide");
            }
        });

        $('.copy_text').click(function(e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            toastr.success('Link Copied Successfully');
        });

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
                    console.log(res);
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


<!-- Mirrored from codervent.com/rocker/demo/vertical/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 11 Aug 2025 05:15:03 GMT -->

</html>
