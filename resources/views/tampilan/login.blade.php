<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login RSHP</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Styling khusus login page */
        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            width: 100%;
            max-width: 400px;
        }

        .login-card h2 {
            text-align: center;
            color: #4e4376;
            margin-bottom: 20px;
        }

        .login-card label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        .login-card input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .login-card button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background: #4e4376;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .login-card button:hover {
            background: #3f3660;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Login RSHP</h2>
        <form action="#" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>

            <button type="submit">Masuk</button>
        </form>

        
        @if($errors->any())
            <div class="error">
                @foreach($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>

