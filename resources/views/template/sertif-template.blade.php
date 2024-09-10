<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Arial', sans-serif;
            text-align: center;
            position: relative;
        }

        .certificate-container {
            width: 100%;
            height: 100vh;
            background-image: url('{{ public_path('/sassets/images/sertifcok.png') }}');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .content {
            padding-top: 150px;
            color: #000;
        }

        .title {
            font-size: 40px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #2C3E50;
        }

        .subtitle {
            font-size: 30px;
            color: #3498DB;
        }

        .recipient {
            font-size: 28px;
            margin-top: 40px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .description {
            font-size: 18px;
            width: 80%;
            margin: 0 auto;
            line-height: 1.6;
        }

        .signatures {
            margin-top: 50px;
            display: block;
            width: 100%;
        }

        .signature {
            display: inline-block;
            width: 45%;
            text-align: center;
        }

        .signature img {
            width: 150px;
        }

        .signature-title {
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold;
        }

        /* Logo styling for the top-right corner */
        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 150px; /* Adjust size */
        }
    </style>
</head>
<body>

<div class="certificate-container">
    <!-- Logo in the top-right corner -->
    <img src="{{ public_path('assets/images/logo.png') }}" alt="Logo" class="logo">

    <div class="content">
        <div class="title">CERTIFICATE</div>
        <div class="subtitle">OF COURSE {{ $kelas_name }}</div>
        <div class="recipient">{{ $name }}</div>
        <div class="description">
            This certifies that {{ $name }} has successfully completed the course on <strong>{{ $kelas_name }}</strong>.
            Your dedication, skills, and persistence have been exemplary in achieving all course challenges.
        </div>
    </div>

    <div class="signatures">
        <div class="signature">
            <img src="{{ public_path('assets/images/fadhel_signature.png') }}" alt="Fadhel Naufal A">
            <div class="signature-title">Fadhel Naufal A</div>
            <div class="signature-title">Edmon</div>
        </div>
        <div class="signature">
            <img src="{{ public_path('assets/images/adifitya_signature.png') }}" alt="Adifitya Bayu">
            <div class="signature-title">Adifitya Bayu</div>
            <div class="signature-title">Edmon</div>
        </div>
    </div>
</div>

</body>
</html>
