<!DOCTYPE html>
<html>
<head>
    <title>Data Pelanggan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Data Pelanggan</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>WhatsApp</th>
            <th>Booking Time</th>
            <th>Description</th>
        </tr>
        @foreach($datapelanggans as $datapelanggan)
        <tr>
            <td>{{ $datapelanggan->name }}</td>
            <td>{{ $datapelanggan->age }}</td>
            <td>{{ $datapelanggan->email }}</td>
            <td>{{ $datapelanggan->whatsap }}</td>
            <td>{{ $datapelanggan->bookingtime }}</td>
            <td>{{ $datapelanggan->description }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
