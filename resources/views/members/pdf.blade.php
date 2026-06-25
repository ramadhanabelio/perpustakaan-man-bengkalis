<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Data Member</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            position: relative;
            margin-bottom: 25px;
            height: 80px;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: 55px;
        }

        .header .title {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
        }

        .header h2 {
            margin: 5px 0;
        }

        .header p {
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 8px;
        }

        table th {
            background: #f3f3f3;
            text-align: center;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">

        <img src="{{ public_path('img/logo.png') }}">

        <div class="title">
            <h2>LAPORAN DATA MEMBER</h2>
            <p>Perpustakaan MAN 1 Bengkalis</p>
        </div>

    </div>

    <table>

        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Kelas</th>
                <th>Email</th>
                <th>No HP</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($members as $index => $member)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $member->user->name }}</td>
                    <td>{{ $member->nisn }}</td>
                    <td>{{ $member->class }}</td>
                    <td>{{ $member->user->email }}</td>
                    <td>{{ $member->user->phone }}</td>
                </tr>
            @endforeach

        </tbody>

    </table>

</body>

</html>
