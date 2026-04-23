<!DOCTYPE html>
<html>
<head>
    <title>Login ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center" style="height:100vh">

<div class="card p-4" style="width:300px">
    <h4 class="text-center">Login</h4>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <input name="username" class="form-control mb-2" placeholder="Username">
        <input type="password" name="password" class="form-control mb-3" placeholder="Password">
        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>