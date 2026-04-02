<!DOCTYPE html>
<html>
<head>
<title>Data Petugas</title>
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

.table-box{
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 8px 15px rgba(0,0,0,0.08);
}

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.btn-tambah{
    padding:8px 15px;
    background:#1e3a8a;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
}

.btn-tambah:hover{
    background:#142a66;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th, table td{
    padding:12px;
    border-bottom:1px solid #eee;
    font-size:14px;
}

table th{
    background:#e3ecff;
    color:#1e3a8a;
}

.btn-hapus{
    padding:6px 12px;
    background:#dc3545;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

.btn-hapus:hover{
    background:#b02a37;
}

.message{
    margin-bottom:15px;
    font-weight:500;
}

/* MODAL */
.modal{
    display:none;
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
    justify-content:center;
    align-items:center;
    z-index:2000;
}

.modal-content{
    background:white;
    padding:30px;
    border-radius:15px;
    width:350px;
    animation:popup 0.3s ease;
}

.modal-content h3{
    margin-top:0;
}

.modal-content input{
    width:100%;
    padding:10px;
    margin-bottom:12px;
    border:1px solid #ccc;
    border-radius:8px;
}

.modal-content button{
    width:100%;
    padding:10px;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

.save-btn{
    background:#1e3a8a;
    color:white;
    margin-bottom:8px;
}

.cancel-btn{
    background:#ccc;
}

@keyframes popup{
    from{transform:scale(0.8); opacity:0;}
    to{transform:scale(1); opacity:1;}
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
    <div class="table-box">
        <div class="top-bar">
            <h2>📌 Data Petugas</h2>
            <button class="btn-tambah" onclick="openModal()"><i class="fas fa-plus"></i> Tambah Petugas</button>
        </div>

        @if(session('message'))
            <div class="message">{{ session('message') }}</div>
        @endif

        <table>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            @foreach($petugas as $no => $p)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $p->username }}</td>
                <td>{{ $p->alamat }}</td>
                <td>{{ $p->no_telp }}</td>
                <td>{{ $p->status }}</td>
                <td>
                    <a href="{{ route('petugas.destroy', $p->id_user) }}" onclick="return confirm('Yakin hapus?')">
                        <button class="btn-hapus"><i class="fas fa-trash"></i></button>
                    </a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

<!-- MODAL -->
<div class="modal" id="modalForm">
    <div class="modal-content">
        <h3>Tambah Petugas</h3>
        <form method="POST" action="{{ route('petugas.store') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="text" name="no_telp" placeholder="No Telepon" required>
            <button type="submit" class="save-btn">Simpan</button>
            <button type="button" class="cancel-btn" onclick="closeModal()">Batal</button>
        </form>
    </div>
</div>

<script>
function openModal(){ document.getElementById("modalForm").style.display="flex"; }
function closeModal(){ document.getElementById("modalForm").style.display="none"; }
window.onclick = function(e){ if(e.target == document.getElementById("modalForm")) closeModal(); }
</script>

</body>
</html>