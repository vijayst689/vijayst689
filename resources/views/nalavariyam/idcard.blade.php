@extends('layouts.app')
@section('content')
    <style>
        body {
            background: #edf4fa;
            font-family: 'Hind Madurai', sans-serif;
        }

        /* =========================
       CARD CONTAINER
    ========================= */

        .id-card {

            width: 860px;
            height: 540px;

            margin: auto;

            position: relative;

            overflow: hidden;

            border-radius: 20px;

            background: #fff;

            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* =========================
       BACKGROUND
    ========================= */

        .card-bg {

            position: absolute;

            left: 0;
            top: 0;

            width: 100%;
            height: 100%;

            object-fit: cover;

            z-index: 1;
        }

        /* =========================
       MEMBER PHOTO
    ========================= */

        .card-photo {

            position: absolute;

            top: 128px;

            right: 20px;

            width: 157px;
            height: 209px;

            object-fit: cover;

            border: 2px solid #4b1616;

            background: #fff;

            z-index: 3;

            image-rendering: -webkit-optimize-contrast;
            image-rendering: crisp-edges;
        }

        /* =========================
       SIGNATURE
    ========================= */

        .card-signature {

            position: absolute;

            right: 30px;

            bottom: 65px;

            width: 125px;

            height: 45px;

            object-fit: contain;


            z-index: 5;

            background: transparent;

            /* IMPORTANT */
            mix-blend-mode: multiply;

            /* REMOVE OLD FILTERS */
            filter: contrast(180%);

            opacity: 1;
        }

        /* =========================
       TEXT GRID
    ========================= */

        .info-grid {

            position: absolute;

            left: 55px;

            top: 178px;

            width: 530px;

            z-index: 3;

            display: flex;

            flex-direction: column;

            gap: 14px;
        }

        .info-row {

            display: flex;

            align-items: flex-start;

            line-height: 1.4;
        }

        .label {

            width: 175px;

            flex-shrink: 0;

            font-size: 17px;

            font-weight: 600;

            color: #111;
        }

        .colon {

            width: 25px;

            flex-shrink: 0;

            font-size: 17px;

            font-weight: 700;

            color: #000;
        }

        .value {

            font-size: 17px;

            font-weight: 700;

            color: #000;

            word-break: break-word;
        }

        /* =========================
       DOWNLOAD BUTTON
    ========================= */

        .download-btn {

            margin-top: 30px;

            background: #6d0d0d;

            color: #fff;

            border: none;

            padding: 12px 40px;

            border-radius: 8px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.2s;
        }

        .download-btn:hover {

            background: #4d0808;
        }

        .aadhaar-number {

            position: absolute;

            top: 350px;
            /* adjust if needed */
            right: 20px;

            width: 157px;

            text-align: center;

            font-size: 16px;

            font-weight: 700;

            letter-spacing: 2px;

            color: #000;

            z-index: 5;
        }
    </style>
    <div class="page-wrapper">
        <div class="id-card" id="card-front">

            <!-- BACKGROUND -->

            <img src="{{ asset('upload/idcard/front-design.png') }}" class="card-bg">

            <!-- PHOTO -->

            @if (!empty($member->photo) && file_exists(public_path('upload/nalavariyam_document/photo/' . $member->photo)))
                <img src="{{ asset('upload/nalavariyam_document/photo/' . $member->photo) }}" class="card-photo"
                    id="cardPhoto">
            @else
                <img src="data:image/svg+xml;utf8,
                <svg xmlns='http://www.w3.org/2000/svg' width='155' height='195'>
                <rect width='100%' height='100%' fill='%23efefef'/>
                <circle cx='77' cy='70' r='35' fill='%23bdbdbd'/>
                <path d='M25 160 C25 120 130 120 130 160' fill='%23bdbdbd'/>
                </svg>"
                    class="card-photo">
            @endif
            <div class="aadhaar-number">
                {{ !empty($member->aadhaar_no)
                    ? chunk_split(preg_replace('/\s+/', '', $member->aadhaar_no), 4, ' ')
                    : '---- ---- ----' }}
            </div>

            <!-- SIGNATURE -->

            @if (
                !empty($member->signature) &&
                    file_exists(public_path('upload/nalavariyam_document/signature/' . $member->signature)))
                <img src="{{ asset('upload/nalavariyam_document/signature/' . $member->signature) }}" class="card-signature"
                    id="cardSignature">
            @else
                <img src="data:image/svg+xml;utf8,
                <svg xmlns='http://www.w3.org/2000/svg' width='140' height='40'>
                <text x='50%' y='60%' text-anchor='middle'
                font-size='14'
                fill='%23999999'
                font-family='sans-serif'>
                SIGNATURE
                </text>
                </svg>"
                    class="card-signature">
            @endif

            <!-- DETAILS -->

            <div class="info-grid">

                <div class="info-row">
                    <div class="label">உறுப்பினர் எண்</div>
                    <div class="colon">:</div>
                    <div class="value">#RJ{{ $member->id ?? '---' }}</div>
                </div>

                <div class="info-row">
                    <div class="label">பெயர்</div>
                    <div class="colon">:</div>
                    <div class="value">{{ $member->name ?? '---' }}</div>
                </div>

                <div class="info-row">
                    <div class="label">பிறந்த தேதி</div>
                    <div class="colon">:</div>
                    <div class="value">
                        {{ !empty($member->dob) ? date('d/m/Y', strtotime($member->dob)) : '---' }}
                    </div>
                </div>

                <div class="info-row">
                    <div class="label">மாவட்டம்</div>
                    <div class="colon">:</div>
                    <div class="value">{{ $member->district_title ?? '---' }}</div>
                </div>

                <div class="info-row">
                    <div class="label">வட்டம்</div>
                    <div class="colon">:</div>
                    <div class="value">{{ $member->taluk_title ?? '---' }}</div>
                </div>

                <div class="info-row">
                    <div class="label">கைபேசி எண்</div>
                    <div class="colon">:</div>
                    <div class="value">{{ $member->phone ?? '---' }}</div>
                </div>

                <div class="info-row">
                    <div class="label">தொழில்</div>
                    <div class="colon">:</div>
                    <div class="value">{{ $displayWorkType ?? '---' }}</div>
                </div>

            </div>

        </div>

        <div class="text-center">

            <button class="download-btn" onclick="downloadPDF()">
                Download ID Card
            </button>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <!-- JSPDF -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        /* =========================
       DOWNLOAD PDF
    ========================= */


        async function makeSignatureTransparent(imgElement) {

            return new Promise((resolve) => {

                const image = new Image();

                image.crossOrigin = "anonymous";

                image.src = imgElement.src;

                image.onload = function() {

                    const canvas = document.createElement('canvas');

                    const ctx = canvas.getContext('2d');

                    canvas.width = image.width;
                    canvas.height = image.height;

                    ctx.drawImage(image, 0, 0);

                    const imageData = ctx.getImageData(
                        0,
                        0,
                        canvas.width,
                        canvas.height
                    );

                    const data = imageData.data;

                    for (let i = 0; i < data.length; i += 4) {

                        const r = data[i];
                        const g = data[i + 1];
                        const b = data[i + 2];

                        // AVERAGE COLOR
                        const avg = (r + g + b) / 3;

                        // REMOVE LIGHT PIXELS + GREY NOISE
                        if (avg > 180) {

                            data[i + 3] = 0;

                        } else {

                            // PURE BLACK SIGNATURE
                            data[i] = 0;
                            data[i + 1] = 0;
                            data[i + 2] = 0;

                            data[i + 3] = 255;
                        }
                    }

                    ctx.putImageData(imageData, 0, 0);

                    imgElement.src = canvas.toDataURL('image/png');

                    resolve();
                };

                image.onerror = function() {
                    resolve();
                };
            });
        }

        async function downloadPDF() {

            const card = document.getElementById('card-front');

            const signature = document.getElementById('cardSignature');

            // REMOVE BACKGROUND BEFORE PDF
            await makeSignatureTransparent(signature);

            const canvas = await html2canvas(card, {
                scale: 3,
                useCORS: true,
                backgroundColor: null
            });

            const imgData = canvas.toDataURL('image/png');

            const {
                jsPDF
            } = window.jspdf;

            const pdf = new jsPDF('l', 'mm', 'a4');

            pdf.addImage(
                imgData,
                'PNG',
                10,
                10,
                277,
                175
            );

            pdf.save('Member_ID_Card.pdf');
        }
    </script>
@endsection
