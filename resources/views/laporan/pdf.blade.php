<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Artikel - {{ $bulan }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info {
            margin-bottom: 20px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .data-table th,
        .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN ARTIKEL E-MAGAZINE</h1>
        <p>Bakti Nusantara 666</p>
        <p>Periode: {{ \Carbon\Carbon::parse($bulan)->format('F Y') }}</p>
        <p>Kategori: {{ $kategoriName }}</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td><strong>Total Artikel:</strong></td>
                <td>{{ $artikels->count() }} artikel</td>
                <td><strong>Total Like:</strong></td>
                <td>{{ $artikels->sum(function($a) { return $a->likes->count(); }) }} like</td>
            </tr>
            <tr>
                <td><strong>Total Komentar:</strong></td>
                <td>{{ $artikels->sum(function($a) { return $a->komentars->count(); }) }} komentar</td>
                <td><strong>Tanggal Cetak:</strong></td>
                <td>{{ now()->format('d/m/Y H:i') }}</td>
            </tr>
        </table>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Kategori</th>
                <th>Tanggal</th>
                <th>Like</th>
                <th>Komentar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($artikels as $artikel)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $artikel->judul }}</td>
                <td>{{ $artikel->user->name }}</td>
                <td>{{ $artikel->kategori->nama ?? 'Umum' }}</td>
                <td>{{ $artikel->created_at->format('d/m/Y') }}</td>
                <td>{{ $artikel->likes->count() }}</td>
                <td>{{ $artikel->komentars->count() }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">
                    Tidak ada data artikel untuk periode ini
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y, H:i:s') }}</p>
        <p>E-Magazine Bakti Nusantara 666</p>
    </div>
</body>
</html>