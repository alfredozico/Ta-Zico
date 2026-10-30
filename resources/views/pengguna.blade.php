<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kelola Properti - KostKu</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #f4f7fc;
    --surface: #ffffff;
    --text: #1e2a44;
    --navy: #0f2a5c;
    --muted: #6b7694;
    --line: #e3e9f4;
    --primary: #1b64e0;
    --side: #2a66c8;
    --side-active: #4a85e6;
    --head: #edf2fb;
    --green: #17a34a;
    --green-soft: #d8f5e2;
    --red: #e5363b;
    --gray-soft: #e3e8f1;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: "Plus Jakarta Sans", system-ui, sans-serif; background: var(--bg); color: var(--text); font-size: 14px; }
  button, input, select { font-family: inherit; font-size: inherit; color: inherit; }
  button { cursor: pointer; }
  a { color: inherit; text-decoration: none; }
  svg { width: 20px; height: 20px; fill: none; stroke: currentColor; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }
  :focus-visible { outline: 2px solid #fff; outline-offset: 2px; box-shadow: 0 0 0 4px var(--primary); }

  .layout { display: grid; grid-template-columns: 250px 1fr; min-height: 100vh; }

  /* Sidebar */
  .sidebar { background: var(--side); color: #fff; padding-bottom: 24px; }
  .brand { display: flex; align-items: center; gap: 12px; height: 80px; padding: 0 34px; font-size: 30px; font-weight: 800; }
  .brand svg { width: 34px; height: 34px; fill: #fff; stroke: none; }
  .nav { padding: 12px 12px; display: grid; gap: 4px; }
  .nav a { display: flex; align-items: center; gap: 16px; padding: 14px 16px; border-radius: 6px; font-weight: 500; opacity: .95; }
  .nav a:hover { background: rgba(255,255,255,.1); }
  .nav a.active { background: var(--side-active); }
  .nav hr { border: 0; border-top: 1px solid rgba(255,255,255,.25); margin: 18px 14px; }
  .nav-logout { display: flex; align-items: center; gap: 16px; width: 100%; padding: 14px 16px; border: 0; border-radius: 6px; background: none; color: #fff; font-weight: 500; opacity: .95; text-align: left; }
  .nav-logout:hover { background: rgba(255,255,255,.1); }

  /* Topbar */
  .topbar { height: 66px; background: var(--surface); border-bottom: 1px solid var(--line); display: flex; align-items: center; justify-content: space-between; padding: 0 28px; }
  .icon-btn { background: none; border: 0; color: var(--navy); display: grid; place-items: center; }
  .icon-btn svg { width: 24px; height: 24px; }
  .user { display: flex; align-items: center; gap: 10px; color: #3b465f; }
  .avatar { width: 38px; height: 38px; border-radius: 50%; background: #3f6fc4; display: grid; place-items: center; color: #fff; }
  .avatar svg { fill: currentColor; stroke: none; }

  /* Main card */
  main { padding: 18px 26px 32px 28px; }
  .panel { background: var(--surface); border-radius: 10px; box-shadow: 0 1px 2px rgba(15,42,92,.05); }
  .panel-head { display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; padding: 30px 28px 18px; border-bottom: 1px solid var(--line); }
  h1 { font-size: 34px; font-weight: 800; color: var(--navy); line-height: 1.15; }
  .sub { margin-top: 8px; color: var(--muted); font-size: 16px; }
  .btn-primary { display: inline-flex; align-items: center; gap: 12px; height: 48px; padding: 0 20px; background: var(--primary); color: #fff; border: 0; border-radius: 6px; font-weight: 600; white-space: nowrap; transition: background .15s; }
  .btn-primary:hover { background: #1352b8; }

  .body { padding: 28px 28px 24px; }
  .toolbar { display: grid; grid-template-columns: 1fr 418px 158px; gap: 28px; }
  .field { display: flex; align-items: center; gap: 14px; height: 50px; padding: 0 18px; border: 1px solid #d5dcec; border-radius: 6px; background: #fff; color: var(--muted); }
  .field input { flex: 1; border: 0; outline: 0; background: none; color: var(--text); min-width: 0; }
  .field input::placeholder { color: #8b96b0; }
  .field select { flex: 1; border: 0; outline: 0; background: none; appearance: none; color: var(--text); cursor: pointer; }
  .field:focus-within { border-color: var(--primary); box-shadow: 0 0 0 3px #d6e5fc; }
  .btn-ghost { display: flex; align-items: center; justify-content: center; gap: 12px; height: 50px; background: #f3f5f9; border: 1px solid var(--line); border-radius: 6px; color: #3b465f; font-weight: 500; }
  .btn-ghost:hover { background: #e9edf5; }
  .btn-ghost.spin svg { animation: spin .6s linear; }
  @keyframes spin { to { transform: rotate(360deg); } }

  /* Table */
  .table-wrap { margin-top: 28px; border: 1px solid var(--line); border-radius: 8px; overflow-x: auto; }
  table { width: 100%; border-collapse: collapse; min-width: 880px; }
  thead th { background: var(--head); text-align: left; font-weight: 600; color: var(--navy); padding: 20px 14px; white-space: nowrap; }
  thead th:first-child, tbody td:first-child { padding-left: 18px; width: 74px; }
  tbody td { padding: 18px 14px; border-top: 1px solid var(--line); height: 98px; }
  tbody tr:first-child td { border-top: 0; }
  tbody tr:hover { background: #fafcff; }
  .prop { display: flex; align-items: center; gap: 16px; }
  .thumb { width: 68px; height: 58px; border-radius: 6px; background: #d9dfeb; display: grid; place-items: center; color: #fff; flex-shrink: 0; }
  .thumb svg { width: 34px; height: 34px; fill: #f4f6fa; stroke: none; }
  .thumb img { width: 100%; height: 100%; object-fit: cover; border-radius: 6px; }
  .prop-name { font-weight: 600; color: var(--navy); }
  .badge { display: inline-block; padding: 4px 13px; border-radius: 999px; font-size: 12px; font-weight: 600; }
  .badge.aktif { background: var(--green-soft); color: var(--green); }
  .badge.nonaktif { background: var(--gray-soft); color: #4b5570; }
  .actions { display: flex; gap: 10px; }
  .act { width: 40px; height: 40px; border-radius: 6px; border: 1px solid transparent; display: grid; place-items: center; color: #fff; transition: filter .15s; }
  .act svg { width: 18px; height: 18px; }
  .act:hover { filter: brightness(.92); }
  .act.edit { background: var(--primary); }
  .act.del { background: var(--red); }
  .act.view { background: #fff; border-color: #cfd6e6; color: #3b465f; }
  .empty { text-align: center; padding: 48px 0; color: var(--muted); }

  /* Footer */
  .foot { display: flex; align-items: center; justify-content: space-between; margin-top: 24px; color: var(--muted); }
  .pager { display: flex; gap: 10px; }
  .pg { width: 36px; height: 36px; border: 1px solid #cfd6e6; background: #fff; border-radius: 6px; display: grid; place-items: center; color: #3b465f; }
  .pg svg { width: 16px; height: 16px; }
  .pg.current { background: var(--primary); border-color: var(--primary); color: #fff; font-weight: 600; }
  .pg:disabled { opacity: .45; cursor: default; }

  /* Toast */
  .toast { position: fixed; bottom: 24px; left: 50%; transform: translate(-50%, 20px); background: var(--navy); color: #fff; padding: 12px 20px; border-radius: 8px; opacity: 0; pointer-events: none; transition: .25s; }
  .toast.show { opacity: 1; transform: translate(-50%, 0); }

  /* Modal */
  .modal { position: fixed; inset: 0; background: rgba(15,42,92,.45); display: none; align-items: center; justify-content: center; padding: 16px; z-index: 50; }
  .modal.show { display: flex; }
  .modal-box { background: #fff; border-radius: 10px; width: 100%; max-width: 520px; padding: 28px; max-height: 92vh; overflow-y: auto; }
  .modal-box h2 { font-size: 22px; font-weight: 800; color: var(--navy); margin-bottom: 18px; }
  .m-field { margin-bottom: 14px; }
  .m-field label { display: block; margin-bottom: 6px; font-weight: 600; color: var(--navy); }
  .m-field input, .m-field select { width: 100%; height: 44px; padding: 0 14px; border: 1px solid #d5dcec; border-radius: 6px; background: #fff; }
  .m-field input:focus, .m-field select:focus { outline: 0; border-color: var(--primary); box-shadow: 0 0 0 3px #d6e5fc; }
  .m-field input[type="file"] { height: auto; padding: 10px 14px; }
  .m-hint { margin-top: 6px; font-size: 12px; color: var(--muted); }
  .m-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
  .btn-cancel { height: 44px; padding: 0 20px; background: #f3f5f9; border: 1px solid var(--line); border-radius: 6px; font-weight: 500; }
  .m-error { margin-bottom: 14px; padding: 10px 12px; background: #fde4e4; border: 1px solid #f6c6c6; border-radius: 6px; color: #d92d2d; font-size: 13px; }

  @media (max-width: 1100px) { .toolbar { grid-template-columns: 1fr 1fr 150px; gap: 14px; } }
  @media (max-width: 860px) {
    .layout { grid-template-columns: 1fr; }
    .sidebar { display: none; }
    .toolbar { grid-template-columns: 1fr; }
    .panel-head { flex-direction: column; }
    h1 { font-size: 28px; }
    main { padding: 14px; }
    .foot { flex-direction: column; gap: 14px; }
  }
  @media (prefers-reduced-motion: reduce) { .btn-ghost.spin svg { animation: none; } }
</style>
</head>
<body>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-home" viewBox="0 0 24 24"><path d="M3 11l9-8 9 8v9a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z" fill="currentColor" stroke="none"/></symbol>
  <symbol id="i-bed" viewBox="0 0 24 24"><path d="M3 19V6M3 15h18v4M21 15v-3a3 3 0 0 0-3-3h-8v6"/><circle cx="6.5" cy="11.5" r="1.5"/></symbol>
  <symbol id="i-cal" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></symbol>
  <symbol id="i-card" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20M6 15h4"/></symbol>
  <symbol id="i-chart" viewBox="0 0 24 24"><path d="M6 20V11M12 20V4M18 20v-6"/></symbol>
  <symbol id="i-gear" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V21a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H3a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3h0a1.7 1.7 0 0 0 1-1.5V3a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5h0a1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8v0a1.7 1.7 0 0 0 1.5 1H21a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></symbol>
  <symbol id="i-out" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></symbol>
  <symbol id="i-menu" viewBox="0 0 24 24"><path d="M3 6h18M3 12h18M3 18h18"/></symbol>
  <symbol id="i-chev" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></symbol>
  <symbol id="i-left" viewBox="0 0 24 24"><path d="M15 18l-6-6 6-6"/></symbol>
  <symbol id="i-right" viewBox="0 0 24 24"><path d="M9 18l6-6-6-6"/></symbol>
  <symbol id="i-plus" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></symbol>
  <symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></symbol>
  <symbol id="i-refresh" viewBox="0 0 24 24"><path d="M21 12a9 9 0 0 0-15.5-6.2L3 8M3 3v5h5M3 12a9 9 0 0 0 15.5 6.2L21 16M21 21v-5h-5"/></symbol>
  <symbol id="i-edit" viewBox="0 0 24 24"><path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></symbol>
  <symbol id="i-trash" viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14M10 11v5M14 11v5"/></symbol>
  <symbol id="i-eye" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></symbol>
  <symbol id="i-img" viewBox="0 0 24 24"><path d="M2 20V6a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14zM6.5 11.5a2 2 0 1 0 0-4 2 2 0 0 0 0 4zM3 19l6-6 4 4 3-3 5 5z" fill="currentColor" stroke="none"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0z"/></symbol>
</svg>

<div class="layout">
  <aside class="sidebar">
    <a class="brand" href="#"><svg><use href="#i-home"/></svg>KostKu</a>
    <nav class="nav" aria-label="Menu utama">
      <a href="#"><svg><use href="#i-home"/></svg>Dashboard</a>
      <a href="{{ route('pengguna') }}" class="active" aria-current="page"><svg><use href="#i-home"/></svg>Kelola Properti</a>
      <a href="{{ route('kamar') }}"><svg><use href="#i-bed"/></svg>Kelola Kamar</a>
      <a href="#"><svg><use href="#i-cal"/></svg>Pemesanan</a>
      <a href="#"><svg><use href="#i-card"/></svg>Pembayaran</a>
      <a href="#"><svg><use href="#i-chart"/></svg>Laporan</a>
      <hr>
      <a href="#"><svg><use href="#i-gear"/></svg>Pengaturan</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-logout"><svg><use href="#i-out"/></svg>Logout</button>
      </form>
    </nav>
  </aside>

  <div>
    <header class="topbar">
      <button class="icon-btn" aria-label="Buka menu"><svg><use href="#i-menu"/></svg></button>
      <div class="user">
        <div class="avatar"><svg><use href="#i-user"/></svg></div>
        <span>{{ Auth::user()->name }}</span>
        <svg style="width:16px;height:16px"><use href="#i-chev"/></svg>
      </div>
    </header>

    <main>
      <section class="panel">
        <div class="panel-head">
          <div>
            <h1>Kelola Properti</h1>
            <p class="sub">Kelola data kos dan kontrakan yang Anda miliki</p>
          </div>
          <button class="btn-primary" id="add-btn" type="button"><svg><use href="#i-plus"/></svg>Tambah Properti</button>
        </div>

        <div class="body">
          <div class="toolbar">
            <label class="field">
              <svg><use href="#i-search"/></svg>
              <input type="search" id="search" placeholder="Cari nama properti..." aria-label="Cari nama properti">
            </label>
            <label class="field">
              <select id="filter" aria-label="Filter jenis">
                <option value="">Semua Jenis</option>
                <option>Kos</option>
                <option>Kontrakan</option>
              </select>
              <svg style="width:16px;height:16px"><use href="#i-chev"/></svg>
            </label>
            <button class="btn-ghost" id="refresh" type="button"><svg><use href="#i-refresh"/></svg>Refresh</button>
          </div>

          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>No</th><th>Nama Properti</th><th>Jenis</th><th>Lokasi</th><th>Harga Mulai</th><th>Status</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody id="tbody"></tbody>
            </table>
          </div>

          <div class="foot">
            <span id="info"></span>
            <div class="pager">
              <button class="pg" id="prev" aria-label="Halaman sebelumnya"><svg><use href="#i-left"/></svg></button>
              <span class="pg current" id="page-now">1</span>
              <button class="pg" id="next" aria-label="Halaman berikutnya"><svg><use href="#i-right"/></svg></button>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</div>

<form id="del-form" method="POST" style="display:none">
  @csrf
  @method('DELETE')
</form>

<div class="modal" id="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
  <div class="modal-box">
    <h2 id="modal-title">Tambah Properti</h2>

    @if ($errors->any())
      <div class="m-error">{{ $errors->first() }}</div>
    @endif

    <form id="p-form" method="POST" action="{{ route('properti.store') }}" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="_method" value="PUT" id="m-method" disabled>
      <input type="hidden" name="edit_id" id="m-edit-id" value="{{ old('edit_id') }}">

      <div class="m-field">
        <label for="m-name">Nama Properti</label>
        <input id="m-name" name="name" value="{{ old('name') }}" placeholder="Contoh: Kost Mawar" required>
      </div>
      <div class="m-field">
        <label for="m-type">Jenis</label>
        <select id="m-type" name="type">
          <option value="Kos" {{ old('type') === 'Kos' ? 'selected' : '' }}>Kos</option>
          <option value="Kontrakan" {{ old('type') === 'Kontrakan' ? 'selected' : '' }}>Kontrakan</option>
        </select>
      </div>
      <div class="m-field">
        <label for="m-location">Lokasi</label>
        <input id="m-location" name="location" value="{{ old('location') }}" placeholder="Contoh: Jl. Sudirman No. 12, Batam" required>
      </div>
      <div class="m-field">
        <label for="m-price">Harga Mulai (Rp / bulan)</label>
        <input id="m-price" name="price" type="number" min="0" value="{{ old('price') }}" placeholder="500000" required>
      </div>
      <div class="m-field">
        <label for="m-active">Status</label>
        <select id="m-active" name="active">
          <option value="1" {{ old('active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
          <option value="0" {{ old('active') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
      </div>
      <div class="m-field">
        <label for="m-image">Foto Properti (opsional)</label>
        <input id="m-image" name="image" type="file" accept="image/png,image/jpeg,image/webp">
        <div class="m-hint" id="m-image-hint" style="display:none">Kosongkan jika tidak ingin mengganti foto.</div>
        <img id="m-preview" alt="Pratinjau foto" style="display:none;margin-top:10px;width:100%;max-height:180px;object-fit:cover;border-radius:6px">
      </div>
      <div class="m-actions">
        <button type="button" class="btn-cancel" id="m-cancel">Batal</button>
        <button type="submit" class="btn-primary" id="m-submit">Simpan</button>
      </div>
    </form>
  </div>
</div>

<div class="toast" id="toast" role="status"></div>

<script>
  let properties = @json($properties);
  const STORE_URL = @json(route('properti.store'));
  const PER_PAGE = 10;
  let page = 1;

  const $ = id => document.getElementById(id);
  const rupiah = n => "Rp " + n.toLocaleString("id-ID");
  const esc = s => s.replace(/[&<>"']/g, c => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));

  function filtered() {
    const q = $("search").value.trim().toLowerCase();
    const t = $("filter").value;
    return properties.filter(p => p.name.toLowerCase().includes(q) && (!t || p.type === t));
  }

  function render() {
    const list = filtered();
    const pages = Math.max(1, Math.ceil(list.length / PER_PAGE));
    page = Math.min(page, pages);
    const start = (page - 1) * PER_PAGE;
    const slice = list.slice(start, start + PER_PAGE);

    $("tbody").innerHTML = slice.length ? slice.map((p, i) => `
      <tr>
        <td>${start + i + 1}</td>
        <td><div class="prop"><div class="thumb">${p.image ? `<img src="${esc(p.image)}" alt="Foto ${esc(p.name)}">` : `<svg><use href="#i-img"/></svg>`}</div>
          <div><div class="prop-name">${esc(p.name)}</div></div></div></td>
        <td>${p.type}</td>
        <td>${esc(p.location)}</td>
        <td>${rupiah(p.price)}</td>
        <td><span class="badge ${p.active ? "aktif" : "nonaktif"}">${p.active ? "Aktif" : "Tidak Aktif"}</span></td>
        <td><div class="actions">
          <button class="act edit" data-act="edit" data-id="${p.id}" aria-label="Edit ${esc(p.name)}"><svg><use href="#i-edit"/></svg></button>
          <button class="act del" data-act="del" data-id="${p.id}" aria-label="Hapus ${esc(p.name)}"><svg><use href="#i-trash"/></svg></button>
          <button class="act view" data-act="view" data-id="${p.id}" aria-label="Lihat ${esc(p.name)}"><svg><use href="#i-eye"/></svg></button>
        </div></td>
      </tr>`).join("") : `<tr><td colspan="7" class="empty">Properti tidak ditemukan. Coba kata kunci atau jenis lain.</td></tr>`;

    const from = list.length ? start + 1 : 0;
    $("info").textContent = `Menampilkan ${from} - ${start + slice.length} dari ${list.length} data`;
    $("page-now").textContent = page;
    $("prev").disabled = page <= 1;
    $("next").disabled = page >= pages;
  }

  function toast(msg) {
    const t = $("toast");
    t.textContent = msg;
    t.classList.add("show");
    clearTimeout(toast.t);
    toast.t = setTimeout(() => t.classList.remove("show"), 2200);
  }

  $("search").addEventListener("input", () => { page = 1; render(); });
  $("filter").addEventListener("change", () => { page = 1; render(); });
  $("prev").addEventListener("click", () => { page--; render(); });
  $("next").addEventListener("click", () => { page++; render(); });

  $("refresh").addEventListener("click", e => {
    const b = e.currentTarget;
    b.classList.add("spin");
    setTimeout(() => b.classList.remove("spin"), 600);
    $("search").value = ""; $("filter").value = ""; page = 1;
    render();
    toast("Data diperbarui");
  });

  // ===== Modal tambah / edit =====
  const modal = $("modal"), form = $("p-form");

  // p = null untuk Tambah; p = objek properti untuk Edit.
  // keepOld = true saat modal dibuka ulang karena validasi gagal (isian lama dipertahankan).
  function openModal(p, keepOld = false) {
    const edit = !!p;
    $("modal-title").textContent = edit ? "Edit Properti" : "Tambah Properti";
    $("m-submit").textContent = edit ? "Simpan Perubahan" : "Simpan";
    form.action = edit ? "/properti/" + p.id : STORE_URL;
    $("m-method").disabled = !edit;
    $("m-edit-id").value = edit ? p.id : "";
    $("m-image-hint").style.display = edit ? "block" : "none";

    if (!keepOld) {
      $("m-name").value = edit ? p.name : "";
      $("m-type").value = edit ? p.type : "Kos";
      $("m-location").value = edit ? p.location : "";
      $("m-price").value = edit ? p.price : "";
      $("m-active").value = edit ? (p.active ? "1" : "0") : "1";
      $("m-image").value = "";
      const img = $("m-preview");
      if (edit && p.image) { img.src = p.image; img.style.display = "block"; }
      else { img.style.display = "none"; }
    }

    modal.classList.add("show");
    $("m-name").focus();
  }

  $("add-btn").addEventListener("click", () => openModal(null));
  $("m-cancel").addEventListener("click", () => modal.classList.remove("show"));
  modal.addEventListener("click", e => { if (e.target === modal) modal.classList.remove("show"); });
  document.addEventListener("keydown", e => { if (e.key === "Escape") modal.classList.remove("show"); });

  $("m-image").addEventListener("change", e => {
    const f = e.target.files[0], img = $("m-preview");
    if (f) { img.src = URL.createObjectURL(f); img.style.display = "block"; }
    else { img.style.display = "none"; }
  });

  $("tbody").addEventListener("click", e => {
    const btn = e.target.closest("button[data-act]");
    if (!btn) return;
    const p = properties.find(x => x.id === Number(btn.dataset.id));
    if (btn.dataset.act === "del") {
      if (confirm(`Hapus properti "${p.name}"?`)) {
        const f = $("del-form");
        f.action = "/properti/" + p.id;
        f.submit();
      }
    } else if (btn.dataset.act === "edit") {
      openModal(p);
    } else {
      toast(`Lihat detail ${p.name}`);
    }
  });

  render();

  @if (session('status'))
    toast(@json(session('status')));
  @endif
  @if ($errors->any())
    openModal(@json(old('edit_id') ? ['id' => (int) old('edit_id')] : null), true);
  @endif
</script>
</body>
</html>