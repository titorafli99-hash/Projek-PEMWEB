<?php
session_start();
require_once '../koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'pengunjung') {
    header("Location: ../auth/login.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku - PerpusKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="beranda.php">PerpusKu (Pengunjung)</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" href="beranda.php">Katalog Buku</a></li>
                </ul>
                <div class="d-flex align-items-center text-white">
                    <span class="me-3 small">Halo, <strong><?= htmlspecialchars($_SESSION['nama_lengkap']); ?></strong></span>
                    <a href="../auth/logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin keluar?')">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="alert alert-success border-0 shadow-sm mb-4">
            <h5 class="alert-heading fw-bold">Layanan Click & Collect PerpusKu</h5>
            <p class="mb-0 small">Cek ketersediaan buku di bawah ini, lalu ambil langsung di meja perpustakaan!</p>
        </div>

        <h4 class="fw-bold mb-3">Daftar Katalog Buku</h4>

        <div class="row">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark"><?= htmlspecialchars($row['judul_buku']); ?></h5>
                                <p class="text-muted small mb-2">Pengarang: <?= htmlspecialchars($row['pengarang']); ?></p>
                                <p class="text-muted small mb-3">Tahun: <?= $row['tahun_terbit']; ?></p>
                                
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="badge <?= $row['stok'] > 0 ? 'bg-primary' : 'bg-danger'; ?>">
                                        Stok: <?= $row['stok']; ?>
                                    </span>
                                    
                                    <?php if ($row['stok'] > 0): ?>
                                        <button class="btn btn-outline-success btn-sm" onclick="alert('Fitur pemesanan akan segera hadir!')">Pesan Buku</button>
                                    <?php else: ?>
                                        <button class="btn btn-secondary btn-sm" disabled>Stok Habis</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12"><div class="alert alert-warning text-center">Belum ada buku tersedia di katalog.</div></div>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>