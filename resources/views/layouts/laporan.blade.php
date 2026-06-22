<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laporan ERP</title>

<style>

body{
    font-family: Arial, sans-serif;
    font-size:12px;
    color:#333;
}

.header{
    text-align:center;
    margin-bottom:20px;
}

.header h1{
    margin:0;
    color:#0d6efd;
}

.header p{
    margin:5px 0;
}

.line{
    border-bottom:2px solid #0d6efd;
    margin-bottom:20px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th{
    background:#0d6efd;
    color:white;
    padding:8px;
    border:1px solid #ddd;
}

table td{
    padding:8px;
    border:1px solid #ddd;
}

.footer{
    margin-top:30px;
    text-align:center;
    color:#777;
    font-size:11px;
}

</style>

</head>

<body>

<div class="header">

    <h1>MINI ERP KEUANGAN</h1>

    <p>Laporan Keuangan Bulanan</p>

    <p>
        Dicetak:
        {{ date('d-m-Y H:i') }}
    </p>

</div>

<div class="line"></div>

@yield('content')

<div class="footer">

    Mini ERP Keuangan

</div>

</body>
</html>