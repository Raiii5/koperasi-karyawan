<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('images/adf-logo.png') }}">
    <title>PT Adis Dimension Footwear</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #0d6efd, #084298);
            color: white;
            padding: 24px 18px;
        }

        .sidebar h4 {
            font-weight: bold;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: #e9f2ff;
            text-decoration: none;
            padding: 12px 14px;
            margin-bottom: 8px;
            border-radius: 10px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,0.18);
            color: #fff;
        }

        .content {
            padding: 28px;
        }

        .page-title {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .card-stat {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }

        .table-card {
            background: white;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }

        .table thead th {
            background: #f1f5f9;
            font-size: 14px;
            text-transform: uppercase;
        }

        .btn {
            border-radius: 10px;
        }

        .form-card {
            background: white;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar">
            <h4>Koperasi</h4>

            <a href="/">Dashboard</a>
            <a href="/karyawan">Data Karyawan</a>
            <a href="/pinjaman">Data Pinjaman</a>
            <a href="/angsuran">Data Angsuran</a>
        </div>

        <div class="col-md-10 content">
            @yield('content')
        </div>

    </div>
</div>

</body>
</html>