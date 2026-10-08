<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $meeting->title }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        }

        .meeting-card {
            max-width: 720px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(14px);
            border-radius: 22px;
            padding: 30px;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .45);
            color: #fff;
        }

        .meeting-header {
            text-align: center;
            padding: 25px;
            border-radius: 18px;
            background: linear-gradient(135deg, #1d2671, #c33764);
            margin-bottom: 30px;
        }

        .meeting-header h3 {
            font-weight: 800;
            margin-bottom: 8px;
        }

        .meeting-header span {
            font-size: 14px;
            opacity: .9;
        }

        .form-section {
            margin-bottom: 25px;
        }

        .form-section-title {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #ffd369;
            margin-bottom: 10px;
        }

        .form-control {
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            color: #fff;
            border-radius: 12px;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, .2);
            border-color: #ffd369;
            box-shadow: none;
            color: #fff;
        }

        .fee-box {
            background: linear-gradient(135deg, #ff9a9e, #fad0c4);
            color: #000;
            text-align: center;
            padding: 14px;
            border-radius: 16px;
            font-weight: 700;
            font-size: 18px;
        }

        .btn-register {
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            border: none;
            border-radius: 16px;
            padding: 14px;
            font-size: 17px;
            font-weight: 700;
            color: #fff;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, .4);
        }

        .back-btn {
            background: rgba(255, 255, 255, .18);
            border: none;
            color: #fff;
            padding: 8px 18px;
            border-radius: 20px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="meeting-card">

        <!-- BACK BUTTON -->
        <button onclick="history.back()" class="back-btn mb-3">← Back</button>

        <!-- HEADER -->
        <div class="meeting-header">
            <h3>ENTRY PASS</h3>
            {{-- <span>
                {{ \Carbon\Carbon::parse($meeting->meetingdate)->format('d F Y') }}
                • {{ $meeting->place }}
            </span> --}}
        </div>

        {{-- ================= ALREADY REGISTERED ================= --}}
        @if ($isRegistered)

            @if ($isRegistered->paymentstatus == 'SUCCESS')

                <div class="alert alert-success fw-bold text-center">
                    ✅ You are already registered for this meeting
                </div>

                <div class="form-section">
                    <div class="form-section-title">Meeting Location</div>
                    <div class="p-3 rounded bg-light text-dark fw-semibold">
                        📍 {{ $meeting->place }}
                    </div>
                </div>

                <a target="_blank"
                    href="https://www.google.com/maps/search/?api=1&query={{ urlencode($meeting->place) }}"
                    class="btn btn-success w-100 mb-3">
                    📍 Open Location in Google Maps
                </a>

                <a href="{{ route('meeting.pass.download', $meeting->id) }}" target="_blank"
                    class="btn btn-register w-100">
                    ⬇ Download Meeting Pass
                </a>

                <a href="javascript:void(0)" class="btn btn-outline-primary w-100 mt-2" onclick="toggleEditForm()">
                    ✏ Update Name / Photo
                </a>

                <div id="editForm" style="display:none;" class="mt-3">

                    <form method="POST" action="{{ route('meeting.update.details') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="meeting_id" value="{{ $isRegistered->id }}">

                        <input type="hidden" name="old_photo" value="{{ $isRegistered->photo }}">


                        <div class="form-section">
                            <div class="form-section-title">Update Details</div>

                            {{-- NAME --}}
                            <input type="text" class="form-control mb-3" name="name"
                                value="{{ $isRegistered->name }}" required>

                            {{-- MOBILE --}}
                            <input type="text" class="form-control mb-3" name="mobile"
                                value="{{ $isRegistered->mobile }}" required>


                            <div class="form-section">
                                <label class="form-section-title">Meeting Place</label>
                                <select class="form-control" name="meeting_place" required>
                                    <option value="">Select</option>
                                    <option {{ $isRegistered->meeting_place == 'Thanjavur' ? 'selected' : '' }}
                                        value="Thanjavur">
                                        Thanjavur->08-05-2026(Friday)</option>
                                    <option {{ $isRegistered->meeting_place == 'Mettupalayam' ? 'selected' : '' }}
                                        value="Mettupalayam">
                                        Mettupalayam->10-05-2026(Sunday)</option>
                                </select>
                            </div>

                            {{-- PHOTO --}}
                            @if ($isRegistered->photo)
                                <div class="mb-3 text-center">
                                    <label class="fw-bold">Current Photo</label><br>

                                    <img src="{{ asset('storage/' . $isRegistered->photo) }}"
                                        style="width:120px;height:120px;object-fit:cover;border-radius:8px;">
                                </div>
                            @endif

                            <label>Change Photo</label>
                            <input type="file" class="form-control mb-3" name="photo" accept="image/*">



                            <div class="row">

                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Save Changes
                                    </button>
                                </div>

                                <div class="col-6">
                                    <button type="button" class="btn btn-secondary w-100" onclick="closeEditForm()">
                                        Close
                                    </button>
                                </div>

                            </div>

                        </div>

                    </form>

                </div>


                {{-- ================= PAYMENT PENDING ================= --}}
            @elseif($isRegistered->paymentstatus == 'PENDING')
                <div class="alert alert-info fw-bold text-center">
                    ⏳ Payment is being verified.
                    <br>
                    Please wait up to 10 minutes.
                    <br><br>
                    Do NOT refresh or pay again.
                </div>

                <div class="text-center">
                    <button class="btn btn-secondary w-100" disabled>
                        Payment Verification in Progress...
                    </button>
                </div>


                {{-- ================= PAYMENT FAILED ================= --}}
            @elseif($isRegistered->paymentstatus == 'FAILED')
                <div class="alert alert-danger fw-bold text-center">
                    ❌ Payment Failed. Please try again.
                </div>

                <form method="POST" action="{{ route('meeting.pay') }}">
                    @csrf
                    <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                    <input type="hidden" name="amount" value="{{ $meeting->amount }}">

                    <input type="text" class="form-control mb-3" name="name"
                        value="{{ $isRegistered->name ?? Auth::user()->full_name }}" required placeholder="Full Name">

                    <input type="number" class="form-control mb-3" name="mobile"
                        value="{{ $isRegistered->mobile ?? Auth::user()->phone }}" required maxlength="15"
                        placeholder="Mobile Number">

                    <button type="submit" class="btn btn-danger w-100">
                        🔁 Retry Payment
                    </button>
                </form>

            @endif

            {{-- ================= NOT REGISTERED ================= --}}
        @else
            <form method="POST" action="{{ route('meeting.pay') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="meeting_id" value="{{ $meeting->id }}">
                <input type="hidden" name="amount" value="{{ $meeting->amount }}">

                <div class="form-section">
                    <div class="form-section-title">Personal Details</div>

                    <input type="text" class="form-control mb-3" name="name" value="{{ Auth::user()->name }}"
                        placeholder="Full Name" required>

                    <input type="number" class="form-control mb-3" name="mobile"
                        value="{{ Auth::user()->mobile }}" placeholder="Mobile Number" required>

                    <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                </div>

                <div class="form-section">
                    <label class="form-section-title">Meeting Place</label>
                    <select class="form-control" name="meeting_place" id="meeting_place" required
                        onchange="showAddress()">
                        <option value="">Select</option>

                        <option value="Thanjavur">
                            Thanjavur->09-05-2026(Saturday)
                        </option>

                        <option value="Mettupalayam">
                            Mettupalayam->10-05-2026(Sunday)
                        </option>
                    </select>
                </div>

                <!-- 🔽 ADDRESS SHOW -->
                <div id="addressBox" style="margin-top:10px; font-weight:500; color:#333;"></div>

                <input type="hidden" name="meeting_address" id="meeting_address">


                <div class="form-section">
                    <div class="form-section-title">Upload Photo ID</div>
                    <input type="file" class="form-control" name="photo" accept="image/*" required>
                </div>

                <div class="fee-box mb-4">
                    Fees : ₹{{ $meeting->amount }}
                </div>

                <button type="submit" class="btn btn-register w-100">
                    Register for Training Programme
                </button>
            </form>

        @endif

    </div>
    <script>
        function toggleEditForm() {
            var form = document.getElementById("editForm");
            form.style.display = (form.style.display === "none") ? "block" : "none";
        }

        function closeEditForm() {
            document.getElementById("editForm").style.display = "none";
        }

        function showAddress() {
            let place = document.getElementById("meeting_place").value;
            let addressBox = document.getElementById("addressBox");
            let addressInput = document.getElementById("meeting_address");

            if (place === "Thanjavur") {

                let address = "Shri Besant Lodge, Opp. Jupiter Theatre, Anna Salai, Near old bus stand, Thanjavur";

                addressBox.innerHTML = `
<b>Place:</b> ${address} <br>
<b>Landmark:</b> Opp. Jupiter Theatre
`;

                addressInput.value = address; // ✅ important
            } else if (place === "Mettupalayam") {

                let address = "25-2-104A, Kendaiyur Road, Kattoor, Mettupalayam - 641305, Near Kattoor Pallivasal";

                addressBox.innerHTML = `
<b>Address:</b> ${address} <br>
<b>Landmark:</b> Near Kattoor Pallivasal
`;

                addressInput.value = address; // ✅ fix
            } else {
                addressBox.innerHTML = "";
                addressInput.value = "";
            }
        }

        // page load
        window.onload = function() {
            showAddress();
        };
    </script>
</body>

</html>
