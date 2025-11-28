<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tamu Undangan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .header p { margin: 5px 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #333; }
        th { background-color: #f2f2f2; padding: 8px; text-align: left; }
        td { padding: 6px; }
        .badge { padding: 2px 6px; border-radius: 4px; font-size: 10px; font-weight: bold; color: white; }
        .bg-green { background-color: #16a34a; }
        .bg-red { background-color: #dc2626; }
        .bg-yellow { background-color: #ca8a04; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Daftar Tamu Undangan</h2>
        <p>Acara Khitanan: {{ $event->child_name ?? '-' }}</p>
        <p>Tanggal Cetak: {{ date('d F Y, H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 30%">Nama Tamu</th>
                <th style="width: 25%">Nomor WA</th>
                <th style="width: 20%">Status</th>
                <th style="width: 20%">Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @foreach($guests as $index => $guest)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $guest->name }}</td>
                <td>{{ $guest->phone }}</td>
                <td style="text-align: center;">
                    @if($guest->status == 'hadir')
                        <span class="badge bg-green">Hadir</span>
                    @elseif($guest->status == 'tidak_hadir')
                        <span class="badge bg-red">Tidak Hadir</span>
                    @else
                        <span class="badge bg-yellow">Pending</span>
                    @endif
                </td>
                <td>{{ $guest->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>