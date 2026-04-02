<!DOCTYPE html>
<html>
<head>
<title>Dashboard Anggota</title>
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

/* STAT CARDS */
.cards{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.stat-card{
    flex:1;
    min-width:200px;
    padding:25px;
    border-radius:20px;
    color:white;
    box-shadow:0 8px 15px rgba(0,0,0,0.1);
    transition:0.3s;
    cursor:pointer;
}

.stat-card:hover{
    transform:translateY(-5px);
    box-shadow:0 12px 20px rgba(0,0,0,0.2);
}

.stat-card h3{
    font-size:28px;
    margin:10px 0;
}

.stat-card i{
    font-size:30px;
    margin-bottom:10px;
    display:block;
}

/* WARNA PETUGAS */
.blue{background:#6c8bd5;}
.green{background:#4CAF50;}
.lightblue{background:#89aee6;}
.yellow{background:#f4b400;}

/* DASHBOARD BOTTOM SECTION */
.dashboard-bottom{
    margin-top:40px;
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.section-bawah{
    margin-top:40px;
    display:flex;
    gap:20px;
    flex-wrap:wrap;
}

.box{
    background:white;
    padding:20px;
    border-radius:20px;
    box-shadow:0 8px 15px rgba(0,0,0,0.1);
}

.box-buku{
    flex:1;
}

.box-info{
    flex:1;
}

.buku-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:15px;
    margin-top:15px;
}

.buku-item{
    background:#f3f4f6;
    padding:10px;
    border-radius:12px;
    text-align:center;
    transition:0.3s;
}

.buku-item:hover{
    transform:translateY(-5px);
}

.buku-item img{
    width:100%;
    height:120px;
    object-fit:cover;
    border-radius:10px;
}

.btn-lihat{
    display:inline-block;
    margin-top:15px;
    background:#1e3a8a;
    color:white;
    padding:10px 18px;
    border-radius:10px;
    text-decoration:none;
    transition:0.3s;
}

.btn-lihat:hover{
    background:#162c6b;
}
</style>
</head>

<body>

<div class="header">
    <div class="logo">
        <img src="{{ asset('assets/images/logo.png') }}">
        <strong style="color:#1e3a8a;">E-Libra Threeban</strong>
    </div>

    <div class="header-right">

        <!-- FOTO PROFIL -->
        <a href="#" style="text-decoration:none;">
            <div class="profile-top">
                @if(!empty($user->foto))
                    <img src="{{ asset('petugas/uploads/'.$user->foto) }}">
                @else
                    <div class="initial">
                        {{ strtoupper(substr($username,0,1)) }}
                    </div>
                @endif
            </div>
        </a>

        <!-- LOGOUT -->
        <a href="/logout" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

    </div>
</div>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="profile">
        <div class="avatar">
            @if(!empty($user->foto))
                <img src="{{ asset('petugas/uploads/'.$user->foto) }}">
            @else
                {{ strtoupper(substr($username,0,1)) }}
            @endif
        </div>
        <h3>{{ $username }}</h3>
    </div>

    <div class="menu">
        <a href="{{ route('anggota.dashboard') }}" class="{{ $halaman=='dashboard'?'active':'' }}">
            <i class="fas fa-home"></i>Dashboard
        </a>

        <a href="/anggota/buku" class="{{ $halaman=='buku'?'active':'' }}">
            <i class="fas fa-book"></i>Daftar buku
        </a>

        <a href="/anggota/peminjaman" class="{{ $halaman=='peminjaman'?'active':'' }}">
            <i class="fas fa-book-reader"></i>Peminjaman
        </a>

        <a href="/anggota/pengembalian" class="{{ $halaman=='pengembalian'?'active':'' }}">
            <i class="fas fa-undo"></i>Pengembalian
        </a>
    </div>

</div>

<!-- CONTENT -->
<div class="content">
    <div class="cards">

        <div class="stat-card blue">
            <i class="fas fa-book"></i>
            <h3>{{ $total_buku }}</h3>
            Total Buku
        </div>

        <div class="stat-card yellow">
            <i class="fas fa-book-reader"></i>
            <h3>{{ $total_pinjam }}</h3>
            Peminjaman Aktif
        </div>

        <div class="stat-card green">
            <i class="fas fa-history"></i>
            <h3>{{ $total_riwayat }}</h3>
            Total Riwayat
        </div>

        <div class="stat-card lightblue">
            <i class="fas fa-money-bill"></i>
            <h3>{{ $total_denda }}</h3>
            Denda Belum Dibayar
        </div>

    </div>

    <div class="section-bawah">

        <!-- TOP BUKU -->
        <div class="box">
            <h3>📚 Buku Paling Banyak Dipinjam</h3>

            <div class="buku-grid">
                @foreach($top_buku as $b)
                <div class="buku-item">
                    @if(!empty($b->cover))
                        <img src="{{ asset('uploads/'.$b->cover) }}">
                    @else
                        <img src="{{ asset('assets/default-book.png') }}">
                    @endif

                    <p><strong>{{ $b->judul }}</strong></p>
                    <small>{{ $b->total_pinjam }}x dipinjam</small>
                </div>
                @endforeach
            </div>

            <a href="#" class="btn-lihat">Lihat Semua Buku</a>
        </div>

        <!-- INFO -->
        <div class="box">
            <h3>📢 Info Perpustakaan</h3>
            <p>📌 Lama peminjaman 7 hari</p>
            <p>📌 Keterlambatan dikenakan denda 1000 perhari</p>
            <p>📌 Buku harus dikembalikan dengan kondisi seperti awal meminjam</p>
            <p>📌 Buku hilang atau rusak wajib ganti</p>
        </div>

    </div>
</div>

</body>
</html>