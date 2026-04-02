<!DOCTYPE html>
<html>
<head>
<title>Dashboard Petugas</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
        url('../assets/bgsidebarmenu.png');
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

.table-box{
    flex:2;
    background:white;
    padding:20px;
    border-radius:20px;
    box-shadow:0 8px 15px rgba(0,0,0,0.08);
}

.table-box h3{
    margin-bottom:15px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th, table td{
    padding:10px;
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
    background:#e9f0ff;
    transition:0.2s;
}

.status{
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:bold;
    color:white;
}

.status.aktif{
    background:#4CAF50;
}

.status.terlambat{
    background:#dc3545;
}

/* NOTIFICATION BOX */
.notif-box{
    flex:2;
    background:white;
    padding:20px;
    border-radius:20px;
    box-shadow:0 8px 15px rgba(0,0,0,0.08);
}

.notif-item{
    background:#f8f9fc;
    padding:15px;
    border-radius:15px;
    margin-bottom:15px;
    font-size:14px;
}

.notif-item span{
    font-weight:bold;
    color:#dc3545;
}

.chart-box{
    margin-top:1px;
    background:white;
    padding:25px;
    border-radius:20px;
    box-shadow:0 8px 15px rgba(0,0,0,0.08);
    transition:0.3s;
}

.chart-box:hover{
    transform:translateY(-5px);
    box-shadow:0 12px 20px rgba(0,0,0,0.15);
}
.lihat-wrapper{
    text-align:center;
    margin-top:25px;
}

.lihat-btn{
    display:inline-block;
    text-decoration:none;
    background:#1e3a8a;
    color:white;
    padding:10px 25px;
    border-radius:30px;
    font-size:14px;
    font-weight:500;
    transition:0.3s;
}

.lihat-btn i{
    margin-right:8px;
}

.lihat-btn:hover{
    background:#163072;
    transform:translateY(-3px);
    box-shadow:0 10px 18px rgba(0,0,0,0.2);
}
</style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="logo">
        <img src="{{ asset('assets/logo.png') }}">
        <strong style="color:#1e3a8a;">E-Libra Threeban</strong>
    </div>

    <div class="header-right">

        <!-- PROFILE -->
        <a href="#" style="text-decoration:none;">
            <div class="profile-top">
                @if(!empty($user->foto))
                    <img src="{{ asset('uploads/'.$user->foto) }}">
                @else
                    <div class="initial">
                        {{ strtoupper(substr($username,0,1)) }}
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
        <a href="{{ route('petugas.dashboard') }}" class="active">
            <i class="fas fa-home"></i>Dashboard
        </a>

        <a href="/petugas/buku">
            <i class="fas fa-book"></i>Data Buku
        </a>

        <a href="/petugas/anggota">
            <i class="fas fa-users"></i>Data Anggota
        </a>

        <a href="/petugas/peminjaman">
            <i class="fas fa-book-reader"></i>Peminjaman
        </a>

        <a href="/petugas/pengembalian">
            <i class="fas fa-undo"></i>Pengembalian
        </a>

        <a href="/petugas/kategori">
            <i class="fas fa-filter"></i>Manajemen Kategori
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

        <div class="stat-card green">
            <i class="fas fa-users"></i>
            <h3>{{ $total_anggota }}</h3>
            Total Anggota
        </div>

        <div class="stat-card yellow">
            <i class="fas fa-book-reader"></i>
            <h3>{{ $total_pinjam }}</h3>
            Peminjaman Aktif
        </div>

        <div class="stat-card lightblue">
            <i class="fas fa-undo"></i>
            <h3>{{ $total_kembali_hariini }}</h3>
            Pengembalian Hari Ini
        </div>

    </div>

    <div class="dashboard-bottom">

        <!-- TABLE -->
        <div class="table-box">
            <table>
                <tr>
                    <th>Nama</th>
                    <th>Judul Buku</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>

                @forelse($peminjaman_terbaru as $row)
                    @php
                        $status_class = $row->selisih_hari > 7 ? 'terlambat' : 'aktif';
                        $status_text = $row->selisih_hari > 7 ? 'Terlambat' : 'Aktif';
                    @endphp

                    <tr>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->judul }}</td>
                        <td>{{ $row->tgl_peminjaman }}</td>
                        <td>
                            <span class="status {{ $status_class }}">
                                {{ $status_text }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4">Belum ada peminjaman.</td></tr>
                @endforelse
            </table>

            <div class="lihat-wrapper">
                <a href="/petugas/peminjaman" class="lihat-btn">
                    <i class="fas fa-eye"></i> Lihat Selengkapnya
                </a>
            </div>
        </div>

        <!-- CHART -->
        <div class="chart-box">
            <h3>Statistik Peminjaman 7 Hari Terakhir</h3>
            <canvas id="myChart"></canvas>
        </div>

    </div>
</div>

<script>
const ctx = document.getElementById('myChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            @for($i=6; $i>=0; $i--)
                "{{ \Carbon\Carbon::now()->subDays($i)->format('d M') }}",
            @endfor
        ],
        datasets: [
        {
            label: 'Peminjaman',
            data: @json($data_chart),
            borderColor: '#3b82f6',
            borderWidth: 3,
            tension: 0.3
        },
        {
            label: 'Pengembalian',
            data: @json($data_kembali),
            borderColor: '#f4b400',
            borderWidth: 3,
            tension: 0.3
        }
        ]
    }
});
</script>

</body>
</html>