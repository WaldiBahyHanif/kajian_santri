<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Peringatan - {{ $student->name }}</title>
    <style>
        @page {
            margin: 1.5cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 13px;
            line-height: 1.5;
            color: #000;
        }
        .page {
            page-break-after: always;
            position: relative;
            min-height: 25cm;
        }
        .page:last-child {
            page-break-after: avoid;
        }
        /* Kop Surat */
        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 4px double #000;
            padding-bottom: 5px;
        }
        .kop-logo {
            width: 34%;
            text-align: center;
        }
        .kop-logo img {
            height: 85px;
            width: auto;
        }
        .kop-left {
            width: 33%;
            font-size: 13px;
            line-height: 1.25;
            text-align: left;
        }
        .kop-left-brand {
            font-size: 19px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .kop-right {
            width: 33%;
            direction: rtl;
            text-align: right;
            line-height: 1.35;
            font-family: 'DejaVu Sans', sans-serif;
        }
        .kop-right-brand {
            font-size: 19px;
            font-weight: bold;
        }
        .kop-right-sub {
            font-size: 11.5px;
        }
        .kop-address {
            font-size: 10px;
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
            font-family: Arial, sans-serif;
            text-transform: uppercase;
        }
        
        /* Titles */
        .title-sp {
            text-align: center;
            margin-top: 25px;
            margin-bottom: 20px;
        }
        .title-sp h2 {
            font-size: 15px;
            font-weight: bold;
            text-decoration: underline;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Details Table */
        .details-table {
            margin-top: 10px;
            margin-bottom: 15px;
            width: 100%;
        }
        .details-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        
        /* Grid / Rincian Table */
        .rincian-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .rincian-table th, .rincian-table td {
            border: 1px solid #000;
            padding: 6px 10px;
            text-align: left;
        }
        .rincian-table th {
            font-weight: bold;
        }
        .rincian-center {
            text-align: center;
        }
        
        /* Content layout */
        p.content-text {
            text-align: justify;
            text-indent: 0;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        
        /* Signatures block */
        .signature-container {
            margin-top: 40px;
            width: 100%;
        }
        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }
        .signature-table td {
            width: 50%;
            vertical-align: top;
            text-align: center;
        }
        .signature-space {
            height: 70px;
        }
        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }
        
        /* Appendix Styles */
        .appendix-title {
            margin-top: 20px;
            margin-bottom: 25px;
        }
        .appendix-title h2 {
            font-size: 15px;
            font-weight: bold;
            margin: 0;
        }
        .consequence-list {
            padding-left: 20px;
            margin-top: 5px;
            margin-bottom: 15px;
        }
        .consequence-list li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <!-- PAGE 1: SURAT PERINGATAN -->
    <div class="page">
        <!-- Kop Surat -->
        <table class="kop-table">
            <tr>
                <td class="kop-left">
                    Pondok Pesantren<br>
                    Mahasiswa<br>
                    <span class="kop-left-brand">DAARU HIRAA</span>
                </td>
                <td class="kop-logo">
                    <img src="{{ public_path('images/logo-daar-hira.png') }}" alt="Logo">
                </td>
                <td class="kop-right">
                    <span class="kop-right-brand">{!! $arabicText1 !!}</span><br>
                    <span class="kop-right-sub">{!! $arabicText2 !!}</span>
                </td>
            </tr>
        </table>
        <div class="kop-address">
            RT 03, RW 34, Malangrejo, Wedomartani, Ngemplak, Sleman, Yogyakarta, 55584 Email: daaruhiraa2017@gmail.com
        </div>

        <!-- Title -->
        <div class="title-sp">
            <h2>Surat Peringatan {{ $spNumberRoman }}</h2>
        </div>

        <!-- Opening -->
        <p>Surat Peringatan tahap {{ $spNumberIndonesian }} ini ditujukan kepada santri :</p>

        <!-- Student Info -->
        <table class="details-table" style="width: 50%;">
            <tr>
                <td style="width: 30%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="font-weight: bold;">{{ $student->name }}</td>
            </tr>
            <tr>
                <td>Angkatan</td>
                <td>:</td>
                <td>{{ $student->generation ?? '-' }}</td>
            </tr>
        </table>

        <!-- Body 1 -->
        <p class="content-text">
            Dengan ini Musyrif PPM Daaru Hiraa memberikan <strong>Surat Peringatan tahap {{ $spNumberIndonesian }} (SP {{ $spNumber }})</strong> kepada santri dengan nama di atas. Hal ini berdasarkan pada evaluasi dan monitoring kehadiran kehadiran kajian dengan rincian sebagai berikut,
        </p>

        <!-- Table Rincian -->
        <table class="rincian-table">
            <thead>
                <tr>
                    <th style="width: 5%; text-align: center;">No.</th>
                    <th style="width: 75%;">Rincian Kehadiran</th>
                    <th style="width: 20%; text-align: center;">Persentase</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1.</td>
                    <td>Kehadiran kajian selama bulan {{ $periodLabel }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $percentage }} %</td>
                </tr>
            </tbody>
        </table>

        <!-- Body 2 -->
        <p class="content-text">
            Surat Peringatan ini diterbitkan karena santri dengan nama di atas mengikuti kajian <strong>kurang dari batas minimal kehadiran dalam satu bulan, yaitu {{ $threshold }}%</strong>. Santri di atas hanya hadir {{ $percentage }}% dari total kajian pada bulan {{ $periodLabel }}, sehingga perlu diberikan peringatan melalui surat ini. Diharapkan surat ini menjadi pedoman bagi santri yang bersangkutan untuk memperbaiki diri dan meningkatkan kedisiplinan kedepannya.
        </p>

        <p class="content-text">
            Demikian surat peringatan ini kami sampaikan, untuk bisa dijadikan pedoman sebagaimana mestinya.
        </p>

        <!-- Signatures -->
        <div class="signature-container">
            <table class="signature-table">
                <tr>
                    <td>
                        Mengetahui.<br>
                        Pengasuh PPM Daaru Hiraa
                        <div class="signature-space"></div>
                        <span class="signature-name">{{ $pengasuhName }}</span>
                    </td>
                    <td>
                        Yogyakarta, {{ $yogyakartaDate }}<br>
                        Mas'ul Musyrif PPM Daaru Hiraa
                        <div class="signature-space"></div>
                        <span class="signature-name">{{ $musyrifName }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- PAGE 2: LAMPIRAN CONCEQUENCES -->
    <div class="page">
        <!-- Title Appendix -->
        <div class="appendix-title">
            <h2>Lampiran: Surat Konsekuensi</h2>
        </div>

        <!-- Opening Appendix -->
        <p>Sebagai tindak lanjut dari Surat Peringatan {{ $spNumberRoman }} (SP{{ $spNumber }}) kepada santri :</p>

        <!-- Student Info Appendix -->
        <table class="details-table" style="width: 50%;">
            <tr>
                <td style="width: 30%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="font-weight: bold;">{{ $student->name }}</td>
            </tr>
            <tr>
                <td>Angkatan</td>
                <td>:</td>
                <td>{{ $student->generation ?? '-' }}</td>
            </tr>
        </table>

        <!-- Body Appendix -->
        <p class="content-text">
            Bahwa santri yang bersangkutan diwajibkan untuk bertemu langsung dengan Mudir Pondok sebagai bentuk konsekuensi dari peringatan ini, dengan tujuan:
        </p>

        <ol class="consequence-list">
            <li>Mendapatkan arahan dan nasihat.</li>
            <li>Menerima bimbingan dalam memperbaiki kedisiplinan.</li>
            <li>Menata kembali sikap dalam mengikuti seluruh kegiatan pondok.</li>
        </ol>

        <p class="content-text">
            Surat konsekuensi ini dibuat agar dapat diperhatikan dan dilaksanakan dengan sebaik-baiknya.
        </p>

        <!-- Signature Appendix -->
        <div class="signature-container" style="margin-top: 60px;">
            <table class="signature-table">
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 50%;">
                        Yogyakarta, {{ $yogyakartaDate }}<br>
                        Pengasuh PPM Daaru Hiraa
                        <div class="signature-space"></div>
                        <span class="signature-name">{{ $pengasuhName }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>
