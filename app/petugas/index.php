
<?php
    include "header.php";
?>
<?php
// Cek apakah session sudah dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// Pastikan file koneksi ada sebelum di-include
$koneksi_file = "../inc/koneksi.php";
if (file_exists($koneksi_file)) {
    include $koneksi_file;
} else {
    die("Error: File koneksi tidak ditemukan!");
}

// Ambil data ringkasan dengan menghindari nilai NULL
$total_siswa = mysqli_fetch_assoc(mysqli_query($konek, "SELECT COUNT(*) as total FROM tb_siswa"))['total'] ?? 0;
$total_kelas = mysqli_fetch_assoc(mysqli_query($konek, "SELECT COUNT(*) as total FROM tb_kelas"))['total'] ?? 0;
$total_tunggakan = mysqli_fetch_assoc(mysqli_query($konek, "SELECT IFNULL(SUM(jumlah_bayar), 0) as total FROM tb_pembayaran WHERE ket='BELUM BAYAR'"))['total'] ?? 0;
$total_pembayaran = mysqli_fetch_assoc(mysqli_query($konek, "SELECT IFNULL(SUM(jumlah_bayar), 0) as total FROM tb_pembayaran WHERE ket='LUNAS'"))['total'] ?? 0;

// Sertakan file heade
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembayaran SPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row mt-4">
            <!-- Total Siswa -->
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Siswa</h5>
                        <p class="card-text text-center display-6"><?php echo $total_siswa; ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Total Kelas -->
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Kelas</h5>
                        <p class="card-text text-center display-6"><?php echo $total_kelas; ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Total Tunggakan -->
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Tunggakan</h5>
                        <p class="card-text text-center display-6">Rp. <?php echo number_format($total_tunggakan, 2, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Total Pembayaran -->
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Pembayaran</h5>
                        <p class="card-text text-center display-6">Rp. <?php echo number_format($total_pembayaran, 2, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
        

</div>
    
<?php
    include "footer.php";
?>