<?php
session_start();
include 'koneksi.php'; // Pastikan ada file koneksi database

// Fungsi untuk menambahkan notifikasi
function tambahNotifikasi($user_id, $pesan) {
    global $conn;
    $query = "INSERT INTO notifikasi (user_id, pesan, status) VALUES ('$user_id', '$pesan', 'unread')";
    mysqli_query($conn, $query);
}

// Fungsi untuk mengambil notifikasi pengguna tertentu
function ambilNotifikasi($user_id) {
    global $conn;
    $query = "SELECT * FROM notifikasi WHERE user_id = '$user_id' ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Fungsi untuk menambahkan notifikasi tenggat pembayaran
function cekTenggatPembayaran() {
    global $conn;
    $query = "SELECT user_id, jatuh_tempo FROM pembayaran WHERE status = 'belum lunas'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $jatuh_tempo = strtotime($row['jatuh_tempo']);
        $sekarang = time();
        $selisih = ($jatuh_tempo - $sekarang) / (60 * 60 * 24);
        
        if ($selisih <= 3) { // Kirim notifikasi jika kurang dari atau sama dengan 3 hari
            $pesan = "Pembayaran SPP Anda jatuh tempo pada " . $row['jatuh_tempo'] . ". Harap segera melakukan pembayaran.";
            tambahNotifikasi($row['user_id'], $pesan);
        }
    }
}

// Panggil fungsi cek tenggat pembayaran
cekTenggatPembayaran();

// Menampilkan notifikasi dalam bentuk JSON (untuk AJAX)
if (isset($_GET['aksi']) && $_GET['aksi'] == 'ambil') {
    $user_id = $_SESSION['user_id'];
    echo json_encode(ambilNotifikasi($user_id));
    exit;
}
?>
