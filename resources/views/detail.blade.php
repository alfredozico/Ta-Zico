<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $hunian['name'] }} - KostKu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #f5f8ff;
    --surface: #ffffff;
    --text: #1e2a44;
    --navy: #0f2a5c;
    --muted: #7a859c;
    --line: #e6ebf5;
    --primary: #1264e8;
    --primary-soft: #e8f1ff;
    --green: #1f9d55;
    --green-soft: #d9f5e3;
    --ph: #c9cacd;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: "Plus Jakarta Sans", system-ui, sans-serif; background: var(--bg); color: var(--text); font-size: 14px; }
  a { color: inherit; text-decoration: none; }
  button { font-family: inherit; cursor: pointer; }
  svg { width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }

  .layout { display: grid; grid-template-columns: 256px 1fr; min-height: 100vh; }

  /* Sidebar */
  .sidebar { background: var(--surface); border-right: 1px solid var(--line); }
  .brand { height: 68px; display: flex; align-items: center; gap: 10px; padding: 0 24px; font-size: 26px; font-weight: 800; color: var(--navy); border-bottom: 1px solid var(--line); }
  .brand svg { width: 34px; height: 34px; color: var(--primary); fill: var(--primary); stroke: none; }
  .nav { padding: 16px 14px; display: grid; gap: 6px; }
  .nav a { display: flex; align-items: center; gap: 14px; padding: 12px 14px; border-radius: 8px; color: #5b6579; font-weight: 500; }
  .nav a svg { color: #6b7488; }
  .nav a.active { background: var(--primary-soft); color: var(--primary); }
  .nav a.active svg { color: var(--primary); }
  .nav-logout { display: flex; align-items: center; gap: 14px; width: 100%; padding: 12px 14px; border: 0; border-radius: 8px; background: none; color: #e02424; font-size: 14px; font-weight: 500; text-align: left; }
  .nav-logout:hover { background: #fde4e4; }

  /* Topbar */
  .topbar { height: 68px; background: var(--surface); border-bottom: 1px solid var(--line); display: flex; align-items: center; gap: 24px; padding: 0 32px 0 20px; }
  .search { flex: 0 1 636px; display: flex; align-items: center; gap: 10px; height: 38px; padding: 0 14px; background: var(--primary-soft); border: 1px solid #cfe0fb; border-radius: 6px; color: #5b6579; }
  .search input { flex: 1; border: 0; background: none; outline: none; font: inherit; font-size: 12px; }
  .top-right { margin-left: auto; display: flex; align-items: center; gap: 28px; }
  .bell { position: relative; background: none; border: 0; color: var(--navy); }
  .bell::after { content: ""; position: absolute; top: -2px; right: -1px; width: 8px; height: 8px; background: #ef4444; border-radius: 50%; }
  .user { display: flex; align-items: center; gap: 10px; padding-left: 24px; border-left: 1px solid var(--line); height: 68px; font-weight: 500; }
  .avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--primary); color: #fff; display: grid; place-items: center; }

  /* Content */
  .content { padding: 28px 32px 48px 22px; display: grid; grid-template-columns: minmax(0, 1fr) 512px; gap: 30px; align-items: start; max-width: 1280px; }
  .back { display: inline-flex; align-items: center; gap: 10px; color: #55607a; margin-bottom: 14px; }
  .back svg { width: 16px; height: 16px; }
  .title-row { display: flex; align-items: flex-start; justify-content: space-between; gap: 12px; }
  h1 { font-size: 32px; font-weight: 700; color: var(--navy); line-height: 1.2; }
  .meta { display: flex; align-items: center; gap: 14px; margin-top: 8px; color: #55607a; }
  .meta svg { width: 16px; height: 16px; color: #5b6579; }
  .meta .loc { display: flex; align-items: center; gap: 8px; }
  .pill { display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 500; white-space: nowrap; }
  .pill.blue { background: #dceafc; color: var(--primary); padding: 4px 14px; }
  .pill.green { background: var(--green-soft); color: var(--green); }
  .pill.red { background: #fde4e4; color: #d33; }

  .gallery { display: grid; grid-template-columns: 1fr 116px; gap: 10px; margin-top: 18px; height: 290px; }
  .ph { background: var(--ph); border-radius: 4px; position: relative; overflow: hidden; }
  .ph::before, .ph::after { content: ""; position: absolute; inset: 0; background: linear-gradient(to top right, transparent calc(50% - 1px), #8d8e92 50%, transparent calc(50% + 1px)); }
  .ph::after { transform: scaleX(-1); }
  .ph img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; }
  .ph.has-img::before, .ph.has-img::after { display: none; }
  .thumbs { display: grid; grid-template-rows: repeat(4, 1fr); gap: 10px; }

  .card { background: var(--surface); border: 1px solid var(--line); border-radius: 8px; }

  /* Tabs */
  .tabs-card { margin-top: 22px; padding: 0 20px 28px; }
  .tabs { display: flex; gap: 8px; border-bottom: 1px solid var(--line); }
  .tab { background: none; border: 0; padding: 20px 24px 14px; font-size: 14px; font-weight: 500; color: #3b465f; border-bottom: 2px solid transparent; margin-bottom: -1px; }
  .tab[aria-selected="true"] { color: var(--primary); border-color: var(--primary); }
  .panel { display: none; padding-top: 24px; }
  .panel.active { display: block; }
  h2 { font-size: 16px; font-weight: 600; color: var(--navy); margin-bottom: 14px; }
  .rows { display: grid; gap: 0; }
  .row { display: grid; grid-template-columns: 220px 1fr; align-items: center; padding: 8px 0; }
  .row dt { display: flex; align-items: center; gap: 12px; color: #55607a; }
  .row dt svg { width: 16px; height: 16px; color: #8b94a8; }
  .row dt.hl, .row dt.hl svg { color: var(--primary); }
  hr { border: 0; border-top: 1px solid var(--line); margin: 20px 0; }
  .desc { line-height: 1.6; color: #3b465f; max-width: 540px; }

  .fac-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px 20px; }
  .fac { display: flex; align-items: center; gap: 14px; color: #3b465f; }
  .ico { width: 44px; height: 44px; border-radius: 50%; background: var(--primary-soft); color: var(--primary); display: grid; place-items: center; }
  .ico svg { width: 20px; height: 20px; }
  .map { height: 220px; border-radius: 8px; background: repeating-linear-gradient(45deg, #eef3fb, #eef3fb 12px, #e5edf9 12px, #e5edf9 24px); display: grid; place-items: center; color: var(--muted); text-align: center; padding: 0 16px; }

  .room-list { display: grid; gap: 10px; }
  .room { display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; border: 1px solid var(--line); border-radius: 8px; }

  /* Right column */
  .side { display: grid; gap: 18px; margin-top: 66px; }
  .side .card { padding: 20px; }
  .side .label { color: #3b465f; font-size: 15px; }
  .price { font-size: 28px; font-weight: 700; color: var(--primary); margin: 6px 0 18px; }
  .price span { font-size: 24px; }
  .room-select { display: flex; align-items: center; gap: 14px; width: 100%; padding: 14px 16px; background: #f4f8ff; border: 0; border-radius: 6px; font-size: 14px; font-weight: 500; color: var(--text); }
  .room-select .ico { width: 34px; height: 34px; background: var(--primary-soft); }
  .room-select .ico svg { width: 16px; height: 16px; }
  .room-select .grow { flex: 1; text-align: left; }
  .room-select > svg { width: 16px; height: 16px; color: #3b465f; }
  .btn { margin-top: 20px; width: 100%; height: 48px; border: 0; border-radius: 6px; background: var(--primary); color: #fff; font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 10px; transition: background .15s; }
  .btn:hover { background: #0d52c4; }
  .btn svg { width: 18px; height: 18px; }
  :focus-visible { outline: 2px solid var(--primary); outline-offset: 2px; }
  .side h2 { margin-bottom: 20px; }
  .info { display: grid; grid-template-columns: 178px 1fr; row-gap: 14px; }
  .info dt { color: var(--muted); }

  .toast { position: fixed; bottom: 24px; left: 50%; transform: translate(-50%, 20px); background: var(--navy); color: #fff; padding: 12px 20px; border-radius: 8px; opacity: 0; pointer-events: none; transition: .25s; }
  .toast.show { opacity: 1; transform: translate(-50%, 0); }

  @media (max-width: 1100px) {
    .content { grid-template-columns: 1fr; padding: 20px; }
    .side { margin-top: 0; }
  }
  @media (max-width: 760px) {
    .layout { grid-template-columns: 1fr; }
    .sidebar { display: none; }
    .topbar { padding: 0 16px; }
    .user span { display: none; }
    .gallery { grid-template-columns: 1fr; height: auto; }
    .gallery .ph.main { height: 220px; }
    .thumbs { grid-template-columns: repeat(4, 1fr); grid-template-rows: 60px; }
    .tabs { overflow-x: auto; }
    .row { grid-template-columns: 130px 1fr; }
    .fac-grid { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-home" viewBox="0 0 24 24"><path d="M3 11l9-8 9 8v9a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></symbol>
  <symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></symbol>
  <symbol id="i-list" viewBox="0 0 24 24"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h4"/></symbol>
  <symbol id="i-history" viewBox="0 0 24 24"><path d="M3 12a9 9 0 1 0 3-6.7L3 8"/><path d="M3 3v5h5M12 7v5l3 2"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0z"/></symbol>
  <symbol id="i-bell" viewBox="0 0 24 24"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9M10 21a2 2 0 0 0 4 0"/></symbol>
  <symbol id="i-chev" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></symbol>
  <symbol id="i-back" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></symbol>
  <symbol id="i-pin" viewBox="0 0 24 24"><path d="M12 21s7-6.2 7-12a7 7 0 0 0-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></symbol>
  <symbol id="i-cal" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></symbol>
  <symbol id="i-tag" viewBox="0 0 24 24"><path d="M20 12l-8 8-9-9V3h8z"/><circle cx="7.5" cy="7.5" r="1.5"/></symbol>
  <symbol id="i-shield" viewBox="0 0 24 24"><path d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path d="M9 12l2 2 4-4"/></symbol>
  <symbol id="i-wifi" viewBox="0 0 24 24"><path d="M2 9a15 15 0 0 1 20 0M5 12.5a10 10 0 0 1 14 0M8.5 16a5 5 0 0 1 7 0"/><circle cx="12" cy="19.5" r="1"/></symbol>
  <symbol id="i-bath" viewBox="0 0 24 24"><path d="M3 12h18v3a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5zM6 12V6a2 2 0 0 1 4 0M6 20l-1 2M18 20l1 2"/></symbol>
  <symbol id="i-bed" viewBox="0 0 24 24"><path d="M3 19V6M3 15h18v4M21 15v-3a3 3 0 0 0-3-3h-8v6"/><circle cx="6.5" cy="11.5" r="1.5"/></symbol>
  <symbol id="i-ac" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="10" rx="2"/><path d="M8 18l-1 3M12 18v3M16 18l1 3"/></symbol>
  <symbol id="i-fan" viewBox="0 0 24 24"><circle cx="12" cy="12" r="2"/><path d="M12 10c0-4 1-7 4-7s2 5-4 7zM14 12c4 0 7 1 7 4s-5 2-7-4zM12 14c0 4-1 7-4 7s-2-5 4-7zM10 12c-4 0-7-1-7-4s5-2 7 4z"/></symbol>
  <symbol id="i-out" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></symbol>
</svg>

<div class="layout">
  <aside class="sidebar">
    <a class="brand" href="{{ route('cari-hunian') }}"><svg><use href="#i-home"/></svg>KostKu</a>
    <nav class="nav" aria-label="Menu utama">
      <a href="#"><svg><use href="#i-home"/></svg>Beranda</a>
      <a href="{{ route('cari-hunian') }}" class="active" aria-current="page"><svg><use href="#i-search"/></svg>Cari Hunian</a>
      <a href="#"><svg><use href="#i-list"/></svg>Pesanan Saya</a>
      <a href="#"><svg><use href="#i-history"/></svg>Riwayat</a>
      <a href="#"><svg><use href="#i-user"/></svg>Akun</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-logout"><svg><use href="#i-out"/></svg>Keluar</button>
      </form>
    </nav>
  </aside>

  <div>
    <header class="topbar">
      <label class="search">
        <svg><use href="#i-search"/></svg>
        <input type="search" placeholder="Cari kos, kontrakan, atau lokasi..." aria-label="Cari hunian">
      </label>
      <div class="top-right">
        <button class="bell" aria-label="Notifikasi"><svg><use href="#i-bell"/></svg></button>
        <div class="user">
          <div class="avatar"><svg><use href="#i-user"/></svg></div>
          <span>{{ Auth::user()->name }}</span>
          <svg style="width:16px;height:16px"><use href="#i-chev"/></svg>
        </div>
      </div>
    </header>

    <main class="content">
      <section>
        <a class="back" href="{{ route('cari-hunian') }}"><svg><use href="#i-back"/></svg>Kembali ke Daftar</a>
        <div class="title-row">
          <div>
            <h1>{{ $hunian['name'] }}</h1>
            <div class="meta">
              <span class="pill blue">{{ $hunian['type'] }}</span>
              <span class="loc"><svg><use href="#i-pin"/></svg>{{ $hunian['location'] }}</span>
            </div>
          </div>
          <span class="pill {{ $hunian['ok'] ? 'green' : 'red' }}">{{ $hunian['ok'] ? 'Tersedia' : 'Tidak Tersedia' }}</span>
        </div>

        <div class="gallery" aria-label="Galeri foto">
          <div class="ph main {{ $hunian['image'] ? 'has-img' : '' }}">
            @if ($hunian['image'])
              <img src="{{ $hunian['image'] }}" alt="Foto {{ $hunian['name'] }}">
            @endif
          </div>
          <div class="thumbs">
            <div class="ph"></div><div class="ph"></div><div class="ph"></div><div class="ph"></div>
          </div>
        </div>

        <div class="card tabs-card">
          <div class="tabs" role="tablist">
            <button class="tab" role="tab" aria-selected="true" data-tab="umum">Informasi Umum</button>
            <button class="tab" role="tab" aria-selected="false" data-tab="fasilitas">Fasilitas</button>
            <button class="tab" role="tab" aria-selected="false" data-tab="lokasi">Lokasi</button>
            <button class="tab" role="tab" aria-selected="false" data-tab="kamar">Kamar Tersedia</button>
          </div>

          <div class="panel active" id="umum" role="tabpanel">
            <h2>Informasi Hunian</h2>
            <dl class="rows">
              <div class="row"><dt><svg><use href="#i-home"/></svg>Nama Hunian</dt><dd>{{ $hunian['name'] }}</dd></div>
              <div class="row"><dt><svg><use href="#i-home"/></svg>Jenis Hunian</dt><dd>{{ $hunian['type'] }}</dd></div>
              <div class="row"><dt><svg><use href="#i-pin"/></svg>Lokasi</dt><dd>{{ $hunian['location'] }}</dd></div>
              <div class="row"><dt><svg><use href="#i-tag"/></svg>Harga</dt><dd>Rp {{ number_format($hunian['price'], 0, ',', '.') }} / bulan</dd></div>
              <div class="row"><dt class="hl"><svg><use href="#i-shield"/></svg>Status</dt><dd><span class="pill {{ $hunian['ok'] ? 'green' : 'red' }}">{{ $hunian['ok'] ? 'Tersedia' : 'Tidak Tersedia' }}</span></dd></div>
            </dl>
            <hr>
            <h2>Deskripsi</h2>
            <p class="desc">{{ $hunian['name'] }} berlokasi di {{ $hunian['location'] }}. Hubungi pemilik untuk informasi lebih lanjut.</p>
          </div>

          <div class="panel" id="fasilitas" role="tabpanel">
            <h2>Fasilitas</h2>
            <div class="fac-grid" id="fac-main"></div>
          </div>

          <div class="panel" id="lokasi" role="tabpanel">
            <h2>Lokasi</h2>
            <div class="map">Peta: {{ $hunian['location'] }}</div>
          </div>

          <div class="panel" id="kamar" role="tabpanel">
            <h2>Kamar Tersedia</h2>
            <div class="room-list" id="room-list"></div>
          </div>
        </div>
      </section>

      <aside class="side">
        <div class="card">
          <div class="label">Harga Sewa</div>
          <div class="price">Rp {{ number_format($hunian['price'], 0, ',', '.') }} <span>/ bulan</span></div>
          <button class="room-select" id="room-btn" type="button">
            <span class="ico"><svg><use href="#i-user"/></svg></span>
            <span class="grow" id="room-name">-</span>
            <span class="pill green" id="room-status">Tersedia</span>
            <svg><use href="#i-chev"/></svg>
          </button>
          <button class="btn" id="book-btn" type="button"><svg><use href="#i-cal"/></svg>Pesan Sekarang</button>
        </div>

        <div class="card">
          <h2>Fasilitas</h2>
          <div class="fac-grid" id="fac-side"></div>
        </div>

        <div class="card">
          <h2>Informasi Tambahan</h2>
          <dl class="info">
            <dt>Kategori</dt><dd>{{ $hunian['type'] }}</dd>
            <dt>Jumlah Kamar</dt><dd>{{ count($hunian['rooms']) }} kamar</dd>
          </dl>
        </div>
      </aside>
    </main>
  </div>
</div>
<div class="toast" id="toast" role="status"></div>

<script>
  const ICONS = { "WiFi": "i-wifi", "AC": "i-ac", "Kipas Angin": "i-fan", "Kamar Mandi Dalam": "i-bath" };
  const facilities = @json($hunian['facilities']).map(n => ({ name: n, icon: ICONS[n] || "i-shield" }));
  const rooms = @json($hunian['rooms']);
  let selected = 0;

  // Render fasilitas
  const facHTML = facilities.length
    ? facilities.map(f => `<div class="fac"><span class="ico"><svg><use href="#${f.icon}"/></svg></span>${f.name}</div>`).join("")
    : `<p class="desc">Belum ada data fasilitas.</p>`;
  document.getElementById("fac-side").innerHTML = facHTML;
  document.getElementById("fac-main").innerHTML = facHTML;

  // Render daftar kamar
  function renderRooms() {
    if (!rooms.length) {
      document.getElementById("room-list").innerHTML = '<p class="desc">Belum ada data kamar.</p>';
      return;
    }
    document.getElementById("room-list").innerHTML = rooms.map(r => `
      <div class="room"><strong>${r.name}</strong>
        <span class="pill ${r.available ? "green" : "red"}">${r.available ? "Tersedia" : "Terisi"}</span>
      </div>`).join("");
  }
  renderRooms();

  // Tabs
  const tabs = document.querySelectorAll(".tab");
  tabs.forEach(tab => tab.addEventListener("click", () => {
    tabs.forEach(t => t.setAttribute("aria-selected", t === tab));
    document.querySelectorAll(".panel").forEach(p => p.classList.toggle("active", p.id === tab.dataset.tab));
  }));

  // Toast
  const toast = document.getElementById("toast");
  function showToast(msg) {
    toast.textContent = msg;
    toast.classList.add("show");
    clearTimeout(showToast.t);
    showToast.t = setTimeout(() => toast.classList.remove("show"), 2200);
  }

  // Pilih kamar (berputar antar kamar)
  function updateRoom() {
    const r = rooms[selected];
    if (!r) { document.getElementById("room-btn").style.display = "none"; return; }
    document.getElementById("room-name").textContent = r.name;
    const st = document.getElementById("room-status");
    st.textContent = r.available ? "Tersedia" : "Terisi";
    st.className = "pill " + (r.available ? "green" : "red");
  }
  document.getElementById("room-btn").addEventListener("click", () => {
    if (!rooms.length) return;
    selected = (selected + 1) % rooms.length;
    updateRoom();
  });

  // Pesan sekarang
  document.getElementById("book-btn").addEventListener("click", () => {
    const r = rooms[selected];
    if (!r) return showToast("Hubungi pemilik untuk memesan hunian ini");
    showToast(r.available ? `Pesanan untuk ${r.name} dibuat` : `${r.name} sudah terisi`);
  });

  updateRoom();
</script>
</body>
</html>