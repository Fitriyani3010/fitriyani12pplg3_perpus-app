<!DOCTYPE html>
<html>
<head>
    <title>Login - E-Libra Threeban</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('/assets/images/bgperpuspipi.png') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 350px;
        }

        .card {
            width: 450px;
            background: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .logo {
            text-align: center;
            font-weight: bold;
            color: #4f7cff;
            margin-bottom: 10px;
        }

        .card h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .card p {
            text-align: center;
            color: #555;
            margin-bottom: 20px;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 12px;
            color: #777;
        }

        .input-group input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #4f7cff;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #345bd1;
        }

        a {
            text-decoration: none;
            color: #4f7cff;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="card">

    <div class="logo">
        <i class="fas fa-book-open"></i> E-Libra Threeban
    </div>

    <h2>SELAMAT DATANG!</h2>
    <p>Silahkan login untuk melanjutkan</p>

    {{-- ERROR --}}
    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="input-group">
            <i class="fas fa-user-circle"></i>
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Masukan Kata Sandi" required>
        </div>

        <button type="submit" class="btn">Login</button>
    </form>

    <p style="text-align:center; margin-top:10px;">
        Belum punya akun? <a href="/register">Daftar</a>
    </p>

</div>

</body>
</html>