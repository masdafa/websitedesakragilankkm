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
    background: #0a1f0f;
    display: flex;
    align-items: stretch;
    overflow: hidden;
  }

  /* ── LEFT PANEL ── */
  .left-panel {
    display: none;
    flex: 1;
    background: linear-gradient(160deg, #0f2e1a 0%, #14532d 50%, #166534 100%);
    position: relative;
    overflow: hidden;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 60px;
  }
  @media (min-width: 900px) { .left-panel { display: flex; } }

  .left-panel::before {
    content: '';
    position: absolute; inset: 0;
    background:
      radial-gradient(circle at 30% 30%, rgba(34,197,94,.18) 0%, transparent 55%),
      radial-gradient(circle at 80% 80%, rgba(22,163,74,.15) 0%, transparent 50%);
    pointer-events: none;
  }

  /* Grid pattern */
  .left-panel::after {
    content: '';
    position: absolute; inset: 0;
    background-image:
      linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
  }

  .left-content { position: relative; z-index: 1; text-align: center; }

  .left-logo {
    margin-bottom: 32px;
  }
  .left-logo img {
    height: 110px;
    width: auto;
    object-fit: contain;
    mix-blend-mode: screen;
    filter: drop-shadow(0 4px 24px rgba(0,0,0,.3));
  }

  .left-title {
    font-size: 2rem;
    font-weight: 800;
    color: #fff;
    line-height: 1.2;
    margin-bottom: 12px;
    text-shadow: 0 2px 12px rgba(0,0,0,.3);
  }
  .left-subtitle {
    font-size: 14px;
    color: rgba(255,255,255,.65);
    line-height: 1.7;
    max-width: 300px;
    margin: 0 auto 40px;
  }

  /* Stats row */
  .left-stats {
    display: flex;
    gap: 24px;
    justify-content: center;
    flex-wrap: wrap;
  }
  .left-stat {
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 14px;
    padding: 16px 20px;
    text-align: center;
    backdrop-filter: blur(8px);
  }
  .left-stat-num { font-size: 1.6rem; font-weight: 800; color: #4ade80; }
  .left-stat-label { font-size: 11px; color: rgba(255,255,255,.55); margin-top: 3px; font-weight: 500; }

  /* Decorative circles */
  .deco-circle {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
  }
  .deco-1 { width: 320px; height: 320px; top: -80px; right: -80px; border: 1px solid rgba(255,255,255,.06); background: transparent; }
  .deco-2 { width: 180px; height: 180px; bottom: 60px; left: -40px; border: 1px solid rgba(255,255,255,.08); background: rgba(34,197,94,.04); }

  /* ── RIGHT PANEL (form) ── */
  .right-panel {
    width: 100%;
    max-width: 100%;
    background: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 32px;
    position: relative;
  }
  @media (min-width: 900px) {
    .right-panel {
      width: 480px;
      flex-shrink: 0;
    }
  }

  .right-inner { width: 100%; max-width: 360px; }

  /* Top badge on mobile */
  .mobile-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 32px;
    padding-bottom: 24px;
    border-bottom: 1px solid #f1f5f9;
  }
  @media (min-width: 900px) { .mobile-brand { display: none; } }
  .mobile-brand img { height: 52px; width: auto; object-fit: contain; }
  .mobile-brand-text strong { display: block; font-size: 15px; font-weight: 800; color: #0f172a; }
  .mobile-brand-text span { font-size: 12px; color: #64748b; }

  /* Heading */
  .form-heading { margin-bottom: 28px; }
  .form-heading h1 {
    font-size: 1.65rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 6px;
    letter-spacing: -.02em;
  }
  .form-heading p { font-size: 13.5px; color: #64748b; line-height: 1.6; }

  /* Form groups */
  .frm-group { display: flex; flex-direction: column; gap: 7px; margin-bottom: 16px; }
  .frm-label { font-size: 13px; font-weight: 700; color: #374151; letter-spacing: .01em; }
  .frm-input-wrap { position: relative; }
  .frm-input-icon {
    position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
    color: #94a3b8; font-size: 14px; pointer-events: none;
    transition: color .2s;
  }
  .frm-input {
    width: 100%; padding: 13px 14px 13px 42px;
    border: 2px solid #e2e8f0; border-radius: 12px;
    font-size: 14px; font-family: inherit; color: #0f172a;
    background: #f8fafc; outline: none;
    transition: border-color .2s, box-shadow .2s, background .2s;
  }
  .frm-input:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 4px rgba(22,163,74,.1);
    background: #fff;
  }
  .frm-input-wrap:focus-within .frm-input-icon { color: #16a34a; }

  /* Password toggle */
  .pass-toggle {
    position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
    color: #94a3b8; cursor: pointer; font-size: 14px; background: none; border: none; padding: 4px;
    transition: color .2s;
  }
  .pass-toggle:hover { color: #374151; }

  /* Error */
  .login-error {
    display: flex; align-items: center; gap: 10px;
    background: #fef2f2; border: 1px solid #fecaca; color: #991b1b;
    border-radius: 10px; padding: 12px 14px; font-size: 13.5px; margin-bottom: 20px;
  }

  /* Submit */
  .login-btn {
    width: 100%; padding: 15px;
    background: linear-gradient(135deg, #15803d, #16a34a, #22c55e);
    color: #fff; border: none; border-radius: 12px;
    font-size: 15px; font-weight: 700; font-family: inherit;
    cursor: pointer; transition: all .25s;
    box-shadow: 0 4px 20px rgba(22,163,74,.35);
    display: flex; align-items: center; justify-content: center; gap: 9px;
    margin-top: 8px; letter-spacing: .01em;
  }
  .login-btn:hover {
    background: linear-gradient(135deg, #166534, #15803d, #16a34a);
    transform: translateY(-1px);
    box-shadow: 0 8px 28px rgba(22,163,74,.45);
  }
  .login-btn:active { transform: scale(.98); box-shadow: none; }

  /* Footer */
  .form-footer {
    margin-top: 28px;
    text-align: center;
  }
  .form-footer span { font-size: 12px; color: #cbd5e1; }
  </style>
</head>
<body>

  {{-- Left decorative panel --}}
  <div class="left-panel">
    <div class="deco-circle deco-1"></div>
    <div class="deco-circle deco-2"></div>

    <div class="left-content">
      <div class="left-logo">
        <img src="{{ asset('assets/images/logo-desa.png') }}" alt="Logo Desa Kragilan"/>
      </div>
      <h2 class="left-title">Panel Administrasi<br>Desa Kragilan</h2>


    </div>
  </div>

  {{-- Right form panel --}}
  <div class="right-panel">
    <div class="right-inner">

      {{-- Mobile brand --}}
      <div class="mobile-brand">
        <img src="{{ asset('assets/images/logo-desa.png') }}" alt="Logo Desa Kragilan"/>
        <div class="mobile-brand-text">
          <strong>Desa Kragilan</strong>
          <span>Panel Administrasi</span>
        </div>
      </div>

      {{-- Heading --}}
      <div class="form-heading">
        <h1>Selamat Datang</h1>
        <p>Masuk ke panel untuk mengelola layanan administrasi desa.</p>
      </div>

      {{-- Error --}}
      @if ($errors->any())
      <div class="login-error">
        <i class="fas fa-exclamation-circle"></i>
        {{ $errors->first('login') ?? 'Email atau password tidak sesuai.' }}
      </div>
      @endif

      {{-- Form --}}
      <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf

        <div class="frm-group">
          <label class="frm-label" for="email">Alamat Email</label>
          <div class="frm-input-wrap">
            <input type="email" id="email" name="email" class="frm-input"
              value="{{ old('email') }}"
              placeholder=""
              autocomplete="email"
              required>
            <i class="fas fa-envelope frm-input-icon"></i>
          </div>
        </div>

        <div class="frm-group">
          <label class="frm-label" for="password">Password</label>
          <div class="frm-input-wrap">
            <input type="password" id="password" name="password" class="frm-input"
              placeholder=""
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

      <div class="form-footer">
        <span>&copy; {{ date('Y') }} Pemerintah Desa Kragilan</span>
      </div>

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
