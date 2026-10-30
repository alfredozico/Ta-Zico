<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lupa Password - KostKu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root { --blue:#2a6fd6; --blue-dark:#1f5bb8; --navy:#1c2745; --text:#1e2a44; --muted:#5b6a8c; --line:#d9e0ee; --error:#d92d2d; }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: "Plus Jakarta Sans", system-ui, sans-serif; color: var(--text); font-size: 14px; background: #fff; }
  a { color: inherit; text-decoration: none; }
  button, input { font-family: inherit; font-size: inherit; color: inherit; }
  button { cursor: pointer; }
  svg { width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
  :focus-visible { outline: 2px solid var(--blue); outline-offset: 2px; }

  .page { display: grid; grid-template-columns: 1fr 1fr; min-height: 100vh; }
  .hero { background: var(--blue); color: #fff; display: grid; place-items: center; padding: 40px; text-align: center; }
  .logo { display: inline-flex; align-items: center; gap: 22px; font-size: 52px; font-weight: 800; letter-spacing: -.5px; }
  .logo svg { width: 76px; height: 76px; fill: #fff; stroke: none; }
  .tagline { margin-top: 26px; font-size: 20px; line-height: 1.6; max-width: 380px; margin-inline: auto; }

  .side { display: grid; place-items: center; padding: 40px 24px; background: #fdfeff; }
  .card { width: 100%; max-width: 640px; padding: 40px 50px 42px; background: #fff; border: 1px solid #e3e9f5; border-radius: 10px; }
  .mobile-logo { display: none; align-items: center; gap: 10px; font-size: 26px; font-weight: 800; color: var(--blue); margin-bottom: 20px; }
  .mobile-logo svg { width: 32px; height: 32px; fill: var(--blue); stroke: none; }
  h1 { font-size: 36px; font-weight: 800; color: var(--navy); line-height: 1.15; }
  .sub { margin-top: 10px; color: var(--muted); font-size: 17px; }

  form { margin-top: 36px; }
  .field { margin-bottom: 22px; }
  .field label { display: block; margin-bottom: 12px; font-size: 16px; font-weight: 700; color: var(--navy); }
  .control { display: flex; align-items: center; height: 64px; border: 1px solid var(--line); border-radius: 6px; background: #fff; transition: border-color .15s, box-shadow .15s; }
  .control:focus-within { border-color: var(--blue); box-shadow: 0 0 0 3px #d6e5fc; }
  .control > svg { margin-left: 20px; width: 24px; height: 24px; color: var(--navy); }
  .control input { flex: 1; min-width: 0; height: 100%; border: 0; outline: 0; background: none; padding: 0 16px; font-size: 16px; }
  .control input::placeholder { color: #8d9bb8; }

  .btn { width: 100%; height: 62px; margin-top: 8px; background: var(--blue); color: #fff; border: 0; border-radius: 6px; font-size: 18px; font-weight: 700; transition: background .15s; }
  .btn:hover { background: var(--blue-dark); }
  .alert { display: none; margin-bottom: 18px; padding: 12px 14px; background: #fde8e8; border: 1px solid #f6c6c6; border-radius: 6px; color: var(--error); font-size: 13px; }
  .alert.show { display: block; }

  .foot { margin-top: 36px; text-align: center; color: var(--muted); font-size: 15px; }
  .foot a { color: #1a5cf0; font-weight: 700; margin-left: 6px; }
  .foot a:hover { text-decoration: underline; }

  @media (max-width: 900px) {
    .page { grid-template-columns: 1fr; }
    .hero { display: none; }
    .side { padding: 24px 16px; background: #f5f8ff; }
    .mobile-logo { display: flex; }
    .card { padding: 28px 22px 30px; }
    h1 { font-size: 30px; }
  }
</style>
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-house" viewBox="0 0 24 24"><path d="M12 2.5l9 7.6V21a1 1 0 0 1-1 1h-5v-7.5a1.5 1.5 0 0 0-1.5-1.5h-3A1.5 1.5 0 0 0 9 14.5V22H4a1 1 0 0 1-1-1V10.1z" fill="currentColor" stroke="none"/></symbol>
  <symbol id="i-mail" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 7l10 7 10-7"/></symbol>
  <symbol id="i-lock" viewBox="0 0 24 24"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></symbol>
  <symbol id="i-phone" viewBox="0 0 24 24"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M11 18h2"/></symbol>
</svg>

<div class="page">
  <section class="hero" aria-label="KostKu">
    <div>
      <div class="logo"><svg><use href="#i-house"/></svg>KostKu</div>
      <p class="tagline">Temukan kos dan kontrakan terbaik untuk kebutuhan Anda</p>
    </div>
  </section>

  <main class="side">
   <div class="card">
  <div class="mobile-logo"><svg><use href="#i-house"/></svg>KostKu</div>
  <h1>Lupa Password</h1>
  <p class="sub">Verifikasi dengan email dan nomor HP yang terdaftar, lalu buat password baru</p>

  <form method="POST" action="{{ route('password.update') }}" novalidate>
    @csrf
    <div class="alert {{ $errors->any() ? 'show' : '' }}" role="alert">{{ $errors->first() }}</div>

    <div class="field">
      <label for="email">Email</label>
      <div class="control">
        <svg><use href="#i-mail"/></svg>
        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" autocomplete="email" required>
      </div>
    </div>

    <div class="field">
      <label for="phone">Nomor HP</label>
      <div class="control">
        <svg><use href="#i-phone"/></svg>
        <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" placeholder="Nomor HP saat registrasi" autocomplete="tel" required>
      </div>
    </div>

    <div class="field">
      <label for="password">Password Baru</label>
      <div class="control">
        <svg><use href="#i-lock"/></svg>
        <input id="password" name="password" type="password" placeholder="Minimal 8 karakter" autocomplete="new-password" required>
      </div>
    </div>

    <div class="field">
      <label for="confirm">Konfirmasi Password</label>
      <div class="control">
        <svg><use href="#i-lock"/></svg>
        <input id="confirm" name="password_confirmation" type="password" placeholder="Ulangi password baru" autocomplete="new-password" required>
      </div>
    </div>

    <button class="btn" type="submit">Simpan Password Baru</button>
  </form>

  <p class="foot">Ingat password?<a href="{{ route('login') }}">Login</a></p>
</div>
  </main>
</div>
</body>
</html>