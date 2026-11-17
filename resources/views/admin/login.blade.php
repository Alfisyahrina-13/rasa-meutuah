<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Masuk | Admin Rasa Meutuah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="login-page">
    <form class="login" method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <p class="brand"><span class="mark" aria-hidden="true"></span>Rasa Meutuah</p>
        <h1>Masuk admin</h1>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" autocomplete="username" required autofocus>
        @error('email')<small class="err">{{ $message }}</small>@enderror

        <label for="password">Password</label>
        <input id="password" type="password" name="password" autocomplete="current-password" required>
        @error('password')<small class="err">{{ $message }}</small>@enderror

        <label class="cek"><input type="checkbox" name="ingat" value="1"> Ingat saya di perangkat ini</label>

        <button class="btn" type="submit">Masuk</button>
        <a class="back" href="{{ route('home') }}">Kembali ke situs</a>
    </form>
</body>
</html>
