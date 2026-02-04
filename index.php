<?php
// Array data produk PlayStation asosiatif 
$produk = [
    [
        "nama" => "PlayStation 3",
        "gambar" => "img/ps3.png",
        "deskripsi" => "Console klasik dengan banyak pilihan game.",
        "harga" => 5000
    ],
    [
        "nama" => "PlayStation 4",
        "gambar" => "img/ps4.png",
        "deskripsi" => "Grafis tajam dan game populer.",
        "harga" => 10000
    ],
    [
        "nama" => "PlayStation 5",
        "gambar" => "img/ps5.jpg",
        "deskripsi" => "Performa tinggi dengan teknologi terbaru.",
        "harga" => 15000
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rental PlayStation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                        url('img/baiground.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            color: white;
        }
        .card-img-top {
            height: 220px;
            object-fit: contain;
            padding: 15px;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .card-title { margin-bottom: 8px; font-weight: 600; }
        .card-text { font-size: 0.95rem; color: #555; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Ashura PS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="#harga">Daftar Harga</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                <li class="nav-item">
                    <a class="nav-link btn btn-success text-white ms-2 px-3" href="pemesanan.php">Pemesanan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="container text-center">
        <h1 class="fw-bold display-4">Rental PlayStation</h1>
        <p class="lead">Tempat Rental PS Nyaman, Murah, dan Lengkap</p>
        <a href="pemesanan.php" class="btn btn-success btn-lg mt-3">Pesan Sekarang</a>
    </div>
</section>

<!-- PRODUK / daftar console -->
<section class="container my-5" id="produk">
    <h2 class="text-center mb-4">Produk</h2>
    <div class="row g-4">

        <?php foreach($produk as $item): ?>
        <!-- Mengulang setiap item produk menggunakan foreach -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <!-- Gambar produk -->
                <img src="<?= $item['gambar']; ?>" class="card-img-top" alt="<?= $item['nama']; ?>">
                <div class="card-body text-center">
                    <!-- Nama produk -->
                    <h5 class="card-title"><?= $item['nama']; ?></h5>
                    <!-- Deskripsi produk -->
                    <p class="card-text"><?= $item['deskripsi']; ?></p>
                    <!-- Tombol pesan -->
                    <a href="pemesanan.php" class="btn btn-success mt-2">Pesan Sekarang</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</section>

<!-- DAFTAR HARGA -->
<section class="container my-5" id="harga">
    <h2 class="text-center mb-4">Daftar Harga</h2>
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Jenis PlayStation</th>
                <th>Harga / Jam</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($produk as $item): ?>
            <tr>
                <td><?= $item['nama']; ?></td>
                <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<!-- TENTANG KAMI -->
<section class="container my-5" id="tentang">
    <h2 class="text-center mb-4">Tentang Kami</h2>
    <div class="card shadow mx-auto p-4" style="max-width:600px;">
        <p><strong>Deskripsi Usaha:</strong><br>
        Kami menyediakan jasa rental PlayStation dengan tempat nyaman dan harga terjangkau.</p>

        <p><strong>Alamat:</strong><br>Jl. Game Center No. 10</p>
        <p><strong>Nomor Telepon:</strong><br>0812-3456-7890</p>
        <p><strong>Email:</strong><br>AshuraPS@gmail.com</p>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; 2026 Rental PlayStation</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
