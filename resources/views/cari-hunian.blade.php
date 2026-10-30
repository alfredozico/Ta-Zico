<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cari Kos / Kontrakan - KostKu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #f5f8ff;
    --surface: #ffffff;
    --text: #1e2a44;
    --navy: #0f2a5c;
    --muted: #6b7694;
    --line: #e6ebf5;
    --primary: #1264e8;
    --primary-soft: #e8f1ff;
    --green: #1f9d55;
    --green-soft: #d9f5e3;
    --red: #e02424;
    --red-soft: #fde4e4;
    --purple: #7c3aed;
    --purple-soft: #ece4fb;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: "Plus Jakarta Sans", system-ui, sans-serif; background: var(--bg); color: var(--text); font-size: 13px; }
  a { color: inherit; text-decoration: none; }
  button, input, select { font-family: inherit; font-size: inherit; color: inherit; }
  button { cursor: pointer; }
  svg { width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
  :focus-visible { outline: 2px solid var(--primary); outline-offset: 2px; }

  .layout { display: grid; grid-template-columns: 256px 1fr; min-height: 100vh; }

  /* Sidebar */
  .sidebar { background: var(--surface); border-right: 1px solid var(--line); }
  .brand { height: 68px; display: flex; align-items: center; gap: 10px; padding: 0 24px; font-size: 26px; font-weight: 800; color: var(--navy); border-bottom: 1px solid var(--line); }
  .brand svg { width: 34px; height: 34px; color: var(--primary); fill: var(--primary); stroke: none; }
  .nav { padding: 16px 14px; display: grid; gap: 6px; }
  .nav a { display: flex; align-items: center; gap: 14px; padding: 12px 14px; border-radius: 8px; color: #5b6579; font-size: 14px; font-weight: 500; }
  .nav a:hover { background: #f1f5fd; }
  .nav a.active { background: var(--primary-soft); color: var(--primary); }
  .nav-logout { display: flex; align-items: center; gap: 14px; width: 100%; padding: 12px 14px; border: 0; border-radius: 8px; background: none; color: var(--red); font-size: 14px; font-weight: 500; text-align: left; }
  .nav-logout:hover { background: var(--red-soft); }

  /* Topbar */
  .topbar { height: 68px; background: var(--surface); border-bottom: 1px solid var(--line); display: flex; align-items: center; gap: 24px; padding: 0 32px 0 20px; }
  .top-search { flex: 0 1 604px; display: flex; align-items: center; gap: 10px; height: 36px; padding: 0 14px; background: var(--primary-soft); border: 1px solid #cfe0fb; border-radius: 6px; color: #5b6579; }
  .top-search input { flex: 1; border: 0; background: none; outline: none; font-size: 12px; min-width: 0; }
  .top-right { margin-left: auto; display: flex; align-items: center; gap: 28px; }
  .bell { position: relative; background: none; border: 0; color: var(--navy); }
  .bell::after { content: ""; position: absolute; top: -2px; right: -1px; width: 8px; height: 8px; background: #ef4444; border-radius: 50%; }
  .user { display: flex; align-items: center; gap: 10px; padding-left: 24px; border-left: 1px solid var(--line); height: 68px; font-size: 14px; font-weight: 500; }
  .avatar { width: 34px; height: 34px; border-radius: 50%; background: var(--primary); color: #fff; display: grid; place-items: center; }

  /* Content */
  main { padding: 26px 22px 48px 20px; }
  h1 { font-size: 30px; font-weight: 700; color: var(--navy); line-height: 1.2; }
  .sub { margin-top: 6px; color: #55607a; font-size: 15px; }

  .card { background: var(--surface); border: 1px solid var(--line); border-radius: 8px; }
  .search-card { margin-top: 20px; padding: 16px; }
  .search-row { display: flex; gap: 16px; }
  .big-search { flex: 1; display: flex; align-items: center; gap: 14px; height: 46px; padding: 0 16px; border: 1px solid #d5dcec; border-radius: 6px; color: var(--muted); }
  .big-search input { flex: 1; border: 0; outline: 0; background: none; color: var(--text); min-width: 0; }
  .big-search:focus-within { border-color: var(--primary); box-shadow: 0 0 0 3px #d6e5fc; }
  .btn-primary { display: inline-flex; align-items: center; justify-content: center; gap: 10px; height: 46px; padding: 0 36px; background: var(--primary); color: #fff; border: 0; border-radius: 6px; font-size: 14px; font-weight: 600; transition: background .15s; }
  .btn-primary:hover { background: #0d52c4; }

  .filters { display: grid; grid-template-columns: 1.05fr 1.05fr 1.05fr 1.05fr; gap: 16px; margin-top: 14px; }
  .sel { position: relative; border: 1px solid var(--line); border-radius: 6px; background: #fff; padding: 6px 12px 4px; }
  .sel label { display: block; font-size: 11px; color: var(--muted); }
  .sel select { width: 100%; border: 0; outline: 0; background: none; appearance: none; font-size: 14px; padding: 4px 24px 6px 0; cursor: pointer; }
  .sel svg { position: absolute; right: 12px; top: 50%; width: 16px; height: 16px; transform: translateY(-30%); pointer-events: none; }
  .sel:focus-within { border-color: var(--primary); }

  .result-bar { margin: 22px 0 14px; }
  .count { font-size: 15px; color: var(--muted); }
  .count strong { color: var(--navy); }

  .badge { display: inline-block; padding: 3px 12px; border-radius: 999px; font-size: 11px; font-weight: 500; white-space: nowrap; }
  .badge.kos { background: #d6e7fc; color: var(--primary); }
  .badge.kontrakan { background: var(--purple-soft); color: var(--purple); }
  .badge.ok { background: var(--green-soft); color: var(--green); }
  .badge.no { background: var(--red-soft); color: var(--red); }
  .btn-detail { display: inline-flex; align-items: center; justify-content: space-between; gap: 10px; min-width: 112px; height: 30px; padding: 0 14px; background: #fff; border: 1px solid var(--primary); border-radius: 5px; color: var(--primary); font-size: 12px; font-weight: 500; }
  .btn-detail:hover { background: var(--primary-soft); }
  .btn-detail svg { width: 13px; height: 13px; }

  /* Kartu */
  .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; }
  .prop { overflow: hidden; display: flex; flex-direction: column; transition: box-shadow .15s, transform .15s; }
  .prop:hover { box-shadow: 0 8px 24px rgba(15,42,92,.10); transform: translateY(-2px); }
  .prop-img { position: relative; height: 170px; background: #dfe6f3; display: grid; place-items: center; }
  .prop-img img { width: 100%; height: 100%; object-fit: cover; }
  .prop-img > svg { width: 52px; height: 52px; fill: #f4f6fa; stroke: none; }
  .pos-l { position: absolute; top: 12px; left: 12px; }
  .pos-r { position: absolute; top: 12px; right: 12px; }
  .prop-body { padding: 16px; display: flex; flex-direction: column; gap: 8px; flex: 1; }
  .prop-body h3 { font-size: 16px; color: var(--navy); }
  .prop .loc { color: var(--muted); display: flex; gap: 6px; align-items: flex-start; line-height: 1.4; }
  .prop .loc svg { width: 14px; height: 14px; margin-top: 2px; }
  .prop .price { font-weight: 800; color: var(--primary); font-size: 18px; }
  .prop .price small { font-size: 12px; font-weight: 500; color: var(--muted); }
  .prop-foot { margin-top: auto; padding-top: 12px; border-top: 1px solid var(--line); }
  .prop .btn-detail { width: 100%; justify-content: center; height: 36px; }
  .empty { text-align: center; padding: 56px 16px; color: var(--muted); }

  @media (max-width: 1000px) { .filters { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 760px) {
    .layout { grid-template-columns: 1fr; }
    .sidebar { display: none; }
    .topbar { padding: 0 16px; }
    .user span { display: none; }
    main { padding: 18px 14px 40px; }
    .search-row { flex-direction: column; }
    .filters { grid-template-columns: 1fr; }
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
  <symbol id="i-right" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></symbol>
  <symbol id="i-pin" viewBox="0 0 24 24"><path d="M12 21s7-6.2 7-12a7 7 0 0 0-14 0c0 5.8 7 12 7 12z"/><circle cx="12" cy="9" r="2.5"/></symbol>
  <symbol id="i-logout" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></symbol>
  <symbol id="i-img" viewBox="0 0 24 24"><path d="M2 20V6a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14zM6.5 11.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM3 19l6-6 4 4 3-3 5 5z" fill="currentColor" stroke="none"/></symbol>
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
        <button type="submit" class="nav-logout"><svg><use href="#i-logout"/></svg>Keluar</button>
      </form>
    </nav>
  </aside>

  <div>
    <header class="topbar">
      <div class="top-right">
        <button class="bell" aria-label="Notifikasi"><svg><use href="#i-bell"/></svg></button>
        <div class="user">
          <div class="avatar"><svg><use href="#i-user"/></svg></div>
          <span>{{ Auth::user()->name }}</span>
          <svg style="width:16px;height:16px"><use href="#i-chev"/></svg>
        </div>
      </div>
    </header>

    <main>
      <h1>Cari Kos / Kontrakan</h1>
      <p class="sub">Temukan hunian yang sesuai dengan kebutuhan Anda</p>

      <section class="card search-card" aria-label="Pencarian">
        <div class="search-row">
          <label class="big-search">
            <svg><use href="#i-search"/></svg>
            <input type="search" id="q" placeholder="Cari berdasarkan nama, lokasi, atau fasilitas..." aria-label="Cari hunian">
          </label>
          <button class="btn-primary" id="btn-cari" type="button"><svg><use href="#i-search"/></svg>Cari</button>
        </div>
        <div class="filters">
          <div class="sel"><label for="f-type">Jenis Hunian</label>
            <select id="f-type"><option value="">Semua</option><option>Kos</option><option>Kontrakan</option></select>
            <svg><use href="#i-chev"/></svg></div>
          <div class="sel"><label for="f-loc">Lokasi</label>
            <select id="f-loc"><option value="">Semua Lokasi</option></select>
            <svg><use href="#i-chev"/></svg></div>
          <div class="sel"><label for="f-price">Harga</label>
            <select id="f-price">
              <option value="">Semua Harga</option>
              <option value="0-1500000">Di bawah Rp 1.500.000</option>
              <option value="1500000-2500000">Rp 1.500.000 - Rp 2.500.000</option>
              <option value="2500000-99999999">Di atas Rp 2.500.000</option>
            </select>
            <svg><use href="#i-chev"/></svg></div>
          <div class="sel"><label for="f-sort">Urutkan</label>
            <select id="f-sort">
              <option value="new">Terbaru</option>
              <option value="low">Harga Terendah</option>
              <option value="high">Harga Tertinggi</option>
              <option value="name">Nama A-Z</option>
            </select>
            <svg><use href="#i-chev"/></svg></div>
        </div>
      </section>

      <div class="result-bar">
        <div class="count" id="count"></div>
      </div>

      <div id="results"></div>
    </main>
  </div>
</div>

<script>
  // Data contoh (nanti diganti data dari database). Isi "image" dengan URL foto bila ada.
  const data = @json($hunian);

  const $ = id => document.getElementById(id);
  const rupiah = n => "Rp " + n.toLocaleString("id-ID");
  const esc = s => s.replace(/[&<>"']/g, c => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));

  [...new Set(data.map(d => d.area).filter(Boolean))].sort().forEach(a => {
    const o = document.createElement("option");
    o.textContent = a;
    $("f-loc").appendChild(o);
  });

  function results() {
    const q = $("q").value.trim().toLowerCase();
    const type = $("f-type").value, area = $("f-loc").value, price = $("f-price").value, sort = $("f-sort").value;
    let list = data.filter(d =>
      (!q || (d.name + " " + d.address + " " + d.area).toLowerCase().includes(q)) &&
      (!type || d.type === type) && (!area || d.area === area));
    if (price) {
      const [min, max] = price.split("-").map(Number);
      list = list.filter(d => d.price >= min && d.price < max);
    }
    if (sort === "low") list.sort((a, b) => a.price - b.price);
    if (sort === "high") list.sort((a, b) => b.price - a.price);
    if (sort === "name") list.sort((a, b) => a.name.localeCompare(b.name));
    return list;
  }

  const typeBadge = t => `<span class="badge ${t.toLowerCase()}">${t}</span>`;
  const statusBadge = ok => `<span class="badge ${ok ? "ok" : "no"}">${ok ? "Tersedia" : "Tidak Tersedia"}</span>`;
  const detailBtn = id => `<a class="btn-detail" href="/hunian/${id}">Lihat Detail <svg><use href="#i-right"/></svg></a>`;

  function render() {
    const list = results();
    $("count").innerHTML = `<strong>Menampilkan ${list.length}</strong> hasil`;

    if (!list.length) {
      $("results").innerHTML = `<div class="card empty">Hunian tidak ditemukan. Coba ubah kata kunci atau filter.</div>`;
      return;
    }

    $("results").innerHTML = `<div class="grid">${list.map(d => `
      <article class="card prop">
        <div class="prop-img" role="img" aria-label="Foto ${esc(d.name)}">
          ${d.image ? `<img src="${esc(d.image)}" alt="">` : `<svg><use href="#i-img"/></svg>`}
          <span class="pos-l">${typeBadge(d.type)}</span>
          <span class="pos-r">${statusBadge(d.ok)}</span>
        </div>
        <div class="prop-body">
          <h3>${esc(d.name)}</h3>
          <div class="loc"><svg><use href="#i-pin"/></svg>${esc(d.address)}</div>
          <div class="price">${rupiah(d.price)} <small>/ bulan</small></div>
          <div class="prop-foot">${detailBtn(d.id)}</div>
        </div>
      </article>`).join("")}</div>`;
  }

  $("btn-cari").addEventListener("click", render);
  $("q").addEventListener("keydown", e => { if (e.key === "Enter") render(); });
  ["f-type", "f-loc", "f-price", "f-sort"].forEach(id => $(id).addEventListener("change", render));

  render();
</script>
</body>
</html>