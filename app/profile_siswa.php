<?php
    session_start();
    if (!isset($_SESSION['id']) || $_SESSION['id'] == "") {
        header('location:../login.php');
        exit();
    }

    include "inc/koneksi.php";

    // Menggunakan prepared statement
    $stmt = $konek->prepare("SELECT tb_siswa.*, tb_kelas.nama_kelas, tb_kelas.kompetensi_keahlian
                             FROM tb_siswa
                             INNER JOIN tb_kelas ON tb_kelas.id_kelas = tb_siswa.id_kelas
                             WHERE tb_siswa.nisn = ?");
                             
    $stmt->bind_param("s", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $profil = $result->fetch_assoc();
    } else {
        die("Data siswa tidak ditemukan.");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/favicon.png">
 
    <title>Pembayaran SPP SMK Patama Mulya Karawang - SISWA</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/style.css" rel="stylesheet">

     <style type="text/css">
        body{
        background-image: url(assets/img/bg-1.jpg);
        background-size: cover;
      }
      a{
        color: white;
      }
      td{
        font-weight: bold;
      }


    .container1 {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    width: 100%;
    }

    .container-profile {
    max-width: 600px;
    background: white;
    padding: 70px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    margin-top: 70px;
    }

        .profile-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            margin-bottom: 5px;
        }
        .table-profile {
            width: 100%;
            margin-top: 15spx;
        }
        @media (max-width: 768px) {
            .navbar-header {
                text-align: center;
            }
            
            .container-profile {
                width: 90%;
            }
        }
    </style>
</head>
<body>
     <nav class="navbar navbar-default navbar-fixed-top" style="border-radius: 0px 0px 40px 40px; border-color: black; background-color:  #267365;">
      <div class="container">
        <div class="navbar-header" style="margin-top: 2%;">
            <a class="navbar-brand" style="color: white; text-align: center;" href="index_siswa.php">HALLO.. <?php echo $profil['nama']; ?></a>
        </div>
        <div style="margin-top: 2%; margin-bottom: 1%;">
         <ul class="nav nav-pills" role="tablist">
            <li role="presentation"><a href="riwayat_siswa.php">History Pembayaran</a></li>
            <li role="presentation"><a href="profile_siswa.php" style="background-color: #F23030; border-radius: 50px;">Profile</a></li>
            <li role="presentation"><a href="inc/logout.php">Keluar</a></li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<!-- Konten Profil -->
<center>
<div class="container1">
    <div class="container-profile">
        <img src="assets/img/logo-1.png" class="profile-image">
        <h3><?php echo htmlspecialchars($profil['nama']); ?></h3>
        <table class="table table-profile">
            <tr>
                <td><strong>NISN</strong></td>
                <td>:</td>
                <td><?php echo htmlspecialchars($profil['nisn']); ?></td>
            </tr>
            <tr>
                <td><strong>NIS</strong></td>
                <td>:</td>
                <td><?php echo htmlspecialchars($profil['nis']); ?></td>
            </tr>
            <tr>
                <td><strong>Kelas</strong></td>
                <td>:</td>
                <td><?php echo htmlspecialchars($profil['nama_kelas']) . " - " . htmlspecialchars($profil['kompetensi_keahlian']); ?></td>
            </tr>
            <tr>
                <td><strong>Alamat</strong></td>
                <td>:</td>
                <td><?php echo htmlspecialchars($profil['alamat']); ?></td>
            </tr>
            <tr>
                <td><strong>Telepon</strong></td>
                <td>:</td>
                <td><?php echo htmlspecialchars($profil['no_hp']); ?></td>
            </tr>
        </table>
    </div>
</div>
</center>

<script src="./assets/js/bootstrap.min.js"></script>

<?php include "footer_siswa.php"; ?>
