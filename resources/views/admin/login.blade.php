<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Admin — Desa Kragilan</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    min-height: 100vh;
    background: #0f2e1a;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    position: relative;
    overflow: hidden;
  }

  /* Background decoration */
  body::before {
    content: '';
    position: fixed; inset: 0;
    background:
      radial-gradient(circle at 20% 20%, rgba(22,163,74,.25) 0%, transparent 50%),
      radial-gradient(circle at 80% 80%, rgba(5,150,105,.2) 0%, transparent 50%),
      radial-gradient(circle at 60% 20%, rgba(16,185,129,.1) 0%, transparent 40%);
    pointer-events: none;
  }

  /* Floating circles */
  .bg-circle {
    position: fixed;
    border-radius: 50%;
    background: rgba(255,255,255,.03);
    pointer-events: none;
  }
  .bg-circle-1 { width: 400px; height: 400px; top: -100px; right: -100px; border: 1px solid rgba(255,255,255,.06); }
  .bg-circle-2 { width: 250px; height: 250px; bottom: -50px; left: -50px; border: 1px solid rgba(255,255,255,.06); }
  .bg-circle-3 { width: 150px; height: 150px; top: 40%; left: 10%; background: rgba(22,163,74,.05); }

  /* Card */
  .login-card {
    position: relative;
    z-index: 1;
    width: min(100%, 440px);
    background: rgba(255,255,255,.96);
    backdrop-filter: blur(20px);
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 32px 64px rgba(0,0,0,.35), 0 0 0 1px rgba(255,255,255,.1);
  }

  /* Logo */
  .login-logo {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 28px;
  }
  .login-logo-icon {
    width: 52px; height: 52px;
    background: linear-gradient(135deg, #16a34a, #22c55e);
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; color: #fff;
    box-shadow: 0 8px 20px rgba(22,163,74,.4);
  }
  .login-logo-title { font-size: 1.1rem; font-weight: 800; color: #0f172a; }
  .login-logo-sub { font-size: 12px; color: #64748b; margin-top: 2px; }

  /* Heading */
  .login-heading { margin-bottom: 24px; }
  .login-heading h1 { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-bottom: 6px; }
  .login-heading p { font-size: 13.5px; color: #64748b; }

  /* Divider */
  .login-divider { height: 1px; background: #f1f5f9; margin-bottom: 24px; }

  /* Form groups */
  .frm-group { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
  .frm-label { font-size: 13px; font-weight: 700; color: #374151; }
  .frm-input-wrap { position: relative; }
  .frm-input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: #94a3b8; font-size: 15px; pointer-events: none;
    transition: color .2s;
  }
  .frm-input {
    width: 100%; padding: 13px 14px 13px 42px;
    border: 2px solid #e2e8f0; border-radius: 12px;
    font-size: 14px; font-family: inherit; color: #0f172a;
    background: #fff; outline: none;
    transition: border-color .2s, box-shadow .2s;
  }
  .frm-input:focus { border-color: #16a34a; box-shadow: 0 0 0 3px rgba(22,163,74,.1); }
  .frm-input:focus + .frm-input-icon { color: #16a34a; }
  .frm-input-wrap:focus-within .frm-input-icon { color: #16a34a; }

  /* Password toggle */
  .pass-toggle {
    position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
    color: #94a3b8; cursor: pointer; font-size: 15px; background: none; border: none; padding: 4px;
    transition: color .2s;
  }
  .pass-toggle:hover { color: #374151; }

  /* Error */
  .login-error {
    display: flex; align-items: center; gap: 8px;
    background: #fef2f2; border: 1px solid #fecaca; color: #991b1b;
    border-radius: 10px; padding: 12px 14px; font-size: 13.5px; margin-bottom: 16px;
  }

  /* Submit */
  .login-btn {
    width: 100%; padding: 14px;
    background: linear-gradient(135deg, #15803d, #16a34a);
    color: #fff; border: none; border-radius: 12px;
    font-size: 15px; font-weight: 700; font-family: inherit;
    cursor: pointer; transition: all .25s;
    box-shadow: 0 4px 16px rgba(22,163,74,.35);
    display: flex; align-items: center; justify-content: center; gap: 8px;
    margin-top: 8px;
  }
  .login-btn:hover {
    background: linear-gradient(135deg, #166534, #15803d);
    transform: translateY(-1px);
    box-shadow: 0 8px 24px rgba(22,163,74,.4);
  }
  .login-btn:active { transform: scale(.98); }

  /* Footer */
  .login-footer {
    margin-top: 24px; padding-top: 20px;
    border-top: 1px solid #f1f5f9;
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 8px;
  }
  .login-footer a { color: #16a34a; text-decoration: none; font-size: 12.5px; font-weight: 600; }
  .login-footer a:hover { text-decoration: underline; }
  .login-footer span { font-size: 12px; color: #94a3b8; }

  /* Security badge */
  .security-badge {
    display: flex; align-items: center; justify-content: center; gap: 6px;
    font-size: 11.5px; color: #94a3b8; margin-top: 20px;
  }
  .security-badge i { color: #16a34a; }
  </style>
</head>
<body>
  <div class="bg-circle bg-circle-1"></div>
  <div class="bg-circle bg-circle-2"></div>
  <div class="bg-circle bg-circle-3"></div>

  <div class="login-card">
    <!-- Logo -->
    <div class="login-logo">
      <div class="login-logo-icon"><i class="fas fa-seedling"></i></div>
      <div>
        <div class="login-logo-title">Desa Kragilan</div>
        <div class="login-logo-sub">Panel Administrasi</div>
      </div>
    </div>

    <div class="login-heading">
      <h1>Selamat Datang</h1>
      <p>Masuk untuk mengelola layanan administrasi desa.</p>
    </div>

    <div class="login-divider"></div>

    @if ($errors->any())
    <div class="login-error">
      <i class="fas fa-exclamation-circle"></i>
      {{ $errors->first('login') ?? 'Email atau password tidak sesuai.' }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf

      <div class="frm-group">
        <label class="frm-label" for="email">Alamat Email</label>
        <div class="frm-input-wrap">
          <input type="email" id="email" name="email" class="frm-input"
            value="{{ old('email') }}"
            placeholder="admin@desa.kragilan"
            autocomplete="email"
            required>
          <i class="fas fa-envelope frm-input-icon"></i>
        </div>
      </div>

      <div class="frm-group">
        <label class="frm-label" for="password">Password</label>
        <div class="frm-input-wrap">
          <input type="password" id="password" name="password" class="frm-input"
            placeholder="Masukkan password"
            autocomplete="current-password"
            required>
          <i class="fas fa-lock frm-input-icon"></i>
          <button type="button" class="pass-toggle" onclick="togglePassword()" id="passToggleBtn" title="Tampilkan/sembunyikan password">
            <i class="fas fa-eye" id="passToggleIcon"></i>
          </button>
        </div>
      </div>

      <button type="submit" class="login-btn">
        <i class="fas fa-sign-in-alt"></i> Masuk ke Panel Admin
      </button>
    </form>

    <div class="login-footer">
      <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Kembali ke Website</a>
      <span>&copy; {{ date('Y') }} Desa Kragilan</span>
    </div>

    <div class="security-badge">
      <i class="fas fa-shield-alt"></i> Koneksi aman — Hanya untuk petugas desa
    </div>
  </div>

  <script>
  function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('passToggleIcon');
    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
      input.type = 'password';
      icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
  }
  </script>
</body>
</html>
