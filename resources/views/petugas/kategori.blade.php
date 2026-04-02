<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Kategori</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

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
.btn-edit{
    background:#4e73df; /* biru */
    color:white;
}

.btn-delete{
    background:#dc3545; /* merah */
    color:white;
}
</style>

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
            @if(!empty($user->foto))
                <img src="{{ asset('uploads/'.$user->foto) }}">
            @else
                {{ strtoupper(substr($username,0,1)) }}
            @endif
        </div>
        <h3>{{ $username }}</h3>
    </div>

    <div class="menu">
        <a href="{{ route('petugas.dashboard') }}">
            <i class="fas fa-home"></i>Dashboard
        </a>

        <a href="/petugas/buku">
            <i class="fas fa-book"></i>Data Buku
        </a>

        <a href="/petugas/Anggota">
            <i class="fas fa-users"></i>Data Anggota
        </a>

        <a href="/petugas/peminjaman">
            <i class="fas fa-book-reader"></i>Peminjaman
        </a>

        <a href="/petugas/pengembalian">
            <i class="fas fa-undo"></i>Pengembalian
        </a>

        <a href="/petugas/kategori" class="active">
            <i class="fas fa-filter"></i>Manajemen Kategori
        </a>
    </div>

</div>


<!-- CONTENT -->
<div class="content">

    <div class="page-title">
        <button class="btn-add" onclick="openModal()">
            <i class="fas fa-plus"></i> Tambah Kategori
        </button>
    </div>
@if(session('error'))
    <div style="background:#dc3545;color:white;padding:12px;border-radius:10px;margin-bottom:15px;">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div style="background:#4CAF50;color:white;padding:12px;border-radius:10px;margin-bottom:15px;">
        {{ session('success') }}
    </div>
@endif
    <div class="table-box">
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>

            @forelse($kategori as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->nama_kategori }}</td>
<td>
    <button type="button" class="action-btn btn-edit" onclick="openEdit('{{ $k->id_kategori }}','{{ $k->nama_kategori }}')">Edit</button>

    <form action="{{ route('petugas.kategori.hapus', $k->id_kategori) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="action-btn btn-delete" onclick="return confirm('Hapus?')">Hapus</button>
</form>
</td>
            </tr>
            @empty
            <tr><td colspan="3">Tidak ada data</td></tr>
            @endforelse
        </table>
    </div>

</div>

<!-- MODAL TAMBAH -->
<div class="modal-overlay" id="modalTambah">
    <div class="modal-box">
        <h3>Tambah</h3>

        <form method="POST" action="{{ route('petugas.kategori.store') }}">
            @csrf
            <input type="text" name="nama_kategori" placeholder="Nama">
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>

<!-- MODAL EDIT -->
<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <h3>Edit</h3>

        <form method="POST" action="{{ route('petugas.kategori.update') }}">
            @csrf
            <input type="hidden" name="id_kategori" id="edit_id">
            <input type="text" name="nama_kategori" id="edit_nama">
            <button type="submit">Update</button>
        </form>
    </div>
</div>

<script>
function openModal(){
    document.getElementById('modalTambah').style.display='flex';
}

function openEdit(id,nama){
    document.getElementById('modalEdit').style.display='flex';
    document.getElementById('edit_id').value=id;
    document.getElementById('edit_nama').value=nama;
}
</script>

</body>
</html>