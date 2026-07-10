<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekap Kehadiran Mingguan - {{ $startOfWeekFormatted }} s.d. {{ $endOfWeekFormatted }}</title>
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
        .cell-h { background-color: #d1fae5; color: #065f46; }
        .cell-i { background-color: #fef3c7; color: #92400e; }
        .cell-a { background-color: #fee2e2; color: #991b1b; }
        .cell-s { background-color: #dbeafe; color: #1e40af; }
        .cell-none { background-color: #f3f4f6; color: #9ca3af; }
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

    <h2>REKAP KEHADIRAN MINGGUAN</h2>
    <h1>PONDOK PESANTREN Daaru Hiraa</h1>
    <p class="subtitle">Minggu: {{ $startOfWeekFormatted }} s.d. {{ $endOfWeekFormatted }} | KBM: {{ $totalKBMDays }} HARI</p>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%; text-align: left; padding-left: 5px;">Nama Santri</th>
                @foreach($weekDays as $dayInfo)
                    <th>
                        <div>{{ $dayInfo['day_name'] }}</div>
                        <div style="font-size: 8px; font-weight: normal;">{{ $dayInfo['date_formatted'] }}</div>
                    </th>
                @endforeach
                <th style="width: 7%;">JML</th>
                <th style="width: 8%;">%</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    <td>{{ $row['no'] }}</td>
                    <td class="name-col">{{ $row['name'] }}</td>
                    @foreach($weekDays as $dayInfo)
                        @php
                            $status = $row['statuses'][$dayInfo['date']];
                            $class = 'cell-none';
                            $display = '-';
                            if ($status === 'H') { $class = 'cell-h'; $display = '✓'; }
                            elseif ($status === 'I') { $class = 'cell-i'; $display = 'I'; }
                            elseif ($status === 'A') { $class = 'cell-a'; $display = '✗'; }
                            elseif ($status === 'S') { $class = 'cell-s'; $display = 'S'; }
                        @endphp
                        <td class="{{ $class }}">{{ $display }}</td>
                    @endforeach
                    <td style="font-weight: bold;">{{ $row['total_hadir'] }}</td>
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
        Hari KBM: {{ $totalKBMDays }} &nbsp;&nbsp;|&nbsp;&nbsp;
        Rata-Rata Kehadiran: 
        @php
            $avgPct = count($rows) > 0 ? round(collect($rows)->avg('percentage')) : 0;
        @endphp
        {{ $avgPct }}%
    </div>

</body>
</html>
