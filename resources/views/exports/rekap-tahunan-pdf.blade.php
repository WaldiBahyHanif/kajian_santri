<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekap Kehadiran Santri - Tahunan {{ $year }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 5px;
            color: #003527;
        }
        p.subtitle {
            text-align: center;
            margin-top: 0;
            font-size: 10px;
            color: #666;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 5px 3px;
            text-align: center;
        }
        th {
            background-color: #003527;
            color: #fff;
            font-weight: bold;
        }
        td.name-col {
            text-align: left;
            padding-left: 5px;
        }
        .pct-high { background-color: #d1fae5; font-weight: bold; }
        .pct-mid { background-color: #fef3c7; font-weight: bold; }
        .pct-low { background-color: #fee2e2; font-weight: bold; }
        .footer-summary {
            font-size: 10px;
            text-align: right;
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>REKAP KEHADIRAN TAHUNAN</h2>
    <h1>PONDOK PESANTREN Daaru Hiraa</h1>
    <p class="subtitle">Tahun: {{ $year }}</p>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%; text-align: left; padding-left: 5px;">Nama Santri</th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Mar</th>
                <th>Apr</th>
                <th>Mei</th>
                <th>Jun</th>
                <th>Jul</th>
                <th>Agt</th>
                <th>Sep</th>
                <th>Okt</th>
                <th>Nov</th>
                <th>Des</th>
                <th>Hadir</th>
                <th>KBM</th>
                <th>Rata</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row['no'] }}</td>
                    <td class="name-col">{{ $row['name'] }}</td>
                    @for($m = 1; $m <= 12; $m++)
                        <td>{{ $row['months'][$m] }}</td>
                    @endfor
                    <td style="font-weight: bold;">{{ $row['total_hadir'] }}</td>
                    <td>{{ $row['total_kbm'] }}</td>
                    @php
                        $pctClass = $row['percentage'] >= 75 ? 'pct-high' : ($row['percentage'] >= 50 ? 'pct-mid' : 'pct-low');
                    @endphp
                    <td class="{{ $pctClass }}">{{ $row['percentage'] }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-summary">
        Total Santri: {{ count($rows) }} &nbsp;&nbsp;|&nbsp;&nbsp;
        Rata-Rata Kehadiran Tahunan: 
        @php
            $avgPct = count($rows) > 0 ? round(collect($rows)->avg('percentage')) : 0;
        @endphp
        {{ $avgPct }}%
    </div>

</body>
</html>
