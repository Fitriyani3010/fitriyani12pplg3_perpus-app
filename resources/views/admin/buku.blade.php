<!DOCTYPE html>
<html>
<head>
<title>Data Buku</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#e9edf5;
}

/* HEADER */
.header{
    height:80px;
    background:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 30px;
    box-shadow:0 4px 10px rgba(0,0,0,0.05);
    position:fixed;
    top:0;
    left:0;
    right:0;
    z-index:1000;
}

.logo{
    display:flex;
    align-items:center;
}

.logo img{
    height:75px;
    margin-right:10px;
}

.toggle-btn{
    font-size:22px;
    cursor:pointer;
}

/* HEADER RIGHT */
.header-right{
    display:flex;
    align-items:center;
    gap:15px;
}

/* FOTO PROFIL */
.profile-top{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#1e3a8a; /* navy */
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
    cursor:pointer;
    transition:0.3s;
}

.profile-top:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 15px rgba(0,0,0,0.2);
}

.profile-top img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.initial{
    color:white;
    font-weight:bold;
    font-size:18px;
}

/* LOGOUT BUTTON */
.logout-btn{
    display:flex;
    align-items:center;
    gap:8px;
    background:#dc3545;
    color:white;
    padding:10px 18px;
    border-radius:12px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.logout-btn i{
    font-size:14px;
}

.logout-btn:hover{
    background:#b02a37;
    transform:translateY(-3px);
    box-shadow:0 8px 15px rgba(0,0,0,0.2);
}
/* DROPDOWN */
.dropdown{
    position:absolute;
    right:0;
    top:60px;
    background:white;
    width:170px;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
    display:none;
    overflow:hidden;
}

.dropdown a{
    display:block;
    padding:12px 15px;
    text-decoration:none;
    color:#333;
    font-size:14px;
    transition:0.2s;
}

.dropdown a:hover{
    background:#f3f4f6;
}

.dropdown a i{
    margin-right:8px;
    color:#5b7bd5;
}

.dropdown.show{
    display:block;
}
/* SIDEBAR */
.sidebar{
    width:230px;
    height:calc(100vh - 80px);
    position:fixed;
    top:80px;
    left:0;
    background:
        linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),
        url('../assets/images/bgsidebarmenu.png');
    background-size:cover;
    padding:20px;
    transition:0.3s;
}

.sidebar.closed{
    width:80px;
}

/* PROFILE */
.profile{
    text-align:center;
    margin-bottom:25px;
    color:white;
}

.avatar{
    width:80px;
    height:80px;
    border-radius:50%;
    background:white;
    color:#4e73df;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    font-weight:bold;
    margin:0 auto;
    overflow:hidden;
}

.avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.profile h3{
    margin-top:10px;
    font-size:16px;
}

