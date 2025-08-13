<!doctype html>
<html lang="en" data-bs-theme="blue-theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pkrm Solutions</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/pkrm.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/mm-vertical.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}">
    <!--bootstrap css-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!--main css-->
    <link href="{{ asset('assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/semi-dark.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/bordered-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/sass/responsive.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/4.0.1/css/bootstrap-toaster.min.css"
        rel="stylesheet">

</head>

<body>

    <!--start header-->
    @include('layouts.header')
    <!--end top header-->


    <!--start sidebar-->
    @include('layouts.sidebar')
    <!--end sidebar-->

    <!--start main wrapper-->
    @yield('content')
    <div id="fullscreen-spinner" style="display: none;">
        <div class="spinner-overlay">
            <div class="spinner-border text-light" style="width: 4rem; height: 4rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div> <!--end main wrapper-->


    <!--bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>
    <script>
        $(".data-attributes span").peity("donut")
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard1.js') }}"></script>

    <script>
        new PerfectScrollbar(".user-list")
    </script>

    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toaster/4.0.1/js/bootstrap-toaster.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

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
    </script>
    <script>
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
                        $("#dupemail").html("email alredy exit!");
                    } else {
                        $("#save").prop('disabled', false);
                        $("#dupemail").html("");
                    }
                },

                error: function(jqXHR, exception) {
                    console.log(exception);
                }
            });
        }

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
                        $("#dupaadhar").html("aadhar no alredy exit!");
                    } else {
                        $("#save").prop('disabled', false);
                        $("#dupaadhar").html("");
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
    </script>
</body>

</html>
