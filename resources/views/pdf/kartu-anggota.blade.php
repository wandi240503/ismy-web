<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Anggota - {{ $anggota->nomor_anggota }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 8px;
            background-color: #FBF7EE;
            color: #121c2a;
        }
        .card {
            border: 2.5px solid #0F4C3A;
            border-radius: 12px;
            padding: 12px 16px;
            background-color: #ffffff;
            position: relative;
        }
        .header {
            border-bottom: 2px solid #C9A227;
            padding-bottom: 6px;
            margin-bottom: 10px;
            display: table;
            width: 100%;
        }
        .header-logo {
            display: table-cell;
            width: 45px;
            vertical-align: middle;
        }
        .header-text {
            display: table-cell;
            vertical-align: middle;
            padding-left: 8px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            color: #003426;
            margin: 0;
            line-height: 1;
        }
        .subtitle {
            font-size: 8px;
            color: #755b00;
            margin: 2px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-weight: bold;
        }
        .body-content {
            display: table;
            width: 100%;
        }
        .photo-cell {
            display: table-cell;
            width: 70px;
            vertical-align: top;
        }
        .photo-img {
            width: 60px;
            height: 75px;
            border: 1.5px solid #C9A227;
            border-radius: 6px;
            object-fit: cover;
        }
        .info-cell {
            display: table-cell;
            vertical-align: top;
            padding-left: 6px;
        }
        .qr-cell {
            display: table-cell;
            width: 85px;
            text-align: right;
            vertical-align: top;
        }
        .name {
            font-size: 12px;
            font-weight: bold;
            color: #003426;
            margin-bottom: 3px;
            line-height: 1.2;
        }
        .detail {
            font-size: 9px;
            color: #334155;
            margin-bottom: 1.5px;
        }
        .badge {
            display: inline-block;
            background-color: #0F4C3A;
            color: #ffffff;
            font-size: 8px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 3px;
            margin-top: 4px;
        }
        .footer-text {
            font-size: 7.5px;
            color: #64748b;
            margin-top: 8px;
            text-align: center;
            border-top: 1px solid #cbd5e1;
            padding-top: 4px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <div class="header-logo">
                @if(file_exists(public_path('images/logo.png')))
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" width="40" height="40" alt="Logo">
                @endif
            </div>
            <div class="header-text">
                <h1 class="title">ISMI / ISMY D.I. YOGYAKARTA</h1>
                <p class="subtitle">Ikatan Sarjana Melayu Indonesia - Daerah Istimewa Yogyakarta</p>
            </div>
        </div>

        <div class="body-content">
            @if($anggota->foto && file_exists(public_path('storage/' . $anggota->foto)))
                <div class="photo-cell">
                    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('storage/' . $anggota->foto))) }}" class="photo-img" alt="Foto">
                </div>
            @endif

            <div class="info-cell">
                <div class="name">{{ $anggota->nama_lengkap }}</div>
                <div class="detail"><strong>No. KTA:</strong> {{ $anggota->nomor_anggota }}</div>
                <div class="detail"><strong>Keahlian:</strong> {{ $anggota->bidang_keahlian ?? 'Sarjana Melayu' }}</div>
                <div class="detail"><strong>Wilayah:</strong> {{ $anggota->wilayah->nama ?? 'D.I. Yogyakarta' }}</div>
                <span class="badge">ANGGOTA RESMI & AKTIF</span>
            </div>

            <div class="qr-cell">
                <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" width="75" height="75" alt="QR Code">
            </div>
        </div>

        <div class="footer-text">
            Kartu Tanda Anggota Resmi Ikatan Sarjana Melayu D.I. Yogyakarta. Pindai QR Code untuk Verifikasi Keaslian.
        </div>
    </div>
</body>
</html>
