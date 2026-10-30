<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login - KostKu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --blue: #2a6fd6;
    --blue-dark: #1f5bb8;
    --navy: #1c2745;
    --text: #1e2a44;
    --muted: #5b6a8c;
    --line: #d9e0ee;
    --error: #d92d2d;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: "Plus Jakarta Sans", system-ui, sans-serif; color: var(--text); font-size: 14px; background: #fff; }
  a { color: inherit; text-decoration: none; }
  button, input { font-family: inherit; font-size: inherit; color: inherit; }
  button { cursor: pointer; }
  svg { width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
  :focus-visible { outline: 2px solid var(--blue); outline-offset: 2px; }

  .page { display: grid; grid-template-columns: 1fr 1fr; min-height: 100vh; }

  /* Panel kiri */
  .hero { background: var(--blue); color: #fff; display: grid; place-items: center; padding: 40px; text-align: center; }
  .logo { display: inline-flex; align-items: center; gap: 22px; font-size: 52px; font-weight: 800; letter-spacing: -.5px; }
  .logo svg { width: 76px; height: 76px; fill: #fff; stroke: none; }
  .tagline { margin-top: 26px; font-size: 20px; line-height: 1.6; max-width: 380px; margin-inline: auto; }

  /* Panel kanan */
  .side { display: grid; place-items: center; padding: 40px 24px; background: #fdfeff; }
  .card { width: 100%; max-width: 640px; padding: 40px 50px 42px; background: #fff; border: 1px solid #e3e9f5; border-radius: 10px; }
  .mobile-logo { display: none; align-items: center; gap: 10px; font-size: 26px; font-weight: 800; color: var(--blue); margin-bottom: 20px; }
  .mobile-logo svg { width: 32px; height: 32px; fill: var(--blue); stroke: none; }
  h1 { font-size: 36px; font-weight: 800; color: var(--navy); line-height: 1.15; }
  .sub { margin-top: 10px; color: var(--muted); font-size: 17px; }

  form { margin-top: 36px; }
  .field { margin-bottom: 22px; }
  .field label { display: block; margin-bottom: 12px; font-size: 16px; font-weight: 700; color: var(--navy); }
  .control { position: relative; display: flex; align-items: center; height: 64px; border: 1px solid var(--line); border-radius: 6px; background: #fff; transition: border-color .15s, box-shadow .15s; }
  .control:focus-within { border-color: var(--blue); box-shadow: 0 0 0 3px #d6e5fc; }
  .control > svg { margin-left: 20px; width: 24px; height: 24px; color: var(--navy); }
  .control input { flex: 1; min-width: 0; height: 100%; border: 0; outline: 0; background: none; padding: 0 16px; font-size: 16px; }
  .control input::placeholder { color: #8d9bb8; }
  .toggle { background: none; border: 0; padding: 0 20px; height: 100%; color: var(--navy); display: grid; place-items: center; }
  .toggle svg { margin: 0; width: 24px; height: 24px; }
  .field.invalid .control { border-color: var(--error); }
  .err { display: none; margin-top: 8px; color: var(--error); font-size: 13px; }
  .field.invalid .err { display: block; }

  .row { display: flex; align-items: center; justify-content: space-between; margin: -4px 0 22px; font-size: 14px; }
  .check { display: inline-flex; align-items: center; gap: 10px; color: var(--muted); cursor: pointer; }
  .check input { width: 17px; height: 17px; accent-color: var(--blue); }
  .row a { color: var(--blue); font-weight: 600; }

  .btn { width: 100%; height: 62px; margin-top: 8px; background: var(--blue); color: #fff; border: 0; border-radius: 6px; font-size: 18px; font-weight: 700; transition: background .15s; }
  .btn:hover { background: var(--blue-dark); }
  .btn:disabled { background: #94b6ea; cursor: wait; }
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
  <symbol id="i-eye" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></symbol>
  <symbol id="i-eye-off" viewBox="0 0 24 24"><path d="M17.9 17.9A10.9 10.9 0 0 1 12 20C5 20 1 12 1 12a18 18 0 0 1 5-5.9M9.9 4.2A10 10 0 0 1 12 4c7 0 11 8 11 8a18 18 0 0 1-2.2 3.2M1 1l22 22M14.1 14.1a3 3 0 1 1-4.2-4.2"/></symbol>
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
      <h1>Login</h1>
      <p class="sub">Masuk ke akun Anda untuk melanjutkan</p>

      <form id="form" method="POST" action="{{ route('login') }}" novalidate>
  @csrf
       <div class="alert {{ $errors->any() || session('status') ? 'show' : '' }}" id="alert" role="alert">
  {{ $errors->first() ?: session('status') }}
</div>

        <div class="field" id="f-email">
          <label for="email">Email</label>
          <div class="control">
            <svg><use href="#i-mail"/></svg>
            <input id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Masukkan email Anda" autocomplete="email">
          </div>
          <div class="err" id="e-email">Masukkan alamat email yang valid.</div>
        </div>

        <div class="field" id="f-pass">
          <label for="password">Password</label>
          <div class="control">
            <svg><use href="#i-lock"/></svg>
            <input id="password" name="password" type="password" placeholder="Masukkan password Anda" autocomplete="current-password">
            <button class="toggle" id="toggle" type="button" aria-label="Tampilkan password"><svg id="toggle-ico"><use href="#i-eye"/></svg></button>
          </div>
          <div class="err">Password wajib diisi.</div>
        </div>

        <div class="row">
          <label class="check"><input type="checkbox" id="remember">Ingat saya</label>
          <a href="{{ route('password.request') }}">Lupa password?</a>
        </div>

        <button class="btn" id="submit" type="submit">Login</button>
      </form>

      <p class="foot">Belum punya akun?<a href="{{ route('register') }}">Registrasi</a></p>
    </div>
  </main>
</div>

<script>
  const $ = id => document.getElementById(id);
  const emailOk = v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);

  // Tampilkan / sembunyikan password
  $("toggle").addEventListener("click", () => {
    const show = $("password").type === "password";
    $("password").type = show ? "text" : "password";
    $("toggle-ico").innerHTML = `<use href="#${show ? "i-eye-off" : "i-eye"}"/>`;
    $("toggle").setAttribute("aria-label", show ? "Sembunyikan password" : "Tampilkan password");
  });

  $("email").addEventListener("blur", () => $("f-email").classList.toggle("invalid", !emailOk($("email").value.trim())));
  $("password").addEventListener("input", () => $("f-pass").classList.remove("invalid"));

  $("forgot").addEventListener("click", e => { e.preventDefault(); showAlert("Fitur lupa password belum tersedia."); });

  function showAlert(msg) {
    $("alert").textContent = msg;
    $("alert").classList.add("show");
  }

 $("form").addEventListener("submit", 1 => {
  $("alert").classList.remove("show");
  const okEmail = emailOk($("email").value.trim());
  const okPass = $("password").value.length > 0;
  $("f-email").classList.toggle("invalid", !okEmail);
  $("f-pass").classList.toggle("invalid", !okPass);
  if (!okEmail || !okPass) return e.preventDefault();

  $("submit").disabled = true;
  $("submit").textContent = "Memproses...";
});
</script>
</body>
</html>
