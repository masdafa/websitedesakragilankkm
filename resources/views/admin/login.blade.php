<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin - Desa Kragilan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <style>
        body { background: linear-gradient(135deg, #0f766e, #14532d); color: #fff; }
        .admin-login { min-height: 100vh; display: grid; place-items: center; padding: 24px; }
        .admin-card { width: min(100%, 460px); background: rgba(255,255,255,0.95); color: #0f172a; border-radius: 24px; padding: 32px; box-shadow: 0 20px 45px rgba(0,0,0,.2); }
        .admin-card h1 { font-size: 1.5rem; margin-bottom: 8px; }
        .admin-card form { display: grid; gap: 14px; margin-top: 20px; }
        .admin-card input { padding: 12px 14px; border-radius: 12px; border: 1px solid #cbd5e1; }
        .admin-card button { background: #0f766e; color: #fff; border: 0; padding: 12px 16px; border-radius: 12px; cursor: pointer; font-weight: 700; }
        .error { color: #dc2626; font-size: .9rem; margin-top: 4px; }
    </style>
</head>
<body>
<div class="admin-login">
    <div class="admin-card">
        <h1>Login Panel Admin</h1>
        <p>Desa Kragilan - Pengelolaan Surat & Testimoni</p>
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <input type="email" name="email" placeholder="Email admin" value="{{ old('email') }}" required />
            <input type="password" name="password" placeholder="Password" required />
            @if ($errors->any())
                <div class="error">{{ $errors->first('login') }}</div>
            @endif
            <button type="submit">Masuk</button>
        </form>
    </div>
</div>
</body>
</html>
