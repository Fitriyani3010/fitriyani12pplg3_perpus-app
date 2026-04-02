```blade
<!DOCTYPE html>
<html>
<head>
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
h2{
    margin-bottom:20px;
}
.search-box{
    margin-bottom:20px;
}
input[type=text]{
    padding:8px;
    width:250px;
}
button{
    padding:8px 12px;
}
.card-container{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(200px,1fr));
    gap:20px;
}
.card{
    background:white;
    border-radius:10px;
    box-shadow:0 4px 8px rgba(0,0,0,0.1);
    overflow:hidden;
    transition:0.3s;
}
.card:hover{
    transform:scale(1.03);
}
.card img{
    width:100%;
    height:250px;
    object-fit:cover;
}
.card-body{
    padding:15px;
}
.judul{
    font-weight:bold;
    font-size:16px;
    margin-bottom:8px;
}
.stok{
    color:green;
}
.stok-habis{
    color:red;
}
.card-footer{
    display:flex;
    justify-content:space-between;
    gap:10px;
    margin-top:10px;
}

.btn-card{
    flex:1;
    padding:8px;
    text-align:center;
    border-radius:8px;
    text-decoration:none;
    font-size:14px;
    font-weight:500;
    transition:0.3s;
}

.btn-detail{
    background:#6c757d;
    color:white;
}

.btn-detail:hover{
    background:#5a6268;
}

.btn-pinjam{
    background:#28a745;
    color:white;
}

.btn-pinjam:hover{
    background:#218838;
}

.btn-disabled{
    background:#ccc;
    color:#666;
    pointer-events:none;
}
/* MODAL */
/* MODAL MODERN */
.modal{
    display:none;
    position:fixed;
    z-index:2000;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.7);
    backdrop-filter:blur(4px);
    justify-content:center;
    align-items:center;
    padding:20px;
}

.modal-content{
    background:white;
    width:750px;
    max-width:95%;
    border-radius:20px;
    padding:30px;
    display:flex;
    gap:30px;
    position:relative;
    animation:popup 0.3s ease;
    box-shadow:0 15px 40px rgba(0,0,0,0.2);
}

@keyframes popup{
    from{transform:scale(0.8); opacity:0;}
    to{transform:scale(1); opacity:1;}
}

.modal-left{
    flex:1;
    text-align:center;
}

.modal-left img{
    width:100%;
    max-width:220px;
    height:300px;
    object-fit:cover;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.modal-right{
    flex:2;
}

.modal-right h2{
    margin-top:0;
    margin-bottom:15px;
    color:#1e3a8a;
}

.detail-item{
    display:flex;
    justify-content:space-between;
    background:#f4f6fb;
    padding:10px 15px;
    border-radius:10px;
    margin-bottom:10px;
    font-size:14px;
}

.detail-item span:first-child{
    font-weight:600;
    color:#555;
}

.badge{
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge-green{
    background:#d4edda;
    color:#155724;
}

.badge-red{
    background:#f8d7da;
    color:#721c24;
}

.close{
    position:absolute;
    top:15px;
    right:20px;
    font-size:22px;
    cursor:pointer;
    color:#999;
}

.close:hover{
    color:#333;
}
.filter-box{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    margin-bottom:25px;
}

.filter-box form{
    display:flex;
    flex-wrap:wrap;
    gap:15px;
    align-items:center;
}

.filter-box input,
.filter-box select{
    padding:8px 10px;
    border-radius:8px;
    border:1px solid #ccc;
}

.filter-box button{
    background:#1e3a8a;
    color:white;
    border:none;
    border-radius:8px;
    padding:8px 15px;
    cursor:pointer;
    transition:0.3s;
}

.filter-box button:hover{
    background:#162d6b;
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
        <a href="/profil" style="text-decoration:none;">
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
                <img src="{{ asset('petugas/uploads/'.$user->foto) }}">
            @else
                {{ strtoupper(substr($username,0,1)) }}
            @endif
        </div>
        <h3>{{ $username }}</h3>
    </div>

    <div class="menu">
        <a href="/anggota/dashboard" class="{{ $halaman=='dashboard'?'active':'' }}">
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

    <!-- FILTER -->
    <div class="filter-box">
        <form method="GET">

            <input type="text" name="search" placeholder="Cari buku..." value="{{ request('search') }}">

            <select name="kategori">
                <option value="">Semua Kategori</option>
                @foreach($kategoriData as $k)
                    <option value="{{ $k->id_kategori }}"
                        {{ request('kategori') == $k->id_kategori ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>

            <select name="urut">
                <option value="">Urutkan</option>
                <option value="az" {{ request('urut')=='az'?'selected':'' }}>Judul A-Z</option>
                <option value="dipinjam_terbanyak" {{ request('urut')=='dipinjam_terbanyak'?'selected':'' }}>
                    Paling Banyak Dipinjam
                </option>
            </select>

            <button type="submit">Terapkan</button>
        </form>
    </div>

    <!-- CARD -->
    <div class="card-container">

        @foreach($data as $row)

        <div class="card">
            <img src="{{ asset('petugas/uploads/'.$row->cover) }}">

            <div class="card-body">

                <div class="judul">{{ $row->judul }}</div>

                @if($row->stok > 0)
                    <div class="stok">Stok: {{ $row->stok }}</div>
                @else
                    <div class="stok-habis">Stok Habis</div>
                @endif

                <div class="card-footer">

                    <a href="#"
                       class="btn-card btn-detail"
                       onclick="showDetail(
                           '{{ addslashes($row->judul) }}',
                           '{{ addslashes($row->penulis) }}',
                           '{{ addslashes($row->penerbit) }}',
                           '{{ $row->tahun_terbit }}',
                           '{{ $row->stok }}',
                           '{{ addslashes($row->lokasi) }}',
                           '{{ addslashes($row->nama_kategori) }}',
                           '{{ asset('petugas/uploads/'.$row->cover) }}'
                       )">
                       Detail
                    </a>

                    @if($row->stok > 0)
                        <a href="/anggota/pinjam/{{ $row->id_buku }}"
                           class="btn-card btn-pinjam">
                           Pinjam
                        </a>
                    @else
                        <a class="btn-card btn-disabled">
                           Tidak Tersedia
                        </a>
                    @endif

                </div>
            </div>
        </div>

        @endforeach

    </div>
</div>

<!-- MODAL -->
<div class="modal" id="detailModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

        <div class="modal-left">
            <img id="modalCover">
        </div>

        <div class="modal-right">
            <h2 id="modalJudul"></h2>

            <div class="detail-item">
                <span>Penulis</span>
                <span id="modalPenulis"></span>
            </div>

            <div class="detail-item">
                <span>Penerbit</span>
                <span id="modalPenerbit"></span>
            </div>

            <div class="detail-item">
                <span>Tahun Terbit</span>
                <span id="modalTahun"></span>
            </div>

            <div class="detail-item">
                <span>Lokasi</span>
                <span id="modalLokasi"></span>
            </div>

            <div class="detail-item">
                <span>ID Kategori</span>
                <span id="modalKategori"></span>
            </div>

            <div class="detail-item">
                <span>Stok</span>
                <span id="modalStok"></span>
            </div>
        </div>
    </div>
</div>

<script>
function showDetail(judul, penulis, penerbit, tahun, stok, lokasi, kategori, cover){
    document.getElementById("modalJudul").innerText = judul;
    document.getElementById("modalPenulis").innerText = penulis;
    document.getElementById("modalPenerbit").innerText = penerbit;
    document.getElementById("modalTahun").innerText = tahun;
    document.getElementById("modalLokasi").innerText = lokasi;
    document.getElementById("modalKategori").innerText = kategori;
    document.getElementById("modalCover").src = cover;

    let stokElement = document.getElementById("modalStok");

    if(stok > 0){
        stokElement.innerHTML = `<span class="badge badge-green">Tersedia (${stok})</span>`;
    }else{
        stokElement.innerHTML = `<span class="badge badge-red">Stok Habis</span>`;
    }

    document.getElementById("detailModal").style.display = "flex";
}

function closeModal(){
    document.getElementById("detailModal").style.display = "none";
}

window.onclick = function(event){
    let modal = document.getElementById("detailModal");
    if(event.target == modal){
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
