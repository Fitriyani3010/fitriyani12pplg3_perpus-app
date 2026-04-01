@php
$username = session('username');
@endphp

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Admin</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* (SEMUA CSS SAMA PERSIS — AKU GAK UBAH) */
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#e9edf5;
}
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
.header-right{
    display:flex;
    align-items:center;
    gap:15px;
}
.profile-top{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#1e3a8a;
    display:flex;
    align-items:center;
    justify-content:center;
    overflow:hidden;
}
.initial{
    color:white;
    font-weight:bold;
}
.logout-btn{
    background:#dc3545;
    color:white;
    padding:10px 18px;
    border-radius:12px;
    text-decoration:none;
}
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
}
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
.content{
    margin-left:260px;
    margin-top:80px;
    padding:30px;
}
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
}
.blue{background:#6c8bd5;}
.green{background:#4CAF50;}
.lightblue{background:#89aee6;}
.yellow{background:#f4b400;}
.table-box{
    background:white;
    padding:20px;
    border-radius:20px;
    margin-top:20px;
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="logo">
        <img src="/assets/images/logo.png">
        <strong style="color:#1e3a8a;">E-Libra Threeban</strong>
    </div>

    <div class="header-right">

        <div class="profile-top">
            <div class="initial">
                {{ strtoupper(substr($username,0,1)) }}
            </div>
        </div>

        <a href="/logout" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
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
        <a href="/admin/dashboard" class="active"><i class="fas fa-chart-line"></i>Dashboard</a>
        <a href="/admin/buku"><i class="fas fa-book"></i>Data Buku</a>
        <a href="/admin/kategori"><i class="fas fa-tags"></i>Data Kategori</a>
        <a href="/admin/anggota"><i class="fas fa-users"></i>Data Anggota</a>
        <a href="/admin/petugas"><i class="fas fa-user-tie"></i>Data Petugas</a>
        <a href="/admin/peminjaman"><i class="fas fa-book-reader"></i>Peminjaman</a>
    </div>

</div>

<!-- CONTENT -->
<div class="content">

<h2 style="margin-bottom:25px;color:#1e3a8a;">
Dashboard Admin
</h2>

<!-- CARDS -->
<div class="cards">

    <div class="stat-card blue">
        <h3>{{ $total_buku }}</h3>
        <p>Total Buku</p>
    </div>

    <div class="stat-card green">
        <h3>{{ $total_anggota }}</h3>
        <p>Total Anggota</p>
    </div>

    <div class="stat-card yellow">
        <h3>{{ $total_pinjam }}</h3>
        <p>Peminjaman Aktif</p>
    </div>

    <div class="stat-card lightblue">
        <h3>{{ $kembali_hari_ini }}</h3>
        <p>Pengembalian Hari Ini</p>
    </div>

</div>

<!-- CHART -->
<div class="table-box">
    <h3>Aktivitas 7 Hari Terakhir</h3>
    <canvas id="chartAktivitas"></canvas>
</div>

<!-- TOP BUKU -->
<div class="table-box">
    <h3>Top 5 Buku</h3>

    @foreach($top_buku as $tb)
        <div style="padding:10px 0;border-bottom:1px solid #eee;">
            <strong>{{ $tb->judul }}</strong>
            <div style="font-size:13px;color:#777;">
                {{ $tb->total }} kali dipinjam
            </div>
        </div>
    @endforeach

</div>

<!-- AKTIVITAS -->
<div class="table-box">
    <h3>Aktivitas Terbaru</h3>

    @foreach($recent as $r)
        <div style="padding:10px 0;border-bottom:1px solid #eee;">
            <strong>{{ $r->username }}</strong>
            meminjam {{ $r->judul }}
            <div style="font-size:12px;color:#888;">
                {{ $r->tgl_peminjaman }}
            </div>
        </div>
    @endforeach

</div>

</div>

<script>
const ctx = document.getElementById('chartAktivitas');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($label_tanggal),
        datasets: [
            {
                label: 'Peminjaman',
                data: @json($data_pinjam),
                borderColor: '#3b82f6',
                backgroundColor: 'transparent',
                tension: 0.3,
                borderWidth: 3
            },
            {
                label: 'Pengembalian',
                data: @json($data_kembali),
                borderColor: '#10b981',
                backgroundColor: 'transparent',
                tension: 0.3,
                borderWidth: 3
            }
        ]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>