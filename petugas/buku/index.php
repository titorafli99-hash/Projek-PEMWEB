<?php
session_start();
require_once '../../koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../../auth/login.php");
    exit;
}

$result = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id_buku DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku - PerpusKu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../dashboard.php">PerpusKu (Petugas)</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../dashboard.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="index.php">Kelola Buku</a></li>
                </ul>
                <div class="d-flex align-items-center text-white">
                    <span class="me-3 small">Halo, <strong><?= htmlspecialchars($_SESSION['nama_lengkap']); ?></strong></span>
                    <a href="../../auth/logout.php" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin keluar?')">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">Daftar Koleksi Buku</h4>
            <a href="tambah.php" class="btn btn-primary btn-sm">+ Tambah Buku Baru</a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th width="5%">No</th>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th width="15%">Tahun Terbit</th>
                                <th width="10%">Stok</th>
                                <th width="15%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                                        <td><?= htmlspecialchars($row['pengarang']); ?></td>
                                        <td><?= $row['tahun_terbit']; ?></td>
                                        <td><span class="badge bg-secondary"><?= $row['stok']; ?></span></td>
                                        <td class="text-center">
                                            <a href="ubah.php?id=<?= $row['id_buku']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="hapus.php?id=<?= $row['id_buku']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center text-muted py-3">Belum ada data buku.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>