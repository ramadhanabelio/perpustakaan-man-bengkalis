<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Buku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }

        .header {
            position: relative;
            height: 90px;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: 65px;
        }

        .header .title {
            text-align: center;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
        }

        .header h3 {
            margin: 3px 0;
            font-size: 16px;
        }

        .header p {
            margin: 0;
            font-size: 12px;
        }

        .report-title {
            text-align: center;
            margin: 20px 0;
        }

        .report-title h4 {
            margin: 0;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background: #f2f2f2;
            text-align: center;
            padding: 8px;
        }

        td {
            padding: 6px;
        }

        .center {
            text-align: center;
        }

        .footer {
            margin-top: 40px;
            width: 100%;
        }

        .signature {
            width: 250px;
            float: right;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">

        <img src="{{ public_path('img/logo.png') }}">

        <div class="title">
            <h2>PERPUSTAKAAN MAN 1 BENGKALIS</h2>
            <h3>LAPORAN PEMINJAMAN BUKU</h3>
            <p>Bengkalis, Riau</p>
        </div>

    </div>

    <div class="report-title">
        <h4>
            Laporan Peminjaman Buku
        </h4>

        <p>
            Periode:
            {{ request('month') ? date('F', mktime(0, 0, 0, request('month'), 1)) : 'Semua Bulan' }}
            -
            {{ request('year') }}
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Peminjam</th>
                <th width="30%">Buku</th>
                <th width="15%">Tgl Pinjam</th>
                <th width="15%">Jatuh Tempo</th>
                <th width="10%">Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($borrowings as $i => $b)
                <tr>
                    <td class="center">{{ $i + 1 }}</td>

                    <td>
                        {{ $b->member?->user?->name ?? $b->guest_name }}
                    </td>

                    <td>
                        {{ $b->book->title }}
                    </td>

                    <td class="center">
                        {{ \Carbon\Carbon::parse($b->borrow_date)->format('d-m-Y') }}
                    </td>

                    <td class="center">
                        {{ \Carbon\Carbon::parse($b->due_date)->format('d-m-Y') }}
                    </td>

                    <td class="center">
                        {{ $b->status_label }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="footer">
        <div class="signature">

            <p>
                Bengkalis,
                {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            </p>

            <br><br><br>

            <strong>
                Kepala Perpustakaan
            </strong>

        </div>
    </div>

</body>

</html>
