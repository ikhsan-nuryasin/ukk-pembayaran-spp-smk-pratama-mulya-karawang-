<?php
    session_start();
    if (!isset($_SESSION['id']) || $_SESSION['id'] == "") {
        header('location:../login.php');
        exit();
    }

    include "inc/koneksi.php";

    // Menggunakan prepared statement untuk keamanan
    $stmt = $konek->prepare("SELECT * FROM tb_siswa WHERE nisn = ?");
    $stmt->bind_param("s", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $profil = $result->fetch_assoc();
    } else {
        die("Data siswa tidak ditemukan");
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran SPP - SISWA</title>

    <!-- Bootstrap CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/style.css" rel="stylesheet">

    <style>
        body {
            background-image: url(assets/img/bg-1.jpg);
            background-size: cover;
            background-position: center;
        }
        .navbar {
            border-radius: 0px 0px 30px 30px;
            background-color: #267365;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
        }
        .nav-pills li a {
            color: white !important;
        }
        .table-responsive {
            overflow-x: auto;
        }
        @media (max-width: 768px) {
            .navbar-header {
                text-align: center;
            }
            
            .table {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

 <nav class="navbar navbar-default navbar-fixed-top" style="border-radius: 0px 0px 40px 40px; border-color: black; background-color:  #267365;">
      <div class="container">
        <div class="navbar-header" style="margin-top: 2%;">
            <a class="navbar-brand" style="color: white;" href="index_siswa.php">HALLO.. <?php echo $profil['nama']; ?></a>
        </div>
        <div style="margin-top: 2%; margin-bottom: 1%;">
         <ul class="nav nav-pills" role="tablist">
            <li role="presentation" style="background-color: #F23030; border-radius: 50px;"><a href="riwayat_siswa.php">History Pembayaran</a></li>
            <li role="presentation"><a href="profile_siswa.php">Profile</a></li>
            <li role="presentation"><a href="inc/logout.php">Keluar</a></li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container" style="margin-top: 80px;">
    <div class="page-header">
        <h3>Riwayat Transaksi Pembayaran</h3>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" style="background-color:#ebe6e6;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NISN</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>No. Bayar</th>
                    <th>Bulan</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $nisn = $profil['nisn'];
                    $stmtBayar = $konek->prepare("SELECT tb_pembayaran.*, tb_siswa.nama, tb_siswa.nis, tb_kelas.nama_kelas, tb_kelas.kompetensi_keahlian
                                                  FROM tb_pembayaran
                                                  INNER JOIN tb_siswa ON tb_siswa.nisn = tb_pembayaran.nisn
                                                  INNER JOIN tb_kelas ON tb_kelas.id_kelas = tb_siswa.id_kelas
                                                  WHERE tb_pembayaran.nisn = ?
                                                  ORDER BY tb_pembayaran.jatuh_tempo ASC");

                    $stmtBayar->bind_param("s", $nisn);
                    $stmtBayar->execute();
                    $resultBayar = $stmtBayar->get_result();

                    if ($resultBayar->num_rows > 0) {
                        $no = 1;
                        $total = 0;
                        while ($d = $resultBayar->fetch_assoc()) {
                            echo "<tr>
                                    <td><center>$no</center></td>
                                    <td>{$d['nisn']}</td>
                                    <td>{$d['nis']}</td>
                                    <td>{$d['nama']}</td>
                                    <td><center>{$d['nama_kelas']} - {$d['kompetensi_keahlian']}</center></td>
                                    <td><center>{$d['nobayar']}</center></td>
                                    <td><center>{$d['bulan']}</center></td>
                                    <td><center>{$d['ket']}</center></td>
                                    <td align='right'>Rp. " . number_format($d['jumlah_bayar'], 2, ',', '.') . "</td>
                                </tr>";
                            $no++;
                            $total += $d['jumlah_bayar'];
                        }

                        echo "<tr>
                                <td colspan='8' align='right'><strong>Total Pembayaran:</strong></td>
                                <td align='right'><strong>Rp. " . number_format($total, 2, ',', '.') . "</strong></td>
                              </tr>";
                    } else {
                        echo "<tr><td colspan='9' align='center'>Tidak ada riwayat pembayaran</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="./assets/js/bootstrap.min.js"></script>

<?php include "footer_siswa.php"; ?>
