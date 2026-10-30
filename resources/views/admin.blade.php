<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pengguna - KostKu</title>
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
  .nav-logout { display: flex; align-items: center; gap: 14px; width: 100%; padding: 12px 14px; border: 0; border-radius: 8px; background: none; color: #e02424; font-size: 14px; font-weight: 500; text-align: left; }
  .nav-logout:hover { background: #fde4e4; }

  /* Topbar */
  .topbar { height: 68px; background: var(--surface); border-bottom: 1px solid var(--line); display: flex; align-items: center; gap: 24px; padding: 0 32px 0 20px; }
  .top-search { flex: 0 1 616px; display: flex; align-items: center; gap: 10px; height: 36px; padding: 0 14px; background: var(--primary-soft); border: 1px solid #cfe0fb; border-radius: 6px; color: #5b6579; }
  .top-search input { flex: 1; border: 0; background: none; outline: none; font-size: 12px; min-width: 0; }
  .top-right { margin-left: auto; display: flex; align-items: center; gap: 28px; }
  .bell { position: relative; background: none; border: 0; color: var(--navy); }
  .bell::after { content: ""; position: absolute; top: -2px; right: -1px; width: 8px; height: 8px; background: #ef4444; border-radius: 50%; }
  .user { display: flex; align-items: center; gap: 10px; padding-left: 24px; border-left: 1px solid var(--line); height: 68px; font-size: 14px; font-weight: 600; }
  .avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--primary); color: #fff; display: grid; place-items: center; }

  /* Content */
  main { padding: 26px 22px 48px 20px; }
  .back { display: inline-flex; align-items: center; gap: 10px; color: #3b465f; font-size: 14px; font-weight: 500; margin-bottom: 12px; }
  .back svg { width: 16px; height: 16px; }
  h1 { font-size: 28px; font-weight: 800; color: var(--navy); line-height: 1.2; }
  .sub { margin-top: 6px; color: #55607a; font-size: 14px; }

  .card { background: var(--surface); border: 1px solid var(--line); border-radius: 8px; }
  .filter-card { margin-top: 20px; padding: 14px 16px; display: grid; grid-template-columns: 1.5fr .5fr .5fr auto; gap: 14px; align-items: center; }
  .search { display: flex; align-items: center; gap: 14px; height: 52px; padding: 0 16px; border: 1px solid #d5dcec; border-radius: 6px; color: var(--muted); }
  .search input { flex: 1; min-width: 0; border: 0; outline: 0; background: none; color: var(--text); }
  .search:focus-within { border-color: var(--primary); box-shadow: 0 0 0 3px #d6e5fc; }
  .sel { position: relative; border: 1px solid var(--line); border-radius: 6px; background: #fff; padding: 6px 12px 4px; }
  .sel label { display: block; font-size: 11px; color: var(--muted); }
  .sel select { width: 100%; border: 0; outline: 0; background: none; appearance: none; font-size: 13px; font-weight: 600; padding: 4px 24px 6px 0; cursor: pointer; }
  .sel svg { position: absolute; right: 12px; top: 50%; width: 16px; height: 16px; transform: translateY(-30%); pointer-events: none; }
  .sel:focus-within { border-color: var(--primary); }
  .btn-primary { display: inline-flex; align-items: center; justify-content: center; gap: 10px; height: 44px; padding: 0 22px; background: var(--primary); color: #fff; border: 0; border-radius: 6px; font-size: 13px; font-weight: 600; white-space: nowrap; transition: background .15s; }
  .btn-primary:hover { background: #0d52c4; }
  .btn-primary svg { width: 16px; height: 16px; }

  /* Stats */
  .stats { display: grid; grid-template-columns: 1.1fr 1.1fr 1fr 1fr; gap: 12px; margin-top: 12px; }
  .stat { display: flex; align-items: center; gap: 18px; padding: 18px 20px; }
  .stat .ico { width: 52px; height: 52px; border-radius: 50%; display: grid; place-items: center; flex-shrink: 0; }
  .stat .ico svg { width: 24px; height: 24px; }
  .ico.blue { background: #dbeafd; color: var(--primary); }
  .ico.green { background: #d6f3e2; color: #1f9d55; }
  .ico.purple { background: #ece4fb; color: #7c3aed; }
  .ico.orange { background: #fdebd0; color: #f59e0b; }
  .stat .lbl { font-size: 13px; color: #3b465f; font-weight: 500; }
  .stat .num { font-size: 24px; font-weight: 800; color: var(--navy); margin: 4px 0 6px; line-height: 1.1; }
  .stat .desc { font-size: 11px; color: var(--muted); }

  /* Table card */
  .table-card { margin-top: 14px; padding: 18px 14px 16px; }
  .table-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px; padding: 0 2px; }
  .table-head h2 { font-size: 16px; font-weight: 700; color: var(--navy); }
  .btn-outline { display: inline-flex; align-items: center; gap: 10px; height: 34px; padding: 0 18px; background: #fff; border: 1px solid var(--primary); border-radius: 5px; color: var(--primary); font-size: 12px; font-weight: 500; }
  .btn-outline:hover { background: var(--primary-soft); }
  .btn-outline svg { width: 14px; height: 14px; }
  .table-wrap { overflow-x: auto; }
  table { width: 100%; border-collapse: collapse; min-width: 980px; }
  thead th { text-align: left; font-weight: 500; font-size: 12px; color: #55607a; padding: 12px 12px; background: #f7f9fd; white-space: nowrap; }
  tbody td { padding: 6px 12px; height: 44px; border-top: 1px solid var(--line); white-space: nowrap; }
  tbody tr:first-child td { border-top: 0; }
  tbody tr:hover { background: #fafcff; }
  td.no { font-weight: 600; color: var(--navy); width: 56px; }
  .badge { display: inline-block; padding: 2px 11px; border-radius: 999px; font-size: 11px; font-weight: 500; }
  .r-penyewa { background: #d9f5e3; color: #1f9d55; }
  .r-pemilik { background: #ece4fb; color: #7c3aed; }
  .r-admin { background: #d6e7fc; color: var(--primary); }
  .s-aktif { background: #d9f5e3; color: #1f9d55; }
  .s-nonaktif { background: #fde4e4; color: #d92d2d; }
  .btn-detail { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 26px; padding: 0 14px; background: #fff; border: 1px solid var(--primary); border-radius: 4px; color: var(--primary); font-size: 11px; font-weight: 500; white-space: nowrap; }
  .btn-detail:hover { background: var(--primary-soft); }
  .btn-detail svg { width: 12px; height: 12px; }
  .row-actions { display: flex; gap: 8px; }
.btn-del { display: inline-flex; align-items: center; justify-content: center; gap: 8px; height: 26px; padding: 0 14px; background: #fff; border: 1px solid #e5363b; border-radius: 4px; color: #e5363b; font-size: 11px; font-weight: 500; white-space: nowrap; }
.btn-del:hover { background: #fde4e4; }
.btn-del svg { width: 12px; height: 12px; }
  .empty { text-align: center; padding: 40px 0; color: var(--muted); }

  .toast { position: fixed; bottom: 24px; left: 50%; transform: translate(-50%, 20px); background: var(--navy); color: #fff; padding: 12px 20px; border-radius: 8px; opacity: 0; pointer-events: none; transition: .25s; }
  .toast.show { opacity: 1; transform: translate(-50%, 0); }

  @media (max-width: 1100px) {
    .filter-card { grid-template-columns: 1fr 1fr; }
    .search { grid-column: 1 / -1; }
    .btn-primary { grid-column: 1 / -1; }
    .stats { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 760px) {
    .layout { grid-template-columns: 1fr; }
    .sidebar { display: none; }
    .topbar { padding: 0 16px; }
    .user span { display: none; }
    main { padding: 18px 14px 40px; }
    .filter-card, .stats { grid-template-columns: 1fr; }
    h1 { font-size: 24px; }
  }
</style>
</head>
<body>
  <symbol id="i-trash" viewBox="0 0 24 24"><path d="M3 6h18M8 6V4h8v2M6 6l1 14h10l1-14M10 11v5M14 11v5"/></symbol>
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="i-home" viewBox="0 0 24 24"><path d="M3 11l9-8 9 8v9a1 1 0 0 1-1 1h-5v-6H9v6H4a1 1 0 0 1-1-1z"/></symbol>
  <symbol id="i-search" viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></symbol>
  <symbol id="i-list" viewBox="0 0 24 24"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M9 8h6M9 12h6M9 16h4"/></symbol>
  <symbol id="i-card" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20M6 15h4"/></symbol>
  <symbol id="i-chart" viewBox="0 0 24 24"><path d="M6 20V11M12 20V4M18 20v-6"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0z"/></symbol>
  <symbol id="i-gear" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.9 4.9l2.1 2.1M17 17l2.1 2.1M4.9 19.1L7 17M17 7l2.1-2.1"/></symbol>
  <symbol id="i-bell" viewBox="0 0 24 24"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9M10 21a2 2 0 0 0 4 0"/></symbol>
  <symbol id="i-chev" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></symbol>
  <symbol id="i-back" viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></symbol>
  <symbol id="i-userplus" viewBox="0 0 24 24"><circle cx="9" cy="8" r="4"/><path d="M1 21a8 8 0 0 1 16 0zM19 8v6M16 11h6"/></symbol>
  <symbol id="i-wallet" viewBox="0 0 24 24"><rect x="2" y="6" width="20" height="14" rx="2"/><path d="M2 10h20M17 15h2"/></symbol>
  <symbol id="i-building" viewBox="0 0 24 24"><rect x="4" y="3" width="16" height="18" rx="1"/><path d="M9 7h.01M15 7h.01M9 11h.01M15 11h.01M9 15h.01M15 15h.01M10 21v-3h4v3"/></symbol>
  <symbol id="i-eye" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z"/><circle cx="12" cy="12" r="3"/></symbol>
  <symbol id="i-download" viewBox="0 0 24 24"><path d="M12 3v12M7 10l5 5 5-5M4 21h16"/></symbol>
  <symbol id="i-out" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></symbol>
</svg>

<div class="layout">
  <aside class="sidebar">
    <a class="brand" href="{{ route('admin') }}"><svg><use href="#i-home"/></svg>KostKu</a>
    <nav class="nav" aria-label="Menu utama">
      <a href="#"><svg><use href="#i-home"/></svg>Beranda</a>
      <a href="#"><svg><use href="#i-list"/></svg>Pemesanan</a>
      <a href="#"><svg><use href="#i-card"/></svg>Pembayaran</a>
      <a href="#"><svg><use href="#i-chart"/></svg>Laporan</a>
      <a href="{{ route('admin') }}" class="active" aria-current="page"><svg><use href="#i-user"/></svg>Pengguna</a>
      <a href="#"><svg><use href="#i-gear"/></svg>Pengaturan</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-logout"><svg><use href="#i-out"/></svg>Keluar</button>
      </form>
    </nav>
  </aside>

  <div>
    <header class="topbar">
      <label class="top-search">
        <svg><use href="#i-search"/></svg>
        <input type="search" placeholder="Cari kos, kontrakan, atau lokasi..." aria-label="Cari cepat">
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

    <main>
      <a class="back" href="#"><svg><use href="#i-back"/></svg>Kelola Pengguna</a>
      <h1>Pengguna</h1>
      <p class="sub">Kelola data pengguna yang terdaftar di sistem KostKu.</p>

      <section class="card filter-card" aria-label="Filter pengguna">
        <label class="search">
          <svg><use href="#i-search"/></svg>
          <input type="search" id="q" placeholder="Cari nama, email, atau nomor HP..." aria-label="Cari pengguna">
        </label>
        <div class="sel"><label for="f-role">Peran</label>
          <select id="f-role"><option value="">Semua</option><option>Penyewa</option><option>Pemilik</option><option>Admin</option></select>
          <svg><use href="#i-chev"/></svg></div>
        <div class="sel"><label for="f-status">Status</label>
          <select id="f-status"><option value="">Semua</option><option>Aktif</option><option>Nonaktif</option></select>
          <svg><use href="#i-chev"/></svg></div>
        <button class="btn-primary" id="add-btn" type="button"><svg><use href="#i-userplus"/></svg>Tambah Pengguna</button>
      </section>

      <section class="stats" aria-label="Ringkasan pengguna">
        <div class="card stat"><span class="ico blue"><svg><use href="#i-user"/></svg></span>
          <div><div class="lbl">Total Pengguna</div><div class="num">{{ $stats['total'] }}</div><div class="desc">Semua pengguna terdaftar</div></div></div>
        <div class="card stat"><span class="ico green"><svg><use href="#i-wallet"/></svg></span>
          <div><div class="lbl">Penyewa</div><div class="num">{{ $stats['penyewa'] }}</div><div class="desc">Pengguna dengan status penyewa</div></div></div>
        <div class="card stat"><span class="ico purple"><svg><use href="#i-building"/></svg></span>
          <div><div class="lbl">Pemilik</div><div class="num">{{ $stats['pemilik'] }}</div><div class="desc">Pemilik kos/kontrakan</div></div></div>
        <div class="card stat"><span class="ico orange"><svg><use href="#i-user"/></svg></span>
          <div><div class="lbl">Admin</div><div class="num">{{ $stats['admin'] }}</div><div class="desc">Pengelola sistem</div></div></div>
      </section>

      <section class="card table-card">
        <div class="table-head">
          <h2>Daftar Pengguna</h2>
          <button class="btn-outline" id="export" type="button"><svg><use href="#i-download"/></svg>Export Data</button>
        </div>
        <div class="table-wrap">
          <table>
            <thead><tr><th>No</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Peran</th><th>Status</th><th>Tanggal Daftar</th><th>Aksi</th></tr></thead>
            <tbody id="tbody"></tbody>
          </table>
        </div>
      </section>
    </main>
  </div>
</div>
<form id="del-form" method="POST" style="display:none">
  @csrf
  @method('DELETE')
</form>
<div class="toast" id="toast" role="status"></div>

<script>
  // Data pengguna asli dari database
  const users = @json($users);

  const $ = id => document.getElementById(id);
  const esc = s => String(s).replace(/[&<>"']/g, c => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));

  function filtered() {
    const q = $("q").value.trim().toLowerCase().replace(/\s/g, "");
    const role = $("f-role").value, status = $("f-status").value;
    return users.filter(u =>
      (!q || (u.name + u.email + u.phone).toLowerCase().replace(/\s/g, "").includes(q)) &&
      (!role || u.role === role) && (!status || u.status === status));
  }

  function render() {
    const list = filtered();
    $("tbody").innerHTML = list.length ? list.map((u, i) => `<tr>
      <td class="no">${i + 1}</td>
      <td>${esc(u.name)}</td><td>${esc(u.email)}</td><td>${esc(u.phone)}</td>
      <td><span class="badge r-${esc(u.role.toLowerCase())}">${esc(u.role)}</span></td>
      <td><span class="badge s-${esc(u.status.toLowerCase())}">${esc(u.status)}</span></td>
      <td>${esc(u.date)}</td>
      <td><div class="row-actions">
  <button class="btn-detail" type="button" data-email="${esc(u.email)}"><svg><use href="#i-eye"/></svg>Lihat Detail</button>
  ${u.can_delete ? `<button class="btn-del" type="button" data-del="${u.id}" data-name="${esc(u.name)}"><svg><use href="#i-trash"/></svg>Hapus</button>` : ""}
</div></td>
    </tr>`).join("") : `<tr><td colspan="8" class="empty">Pengguna tidak ditemukan. Coba ubah kata kunci atau filter.</td></tr>`;
  }

  function toast(msg) {
    const t = $("toast");
    t.textContent = msg;
    t.classList.add("show");
    clearTimeout(toast.t);
    toast.t = setTimeout(() => t.classList.remove("show"), 2200);
  }

  $("q").addEventListener("input", render);
  $("f-role").addEventListener("change", render);
  $("f-status").addEventListener("change", render);
  $("add-btn").addEventListener("click", () => toast("Buka form Tambah Pengguna"));

 $("tbody").addEventListener("click", e => {
  const del = e.target.closest("button[data-del]");
  if (del) {
    if (confirm(`Hapus akun "${del.dataset.name}"?\n\nSemua properti dan kamar milik akun ini juga akan terhapus. Tindakan ini tidak bisa dibatalkan.`)) {
      const f = $("del-form");
      f.action = "/admin/pengguna/" + del.dataset.del;
      f.submit();
    }
    return;
  }
  const b = e.target.closest("button[data-email]");
  if (b) toast(`Buka detail ${b.dataset.email}`);
  });

  // Export data yang sedang tampil ke file CSV
  $("export").addEventListener("click", () => {
    const list = filtered();
    if (!list.length) return toast("Tidak ada data untuk diekspor");
    const cell = v => `"${String(v).replace(/"/g, '""')}"`;
    const rows = [["Nama", "Email", "No. HP", "Peran", "Status", "Tanggal Daftar"], ...list.map(u => [u.name, u.email, u.phone, u.role, u.status, u.date])];
    const csv = "\uFEFF" + rows.map(r => r.map(cell).join(",")).join("\n");
    const a = document.createElement("a");
    a.href = URL.createObjectURL(new Blob([csv], { type: "text/csv;charset=utf-8" }));
    a.download = "pengguna-kostku.csv";
    document.body.appendChild(a);
    a.click();
    a.remove();
    URL.revokeObjectURL(a.href);
    toast(`${list.length} data diekspor`);
  });

  render();
  render();

@if (session('status'))
  toast(@json(session('status')));
@endif
</script>
</script>
</body>
</html>