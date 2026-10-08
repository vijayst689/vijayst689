<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Access Denied</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap (optional if already loaded globally) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* 🔒 BLOCK SCROLL */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .block-page {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 99999; /* 🔒 BLOCK EVERYTHING */
        }

        .block-card {
            background: rgba(0, 0, 0, 0.65);
            border-radius: 20px;
            padding: 50px 40px;
            text-align: center;
            max-width: 450px;
            width: 90%;
            box-shadow: 0 0 40px rgba(0,0,0,0.8);
        }

        .block-card h1 {
            color: #ff4d4d;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .block-card p {
            color: #ddd;
            font-size: 17px;
            margin-bottom: 30px;
        }

        .block-card .btn {
            min-width: 140px;
            margin: 5px;
        }

        .lock-icon {
            font-size: 70px;
            color: #ff4d4d;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="block-page">
    <div class="block-card">
        <div class="lock-icon">🔒</div>
        <h1>Access Denied</h1>
        <p>
            You do not have permission to access this service.<br>
            Please contact administrator or go back.
        </p>

        <a href="{{ url()->previous() }}" class="btn btn-outline-light">
            Go Back
        </a>

        <a href="{{ url('dashboard') }}" class="btn btn-danger">
            Dashboard
        </a>
    </div>
</div>

</body>
</html>