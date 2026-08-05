<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        h3 { text-align: center; margin-bottom: 2px; }
        p.subtitle { text-align: center; margin-top: 0; color: #555; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 5px 8px; text-align: left; }
        th { background-color: #2563EB; color: #fff; }
    </style>
</head>
<body>
    <h3>LAPORAN DATA GURU</h3>
    <p class="subtitle">SD Negeri 15 Batipuh - Dicetak pada {{ now()->format('d-m-Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th><th>NIP</th><th>Nama</th><th>JK</th><th>Tempat, Tgl Lahir</th><th>Jabatan</th><th>No HP</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guru as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->tempat_lahir }}, {{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d-m-Y') : '-' }}</td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>