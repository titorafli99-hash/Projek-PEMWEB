<?php
session_start();
require_once '../../koneksi.php';

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'petugas') {
    header("Location: ../../auth/login.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id > 0) {
    mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = $id");
}

header("Location: index.php");
exit;
?>