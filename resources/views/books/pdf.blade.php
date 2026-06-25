<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Buku</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
        }

        .header img {
            width: 60px;
        }

        h2 {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 7px;
        }

        table th {
            background: #f3f3f3;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">

        <img src="{{ public_path('img/logo.png') }}">

        <h2>LAPORAN DATA BUKU</h2>

        <p>Perpustakaan MAN 1 Bengkalis</p>

    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <th>Stok</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($books as $index => $book)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $book->code }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->published_year }}</td>
                    <td>{{ $book->category }}</td>
                    <td class="center">{{ $book->stock }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