/* MENU STYLE */
.menu a{
    display:flex;
    align-items:center;
    gap:10px;
    background:rgba(255,255,255,0.85);
    color:#333;
    padding:12px 15px;
    margin:8px 0;
    border-radius:15px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.menu a:hover{
    background:white;
    transform:translateX(5px);
    box-shadow:0 6px 12px rgba(0,0,0,0.15);
}

.menu a i{
    width:20px;
    text-align:center;
    color:#5b7bd5;
}

/* ACTIVE MENU */
.menu a.active{
    background:white;
    border-left:5px solid #5b7bd5;
    padding-left:10px;
}

/* CONTENT */
.content{
    margin-left:260px;
    margin-top:80px;
    padding:30px;
}

.sidebar.closed + .content{
    margin-left:80px;
}


/* TITLE */
.page-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-title h2{
    color:#1e3a8a;
}

/* BUTTON TAMBAH */
.btn-add{
    background:#4CAF50;
    color:white;
    padding:10px 18px;
    border-radius:12px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.btn-add:hover{
    background:#3e8e41;
    transform:translateY(-3px);
}

/* FILTER BOX */
.filter-box{
    background:white;
    padding:20px;
    border-radius:20px;
    box-shadow:0 8px 15px rgba(0,0,0,0.08);
    margin-bottom:25px;
}

.filter-row{
    display:flex;
    gap:15px;
    margin-bottom:15px;
}

.filter-row select{
    flex:1;
    padding:10px;
    border-radius:10px;
    border:1px solid #ddd;
}

.search-row input{
    width:98%;
    padding:12px;
    border-radius:12px;
    border:1px solid #ddd;
}

.filter-button{
    margin-top:15px;
    text-align:right;
}

.filter-button button{
    background:#4CAF50;
    color:white;
    padding:10px 20px;
    border:none;
    border-radius:12px;
    cursor:pointer;
    transition:0.3s;
}

.filter-button button:hover{
    background:#3e8e41;
    transform:translateY(-2px);
}

/* MODAL OVERLAY */
.modal-overlay{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    backdrop-filter:blur(5px);
    display:none;
    align-items:center;
    justify-content:center;
    z-index:2000;
}

/* MODAL BOX */
.modal-box{
    background:white;
    width:400px;
    padding:25px;
    border-radius:20px;
    box-shadow:0 15px 30px rgba(0,0,0,0.3);
    animation:popUp 0.3s ease;
}

@keyframes popUp{
    from{transform:scale(0.8); opacity:0;}
    to{transform:scale(1); opacity:1;}
}

.modal-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.close-btn{
    font-size:22px;
    cursor:pointer;
    color:#dc3545;
}

.modal-box form{
    display:flex;
    flex-direction:column;
    gap:12px;
}

.modal-box input,
.modal-box select{
    padding:10px;
    border-radius:10px;
    border:1px solid #ddd;
    font-size:14px;
}

.btn-save{
    background:#4CAF50;
    color:white;
    padding:10px;
    border:none;
    border-radius:12px;
    cursor:pointer;
    transition:0.3s;
}

.btn-save:hover{
    background:#3e8e41;
}

/* TABLE BOX */
.table-box{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 8px 15px rgba(0,0,0,0.08);
}

table{
    width:100%;
    border-collapse:collapse;
}

table th, table td{
    padding:12px;
    text-align:left;
    border-bottom:1px solid #eee;
    font-size:14px;
}

table th{
    background:#e3ecff;
    color:#1e3a8a;
    font-weight:600;
}

table tr:hover td{
    background:#f0f5ff;
}

table img{
    border-radius:8px;
    object-fit:cover;
}

/* ACTION BUTTON */
.action-btn{
    padding:6px 12px;
    border-radius:8px;
    text-decoration:none;
    font-size:13px;
    margin-right:5px;
    transition:0.3s;
}

.edit{
    background:#6c8bd5;
    color:white;
}

.delete{
    background:#dc3545;
    color:white;
}

.edit:hover{
    background:#4e73df;
}

.delete:hover{
    background:#b02a37;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="logo">
        <img src="{{ asset('assets/images/logo.png') }}">
        <strong style="color:#1e3a8a;">E-Libra Threeban</strong>
    </div>

    <div class="header-right">

        <!-- PROFILE -->
        <a href="#" style="text-decoration:none;">
            <div class="profile-top">
                @if(session('user') && session('user')->foto)
                    <img src="{{ asset('uploads/' . session('user')->foto) }}">
                @else
                    <div class="initial">
                        {{ strtoupper(substr(session('user')->username ?? 'A',0,1)) }}
                    </div>
                @endif
            </div>
        </a>

        <!-- LOGOUT -->
        <a href="{{ route('logout') }}" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>

    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="profile">
        <div class="avatar">
            {{ strtoupper(substr($username,0,1)) }}
        </div>
        <h3>{{ $username }}</h3>
    </div>

    <div class="menu">
<a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
    <i class="fas fa-chart-line"></i>Dashboard
</a>

<a href="/admin/buku" class="{{ request()->is('admin/buku') ? 'active' : '' }}">
    <i class="fas fa-book"></i>Data Buku
</a>

<a href="/admin/kategori" class="{{ request()->is('admin/kategori') ? 'active' : '' }}">
    <i class="fas fa-tags"></i>Data Kategori
</a>

<a href="/admin/anggota" class="{{ request()->is('admin/anggota') ? 'active' : '' }}">
    <i class="fas fa-users"></i>Data Anggota
</a>

<a href="/admin/petugas" class="{{ request()->is('admin/petugas') ? 'active' : '' }}">
    <i class="fas fa-user-tie"></i>Data Petugas
</a>

<a href="/admin/peminjaman" class="{{ request()->is('admin/peminjaman') ? 'active' : '' }}">
    <i class="fas fa-book-reader"></i>Peminjaman
</a>
    </div>

</div>


<div class="content">

    <div class="page-title">
        <button class="btn-add" onclick="openModal()">
            <i class="fas fa-plus"></i> Tambah Buku
        </button>
    </div>

    <!-- FILTER -->
    <div class="filter-box">
        <form method="GET">

            <div class="filter-row">

                <!-- KATEGORI -->
                <select name="kategori">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}"
                            {{ request('kategori') == $k->id_kategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>

                <!-- STOK -->
                <select name="stok">
                    <option value="">Urut Stok</option>
                    <option value="DESC" {{ request('stok')=='DESC'?'selected':'' }}>
                        Stok Terbanyak
                    </option>
                    <option value="ASC" {{ request('stok')=='ASC'?'selected':'' }}>
                        Stok Terkecil
                    </option>
                </select>

                <!-- JUDUL -->
                <select name="urut">
                    <option value="">Urut Judul</option>
                    <option value="ASC" {{ request('urut')=='ASC'?'selected':'' }}>A - Z</option>
                    <option value="DESC" {{ request('urut')=='DESC'?'selected':'' }}>Z - A</option>
                </select>
            </div>

            <div class="search-row">
                <input type="text" name="cari" placeholder="🔎 Cari judul atau penulis..."
                    value="{{ request('cari') }}">
            </div>

            <div class="filter-button">
                <button type="submit">Terapkan Filter</button>
            </div>

        </form>
    </div>

    <!-- TABLE -->
    <div class="table-box">
        <table>
            <tr>
                <th>No</th>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>

            @forelse($buku as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>

                <td>
                    @if($row->cover)
                        <img src="{{ asset('uploads/'.$row->cover) }}" width="60">
                    @else
                        Tidak ada
                    @endif
                </td>

                <td>{{ $row->judul }}</td>
                <td>{{ $row->penulis }}</td>
                <td>{{ $row->penerbit }}</td>
                <td>{{ $row->tahun_terbit }}</td>
                <td>{{ $row->nama_kategori }}</td>
                <td>{{ $row->stok }}</td>
                <td>{{ $row->lokasi }}</td>

                <td>
                    <a href="#" class="action-btn edit"
                        onclick="openEditModal(
                        '{{ $row->id_buku }}',
                        '{{ $row->judul }}',
                        '{{ $row->penulis }}',
                        '{{ $row->penerbit }}',
                        '{{ $row->tahun_terbit }}',
                        '{{ $row->id_kategori }}',
                        '{{ $row->stok }}',
                        '{{ $row->lokasi }}',
                        '{{ $row->cover }}'
                        )">
                        <i class="fas fa-edit"></i>
                    </a>

                    <a href="{{ route('admin.buku.hapus',$row->id_buku) }}"
                        class="action-btn delete"
                        onclick="return confirm('Yakin ingin menghapus buku ini?')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10">Belum ada data buku</td>
            </tr>
            @endforelse

        </table>
    </div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal-overlay" id="modalForm">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Tambah Buku</h3>
            <span onclick="closeModal()" class="close-btn">&times;</span>
        </div>

        <form method="POST" action="{{ route('admin.buku.simpan') }}" enctype="multipart/form-data">
            @csrf

            <input type="text" name="judul" placeholder="Judul Buku" required>
            <input type="text" name="penulis" placeholder="Penulis" required>
            <input type="text" name="penerbit" placeholder="Penerbit" required>
            <input type="number" name="tahun" placeholder="Tahun Terbit" required>

            <select name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>

            <input type="number" name="stok" placeholder="Stok" required>
            <input type="text" name="lokasi" placeholder="Lokasi Buku" required>
            <input type="file" name="cover">

            <button type="submit" name="simpan" class="btn-save">
                Simpan Buku
            </button>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <div class="modal-header">
            <h3>Edit Buku</h3>
            <span onclick="closeEditModal()" class="close-btn">&times;</span>
        </div>

        <form method="POST" action="{{ route('admin.buku.update') }}" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id_buku" id="edit_id">

            <input type="text" name="judul" id="edit_judul" required>
            <input type="text" name="penulis" id="edit_penulis" required>
            <input type="text" name="penerbit" id="edit_penerbit" required>
            <input type="number" name="tahun" id="edit_tahun" required>

            <select name="id_kategori" id="edit_kategori" required>
                @foreach($kategori as $k)
                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>

            <input type="number" name="stok" id="edit_stok" required>
            <input type="text" name="lokasi" id="edit_lokasi" required>

            <div id="preview_cover"></div>
            <input type="file" name="cover">

            <button type="submit" name="update" class="btn-save">
                Update Buku
            </button>
        </form>
    </div>
</div>

<script>
function openModal(){
    document.getElementById("modalForm").style.display = "flex";
}

function closeModal(){
    document.getElementById("modalForm").style.display = "none";
}

function openEditModal(id, judul, penulis, penerbit, tahun, kategori, stok, lokasi, cover){
    document.getElementById("modalEdit").style.display="flex";

    edit_id.value = id;
    edit_judul.value = judul;
    edit_penulis.value = penulis;
    edit_penerbit.value = penerbit;
    edit_tahun.value = tahun;
    edit_kategori.value = kategori;
    edit_stok.value = stok;
    edit_lokasi.value = lokasi;

    if(cover){
        preview_cover.innerHTML = "<img src='/uploads/"+cover+"' width='80'>";
    }else{
        preview_cover.innerHTML = "";
    }
}

function closeEditModal(){
    document.getElementById("modalEdit").style.display="none";
}
</script>

</body>
</html>