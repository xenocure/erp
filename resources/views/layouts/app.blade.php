<!DOCTYPE html>
<html>
<head>
    <title>Mini ERP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { margin:0; }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #6a11cb, #2575fc);
            color: white;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        a { text-decoration:none; }
    </style>
</head>
<body>

@include('partials.sidebar')

<div class="content">
    @yield('content')
</div>

</body>
</html>