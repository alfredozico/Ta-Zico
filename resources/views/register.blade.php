<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registrasi - KostKu</title>
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
  .hero { background: var(--blue); color: #fff; display: grid; place-items: center; padding: 40px; text-align: center; position: sticky; top: 0; height: 100vh; }
  .logo { display: inline-flex; align-items: center; gap: 22px; font-size: 52px; font-weight: 800; letter-spacing: -.5px; }
  .logo svg { width: 76px; height: 76px; fill: #fff; stroke: none; }
  .tagline { margin-top: 26px; font-size: 20px; line-height: 1.6; max-width: 380px; margin-inline: auto; }

  /* Panel kanan */
  .side { display: grid; place-items: center; padding: 40px 24px; background: #fdfeff; }
  .card { width: 100%; max-width: 640px; padding: 38px 50px 40px; background: #fff; border: 1px solid #e3e9f5; border-radius: 10px; }
  .mobile-logo { display: none; align-items: center; gap: 10px; font-size: 26px; font-weight: 800; color: var(--blue); margin-bottom: 20px; }
  .mobile-logo svg { width: 32px; height: 32px; fill: var(--blue); stroke: none; }
  h1 { font-size: 36px; font-weight: 800; color: var(--navy); line-height: 1.15; }
  .sub { margin-top: 10px; color: var(--muted); font-size: 17px; }

  form { margin-top: 30px; }
  .field { margin-bottom: 18px; }
  .field > label, .field > .lbl { display: block; margin-bottom: 10px; font-size: 15px; font-weight: 700; color: var(--navy); }
  .control { position: relative; display: flex; align-items: center; height: 58px; border: 1px solid var(--line); border-radius: 6px; background: #fff; transition: border-color .15s, box-shadow .15s; }
  .control:focus-within { border-color: var(--blue); box-shadow: 0 0 0 3px #d6e5fc; }
  .control > svg { margin-left: 18px; width: 22px; height: 22px; color: var(--navy); }
  .control input { flex: 1; min-width: 0; height: 100%; border: 0; outline: 0; background: none; padding: 0 14px; font-size: 15px; }
  .control input::placeholder { color: #8d9bb8; }
  .toggle { background: none; border: 0; padding: 0 18px; height: 100%; color: var(--navy); display: grid; place-items: center; }
  .toggle svg { margin: 0; width: 22px; height: 22px; }
  .field.invalid .control { border-color: var(--error); }
  .err { display: none; margin-top: 8px; color: var(--error); font-size: 13px; }
  .field.invalid .err { display: block; }
  .two { display: grid; grid-template-columns: 1fr 1fr; gap: 0 18px; }

  /* Pilihan peran */
  .roles { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
  .role { position: relative; }
  .role input { position: absolute; opacity: 0; inset: 0; cursor: pointer; }
  .role span { display: flex; align-items: center; justify-content: center; gap: 10px; height: 54px; border: 1px solid var(--line); border-radius: 6px; font-weight: 600; color: var(--muted); transition: .15s; }
  .role span svg { width: 20px; height: 20px; }
  .role input:checked + span { border-color: var(--blue); background: #eaf2ff; color: var(--blue); box-shadow: 0 0 0 1px var(--blue); }
  .role input:focus-visible + span { outline: 2px solid var(--blue); outline-offset: 2px; }

  /* Kekuatan password */
  .strength { display: none; margin-top: 10px; align-items: center; gap: 10px; font-size: 12px; color: var(--muted); }
  .strength.show { display: flex; }
  .bars { display: flex; gap: 4px; flex: 1; }
  .bars i { height: 5px; flex: 1; background: #e3e9f5; border-radius: 99px; transition: background .2s; }

  .check-row { display: flex; gap: 12px; align-items: flex-start; margin: 4px 0 6px; color: var(--muted); font-size: 14px; line-height: 1.5; cursor: pointer; }
  .check-row input { width: 18px; height: 18px; margin-top: 2px; accent-color: var(--blue); flex-shrink: 0; }
  .check-row a { color: var(--blue); font-weight: 600; }
  #f-terms.invalid .check-row { color: var(--error); }

  .btn { width: 100%; height: 60px; margin-top: 16px; background: var(--blue); color: #fff; border: 0; border-radius: 6px; font-size: 18px; font-weight: 700; transition: background .15s; }
  .btn:hover { background: var(--blue-dark); }
  .btn:disabled { background: #94b6ea; cursor: wait; }

  .foot { margin-top: 26px; text-align: center; color: var(--muted); font-size: 15px; }
  .foot a { color: #1a5cf0; font-weight: 700; margin-left: 6px; }
  .foot a:hover { text-decoration: underline; }

  .toast { position: fixed; bottom: 24px; left: 50%; transform: translate(-50%, 20px); background: var(--navy); color: #fff; padding: 12px 20px; border-radius: 8px; opacity: 0; pointer-events: none; transition: .25s; }
  .toast.show { opacity: 1; transform: translate(-50%, 0); }

  @media (max-width: 900px) {
    .page { grid-template-columns: 1fr; }
    .hero { display: none; }
    .side { padding: 24px 16px; background: #f5f8ff; }
    .mobile-logo { display: flex; }
    .card { padding: 28px 22px 30px; }
    .two { grid-template-columns: 1fr; }
    h1 { font-size: 30px; }
  }
</style>
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-house" viewBox="0 0 24 24"><path d="M12 2.5l9 7.6V21a1 1 0 0 1-1 1h-5v-7.5a1.5 1.5 0 0 0-1.5-1.5h-3A1.5 1.5 0 0 0 9 14.5V22H4a1 1 0 0 1-1-1V10.1z" fill="currentColor" stroke="none"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></symbol>
  <symbol id="i-mail" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 7l10 7 10-7"/></symbol>
  <symbol id="i-phone" viewBox="0 0 24 24"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M11 18h2"/></symbol>
  <symbol id="i-lock" viewBox="0 0 24 24"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></symbol>
  <symbol id="i-key" viewBox="0 0 24 24"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3M12 15v2"/></symbol>
  <symbol id="i-eye" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></symbol>
  <symbol id="i-eye-off" viewBox="0 0 24 24"><path d="M17.9 17.9A10.9 10.9 0 0 1 12 20C5 20 1 12 1 12a18 18 0 0 1 5-5.9M9.9 4.2A10 10 0 0 1 12 4c7 0 11 8 11 8a18 18 0 0 1-2.2 3.2M1 1l22 22M14.1 14.1a3 3 0 1 1-4.2-4.2"/></symbol>
  <symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></symbol>
  <symbol id="i-building" viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="1"/><path d="M9 7h.01M15 7h.01M9 11h.01M15 11h.01M9 15h.01M15 15h.01M10 21v-3h4v3"/></symbol>
</svg>

<div class="page">
  <section class="hero" aria-label="KostKu">
    <div>
      <div class="logo"><svg><use href="#i-house"/></svg>KostKu</div>
      <p class="tagline">Daftar sekarang dan temukan kos serta kontrakan terbaik untuk kebutuhan Anda</p>
    </div>
  </section>

  <main class="side">
    <div class="card">
      <div class="mobile-logo"><svg><use href="#i-house"/></svg>KostKu</div>
      <h1>Registrasi</h1>
      <p class="sub">Buat akun baru untuk mulai menggunakan KostKu</p>
@if ($errors->any())
  <div class="err" style="display:block; margin-top:16px;">{{ $errors->first() }}</div>
@endif
      <form id="form" method="POST" action="{{ route('register') }}" novalidate>
  @csrf

  <div class="field">
    <span class="lbl" id="role-lbl">Daftar sebagai</span>
    <div class="roles" role="radiogroup" aria-labelledby="role-lbl">
      <label class="role"><input type="radio" name="role" value="Penyewa" {{ old('role', 'Penyewa') === 'Penyewa' ? 'checked' : '' }}><span><svg><use href="#i-search"/></svg>Penyewa</span></label>
      <label class="role"><input type="radio" name="role" value="Pemilik" {{ old('role') === 'Pemilik' ? 'checked' : '' }}><span><svg><use href="#i-building"/></svg>Pemilik</span></label>
    </div>
  </div>

        <div class="field" id="f-name">
          <label for="name">Nama Lengkap</label>
          <div class="control"><svg><use href="#i-user"/></svg><input id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" autocomplete="name"></div>
          <div class="err">Nama lengkap wajib diisi.</div>
        </div>

        <div class="two">
          <div class="field" id="f-email">
            <label for="email">Email</label>
            <div class="control"><svg><use href="#i-mail"/></svg><input id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Masukkan email Anda" autocomplete="email"></div>
            <div class="err">Masukkan alamat email yang valid.</div>
          </div>
          <div class="field" id="f-phone">
            <label for="phone">Nomor HP</label>
            <div class="control"><svg><use href="#i-phone"/></svg><input id="phone" name="phone" value="{{ old('phone') }}" type="tel" placeholder="0812 3456 7890" autocomplete="tel"></div>
            <div class="err">Masukkan nomor HP yang valid.</div>
          </div>
        </div>

        <div class="field" id="f-pass">
          <label for="password">Password</label>
          <div class="control">
            <svg><use href="#i-lock"/></svg>
            <input id="password" name="password" type="password" placeholder="Minimal 8 karakter" autocomplete="new-password">
            <button class="toggle" data-target="password" type="button" aria-label="Tampilkan password"><svg><use href="#i-eye"/></svg></button>
          </div>
          <div class="strength" id="strength"><div class="bars"><i></i><i></i><i></i><i></i></div><span id="strength-text"></span></div>
          <div class="err">Password minimal 8 karakter.</div>
        </div>

        <div class="field" id="f-confirm">
          <label for="confirm">Konfirmasi Password</label>
          <div class="control">
            <svg><use href="#i-key"/></svg>
            <input id="confirm" name="password_confirmation" type="password" placeholder="Ulangi password Anda" autocomplete="new-password">
            <button class="toggle" data-target="confirm" type="button" aria-label="Tampilkan password"><svg><use href="#i-eye"/></svg></button>
          </div>
          <div class="err">Konfirmasi password tidak sama.</div>
        </div>

        <div class="field" id="f-terms" style="margin-bottom:0">
         <label class="check-row"><input type="checkbox" id="terms" name="terms" value="1">
            <span>Saya setuju dengan <a href="#">Syarat &amp; Ketentuan</a> dan <a href="#">Kebijakan Privasi</a> KostKu.</span></label>
          <div class="err">Anda harus menyetujui syarat dan ketentuan.</div>
        </div>

        <button class="btn" id="submit" type="submit">Daftar</button>
      </form>

      <p class="foot">Sudah punya akun?<a href="{{ route('login') }}">Login</a></p>
    </div>
  </main>
</div>
<div class="toast" id="toast" role="status"></div>

<script>
  const $ = id => document.getElementById(id);
  const rules = {
    name:    () => $("name").value.trim().length >= 2,
    email:   () => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($("email").value.trim()),
    phone:   () => /^(\+62|62|0)8\d{7,11}$/.test($("phone").value.replace(/[\s-]/g, "")),
    pass:    () => $("password").value.length >= 8,
    confirm: () => $("confirm").value === $("password").value && $("confirm").value.length > 0,
    terms:   () => $("terms").checked,
  };
  const check = k => { const ok = rules[k](); $("f-" + k).classList.toggle("invalid", !ok); return ok; };

  ["name", "email", "phone"].forEach(k => $(k).addEventListener("blur", () => check(k)));
  $("password").addEventListener("blur", () => check("pass"));
  $("confirm").addEventListener("blur", () => check("confirm"));
  $("terms").addEventListener("change", () => check("terms"));

  // Tampilkan / sembunyikan password
  document.querySelectorAll(".toggle").forEach(btn => btn.addEventListener("click", () => {
    const input = $(btn.dataset.target);
    const show = input.type === "password";
    input.type = show ? "text" : "password";
    btn.innerHTML = `<svg><use href="#${show ? "i-eye-off" : "i-eye"}"/></svg>`;
    btn.setAttribute("aria-label", show ? "Sembunyikan password" : "Tampilkan password");
  }));

  // Indikator kekuatan password
  const LEVELS = [["Terlalu lemah", "#d92d2d"], ["Lemah", "#e8820c"], ["Cukup", "#d4a600"], ["Kuat", "#1f9d55"]];
  $("password").addEventListener("input", () => {
    const v = $("password").value;
    $("f-pass").classList.remove("invalid");
    $("strength").classList.toggle("show", v.length > 0);
    let score = 0;
    if (v.length >= 8) score++;
    if (/[A-Z]/.test(v) && /[a-z]/.test(v)) score++;
    if (/\d/.test(v)) score++;
    if (/[^A-Za-z0-9]/.test(v) || v.length >= 12) score++;
    const idx = v.length < 8 ? 0 : Math.min(3, Math.max(1, score - 1));
    document.querySelectorAll(".bars i").forEach((b, i) => b.style.background = i <= idx ? LEVELS[idx][1] : "#e3e9f5");
    $("strength-text").textContent = LEVELS[idx][0];
    $("strength-text").style.color = LEVELS[idx][1];
    if ($("confirm").value) check("confirm");
  });
  $("confirm").addEventListener("input", () => $("f-confirm").classList.remove("invalid"));

  function toast(msg) {
    const t = $("toast");
    t.textContent = msg;
    t.classList.add("show");
    clearTimeout(toast.t);
    toast.t = setTimeout(() => t.classList.remove("show"), 2400);
  }

  $("form").addEventListener("submit", e => {
  const results = Object.keys(rules).map(check);
  if (!results.every(Boolean)) {
    e.preventDefault();
    return toast("Lengkapi data yang masih salah.");
  }
  $("submit").disabled = true;
  $("submit").textContent = "Memproses...";
});
</script>
</body>
</html>
