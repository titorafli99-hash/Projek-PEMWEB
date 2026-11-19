<?php
session_start();

if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] === 'petugas') {
        header("Location: petugas/dashboard.php");
        exit;
    } else {
        header("Location: pengunjung/beranda.php");
        exit;
    }
}

header("Location: auth/login.php");
exit;
?>